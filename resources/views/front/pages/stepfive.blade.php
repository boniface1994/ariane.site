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
                            <form action="{{route('session_five')}}" method="POST">
                                @csrf
                                <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                                <div class="input-group">
                                    @foreach($options as $option)
                                    <div class="col-md-4">
                                        <div class="card" style="background-color: {{(in_array($option->id,$sessions)) ? '#2176bd' : ''}}">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <h4 class="form-label mr-2">{{$option->name}}</h4>
                                                        <label class="checkbox checkbox-primary" style="margin-top: -10px">
                                                            <input type="checkbox" class="ml-3 checker" data-session="{{$option->id}}" name="alloptions[]" value="{{$option->id}}" {{($sessions && in_array($option->id,$sessions)) ? 'checked' : ''}}/>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <label class="form-label">{{$option->explication}}</label><br>
                                                    <!-- <label class="form-label" style="font-size: 10px">{{$option->cost}}</label> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div><br>
                                <div class="form-group">
                                    <a href="{{($type == 'smallsat') ? route('step_smallsat') : route('step_cubesat') }}" class="btn btn-default" ><< Prev</a>
                                </div>
                                <div class="form-group" style="float: right; margin-top: -70px">
                                    <button  class="btn btn-primary" >Suivant >></button>
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
        var all_data = [];
        var data_session = [];
        $('#step_5').find('.card').each(function(i,el){
            $(el).on('click',function(){
                if($(this).find('.checker').is(':checked')){
                    $(this).find('.checker').attr('checked',false);
                    $(this).css('background-color',"");
                    for (var i = 0; i < all_data.length; i++) {
                        if(all_data[i] == $(this).find('.checker').val()){
                            all_data.splice(i,1);
                        }
                    }
                }else{
                    $(this).find('.checker').attr('checked',true);
                    $(this).css('background-color',"#2176bd");
                    all_data.push(parseInt($(this).find('.checker').val()));
                    sessionStorage.setItem('options',JSON.stringify(all_data));
                }
            });

            // if(sessionStorage.getItem('options').includes(parseInt($(el).find('.checker').val()))){
            //     // $(el).trigger('click');
            //     $(el).find('.checker').attr('checked',true);
            //     $(el).css('background-color',"#2176bd");
            // }
        })
        // console.log('icici',sessionStorage.getItem('options'))
    });
</script>
@endsection