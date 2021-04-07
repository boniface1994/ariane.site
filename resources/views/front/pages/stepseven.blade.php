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
                                    <a>{{$tarifs}} €</a><br>
                                    <label class="form-label">{{ __('Without option') }}</label><br>
                                    <a>{{$tarifs}} €</a>
                                </div>
                                @if(count($options)>0)
                                @foreach($options as $option)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="input-group">
                                            <h5 class="form-label mr-2">{{ $option->name }}</h5>
                                            <label class="checkbox checkbox-primary">
                                                <input type="checkbox" name="radios11" checked="checked" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <label class="form-label">{{$option->cost}} €</label>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                <!-- <div class="card ">
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
                                </div> -->
                            </div>

                        </div>
                        <div class="form-group col-lg-9"  id="step_5">
                            <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                            <div class="input-group">
                                <div class="col-md-3 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <h4> {{ __('Spacecraft position') }}</h4>
                                                <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" />
                                            </div>
                                            <div class="card ">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <a href="{{asset('upload/'.$document)}}" target="_blank" > {{ __('Terms and condition standard') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <h4> {{ __('Select your lunch') }}</h4>
                                                @foreach($opportunities as $opportunity)
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="input-group">
                                                                    <h5 class="form-label mr-2"> [{{ $opportunity->name }}]</h5>
                                                                    <h5 class="form-label mr-2">{{ __('Launch due in') }}<br> [{{$opportunity->month.' / '.$opportunity->year}}]</h5>
                                                                    <div class="form-group">
                                                                        <h5 class="form-label">Orbite : {{session('sso') ? 'SSO' : ''}} {{session('leo') ? 'LEO' : ''}}</h5><br>
                                                                        <h5 class="form-label">altitude : {{$opportunity->altitude}} km</h5><br>
                                                                        <h5 class="form-label">inclination : {{$opportunity->inclination}} °</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            
                            <div class="form-group">
                                <a href="{{route('step_five',['type'=>session('space_type')])}}" class="btn btn-default" ><< Prev</a>
                            </div>
                            <div class="form-group" style="float: right; margin-right: 175px;margin-top: -70px">
                                <!-- <a class="btn btn-primary disabled" >Suivant >></a> -->
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