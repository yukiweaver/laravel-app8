<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;

class Payment extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'amount',
        'type',
        'memo',
        'payment_date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * 登録
     */
    public function create($params)
    {
        $this->fill([
            'category_id' => $params['category_id'],
            'user_id' => $params['user_id'],
            'amount' => $params['amount'],
            'type' => $params['type'],
            'memo' => $params['memo'],
            'payment_date' => $params['payment_date'],
        ]);

        return $this->save();
    }

    /**
     * 指定期間の支出、収入データを取得
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getPaymentsByPeriod($userId, $startDate, $endDate)
    {
        $payments = $this->where('user_id', '=', $userId)
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->orderBy('payment_date', 'DESC')
            ->get();

        return $payments;
    }

    /**
     * 指定期間の支出の合計をカテゴリー別で取得
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getTotalExpenseAmountGroupCategory($userId, $startDate, $endDate)
    {
        $query = $this->query();
        return $query
            ->select(
                DB::raw('(sum(payments.amount)) as total_amount'),
                DB::raw('payments.category_id'),
                DB::raw('categories.name')
            )
            ->join('categories', 'payments.category_id', '=', 'categories.id')
            ->where([
                ['payments.user_id', '=', $userId],
                ['payments.type', '=', \PaymentConst::TYPE_EXPENSE],
            ])
            ->whereBetween('payments.payment_date', [$startDate, $endDate])
            ->orderBy('payments.category_id', 'ASC')
            ->groupBy(DB::raw('payments.category_id, categories.name'))
            ->get();
    }

    /**
     * 指定のidでデータ取得
     */
    public function getPaymentById($id)
    {
        return $this->findOrFail($id);
    }

    /**
     * 指定ユーザの最初の帳簿データを1件返す
     * @param App\User $user
     * @return App\Payment
     */
    public function getFirstPaymentByUser(User $user)
    {
        return $user->payments()->orderBy('payment_date', 'ASC')->first();
    }

    /**
     * 指定ユーザの最後の帳簿データを1件返す
     * @param App\User $user
     * @return App\Payment
     */
    public function getLastPaymentByUser(User $user)
    {
        return $user->payments()->orderBy('payment_date', 'DESC')->first();
    }
}
