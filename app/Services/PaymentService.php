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
    public function getSaveAmounts($params)
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
        $firstPayment = $this->payment->getFirstPaymentByUser(Auth::user());
        $lastPayment = $this->payment->getLastPaymentByUser(Auth::user());
    }
}
