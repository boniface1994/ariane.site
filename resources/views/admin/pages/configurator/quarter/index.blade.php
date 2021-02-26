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
            <form class="form upload" action="{{ route('trimester.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="col-form-label col-lg-6">{{ __('The 1st quarter offered on the configurator is based on today\'s date +') }}</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" class="form-control col-md-2" name="month">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button">{{ __('Month') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12">{{ __('Last quarter displayed *') }}</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup"
                                ><select class="form-control selectpicker" tabindex="null" name="quarter">
                                    <option>Q1</option>
                                    <option>Q2</option>
                                    <option>Q3</option>
                                    <option>Q4</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group col-lg-4">
                            <label class="col-form-label">{{ __('Year *') }}</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" class="form-control" name="year" >
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-light-dark font-weight-bold" value="{{ __('Validate') }}">
                    </div>
                </div>
            </form>
        </div>
        <!--end::Card-->
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/custom/draggable/draggable.bundle.js') }}" type="text/javascript"></script>

<script type="text/javascript">

</script>
@endsection