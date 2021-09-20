<?php

namespace App\Services;

use App\Services\DateService;
use App\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    private $dateService;
    private $payment;

    public function __construct(DateService $dateService, Payment $payment)
    {
        $this->dateService = $dateService;
        $this->payment = $payment;
    }

    /**
     * 基準日からデータを算出する期間を返す
     * @param Carbon $baseDate
     * @return array
     */
    public function getPeriodByBaseDate($baseDate)
    {
        $startDate = $baseDate->copy()->format('Y-m-d 00:00:00');
        $endDate = $baseDate->copy()->addMonth()->subDay()->format('Y-m-d 23:59:59');

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }

    /**
     * 基準日を取得
     * （ここで欲しいのは、
     * パラメータ値なしで今日が8/1なら7/15のCarbon、パラメータありで値が7/1なら6/15のCarbon、パラメータありで値が7/18なら7/15のCarbon）
     * @return Carbon
     */
    public function getBaseDate($monthlyStartDate, $dateData)
    {
        if (empty($dateData)) {
            $targetDate = $this->dateService->getDate($monthlyStartDate);
            if ($this->dateService->getToday()->lt($targetDate)) {
                $baseDate = $this->dateService->getToday()->copy()->subMonth()->day($monthlyStartDate);
            } else {
                $baseDate = $targetDate->copy();
            }
        } else {
            $targetDate = $this->dateService->getDate($monthlyStartDate, $dateData['year'], $dateData['month']);
            $date = $this->dateService->getDate($dateData['day'], $dateData['year'], $dateData['month']);
            if ($date->lt($targetDate)) {
                $baseDate = $targetDate->copy()->subMonth()->day($monthlyStartDate);
            } else {
                $baseDate = $targetDate->copy();
            }
        }

        return $baseDate;
    }

    /**
     * 日付でまとめて返す
     */
    public function convertGroupByPaymentDate($payments)
    {
        if ($payments->isEmpty()) {
            return $payments;
        }

        return $payments->groupby('payment_date');
    }

    /**
     * 月ごとの貯金額を返す
     * @param array $params [
     *   'user_id' => '',
     *   'monthly_start_date' => '',
     * ]
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getMonthlySaveAmounts($params)
    {
        // TODO:最初と最後のpayment取得してその差分の月数分ループしてDBからデータ取得する
        // データ取得したらさらにループさせて配列に貯金額を格納
        // [
        //     [
        //         'save_amount' => '',
        //         'month' => '2021年8月',
        //         'start_date' => '2021-08-15',
        //         'end_date' => '2021-09-14',
        //     ],
        //     [
        //         //
        //     ],
        // ]

        // ユーザが登録した最初と最後のデータを取得
        $firstPayment = $this->payment->getFirstPaymentByUser(Auth::user());
        $lastPayment = $this->payment->getLastPaymentByUser(Auth::user());
        \Debugbar::info($firstPayment->payment_date);
        \Debugbar::info($lastPayment->payment_date);

        if (!$firstPayment && !$lastPayment) {
            return [];
        }

        $paymentDate = $this->dateService->getDateByDate($firstPayment->payment_date);
        $period = $this->getPeriodByBaseDate($this->getBaseDate($params['monthly_start_date'], [
            'year' => $this->dateService->getYear($paymentDate),
            'month' => $this->dateService->getMonth($paymentDate),
            'day' => $this->dateService->getDay($paymentDate),
        ]));

        // Carbonに変換
        $period['start_date'] = $this->dateService->getDateByDate($period['start_date'], true);
        $period['end_date'] = $this->dateService->getDateByDate($period['end_date'], true);

        \Debugbar::info($period);
        $months = $this->getNumberOfMonthsToCalculate($firstPayment, $lastPayment, $params['monthly_start_date']);
        $saveAmounts = [];
        for ($i = 1; $i <= $months; $i++) {
            $saveAmounts[] = [
                'save_amount' => $this->getSaveAmountByPaymentTotalAmounts(
                    $this->payment->gePaymentTotalAmountByPeriod(
                        Auth::user(),
                        $period['start_date']->format('Y-m-d H:i:s'),
                        $period['end_date']->format('Y-m-d H:i:s')
                    )
                ),
                'start_date' => $period['start_date']->format('Y-m-d H:i:s'),
                'end_date' => $period['end_date']->format('Y-m-d H:i:s'),
            ];

            // 日付あふれを許可せずに一月進める
            $period['start_date']->addMonthNoOverflow();
            $period['end_date']->addMonthNoOverflow();
        }
        \Debugbar::info($saveAmounts);
    }

    // private -----------------------------------------------------------------------

    /**
     * 算出する月数を返す
     */
    private function getNumberOfMonthsToCalculate($firstPayment, $lastPayment, $monthlyStartDate)
    {
        $firstPaymentDate = $this->dateService->getDateByDate($firstPayment->payment_date);
        $lastPaymentDate = $this->dateService->getDateByDate($lastPayment->payment_date);
        if ($this->dateService->getDay($firstPaymentDate) < $monthlyStartDate) {
            $firstPaymentDate = $this->dateService->getSubMonthByNumber($firstPaymentDate, 1);
        }
        if ($this->dateService->getDay($lastPaymentDate) < $monthlyStartDate) {
            $lastPaymentDate = $this->dateService->getSubMonthByNumber($lastPaymentDate, 1);
        }

        // 月の差分を出すため、日付を1日に変更
        $firstPaymentDate->day(1);
        $lastPaymentDate->day(1);

        \Debugbar::info($firstPaymentDate);
        \Debugbar::info($lastPaymentDate);

        return $firstPaymentDate->diffInMonths($lastPaymentDate) + 1;
    }

    /**
     * 収入の合計 - 支出の合計を算出して貯金額を返す
     * @return int
     */
    private function getSaveAmountByPaymentTotalAmounts($payments)
    {
        if ($payments->isEmpty()) {
            return 0;
        }

        $totalExpenseAmount = 0;
        $totalIncomeAmount = 0;
        foreach ($payments as $val) {
            if ($val->type == \PaymentConst::TYPE_EXPENSE) {
                $totalExpenseAmount = $val->sum_amount;
            } elseif ($val->type == \PaymentConst::TYPE_INCOME) {
                $totalIncomeAmount = $val->sum_amount;
            }
        }

        return $totalIncomeAmount - $totalExpenseAmount;
    }
}
