@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" />
                            </div>
                        </div>
                        <div class="form-group col-lg-6"  >
                            <div class="input-group">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <h3 class="form-label" style="font-size: 30px"> {{ __('New on board?') }}</h3><br><br>
                                        <a href="{{route('signin')}}" class="btn btn-warning">{{ __('REGISTER') }}</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h3 class="form-label" style="font-size: 30px"> {{ __('Already have an accout?') }}</h3>
                                        <a href="{{route('beforelogin')}}" class="btn btn-warning">{{ __('SIGN IN') }}</a>
                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <div class="col-lg-3">
                        </div>
                    </div>
                    <a href="{{route('step_seven')}}"> <label class="form-label"><-Back</label></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {
        
    });
</script>
@endsection