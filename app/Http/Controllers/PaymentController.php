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
        // $requestからは今日の年、月、日をそれぞれ別でもらう、そしてDBの値monthly_start_dateと比較して基準日を決定する。
        $monthlyStartDate = Auth::user()->monthly_start_date;
        $baseDate = $this->paymentService->getBaseDate($monthlyStartDate, $request->all());
        $period = $this->paymentService->getPeriodByBaseDate($baseDate);
        $payments = $this->payment->getPaymentsByPeriod(Auth::user()->id, $period['start_date'], $period['end_date']);
        $payments = $this->paymentService->convertGroupByPaymentDate($payments);
        $categories = $this->category->getCategoryAll();
        $expenseCategories = $this->category->getCategoryByTypes([
            \CategoryConst::TYPE_EXPENSE,
            \CategoryConst::TYPE_EXPENSE_AND_INCOME,
        ]);
        $incomeCategories = $this->category->getCategoryByTypes([
            \CategoryConst::TYPE_INCOME,
            \CategoryConst::TYPE_EXPENSE_AND_INCOME,
        ]);
        $params = [
            'payments' => $payments,
            'categories' => $categories,
            'base_date' => $baseDate->copy()->format('Y-m-d H:i:s'),
            'start_date' => $period['start_date'],
            'end_date' => $period['end_date'],
            'expense_category_list' => $expenseCategories,
            'income_category_list' => $incomeCategories,
        ];
        if (empty($request->all())) {
            return view('payment.show', $params);
        } else {
            return putJsonSuccess($params);
        }
    }

    /**
     * 更新処理
     */
    public function update(PaymentRequest $request)
    {
        try {
            $payment = $this->payment->getPaymentById($request->id);
            $payment->fill($request->all())->save();
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
     * グラフページ
     */
    public function graph()
    {
        return view('payment.graph');
    }
}
