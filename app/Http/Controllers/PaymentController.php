<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class PaymentController extends Controller
{


    private $category;

    public function __construct()
    {
        $this->category = app()->make('App\Category');
    }
    /**
     * 支出 or 収入入力ページ
     */
    public function show()
    {
        $allCategory = $this->category->getCategoryAll();
        $params = [
            'categories' => $allCategory,
        ];
        return view('payment.show', $params);
    }
}
