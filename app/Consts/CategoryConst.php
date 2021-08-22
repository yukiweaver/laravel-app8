<?php

namespace App\Consts;

class CategoryConst
{
    const IMG_PATH = 'storage/';

    const TYPE_EXPENSE = 1;
    const TYPE_INCOME = 2;
    const TYPE_EXPENSE_AND_INCOME = 3;

    const CATEGORY_COLORS = [
        '食費' => 'rgb(255, 99, 132, 0.7)',
        '日用品' => 'rgb(54, 162, 235, 0.7)',
        '衣服' => 'rgb(255, 205, 86, 0.7)',
        '美容' => 'rgb(255, 215, 255, 0.7)',
        '交際費' => 'rgb(255, 154, 227, 0.7)',
        '医療費' => 'rgb(185, 246, 243, 0.7)',
        '教育費' => 'rgb(47, 93, 226, 0.7)',
        '光熱費' => 'rgb(238, 163, 0, 0.7)',
        '交通費' => 'rgb(54, 146, 0, 0.7)',
        '通信費' => 'rgb(37, 0, 45, 0.7)',
        '住居費' => 'rgb(37, 0, 119, 0.7)',
        'その他' => 'rgb(192, 76, 119, 0.7)',
    ];
}
