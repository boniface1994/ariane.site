@extends('layouts.front')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
<div class="content-box">
    <div class="row">
        <div class="col-md-4 left-section">
            <div class="logo">
                <img src="{{ asset('media/logos/logo-easy.svg') }}" alt="logo easy">
            </div>
            <div class="launch-period">
                <div class="number">01</div>
                <div class="label-number">Choose your launch period</div>
            </div>
            <div class="read-more">
                <span class="text">Any questions? contact us</span>
            </div>
        </div>
        <div class="col-md-8 right-section">
            {{-- <div class="line-bar"></div> --}}
            <br><br><br><br><br><br>
            <br><br><br><br><br><br>
            <br><br><br><br><br><br>
        </div>
    </div>
</div>
@endsection