<?php

namespace App\Services;

use Carbon\Carbon;

class DateService
{

    private $today;

    public function __construct()
    {
        $this->today = Carbon::now();
    }

    public function getToday()
    {
        return $this->today;
    }

    /**
     * 渡された引数からCarbonインスタンスを作成し、返す
     */
    public function getDate($day, $year = null, $month = null)
    {
        if (!isset($year) && !isset($month)) {
            // 今月の特定の日付で返す
            return $this->today->copy()->day($day);
        }

        return $this->today->copy()->year($year)->month($month)->day($day);
    }
}
