<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $category;
    private $payment;

    public function __construct(Category $category, Payment $payment)
    {
        $this->category = $category;
        $this->payment = $payment;
    }
    /**
     * 支出 or 収入入力ページ
     */
    public function show()
    {
        $allCategory = $this->category->getCategoryAll();
        $viewParams = [
            'category_list' => $allCategory,
        ];
        return view('payment.show', $viewParams);
    }

    /**
     * 登録処理
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $params['user_id'] = Auth::id();

        try {
            $this->payment->create($params);
            return putJsonSuccess();
        } catch (\Exception $e) {
            return putJsonError(['message' => $e->getMessage()]);
        }
    }
}