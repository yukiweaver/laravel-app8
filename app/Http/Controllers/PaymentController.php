<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Payment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    private $category;
    private $payment;
    private $paymentService;

    public function __construct(Category $category, Payment $payment, PaymentService $paymentService)
    {
        $this->category = $category;
        $this->payment = $payment;
        $this->paymentService = $paymentService;
    }
    /**
     * 支出 or 収入入力ページ
     */
    public function create()
    {
        $expenseCategories = $this->category->getCategoryByTypes([
            \CategoryConst::TYPE_EXPENSE,
            \CategoryConst::TYPE_EXPENSE_AND_INCOME,
        ]);
        $incomeCategories = $this->category->getCategoryByTypes([
            \CategoryConst::TYPE_INCOME,
            \CategoryConst::TYPE_EXPENSE_AND_INCOME,
        ]);
        $viewParams = [
            'expense_category_list' => $expenseCategories,
            'income_category_list' => $incomeCategories,
        ];
        return view('payment.create', $viewParams);
    }

    /**
     * 登録処理
     */
    public function store(PaymentRequest $request)
    {
        $params = $request->all();
        $params['user_id'] = Auth::id();

        try {
            $this->payment->create($params);
            return putJsonSuccess();
        } catch (\Exception $e) {
            $data = [
                'code' => 500,
                'summary' => 'Exception例外エラー',
                'errors' => [
                    'other' => $e->getMessage(),
                ],
            ];
            return putJsonError($data);
        }
    }

    /**
     * カレンダーページ
     */
    public function show(Request $request)
    {
        // TODO:初回遷移時はmonthly_start_dateからbaseDateを算出してデータを取得する必要がある
        $period = $this->paymentService->getPeriodByMonthlyStartDate(Auth::user()->monthly_start_date);
        $viewParams = [
            'monthly_start_date' => Auth::user()->monthly_start_date,
        ];
        return view('payment.show', $viewParams);
    }
}
