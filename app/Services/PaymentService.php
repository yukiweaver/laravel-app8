<?php

namespace App\Services;

use Carbon\Carbon;

class PaymentService
{
    private $today;

    public function __construct()
    {
        $this->today = Carbon::now();
    }

    /**
     * 指定の月の開始日からデータを算出する期間を返す
     * @param int $monthlyStartDate
     * @return array
     */
    public function getPeriodByMonthlyStartDate($monthlyStartDate)
    {
        $date = $this->today->copy()->day($monthlyStartDate);
        if ($this->today->lt($date)) {
            // 今日の日付が今月の基準日より前なら先月分
            $baseDate = $this->today->copy()->subMonth()->day($monthlyStartDate);
        } else {
            // 今日の日付が今月の基準日以降なら今月分
            $baseDate = $this->today->copy()->day($monthlyStartDate);
        }

        $startDate = $baseDate->copy()->format('Y-m-d 00:00:00');
        $endDate = $baseDate->copy()->addMonth()->subDay()->format('Y-m-d 23:59:59');

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

    }
}