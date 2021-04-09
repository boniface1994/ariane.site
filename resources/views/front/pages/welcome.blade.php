@extends('layouts.front')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
<div class="content-box">
    <div class="row">
        <section class="col-md-4 left-section">
            <div class="logo">
                <img src="{{ asset('media/logos/logo-easy.svg') }}" alt="logo easy">
            </div>
            <div class="launch-period">
                <div class="number">01</div>
                <div class="label-number">Choose your launch period</div>
            </div>
            <div class="read-more">
                <span class="text">Any questions? contact us</span>
                <span><img src="{{ asset('media/svg/icons/Navigation/Vector.svg') }}" alt="contact us"></span>
            </div>
            <ul class="pagination">
              <li class="number active" style="top: 207px">01</li>  
              <li class="number" style="top: 247px">02</li>  
              <li class="number" style="top: 287px">03</li>  
              <li class="number" style="top: 327px">04</li>  
              <li class="number" style="top: 367px">05</li>  
            </ul>
        </section>
        <section class="col-md-8 right-section">
            {{-- <div class="line-bar"></div> --}}
            <div class="book-your-launch">BOOK YOUR LAUNCH</div>
            <button class="close"><img src="{{ asset('media/svg/icons/Navigation/Cross.svg') }}" alt="close"></button>
            <div class="container-box">
                <div class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </div>
                <div class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </div>
                <div class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </div>
                <div class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </div>
                <div class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </div>
                <div class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </div>
                <div class="page-nav">
                    <div class="prev">
                        <span class="icon"><img src="{{ asset('media/svg/icons/Navigation/Vector-left.svg') }}" alt="previous"></span>
                        <span>Q3.2021</span>
                    </div>
                    <div class="next">
                        <span>Q2.2022</span>
                        <span class="icon"><img src="{{ asset('media/svg/icons/Navigation/Vector-right.svg') }}" alt="next"></span>
                    </div>
                </div>
            </div>
            <button class="btn next-btn">Continue</button>
        </section>
    </div>
</div>
@endsection