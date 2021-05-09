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
                        <!-- 食費 -->
                        <div class="categories">
                            <input id="image_a" type="radio" value="image_a.jpg" name="image">
                            <label for="image_a"><img src="{{ asset('storage/fork_spoon.png') }}" width="60" height="60"></label>
                            <p>食費</p>
                        </div>
                        <!-- 日用品 -->
                        <div class="categories">
                            <input id="image_b" type="radio" value="image_b.jpg" name="image">
                            <label for="image_b"><img src="{{ asset('storage/senzai_syokki.png') }}" width="60" height="60"></label>
                            <p>日用品</p>
                        </div>
                        <!-- 衣服 -->
                        <div class="categories">
                            <input id="image_c" type="radio" value="image_c.png" name="image">
                            <label for="image_c"><img src="{{ asset('storage/cloth_longt.png') }}" width="60" height="60"></label>
                            <p>衣服</p>
                        </div>
                        <!-- 美容 -->
                        <div class="categories">
                            <input id="image_d" type="radio" value="image_d.png" name="image">
                            <label for="image_d"><img src="{{ asset('storage/makeup_lipgloss.png') }}" width="60" height="60"></label>
                            <p>美容</p>
                        </div>
                        <!-- 交際費 -->
                        <input id="image_e" type="radio" value="image_e.png" name="image">
                        <label for="image_e"><img src="{{ asset('storage/beer_kanpai.png') }}" width="60" height="60"></label>
                        <!-- 医療費 -->
                        <input id="image_f" type="radio" value="image_f.png" name="image">
                        <label for="image_f"><img src="{{ asset('storage/iryou_kusuribako2.png') }}" width="60" height="60"></label>
                        <!-- 教育費 -->
                        <input id="image_g" type="radio" value="image_g.png" name="image">
                        <label for="image_g"><img src="{{ asset('storage/bunbougu_note.png') }}" width="60" height="60"></label>
                        <!-- 光熱費 -->
                        <input id="image_h" type="radio" value="image_h.png" name="image">
                        <label for="image_h"><img src="{{ asset('storage/mizu_suidou_tareru.png') }}" width="60" height="60"></label>
                        <!-- 交通費 -->
                        <input id="image_i" type="radio" value="image_i.png" name="image">
                        <label for="image_i"><img src="{{ asset('storage/train_ic_card.png') }}" width="60" height="60"></label>
                        <!-- 通信費 -->
                        <input id="image_j" type="radio" value="image_j.png" name="image">
                        <label for="image_j"><img src="{{ asset('storage/kaden_wifi_router.png') }}" width="60" height="60"></label>
                        <!-- 住居費 -->
                        <input id="image_k" type="radio" value="image_k.png" name="image">
                        <label for="image_k"><img src="{{ asset('storage/house_1f.png') }}" width="60" height="60"></label>
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
