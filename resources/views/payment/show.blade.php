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
            :monthly-start-date='@json($monthly_start_date)'
            :payments='@json($payments)'
            :categories='@json($categories)'
            >
            </show>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection