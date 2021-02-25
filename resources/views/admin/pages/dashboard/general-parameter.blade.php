@extends('layouts.admin')

@section('content')
<h3 class="card-title">
            {{ __('General parameters') }}
</h3>
<div class="row general_parameter">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('Contact form') }}</h3>
                </div>
            </div>
            <form class="form" action="{{ route('parameter.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('Sender email address for contact emails *') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button">@</button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control" name="sender" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'sender' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control" name="sender" value="">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Ariane email address Recipient area for contact requests *') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button">@</button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control" name="recipient" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'recipient' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control" name="recipient">
                            @endif
                        </div>
                    </div>

                    <input type="submit" class="btn btn-light-dark font-weight-bold" value="{{ __('Validate') }}">
                </div>
            </form>
        </div>
        <!--end::Card-->
    </div>
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('Extensions and weights for 3D plans') }}</h3>
                </div>
            </div>
            <form class="form" action="{{ route('parameter.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('Name of the constraint to display on the GO *') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button">GO</button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control" name="constraint" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'constraint' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control" name="constraint">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('List of authorized extensions *') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button">Ext</button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control" name="extension" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'extension' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control" name="extension">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Max authorized weight in ko *') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-weight-hanging"></i></button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control" name="weight" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'weight' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control" name="weight">
                            @endif
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
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('Maximum values ​​for SmallSat') }}</small></h3>
                </div>
            </div>
            <form class="form" action="{{ route('parameter.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <h1 class=""><i class="fa fa-weight-hanging col-md-2 lg-5"></i></h1>
                            <h3 class="card-label">{{ __('Maximum values ​​for SmallSat') }}</small></h3> &nbsp;&nbsp;&nbsp;&nbsp;
                            @if($parameters)
                                <input type="text" class="form-control" name="smallsat" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'smallsat' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control" name="smallsat">
                            @endif
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">Kg</button>
                            </div>
                        </div>
                    </div>
                    <div class ="form-group">
                        <div class="input-group">
                            <h1 class=""><i class="fa fa-box col-md-2"></i></h1>
                            <h3 class="card-label">{{ __('Max authorized dimensions') }}</small></h3>
                        </div>
                        <div class="input-group">
                            @if($parameters)
                                <input type="text" class="form-control col-md-2" name="dimention_l" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'dimention_l' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control col-md-2" name="dimention_l">
                            @endif
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">L</button>
                            </div>&nbsp;&nbsp;&nbsp;
                            @if($parameters)
                                <input type="text" class="form-control col-md-2" name="dimention_i" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'dimention_i' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control col-md-2" name="dimention_i">
                            @endif
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">I</button>
                            </div>&nbsp;&nbsp;&nbsp;
                            @if($parameters)
                                <input type="text" class="form-control col-md-2" name="dimension_p" value="<?php foreach ($parameters as $parameter){if($parameter->name != 'dimension_p' ) continue;  echo $parameter->value;}?>">
                            @else
                                <input type="text" class="form-control col-md-2" name="dimension_p">
                            @endif
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">P</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="card-label">{{ __('If the mass or one of the dimensions indicated by the user exceeds the maximum authorized mass, the following text is displayed :') }}</label>
                        @if($parameters)
                            <textarea class="form-control col-lg-10" rows="4" name="text" > <?php foreach ($parameters as $parameter){if($parameter->name != 'text' ) continue;  echo $parameter->value;} ?> </textarea>
                        @else
                            <textarea class="form-control col-lg-10" rows="4" name="text"></textarea>
                        @endif
                        
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-light-dark font-weight-bold" value="{{ __('Validate') }}">
                    </div>
                </div>
            </form>
        </div>
        <!--end::Card-->
    </div>
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('Standard terms and conditions') }}</small></h3>
                </div>
            </div>
            <form class="form" action="{{ route('parameter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">{{ __('PDF file for CubeSatt*') }}</label>
                        <div class="input-group">
                            <input type="file" name="cubesatt" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ __('PDF file for SmallSatt*') }}</label>
                        <div class="input-group">
                            <input type="file" name="smallsatt" value="">
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