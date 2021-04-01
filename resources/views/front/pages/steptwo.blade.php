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
                                <label class="number" style="font-size: 120px">02</label>
                                <label class="title" style="font-size: 30px">{{ __('Describe your spacecraft') }}</label>
                            </div>
                        </div>
                            <div class="form-group col-lg-9 justify-content-center"  id="orbite">
                                <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                                <div class="input-group">
                                    @foreach($orbites as $orbite)
                                    <div class="card card-custom col-md-3 mr-2 mb-2 orbite" data-id="{{$orbite->id}}" data-url="{{route('parameter',['orbite_id'=>$orbite->id])}}">
                                        <div class="card-body">
                                            <div class="input-group">
                                                <h4 class="">
                                                    {{ $orbite->name }}
                                                </h4>
                                                <input class="orbite-type" type="hidden" name="orbite" value="{{$orbite->orbit_sso}}">
                                            </div>
                                            <i class="icon-xl fa fa-info-circle" title="{{$orbite->explication}}" style="margin-top: -40px;float: right;margin-right: -37px"></i>
                                            <input type="radio" name="orbite_type" class="d-none radio">
                                        </div>
                                        @foreach($orbite->parameters as $parameter)
                                            @if($parameter->type == 'altitude')
                                                <div class="d-none parameter {{$parameter->type}}">
                                                    <input type="text" class="start" name="min_alt" value="{{$parameter->start}}">
                                                    <input type="text" class="end" name="max_alt" value="{{$parameter->end}}">
                                                    <input type="text" class="jump" name="step_alt" value="{{$parameter->jump}}">
                                                </div>
                                            @endif
                                            @if($parameter->type == 'inclination')
                                                <div class="d-none parameter {{$parameter->type}}">
                                                    <input type="text" class="start" name="min_in" value="{{$parameter->start}}">
                                                    <input type="text" class="end" name="max_inc" value="{{$parameter->end}}">
                                                    <input type="text" class="jump" name="step_inc" value="{{$parameter->jump}}">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div><br>
                                <div class="orb-altitude ml-2 d-none">
                                    <div class="form-group row ">
                                        <h3 class="form-label">{{ __('Altitude') }} <span class="text-danger">*</span></h3>
                                    </div>
                                    <div class="form-group row  mb-13">
                                        <div class="col-lg-8 col-md-9 col-sm-12">
                                            <div class="ion-range-slider">
                                                <input type="hidden" id="altitude" data-step="0" data-type="double" data-min="0"data-max="1000" data-from="0" data-to="0" data-grid="true"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="orb-inclination ml-2 d-none">
                                    <div class="form-group row ">
                                        <h3 class="form-label">{{ __('Inclination') }} <span class="text-danger">*</span></h3>
                                    </div>
                                    <div class="form-group row  mb-13">
                                        <div class="col-lg-8 col-md-9 col-sm-12">
                                            <div class="ion-range-slider">
                                                <input type="hidden" id="inclination" data-step="0" data-type="double" data-min="0"data-max="1000" data-from="0" data-to="0" data-grid="true"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="local-time ml-2 d-none">
                                    <div class="form-group row">
                                        <h3 class="form-label">{{ __('Local time') }} <span class="text-danger">*</span></h3>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label mr-3 mt-2">{{ __('Between') }}</label>
                                        <div class="col-9 col-form-label d-flex flex-wrap row">
                                            <div class="col-lg-3 col-md-9 col-sm-12 mr-6 row">
                                                
                                                <input type="time" class="local_start form-control form-control-solid" name="local_start"/>
                                            </div>
                                            <label class="col-form-label mr-3 mt-2">{{ __('and') }}</label>
                                            <div class="col-lg-3 col-md-9 col-sm-12 mr-6 row">
                                                <input type="time" class="local_end form-control form-control-solid" name="local_end"/>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label class="checkbox checkbox-primary">
                                                    <input class="local_time_type ltan" type="checkbox" name="time"/>
                                                    <span></span>
                                                    {{ __('LTAN') }}
                                                </label>
                                                <label class="checkbox checkbox-primary">
                                                    <input class="local_time_type ltdn" type="checkbox" name="time"/>
                                                    <span></span>
                                                    {{ __('LTDN') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment ml-2">
                                    <div class="form-group row">
                                        <h3 class="form-label">{{ __('Your constraint') }} </h3>
                                    </div>
                                    <div class="form-group row">
                                        <input class="form-control" type="text" name="constraint">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <a href="{{route('step_one')}}" class="btn btn-default "><< Prev</a>
                                    <a href="{{route('step_three')}}" class="btn btn-primary disabled" style="float: right;">Next >></a>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('#orbite').find('.orbite').each(function(i,el){
            $(el).on('click',function(){
                let url = $(this).data('url');
                let id = $(this).data('id');
                var type = $(this).find('.orbite-type').val();
                if(type == 1){
                    $('#orbite').find('.local-time').removeClass('d-none');
                }else{
                    $('#orbite').find('.local-time').addClass('d-none');
                }
                sessionStorage.setItem('id',id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response){
                        if(response){
                            $('#orbite').find('#altitude').ionRangeSlider();
                            $('#orbite').find('#inclination').ionRangeSlider();

                            let lat = $('#altitude').data('ionRangeSlider');
                            let inc = $('#inclination').data('ionRangeSlider');
                            let min_alt =0;
                            var max_alt = 0;
                            var step_alt = 0;
                            var min_inc = 0;
                            var max_inc = 0;
                            var step_inc = 0;
                            var altitudes = [];
                            var inclinations = [];
                            sessionStorage.setItem('min_alt','');
                            sessionStorage.setItem('max_alt','');
                            sessionStorage.setItem('step_alt','');
                            sessionStorage.setItem('min_inc','');
                            sessionStorage.setItem('max_inc','');
                            sessionStorage.setItem('step_inc','');
                            for(var i=0;i<response.length;i++){
                                if(response[i]['type'] == 'altitude'){
                                    altitudes.push(response[i]['type']);
                                    min_alt = response[i]['start'];
                                    max_alt = response[i]['end'];
                                    step_alt = response[i]['jump'];

                                    sessionStorage.setItem('min_alt',min_alt);
                                    sessionStorage.setItem('max_alt',max_alt);
                                    sessionStorage.setItem('step_alt',step_alt);
                                }
                                if(response[i]['type'] == 'inclination'){
                                    inclinations.push(response[i]['type']);
                                    min_inc = response[i]['start'];
                                    max_inc = response[i]['end'];
                                    step_inc = response[i]['jump'];

                                    sessionStorage.setItem('min_inc',min_inc);
                                    sessionStorage.setItem('max_inc',max_inc);
                                    sessionStorage.setItem('step_inc',step_inc);
                                }
                                if(altitudes.includes('altitude')){
                                    $('#orbite').find('.orb-altitude').removeClass('d-none');
                                }else{
                                   $('#orbite').find('.orb-altitude').addClass('d-none'); 
                                }
                                if(inclinations.includes('inclination')){
                                    $('#orbite').find('.orb-inclination').removeClass('d-none');
                                }else{
                                    $('#orbite').find('.orb-inclination').addClass('d-none');
                                }
                                setTimeout(function(){ 
                                    lat.update({
                                        from: min_alt,
                                        to: max_alt,
                                        step: step_alt
                                    });
                                    inc.update({
                                        from: min_inc,
                                        to: max_inc,
                                        step: step_inc
                                    })
                                }, 2000);
                                
                            }
                        }
                    }
                })
                
                $(this).find('.radio').attr('checked',true);
                $(this).css("background-color","#2176bd");
                $(this).siblings().removeAttr('checked');
                $(this).siblings().css("background-color","");
                $(this).closest('#orbite').find('.btn-primary').removeClass('disabled');

            });
            if(sessionStorage.getItem("id") == $(el).data('id')){
                $(el).css("background-color","#2176bd");
                $(el).find('.radio').attr('checked',true);
                $(el).closest('#orbite').find('.btn-primary').removeClass('disabled');
                $(el).trigger('click');
            }
        });
        $('#orbite').find('#altitude').on('change',function(){
            console.log('altitude',$(this).data('to'));
        })
        $('#orbite').find('#inclination').on('change',function(){
            console.log('inclination',$(this).data('to'));
        })
    });
</script>
@endsection