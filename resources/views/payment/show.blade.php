@extends('app')

@section('title', '入力')

@section('content')
@include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">カレンダー</h2>
            <show
            :payments='@json($payments)'
            :categories='@json($categories)'
            :base-date='@json($base_date)'
            :start-date='@json($start_date)'
            :end-date='@json($end_date)'
            show-path={{ route('payment.show') }}
            :payment-expense-type='@json(\PaymentConst::TYPE_EXPENSE)'
            :payment-income-type='@json(\PaymentConst::TYPE_INCOME)'
            :expense-category-list='@json($expense_category_list)'
            :income-category-list='@json($income_category_list)'
            :img-path='@json(asset(\CategoryConst::IMG_PATH))'
            store-path={{ route('payment.store') }}
            >
            </show>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection