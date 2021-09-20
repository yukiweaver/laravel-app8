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

    /**
     * 指定の日付のCarbonインスタンスを作成し返す
     * @param string $date YYYY-MM-DD形式
     * @return Carbon
     */
    public function getDateByDate($date, $dateTimeFlg = false)
    {

        return $dateTimeFlg ?
            $this->today->copy()->createFromFormat('Y-m-d H:i:s', $date, 'Asia/Tokyo') :
            $this->today->copy()->createFromFormat('Y-m-d', $date, 'Asia/Tokyo');
    }

    /**
     * 指定のCarbonインスタンスから日付を返す
     * @param Carbon\Carbon $carbon
     * @return string
     */
    public function getDay(Carbon $carbon)
    {
        return $carbon->copy()->day;
    }

    public function getYear(Carbon $carbon)
    {
        return $carbon->copy()->year;
    }

    public function getMonth(Carbon $carbon)
    {
        return $carbon->copy()->month;
    }

    /**
     * 指定の月数分だけ減らしたCarbonを返す
     * @param Carbon\Carbon $carbon
     * @param int $number
     * @return Carbon\Carbon
     */
    public function getSubMonthByNumber(Carbon $carbon, $number)
    {
        return $carbon->copy()->subMonths($number);
    }
}
