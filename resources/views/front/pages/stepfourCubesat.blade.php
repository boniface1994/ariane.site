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
                            <form action="{{route('session_cubesat')}}" method="POST">
                                @csrf
                                <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                                <div class="form-group" style="margin-left: 20%">
                                    <h2>Choix de votre configuration <i class="icon-xl fa fa-info-circle"></i></h2>
                                </div>
                                <div class="form-group" style="margin-left: 30%">
                                    <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" /><br>
                                </div>
                                <div class="input-group">
                                    @foreach($cubesats as $cubesat)
                                    <div class="card card-custom col-md-3 mr-2 mb-2 cubesat" data-id="{{$cubesat->id}}" style="background-color: {{ (session('cubesat') == $cubesat->id) ? '#2176bd' : ''}}">
                                        <div class="card-body">
                                            <div class="input-group">
                                                <h3 class="mr-2">
                                                    {{$cubesat->name}}
                                                </h3>
                                                <input type="radio" class="d-none" value="{{$cubesat->id}}" {{ (session('cubesat') == $cubesat->id) ? 'checked' : ''}}>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <input type="hidden" class="cubesat-id" name="cubesat" value="{{session('cubesat') ? session('cubesat') : ''}}">
                                </div><br><br>
                                <div class="form-group">
                                    <a href="{{route('step_three')}}" class="btn btn-default" ><< Prev</a>
                                </div>
                                <div class="form-group" style="float: right; margin-right: 175px;margin-top: -70px">
                                    <button href="{{route('step_five',['type'=>'cubsat'])}}" class="btn btn-primary disabled" >Suivant >></button>
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
        $('#step_4').find('.cubesat').each(function(i,el){
            $(el).on('click',function(){
                $(this).css('background-color','#2176bd');
                $(this).find('input[type="radio"]').attr('checked',true);
                $(this).siblings().css('background-color','');
                $(this).siblings().find('input[type="radio"]').attr('checked',false);
                $('#step_4').find('.btn-primary').removeClass('disabled');
                $('#step_4').find('.cubesat-id').val($(this).find('input[type="radio"]').val());
                sessionStorage.setItem('cubesat',$(this).find('input[type="radio"]').val());
            })
        })
    });
</script>
@endsection