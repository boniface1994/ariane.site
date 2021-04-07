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
                                <form action="{{route('session_two')}}" method="POST">
                                    @csrf
                                    <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                                    <div class="input-group">
                                        @foreach($orbites as $orbite)
                                        <div class="card card-custom col-md-3 mr-2 mb-2 orbite" data-id="{{$orbite->id}}" data-url="{{route('parameter',['orbite_id'=>$orbite->id])}}" data-leo="{{$orbite->tarif_leo}}" data-gto="{{$orbite->tarif_gto}}" data-orbitleo="{{$orbite->orbit_leo}}" data-orbitsso="{{$orbite->orbit_sso}}">
                                            <div class="card-body">
                                                <div class="input-group">
                                                    <h4 class="">
                                                        {{ $orbite->name }}
                                                    </h4>
                                                </div>
                                                <i class="icon-xl fa fa-info-circle" data-container="body" data-offset="20px 20px" data-toggle="popover" data-placement="top" data-content="{{$orbite->explication}}"  style="margin-top: -40px;float: right;margin-right: -37px"></i>
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
                                        <input type="hidden" class="tarif" name="tarif" value="{{session('tarif') ? session('tarif') : ''}}">
                                        <input type="hidden" class="sso" name="sso" value="{{session('sso') ? session('sso') : ''}}">
                                        <input type="hidden" class="leo" name="leo" value="{{session('leo') ? session('leo') : ''}}">
                                    </div><br>
                                    <div class="orb-altitude ml-2 d-none">
                                        <div class="form-group row ">
                                            <h3 class="form-label">{{ __('Altitude') }} <span class="text-danger">*</span></h3>
                                        </div>
                                        <div class="form-group row  mb-13">
                                            <div class="col-lg-8 col-md-9 col-sm-12">
                                                <div class="ion-range-slider">
                                                    <input type="hidden" id="altitude" data-step="0" data-type="double" data-min="0"data-max="0" data-from="0" data-to="0" data-grid="true" name="altitude" value="{{ session('altitude') ? session('altitude') : '' }}" />
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
                                                    <input type="hidden" id="inclination" data-step="0" data-type="double" data-min="0"data-max="0" data-from="0" data-to="0" data-grid="true" name="inclination" value="{{ session('inclination') ? session('inclination') : '' }}" />
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
                                                    
                                                    <input type="time" class="local_start form-control form-control-solid" name="local_start" value="{{ session('local_start') ? session('local_start') : '' }}" />
                                                </div>
                                                <label class="col-form-label mr-3 mt-2">{{ __('and') }}</label>
                                                <div class="col-lg-3 col-md-9 col-sm-12 mr-6 row">
                                                    <input type="time" class="local_end form-control form-control-solid" name="local_end" value="{{ session('local_end') ? session('local_end') : '' }}" />
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label class="checkbox checkbox-primary">
                                                        <input class="local_time_type ltan" type="checkbox" {{ session('ltan') ? 'checked' : '' }} />
                                                        <input type="hidden" name="ltan" value="{{session('ltan') ? session('ltan') : 0 }}">
                                                        <span></span>
                                                        {{ __('LTAN') }}
                                                    </label>
                                                    <label class="checkbox checkbox-primary">
                                                        <input class="local_time_type ltdn" type="checkbox" {{ session('ltdn') ? 'checked' : '' }}/>
                                                        <input type="hidden" name="ltdn" value="{{session('ltan') ? session('ltan') : 0 }}">
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
                                            <input class="form-control constraint" type="text" name="constraint" value="{{session('constraint') ? session('constraint') : '' }}">
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <a href="{{route('step_one')}}" class="btn btn-default "><< Prev</a>
                                        <button href="{{route('step_three')}}" class="btn btn-primary disabled" style="float: right;">Next >></button>
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
<script src="{{ asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('#orbite').find('.orbite').each(function(i,el){
            let data_latitude = $('#altitude').val();
            let data_inclination = $('#inclination').val();
            $(el).on('click',function(){
                let url = $(this).data('url');
                let id = $(this).data('id');
                var type = $(this).data('orbitsso');
                if($(this).data('leo')){
                    $(this).siblings('.tarif').val('tarif_leo');
                }
                if($(this).data('gto')){
                    $(this).siblings('.tarif').val('tarif_gto');
                }
                if($(this).data('orbitleo')){
                    $(this).siblings('.leo').val('leo');
                }else{
                    $(this).siblings('.leo').val('');
                }
                if($(this).data('orbitsso')){
                    $(this).siblings('.sso').val($(this).data('orbitsso'));
                }else{
                    $(this).siblings('.sso').val('');
                }
                if(type == 1){
                    $('#orbite').find('.local-time').removeClass('d-none');
                }else{
                    $('#orbite').find('.local-time').addClass('d-none');
                }
                sessionStorage.setItem('id',id);
                $('#orbite').find('.constraint').val('');
                $('#orbite').find('.ltdn').attr('checked',false);
                $('#orbite').find('.ltan').attr('checked',false);
                $('#orbite').find('.local_end').val('');
                $('#orbite').find('.local_start').val('');
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response){
                        if(response){
                            $('#orbite').find('#altitude').ionRangeSlider();
                            $('#orbite').find('#inclination').ionRangeSlider();
                            $('#altitude').val('');
                            $('#inclination').val('');
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
                            sessionStorage.setItem('local_start','');
                            sessionStorage.setItem('local_end','');
                            sessionStorage.setItem('ltan','');
                            sessionStorage.setItem('ltdn','');
                            sessionStorage.setItem('constraint','');
                            for(var i=0;i<response.length;i++){
                                if(response[i]['type'] == 'altitude'){
                                    altitudes.push(response[i]['type']);
                                    min_alt = response[i]['start'];
                                    max_alt = response[i]['end'];
                                    step_alt = response[i]['jump'];
                                    sessionStorage.setItem('step_alt',step_alt);
                                }
                                if(response[i]['type'] == 'inclination'){
                                    inclinations.push(response[i]['type']);
                                    min_inc = response[i]['start'];
                                    max_inc = response[i]['end'];
                                    step_inc = response[i]['jump'];

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
                                        min: min_alt,
                                        max: max_alt,
                                        step: step_alt,
                                        from: min_alt,
                                        to: min_alt

                                    });
                                    inc.update({
                                        min: min_inc,
                                        max: max_inc,
                                        step: step_inc,
                                        from: min_inc,
                                        to: min_inc
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
                $('#orbite').find('.orb-inclination').addClass('d-none');
                $('#orbite').find('.orb-altitude').addClass('d-none');
                if($('.sso').val() == 1){
                    $('#orbite').find('.local-time').removeClass('d-none');
                }

                if($(el).children().hasClass('altitude')){
                    $('#orbite').find('.orb-altitude').removeClass('d-none');
                    $('#orbite').find('#altitude').ionRangeSlider();
                    let min = $(el).find('.altitude .start').val();
                    let max = $(el).find('.altitude .end').val();
                    let step = $(el).find('.altitude .jump').val();
                    sessionStorage.setItem('step_alt',$(el).find('.altitude .jump').val());
                    let value = data_latitude.split(';');

                    let lat = $('#altitude').data('ionRangeSlider');
                    lat.update({
                        min: min,
                        max: max,
                        step: step,
                        from: value[0],
                        to: value[1]
                    });
                }
                if($(el).children().hasClass('inclination')){
                    $('#orbite').find('.orb-inclination').removeClass('d-none');
                    $('#orbite').find('#inclination').ionRangeSlider();
                    let min = $(el).find('.inclination .start').val();
                    let max = $(el).find('.inclination .end').val();
                    let step = $(el).find('.inclination .jump').val();
                    let incl = data_inclination.split(';');
                    sessionStorage.setItem('step_inc',$(el).find('.inclination .jump').val());
                    let inc = $('#inclination').data('ionRangeSlider');
                    inc.update({
                        min: min,
                        max: max,
                        step: step,
                        from: incl[0],
                        to: incl[1]
                    })
                }
            }
        });
        // $('#orbite').find('#altitude').on('change',function(){
        //     console.log('altitude',$(this).data('to'));
        //     sessionStorage.setItem('min_alt',$(this).data('from'));
        //     sessionStorage.setItem('max_alt',$(this).data('to'));
        // })
        // $('#orbite').find('#inclination').on('change',function(){
        //     console.log('inclination',$(this).data('to'));
        //     sessionStorage.setItem('min_inc',$(this).data('from'));
        //     sessionStorage.setItem('max_inc',$(this).data('to'));
        // })

        // $('#orbite').find('.local_start').on('change',function(){
        //     sessionStorage.setItem('local_start',$(this).val());
        // })
        // $('#orbite').find('.local_end').on('change',function(){
        //     sessionStorage.setItem('local_end',$(this).val());
        // })
        // if(sessionStorage.getItem('local_start')){
        //     $('#orbite').find('.local_start').val(sessionStorage.getItem('local_start'));
        // }
        // if(sessionStorage.getItem('local_end')){
        //     $('#orbite').find('.local_end').val(sessionStorage.getItem('local_end'));
        // }
        $('#orbite').find('.ltan').on('click',function(){
            if($(this).is(':checked')){
                sessionStorage.setItem('ltan',1);
                $(this).siblings('input').val(1);
            }else{
                sessionStorage.setItem('ltan','');
                $(this).siblings('input').val(0);
            }
        })
        $('#orbite').find('.ltdn').on('click',function(){
            if($(this).is(':checked')){
                sessionStorage.setItem('ltdn',1);
                $(this).siblings('input').val(1);
            }else{
                sessionStorage.setItem('ltdn','');
                $(this).siblings('input').val(0);
            }
        })

        
    });
</script>
@endsection