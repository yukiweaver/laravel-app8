<?php

namespace App\Services;

use App\Services\DateService;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    private $dateService;

    public function __construct(DateService $dateService)
    {
        $this->dateService = $dateService;
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
     * 算出に用いる基準となる日時データを取得
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

            return $baseDate;
        }

        $targetDate = $this->dateService->getDate($monthlyStartDate, $dateData['year'], $dateData['month']);
        $date = $this->dateService->getDate($dateData['day'], $dateData['year'], $dateData['month']);
        if ($date->lt($targetDate)) {
            $baseDate = $targetDate->copy()->subMonth()->day($monthlyStartDate);
        } else {
            $baseDate = $targetDate->copy();
        }

        return $baseDate;
    }
}
