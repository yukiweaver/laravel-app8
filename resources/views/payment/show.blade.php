@extends('app')

@section('title', '入力')

@section('content')
@include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">入力</h2>

            @include('error_card_list')

            <div class="card-text">
                <form>
                    <!-- 日付 -->
                    <div class="form-outline mb-4 text-left">
                        <label class="form-label" for="payment_date">日付</label>
                        <input type="date" id="payment_date" class="form-control" />
                    </div>
                    
                    <!-- メモ -->
                    <div class="form-outline mb-4 text-left">
                        <label class="form-label" for="memo">メモ</label>
                        <input type="email" id="memo" class="form-control" />
                    </div>
                  
                    <!-- 支出額 -->
                    <div class="form-outline mb-4 text-left">
                        <label class="form-label" for="expense">支出額</label>
                        <input type="password" id="expense" class="form-control" type="number" />
                    </div>

                    <!-- カテゴリー -->
                    <div class="form-outline mb-4 text-left">
                        <label class="form-label" for="expense">カテゴリー</label>
                    </div>
                    <div class="sample-form">
                        @foreach ($categories as $category)
                        <div class="categories">
                            <input id="{{ $category->id }}" type="radio" value="{{ $category->id }}" name="category_id">
                            <label for="{{ $category->id }}"><img src="{{ asset('storage/' . $category->img) }}" width="60" height="60"></label>
                            <p>{{ $category->name }}</p>
                        </div>
                        @endforeach
                    </div>
                  
                    <button type="submit" class="btn btn-primary btn-block mb-4">支出を登録する</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
