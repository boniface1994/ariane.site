@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Configuration of available quarters') }}
</h3>

<div class="row ">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <label >{{ __('The configurator shows quarters available for launch.You can configure here the quarters that will appear on the configurator.') }}</label>
                </div>
            </div>
            <form id="quarter_available" class="form" data-url="{{ route('trimester.store') }}" action="{{ $quarterAvailable ? route('trimester.update',['trimester'=>$quarterAvailable->id]) : route('trimester.store') }}" method="{{ $quarterAvailable ? 'PATCH' : 'POST' }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="input-group">
                            <label class="col-form-label col-lg-5 mr-2">{{ __('The 1st quarter offered on the configurator is based on today\'s date +') }}</label>
                            <input type="text" class="form-control col-md-2" name="month" value="{{ $quarterAvailable ? $quarterAvailable->month : ''}}">
                            <span class="text-danger error-text month_err"></span>
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button">{{ __('Month') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12">{{ __('Last quarter displayed *') }}</label>
                        <div class="col-lg-2 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" tabindex="null" name="quarter">
                                    <option value="">{{  __('Choose one quarter') }}</option>
                                    <option value="q1" {{ (isset($quarterAvailable->quart) && $quarterAvailable->quart == 'q1') ? 'selected' : '' }}>Q1</option>
                                    <option value="q2" {{ (isset($quarterAvailable->quart) && $quarterAvailable->quart == 'q2') ? 'selected' : '' }}>Q2</option>
                                    <option value="q3" {{ (isset($quarterAvailable->quart) && $quarterAvailable->quart == 'q3') ? 'selected' : '' }}>Q3</option>
                                    <option value="q4" {{ (isset($quarterAvailable->quart) && $quarterAvailable->quart == 'q4') ? 'selected' : '' }}>Q4</option>
                                    <!-- @if($quarters)
                                        @foreach($quarters as $quarter)
                                            <option value="{{$quarter->id}}" {{ ($quarterAvailable && $quarterAvailable->quarter_id == $quarter->id) ? 'selected' : '' }}>{{$quarter->name}}</option>
                                        @endforeach
                                    @endif -->
                                </select>
                            </div>
                        </div>
                        <div class="input-group col-lg-4">
                            <label class="col-form-label">{{ __('Year *') }}</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" class="form-control" name="year" value="{{ $quarterAvailable ? $quarterAvailable->year : '' }}">
                        </div>
                    </div>
                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </div>
            </form>
        </div>
        <!--end::Card-->
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.form button[type="submit"]').on('click',function(e){
            e.preventDefault();
            let form = $(this).closest('form');
            let url = form.attr('action');
            let method = form.attr('method');
            $.ajax({
                url: url,
                method: method,
                data : form.serialize(),
                success: function(response){
                    if($.isEmptyObject(response.error)){
                        form.attr('action',form.data('url')+'/'+response.id);
                        form.attr('method','PATCH');
                        toastr.success("Success !");
                    }else{
                        toastr.error("Complete the required fields")
                    }
                }
            })
        });

    });
</script>
@endsection