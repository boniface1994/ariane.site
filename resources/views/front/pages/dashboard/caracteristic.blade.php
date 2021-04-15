@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-group">
                                    <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" />
                                </div>
                                <div class="form-group" style="height: 100%;overflow-y: auto;">
                                    @foreach($projects as $project)
                                        <div class="form-group ml-4">
                                            <label class="form-label">{{$project->name}}</label><br>
                                            <a href="{{route('timeline',['project_id'=>$project->id])}}">Timelines</a><br>
                                            <a href="{{route('caracteristic',['id'=>$project->id])}}">Informations</a><br>
                                            <a href="{{route('option',['project_id'=>$project->id])}}">Options</a><br>
                                            <a href="">Synthèse</a><br>
                                            <a href="{{route('project.document',['project_id'=>$project->id])}}">Documents</a><br>
                                            <a href="{{route('contact.ariane',['project_id'=>$project->id])}}">Votre contacts</a><br>
                                            <a href="">NDA</a><br>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-9"  >
                            <div class="input-group col-md-12" >
                                <div class="form-group col-md-6">
                                    <select class="form-control select_project">
                                        <option value="">Select project</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}" {{($detail && $detail->id == $project->id) ? 'selected' : ''}}>{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group col-md-6">
                                    <div class="form-group">
                                        <label>{{Auth::guard('customer')->user()->name}}</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <a class="form-label" href="{{route('beforelogin')}}">Deconnexion</a>
                                    </div>
                                </div>
                            </div>
                            @if(count($projects) > 0)
                                @if($detail)
                                <div class="input-group">
                                    <div class="col-md-12">
                                        <form class="form" action="{{route('project.update')}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="project_id" value="{{$detail->id}}">
                                                <label class="form-label">Vos caractéristique pour ce vol</label>
                                            </div>
                                            <div class="form-group">
                                                <h3 class="form-label"> Type d'orbite <span class="text-danger">*</span></h3>
                                                <select class="form-control col-md-6 orbit_type" name="orbit_type_id">
                                                    <option value="">Choisir le type d'orbite</option>
                                                    @foreach($orbits as $orbit)
                                                        <option class="option" data-sso="{{($orbit->orbit_sso) ? 1 : ''}}" data-explanation="{{$orbit->explication}}" data-leo="{{($orbit->orbit_leo) ? 1 : ''}}" value="{{$orbit->id}}" {{($detail->orbit_type_id == $orbit->id) ? 'selected' : ''}} >{{$orbit->name}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="form-label explanation"></label>
                                            </div>
                                            <div class="form-group altitude d-none" data-min="{{$detail->altitude_min}}"data-max="{{$detail->altitude_max}}" data-step="{{$detail->step_alt}}" data-latitude="{{$detail->latitude}}">
                                                <div class="form-group row ">
                                                    <h3 class="form-label">{{ __('Altitude') }} <span class="text-danger">*</span></h3>
                                                    <div class="input-group">
                                                        <button class="btn btn-default">Palier</button>
                                                        <button class="btn btn-default">Palier</button>
                                                        <button class="btn btn-default">Palier</button>
                                                        <button class="btn btn-default">Palier</button>
                                                    </div>
                                                </div>
                                                <div class="form-group row  mb-13">
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <div class="ion-range-slider">
                                                            <input type="hidden" id="altitude" data-step="0" data-type="double" data-min="0"data-max="0" data-from="0" data-to="0" data-grid="true" name="latitude" value="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group inclination d-none" data-min="{{$detail->inclination_min}}"data-max="{{$detail->inclination_max}}" data-step="{{$detail->step_inc}}" data-inclination="{{$detail->inclination}}">
                                                <div class="form-group row ">
                                                    <h3 class="form-label">{{ __('Inclination') }} <span class="text-danger">*</span></h3>
                                                    <div class="input-group">
                                                        <button class="btn btn-default">Palier</button>
                                                        <button class="btn btn-default">Palier</button>
                                                        <button class="btn btn-default">Palier</button>
                                                        <button class="btn btn-default">Palier</button>
                                                    </div>
                                                </div>
                                                <div class="form-group row  mb-13">
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <div class="ion-range-slider">
                                                            <input type="hidden" id="inclination" data-step="0" data-type="double" data-min="0"data-max="0" data-from="0" data-to="0" data-grid="true" name="inclination" value="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group localtime d-none">
                                                <div class="form-group row">
                                                    <h3 class="form-label">{{ __('Local time') }} <span class="text-danger">*</span></h3>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label mr-3 mt-2">{{ __('Between') }}</label>
                                                    <div class="col-9 col-form-label d-flex flex-wrap row">
                                                        <div class="col-lg-3 col-md-9 col-sm-12 mr-6 row">
                                                            
                                                            <input type="time" class="local_start form-control form-control-solid" name="local_start" value="{{$detail->local_start}}" />
                                                        </div>
                                                        <label class="col-form-label mr-3 mt-2">{{ __('and') }}</label>
                                                        <div class="col-lg-3 col-md-9 col-sm-12 mr-6 row">
                                                            <input type="time" class="local_end form-control form-control-solid" name="local_end" value="{{$detail->local_end}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox checkbox-primary">
                                                            <input class="local_time_type ltan" type="checkbox" {{($detail->ltan !=0 ) ? 'checked' : ''}}/>
                                                            <input type="hidden" name="ltan" value="{{($detail->ltan !=0 ) ? $detail->ltan : 0}}">
                                                            <span></span>
                                                            {{ __('LTAN') }}
                                                        </label>
                                                        <label class="checkbox checkbox-primary">
                                                            <input class="local_time_type ltdn" type="checkbox" {{($detail->ltdn !=0 ) ? 'checked' : ''}}/>
                                                            <input type="hidden" name="ltdn" value="{{($detail->ltdn !=0 ) ? $detail->ltdn : 0}}">
                                                            <span></span>
                                                            {{ __('LTDN') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h4 class="form-label">SC Interface <span class="text-danger">*</span></h4>
                                                <div class="form-group">
                                                    <select class="form-control col-md-6" name="sc_interface_id">
                                                        <option value=""> Choisir SC Interface</option>
                                                        @foreach($scinterfaces as $sc)
                                                         <option value="{{$sc->id}}" {{($detail->sc_interface_id == $sc->id) ? 'selected' : ''}}>{{$sc->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control col-md-6" name="supplier_type_id">
                                                        <option value=""> Choisir le type de fournisseur</option>
                                                        @foreach($suppliers as $sup)
                                                         <option value="{{$sup->id}}" {{($detail->supplier_type_id == $sup->id) ? 'selected' : ''}}>{{$sup->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h4 class="form-label">Type d'ergol <span class="text-danger">*</span></h4>
                                                <div class="form-group">
                                                    <select class="form-control col-md-6" name="propellant_type_id">
                                                        <option value=""> Choisir le type d'ergol</option>
                                                        @foreach($propellants as $prop)
                                                         <option value="{{$prop->id}}" {{($detail->propellant_type_id == $prop->id) ? 'selected' : ''}}>{{$prop->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <h4 class="form-label">Vos contraintes</h4>
                                                </div>
                                                <textarea class="form-control col-md-6" name="constraint">{{$detail->constraint ? $detail->constraint : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-warning">Valider</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @else
                                <div class="form-group">
                                    <label class="form-label">Select an project</label>
                                </div>
                                @endif
                            @else
                                <div class="col-lg-3">
                                    <label class="btn btn-warning"><a href="">CRÉER VOTRE PREMIER PROJET</a></label>
                                </div>
                            @endif
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
        $('.select_project').on('change',function(){
            var project_id = $(this).val();
            setTimeout(function(){
                var path='';
                var old_path = window.location.pathname.split('/');
                for(var i=0;i<old_path.length;i++){
                    if(i>0 && i<(old_path.length-1)){
                        path+='/'+old_path[i];
                    }
                }
                window.location.replace(window.location.origin+path+'/'+project_id);
            },1000);
        });
        
        if($('.orbit_type').val()){
            var url = window.location.origin+'/customer/dashboard/orbit-parameter/'+$('.orbit_type').val();
            $('.orbit_type').find('.option').each(function(i,el){
                if( $('.orbit_type').val() == $(el).val() && $(el).data('sso')){
                    $('.localtime').removeClass('d-none');
                }

                if($('.orbit_type').val() == $(el).val()){
                    $('.explanation').text($(el).data('explanation'));
                }
            })
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response){
                    for(var i=0;i<response.length;i++){
                        if(response[i].type == 'altitude'){
                            $('.altitude').find('#altitude').ionRangeSlider();
                            let lat = $('#altitude').data('ionRangeSlider');
                            lat.update({
                                min: response[i].start,
                                max: response[i].end,
                                step: response[i].jump,
                                from: 0,
                                to: 0
                            });
                            $('.altitude').removeClass('d-none');
                        }

                        if(response[i].type == 'inclination'){
                            $('.inclination').find('#inclination').ionRangeSlider();
                            let inc = $('#inclination').data('ionRangeSlider');
                            inc.update({
                                min: response[i].start,
                                max: response[i].end,
                                step: response[i].jump,
                                from: 0,
                                to: 0
                            });
                            $('.inclination').removeClass('d-none');

                        }
                    }
                }
            })
        }

        $('.ltan').on('click',function(){
            if($(this).is(':checked'))
                $(this).siblings('input').val(1);
            else
                $(this).siblings('input').val(0);
        });
        $('.ltdn').on('click',function(){
            if($(this).is(':checked'))
                $(this).siblings('input').val(1);
            else
                $(this).siblings('input').val(0);
        });

        $('.orbit_type').on('change',function(){
            var url = window.location.origin+'/customer/dashboard/orbit-parameter/'+$(this).val();
            if(!$('.altitude').hasClass('d-none'))
                $('.altitude').addClass('d-none');
            if(!$('.inclination').hasClass('d-none'))
                $('.inclination').addClass('d-none');
            if(!$('.localtime').hasClass('d-none'))
                $('.localtime').addClass('d-none');
            var val = $(this).val();
            $(this).find('.option').each(function(i,el){
                if( val == $(el).val() && $(el).data('sso')){
                    $('.localtime').removeClass('d-none');
                }

                if(val == $(el).val()){
                    $('.explanation').text($(el).data('explanation'));
                }
            })
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response){
                    for(var i=0;i<response.length;i++){
                        if(response[i].type == 'altitude'){
                            $('.altitude').find('#altitude').ionRangeSlider();
                            let lat = $('#altitude').data('ionRangeSlider');
                            lat.update({
                                min: response[i].start,
                                max: response[i].end,
                                step: response[i].jump,
                                from: 0,
                                to: 0
                            });
                            $('.altitude').removeClass('d-none');
                        }

                        if(response[i].type == 'inclination'){
                            $('.inclination').find('#inclination').ionRangeSlider();
                            let inc = $('#inclination').data('ionRangeSlider');
                            inc.update({
                                min: response[i].start,
                                max: response[i].end,
                                step: response[i].jump,
                                from: 0,
                                to: 0
                            });
                            $('.inclination').removeClass('d-none');

                        }
                    }
                }
            })
        });
    });
</script>
@endsection