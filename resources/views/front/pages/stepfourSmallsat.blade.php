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
                            <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                            <div class="form-group" style="margin-left: 20%">
                                <h2>Dimensions & masse <i class="icon-xl fa fa-info-circle"></i></h2>
                            </div>
                            <div class="form-group" style="margin-left: 30%">
                                <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" /><br>
                            </div>
                            <div class="input-group">
                                <div class="card card-custom col-md-3 mr-2 mb-2" >
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Longueur (mm)</label>
                                            <input class="form-control" type="number" data-max="{{$parameters['dimension_l']}}" name="dimension_l">
                                            <label class="form-label">Largeur (mm)</label>
                                            <input class="form-control" type="number" data-max="{{$parameters['dimension_p']}}"  name="dimension_p">
                                            <label class="form-label">Hauteur (mm)</label>
                                            <input class="form-control" type="number" data-max="{{$parameters['dimension_i']}}" name="dimension_i">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-custom col-md-3 mr-2 mb-2" >
                                    <div class="card-body">
                                        <div class="form-group mr-2">
                                            <img src="{{ asset('media/logos/logo-light.png') }}" style="min-height: 200px;max-width: 200px">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-custom col-md-3 mb-2" >
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Mass (kg)</label>
                                            <input class="form-control" data-max="{{$parameters['smallsat']}}"  type="number" name="masse">
                                            <label class="form-label">Maturité technique</label>
                                            <select class="form-control maturity" name="maturity">
                                                <option>{{ __('Choose maturity technical') }}</option>
                                                @foreach($maturities as $maturity)
                                                    <option value="{{$maturity->id}}">{{$maturity->title}}</option>
                                                @endforeach
                                            </select>
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
                            <div class="form-group" style="float: right; margin-right: 175px;margin-top: -70px">
                                <a href="{{route('step_five',['type'=>'smallsat'])}}" class="btn btn-primary " >Suivant >></a>
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
        $('#step_4').find('input').each(function(i,el){
            $(el).on('keyup',function(){
                let max = $(this).data('max');
                let current = $(this).val();
                console.log('name',$(this).attr('name'))
                sessionStorage.setItem($(this).attr('name'),current);
                if(current > max){
                    $('#step_4').find('.error-max').removeClass('d-none');
                }else{
                    $('#step_4').find('.error-max').addClass('d-none');
                }
            });

            if(sessionStorage.getItem($(el).attr('name'))){
                $(el).val(sessionStorage.getItem($(el).attr('name')));
            }
        })

        $('.maturity').on('change',function(){
            let current = $(this).val();
            sessionStorage.setItem($(this).attr('name'),current);
        });
        if(sessionStorage.getItem('maturity')){
            $('.maturity').val(sessionStorage.getItem('maturity'));
        }
    });
</script>
@endsection