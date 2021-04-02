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
                                <label class="number" style="font-size: 120px">03</label>
                                <label class="title" style="font-size: 30px">{{ __('Describe your spacecraft') }}</label>
                            </div>

                        </div>
                        <div class="form-group col-lg-9"  id="step_3">
                            <form action="{{route('session_three')}}" method="POST">
                                @csrf
                                <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                                <div class="input-group">
                                    <div class="form-group space" data-type="cubesat" data-next="{{route('step_cubesat')}}" style="background-color: {{ (session('space_type') == 'cubsat') ? '#2176bd' : '' }}">
                                        <img src="{{ asset('media/logos/logo-light.png') }}" style="min-height: 200px;max-width: 300px">
                                        <input type="radio" class="space-type" value="cubsat" {{ (session('space_type') == 'cubsat') ? 'checked' : '' }}>
                                        <br>
                                        <label>CUBESAT</label>
                                    </div>
                                    <input type="hidden" class="craft" name="space_type" value="{{session('space_type') ? session('space_type') : '' }}">
                                    <div class="form-group space" data-type="smallsat" data-next="{{route('step_smallsat')}}" style="background-color: {{ (session('space_type') == 'smallsat') ? '#2176bd' : '' }}">
                                        <img src="{{ asset('media/logos/logo-light.png') }}" style="min-height: 200px;max-width: 300px">
                                        <input type="radio" class="space-type" value="smallsat" {{ (session('space_type') == 'smallsat') ? 'checked' : '' }}><br>
                                        <label>SMALSAT</label>
                                    </div>
                                </div><br>
                                <div class="form-group">
                                    <a href="{{route('step_two')}}" class="btn btn-default" ><< Prev</a>
                                </div>
                                <div class="form-group" style="float: right; margin-right: 175px;margin-top: -70px">
                                    <button class="btn btn-primary " disabled>Suivant >></button>
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
        $('#step_3').find('.space').each(function(i,el){
            $(el).on('click',function(){
                $(this).find('.space-type').attr('checked',true);
                $(this).siblings().find('.space-type').attr('checked',false);
                $(this).css("background-color","#2176bd");
                // $(this).removeClass("disabled");
                $(this).siblings().css("background-color","");
                // $(this).siblings('.cubesat').addClass("disabled");
                $('#step_3').find('.btn-primary').removeAttr('disabled');
                var url = $(this).data('next');
                $('#step_3').find('.btn-primary').attr('href',url);
                sessionStorage.setItem('space_type',$(this).find('input[type="radio"]').val());
                $('#step_3').find('.craft').val($(this).find('.space-type').val());
            });

        })
        if($('#step_3').find('.craft').val() != ""){
            $('#step_3').find('.btn-primary').removeAttr('disabled');
        }
    });
</script>
@endsection