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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
