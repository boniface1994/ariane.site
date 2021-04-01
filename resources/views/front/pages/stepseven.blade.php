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
                                <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" /><br>
                                <div class="form-group">
                                    <h3>{{ __('Estimate launch price') }} <span class="text-danger">*</span></h3>
                                    <label class="form-label">{{ __('With option') }}</label><br>
                                    <a>875 000 €</a><br>
                                    <label class="form-label">{{ __('Without option') }}</label><br>
                                    <a>875 000 €</a>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="input-group">
                                            <label class="form-label mr-2">{{ __('Launch due in') }}</label>
                                            <label class="radio radio-primary">
                                                <input type="radio" name="radios11" checked="checked" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <label class="form-label">5000 €</label>
                                    </div>
                                </div>
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="input-group">
                                            <label class="form-label mr-2">{{ __('Launch due in') }}</label>
                                            <label class="radio radio-primary">
                                                <input type="radio" name="radios11" checked="checked" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <label class="form-label">5000 €</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-lg-9"  id="step_5">
                            <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                            <div class="input-group">
                                <div class="card  col-md-3 mr-2 mb-2">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h4> {{ __('Spacecraft position') }}</h4>
                                            <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" />
                                        </div>
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <a> {{ __('Terms and condition standard') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-md-6 mr-2 mb-2">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h4> {{ __('Select your lunch') }}</h4>
                                            <div class="card  mr-2 mb-2">
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <a> {{ __('Terms and condition standard') }}</a>
                                                        <label class="form-label">{{ __('Launch due in') }}</label>
                                                        <div class="form-group">
                                                            <label class="form-label">Orbite : SSO</label>
                                                            <label class="form-label">altitude : 450000km</label>
                                                            <label class="form-label">inclination : 50°</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div><br>
                            
                            <div class="form-group">
                                <a href="{{route('step_three')}}" class="btn btn-default" ><< Prev</a>
                            </div>
                            <div class="form-group" style="float: right; margin-right: 175px;margin-top: -70px">
                                <a class="btn btn-primary disabled" >Suivant >></a>
                            </div>
                        </div>
                        <div id="pagination-container"></div>
                    </div>
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