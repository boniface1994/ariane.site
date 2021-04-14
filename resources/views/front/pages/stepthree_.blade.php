@extends('layouts.front')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
<link rel="stylesheet" href="{{ asset('css/icons.css') }}">
@endsection

@section('content')
<div class="content-box">
    <div class="row">
        <section class="col-md-4 left-section">
            <div class="logo">
                <img src="{{ asset('media/logos/logo-easy.svg') }}" alt="logo easy">
            </div>
            <div class="launch-period">
                <div class="number">03</div>
                <div class="label-number" style="font-size: 18px;">Choose your spacecraft</div>
            </div>
            <div class="read-more">
                <span class="text">Any questions? contact us</span>
                <span class="ico ico-vector-bl"></span>
            </div>
            <ul class="pagination">
              <li class="number active" style="top: 50%">01</li>  
              <li class="number" style="top: 70%">02</li>  
              <li class="number" style="top: 90%">03</li>  
              <li class="number" style="top: 110%">04</li>  
              <li class="number" style="top: 130%">05</li>  
            </ul>
        </section>
        <section class="col-md-8 right-section">
            {{-- <div class="line-bar"></div> --}}
            <div class="book-your-launch">BOOK YOUR LAUNCH</div>
            <button class="close"><span class="ico ico-cross"></span></button>
            <div class="container-box">
              <label class="card-box card-img">
                <img src="{{ asset('media/tmp/tmp1.svg') }}">
                <input type="radio" name="q4" id="">
                <span class="card-desc">CUBESAT</span>
              </label>
              <label class="card-box card-img disabled">
                <img src="{{ asset('media/tmp/tmp2.svg') }}">
                <input type="radio" name="q4" id="" disabled>
                <span class="card-desc">SMALLSAT</span>
              </label>
            </div>
            <button class="btn-back">
              <span class="ico ico-vector-l"></span>
              <span>BACK</span>
            </button>
            <button class="btn next-btn btn-active">Continue</button>
          </section>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.card-box input[type="radio"]').on('change', function() {
                $('.card-box').removeClass('active');
                $(this).parent().addClass('active');
            })
            $(".js-range-slider").ionRangeSlider();
        })
    </script>
@endsection