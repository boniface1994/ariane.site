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
                                <label class="number" style="font-size: 120px">05</label>
                                <label class="title" style="font-size: 30px">{{ __('Describe your spacecraft') }}</label>
                            </div>

                        </div>
                        <div class="form-group col-lg-9"  id="step_5">
                            <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                            <div class="input-group">
                                @foreach($options as $option)
                                <div class="card  col-md-4 mr-2 mb-2">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <h4 class="form-label mr-2">{{$option->name}}</h4>
                                                <label class="checkbox checkbox-primary" style="margin-top: -10px">
                                                    <input type="checkbox" class="ml-3 checker" name="options[]" value="{{$option->id}}" />
                                                    <span></span>
                                                </label>
                                            </div>
                                            <label class="form-label">{{$option->explication}}</label><br>
                                            <label class="form-label" style="font-size: 10px">{{$option->cost}}</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div><br>
                            
                            <div class="form-group">
                                <a href="{{($type == 'smallsat') ? route('step_smallsat') : route('step_cubesat') }}" class="btn btn-default" ><< Prev</a>
                            </div>
                            <div class="form-group" style="float: right; margin-right: 175px;margin-top: -70px">
                                <a href="{{route('step_seven')}}" class="btn btn-primary" >Suivant >></a>
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
        $('#step_5').find('.card').each(function(i,el){
            $(el).on('click',function(){
                if($(this).find('.checker').is(':checked')){
                    $(this).find('.checker').attr('checked',false);
                    $(this).css('background-color',"");
                }else{
                    $(this).find('.checker').attr('checked',true);
                    $(this).css('background-color',"#2176bd");
                }
                
            });

        })
    });
</script>
@endsection