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
                                <label class="number" style="font-size: 120px">04</label>
                                <label class="title" style="font-size: 30px">{{ __('Describe your spacecraft') }}</label>
                            </div>

                        </div>
                        <div class="form-group col-lg-9"  id="step_4">
                            <form action="{{route('session_smallsat')}}"  method="POST">
                                @csrf
                                <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                                <div class="form-group" style="margin-left: 20%">
                                    <h2>Dimensions & masse <i class="icon-xl fa fa-info-circle"></i></h2>
                                </div>
                                <div class="form-group" style="margin-left: 30%">
                                    <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" /><br>
                                </div>
                                <div class="input-group">
                                    <div class="col-md-4">
                                        <div class="card card-custom" >
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label">Longueur (mm)</label>
                                                    <input class="form-control dimension_l" type="number" data-max="{{isset($parameters['dimension_l']) ? $parameters['dimension_l'] : ''}}" name="dimension_l" value="{{session('dimension_l') ? session('dimension_l') : ''}}">
                                                    <label class="form-label">Largeur (mm)</label>
                                                    <input class="form-control dimension_p" type="number" data-max="{{isset($parameters['dimension_p']) ? $parameters['dimension_p'] : ''}}"  name="dimension_p" value="{{session('dimension_p') ? session('dimension_p') : ''}}">
                                                    <label class="form-label">Hauteur (mm)</label>
                                                    <input class="form-control dimension_i" type="number" data-max="{{isset($parameters['dimension_i']) ? $parameters['dimension_i'] : ''}}" name="dimension_i" value="{{session('dimension_i') ? session('dimension_i') : ''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-custom " >
                                            <div class="card-body">
                                                <div class="form-group mr-2">
                                                    <img src="{{ asset('media/logos/logo-light.png') }}" style="min-height: 200px;max-width: 200px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-custom " >
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label">Mass (kg)</label>
                                                    <input class="form-control masse" data-max="{{isset($parameters['masse']) ? $parameters['masse'] : ''}}"   type="number" name="masse" value="{{session('masse') ? session('masse') : ''}}">
                                                    <label class="form-label">Maturité technique</label>
                                                    <select class="form-control maturity" name="maturity">
                                                        <option>{{ __('Choose maturity technical') }}</option>
                                                        @foreach($maturities as $maturity)
                                                            <option value="{{$maturity->id}}" {{ (session('maturity') == $maturity->id) ? 'selected' : '' }}>{{$maturity->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-group">
                                    <p class="text-danger d-none error-max">{{$parameters['text']}}</p>
                                </div>
                                <div class="form-group">
                                    <a href="{{route('step_three')}}" class="btn btn-default" ><< Prev</a>
                                </div>
                                <div class="form-group" style="float: right;margin-top: -70px">
                                    <button href="{{route('step_five',['type'=>'smallsat'])}}" class="btn btn-primary " disabled>Suivant >></button>
                                </div>
                            </form>
                        </div>
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
        var dimension_i = $('#step_4').find('.dimension_i').val();
        var dimension_p = $('#step_4').find('.dimension_p').val();
        var dimension_l = $('#step_4').find('.dimension_l').val();
        var masse = $('#step_4').find('.masse').val();
        var maturity = $('#step_4').find('.maturity').val();
        var max_dimension_i = $('#step_4').find('.dimension_i').data('max');
        var max_dimension_p = $('#step_4').find('.dimension_p').data('max');
        var max_dimension_l = $('#step_4').find('.dimension_l').data('max');
        var max_masse = $('#step_4').find('.masse').data('max');
        if(dimension_l && dimension_p && dimension_i && masse && maturity){
            $('#step_4').find('.btn-primary').removeAttr('disabled');
            if(dimension_p > max_dimension_p || dimension_l > max_dimension_l || dimension_i > max_dimension_i || masse > max_masse){
                $('#step_4').find('.error-max').removeClass('d-none');
            }else{
                $('#step_4').find('.error-max').addClass('d-none');
            }
        }
        $('#step_4').find('input').each(function(i,el){
            $(el).on('keyup',function(){
                let is_max = false;
                let max = $(this).data('max');
                let current = $(this).val();
                dimension_i = $('#step_4').find('.dimension_i').val();
                dimension_p = $('#step_4').find('.dimension_p').val();
                dimension_l = $('#step_4').find('.dimension_l').val();
                masse = $('#step_4').find('.masse').val();
                maturity = $('#step_4').find('.maturity').val();
                if(dimension_l && dimension_p && dimension_i && masse && maturity){
                    $('#step_4').find('.btn-primary').removeAttr('disabled');
                }else{
                    $('#step_4').find('.btn-primary').attr('disabled',true);
                }
                console.log('maturity',maturity)
                if(dimension_p > max_dimension_p || dimension_l > max_dimension_l || dimension_i > max_dimension_i || masse > max_masse){
                    is_max = true;
                }else{
                    is_max = false;
                }
                sessionStorage.setItem($(this).attr('name'),current);
                if(is_max){
                    $('#step_4').find('.error-max').removeClass('d-none');
                }else{
                    $('#step_4').find('.error-max').addClass('d-none');
                }
            });
        })

        $('#step_4').find('.maturity').on('change',function(){
            dimension_i = $('#step_4').find('.dimension_i').val();
            dimension_p = $('#step_4').find('.dimension_p').val();
            dimension_l = $('#step_4').find('.dimension_l').val();
            masse = $('#step_4').find('.masse').val();
            maturity = $('#step_4').find('.maturity').val();
            if(dimension_l && dimension_p && dimension_i && masse && maturity){
                $('#step_4').find('.btn-primary').removeAttr('disabled');
                if(dimension_p > max_dimension_p || dimension_l > max_dimension_l || dimension_i > max_dimension_i || masse > max_masse){
                    $('#step_4').find('.error-max').removeClass('d-none');
                }else{
                    $('#step_4').find('.error-max').addClass('d-none');
                }
            }
        })

        
    });
</script>
@endsection