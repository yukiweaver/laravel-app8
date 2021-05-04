<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * 支出 or 収入入力ページ
     */
    public function show()
    {
        return view('payment.show');
    }
}
