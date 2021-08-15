@extends('app')

@section('title', 'グラフ')

@section('content')
@include('nav')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h2 class="h3 card-title text-center mt-2">グラフ</h2>
                    <graph></graph>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection