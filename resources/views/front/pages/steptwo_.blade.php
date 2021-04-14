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
                <div class="number">02</div>
                <div class="label-number" style="font-size: 18px;">Where do you need to send your spacecraft?</div>
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
              <h2 class="font-weight-bolder">Type of orbite</h2>
              <div class="content">
                <label class="card-box">
                    <div class="card-title">SSE</div>
                    <input type="radio" name="q4" id="">
                </label>
                <label class="card-box">
                    <div class="card-title">LEO</div>
                    <input type="radio" name="q4" id="">
                </label>
                <label class="card-box">
                    <div class="card-title">POLAR</div>
                    <input type="radio" name="q4" id="">
                </label>
              </div>
              <h2 class="font-weight-bolder">{{ __('Altitude') }} <span class="text-danger">*</span></h2>
              <div class="range">
                <input type="text" class="js-range-slider" name="my_range" value=""
                  data-type="double"
                  data-min="0"
                  data-max="1000"
                  data-from="200"
                  data-to="500"
                  data-grid="true"
                  data-skin="round"
                />
              </div>
              <h2 class="font-weight-bolder mt-5">{{ __('Inclination') }} <span class="text-danger">*</span></h2>
              <div class="range">
                <input type="text" class="js-range-slider" name="my_range" value=""
                  data-type="double"
                  data-min="0"
                  data-max="1000"
                  data-from="200"
                  data-to="700"
                  data-grid="true"
                  data-skin="round"
                />
              </div>
              <h2 class="font-weight-bolder mt-5">{{ __('Local time') }} <span class="text-danger">*</span></h2>
              <div class="form-group row width-90">
                <label class="col-form-label mr-3 mt-2">{{ __('Between') }}</label>
                <div class="col-9 col-form-label d-flex flex-wrap row">
                    <div class="col-lg-3 col-md-9 col-sm-12 mr-6 row">
                        
                        <input type="time" class="local_start form-control form-control-solid" name="local_start" value="{{ session('local_start') ? session('local_start') : '' }}" />
                    </div>
                    <label class="col-form-label mr-3 mt-2">{{ __('and') }}</label>
                    <div class="col-lg-3 col-md-9 col-sm-12 mr-6 row">
                        <input type="time" class="local_end form-control form-control-solid" name="local_end" value="{{ session('local_end') ? session('local_end') : '' }}" />
                    </div>
                    <div class="checkbox-inline">
                        <label class="checkbox checkbox-warning">
                            <input class="local_time_type ltan" type="checkbox" {{ session('ltan') ? 'checked' : '' }} />
                            <input type="hidden" name="ltan" value="{{session('ltan') ? session('ltan') : 0 }}">
                            <span></span>
                            {{ __('LTAN') }}
                        </label>
                        <label class="checkbox checkbox-warning">
                            <input class="local_time_type ltdn" type="checkbox" {{ session('ltdn') ? 'checked' : '' }}/>
                            <input type="hidden" name="ltdn" value="{{session('ltan') ? session('ltan') : 0 }}">
                            <span></span>
                            {{ __('LTDN') }}
                        </label>
                    </div>
                </div>
              </div>
              <h2 class="font-weight-bolder mt-5">{{ __('Your constraint') }}</h2>
              <div class="form-group row width-90">
                <textarea class="form-control constraint" name="constraint" placeholder="Consectetur sit iaculis iaculis ullamcorper...">{{session('constraint') ? session('constraint') : '' }}</textarea>
              </div>
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