@extends('layouts.admin')

@section('content')
<h3 class="card-title">
            {{ __('General parameters') }}
</h3>
<div class="card card-custom general_parameter">
    <div class="card-header card-header-tabs-line">
        <div class="card-toolbar">
            <ul class="nav nav-tabs  nav-tabs-line" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#contact_form">
                        <h5 class="card-label">{{ __('Contact form') }}</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#extension">
                        <h5 class="card-label">{{ __('Extensions and weights for 3D plans') }}</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#smallsat">
                        <h5 class="card-label">{{ __('Maximum values ​​for SmallSat') }}</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#condition">
                        <h5 class="card-label">{{ __('Maximum values ​​for SmallSat') }}</h5>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="contact_form" role="tabpanel" aria-labelledby="contact_form">
                <form class="form" action="{{ route('parameter.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Sender email address for contact emails *') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button">@</button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control" name="sender" value="{{ isset($parameters['sender']) ? $parameters['sender'] : '' }}">
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
                                <input type="text" class="form-control" name="recipient" value="{{ isset($parameters['recipient']) ? $parameters['recipient'] : '' }}">
                            @else
                                <input type="text" class="form-control" name="recipient">
                            @endif
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <input type="submit" class="btn btn-success font-weight-bold" value="{{ __('Validate') }}">
                    </div>-->
                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form>
            </div>
            <div class="tab-pane fade" id="extension" role="tabpanel" aria-labelledby="extension">
                <form class="form" action="{{ route('parameter.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Name of the constraint to display on the GO *') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button">GO</button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control" name="constraint" value="{{ isset($parameters['constraint']) ? $parameters['constraint'] : '' }}">
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
                                <input type="text" class="form-control" name="extension" value="{{ isset($parameters['extension']) ? $parameters['extension'] : '' }}">
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
                                <input type="text" class="form-control" name="weight" value="{{ isset($parameters['weight']) ? $parameters['weight'] : '' }}">
                            @else
                                <input type="text" class="form-control" name="weight">
                            @endif
                        </div>
                    </div>
                    
                    <!--<div class="form-group">
                        <input type="submit" class="btn btn-success font-weight-bold" value="{{ __('Validate') }}">
                    </div>-->
                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form>
            </div>
            <div class="tab-pane fade" id="smallsat" role="tabpanel" aria-labelledby="smallsat">
                <form class="form" action="{{ route('parameter.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <i class="fa fa-weight-hanging icon-3x mt-6 mr-2"></i>
                            <h5 class="card-label mt-3 mr-4">{{ __('Max authorized mass') }}</h5>
                            @if($parameters)
                                <input type="text" class="form-control col-lg-6" name="smallsat" value="{{ isset($parameters['smallsat']) ? $parameters['smallsat'] : '' }}">
                            @else
                                <input type="text" class="form-control col-lg-6" name="smallsat">
                            @endif
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">Kg</button>
                            </div>
                        </div>
                    </div>
                    <div class ="form-group">
                        <div class="input-group">
                            <i class="fa fa-box icon-3x mt-6 mr-2"></i>
                            <h5 class="card-label mt-3">{{ __('Max authorized dimensions') }}</h5>
                        
                            @if($parameters)
                                <input type="text" class="form-control col-md-2 ml-2" name="dimension_l" value="{{ isset($parameters['dimension_l']) ? $parameters['dimension_l'] : '' }}">
                            @else
                                <input type="text" class="form-control col-md-2" name="dimension_l">
                            @endif
                            <div class="input-group-append mr-4">
                                <button class="btn btn-secondary" type="button">L</button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control col-md-2" name="dimension_i" value="{{ isset($parameters['dimension_i']) ? $parameters['dimension_i'] : '' }}">
                            @else
                                <input type="text" class="form-control col-md-2" name="dimension_i">
                            @endif
                            <div class="input-group-append mr-4">
                                <button class="btn btn-secondary" type="button">I</button>
                            </div>
                            @if($parameters)
                                <input type="text" class="form-control col-md-2" name="dimension_p" value="{{ isset($parameters['dimension_p']) ? $parameters['dimension_p'] : '' }}">
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
                            <textarea class="form-control col-lg-10" rows="4" name="text" > {{ isset($parameters['text']) ? $parameters['text'] : '' }} </textarea>
                        @else
                            <textarea class="form-control col-lg-10" rows="4" name="text"></textarea>
                        @endif
                        
                    </div>
                    
                    <!--<div class="form-group">
                        <input type="submit" class="btn btn-success font-weight-bold" value="{{ __('Validate') }}">
                    </div>-->
                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>>
                </form>
            </div>
            <div class="tab-pane fade" id="condition" role="tabpanel" aria-labelledby="condition">
                <form class="form upload" action="{{ route('parameter.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">{{ __('PDF file for CubeSatt*') }}</label>
                        <div class="input-group">
                            <input type="file" name="cubesatt">
                            @if($parameters && isset($parameters['cubesatt']) && $parameters['cubesatt'] !== '')
                                <a class="btn btn-default" href="{{ route('download',$parameters['cubesatt']) }}"><i class="fa fa-download"></i>{{ __('Download current file') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ __('PDF file for SmallSatt*') }}</label>
                        <div class="input-group">
                            <input type="file" name="smallsatt" >
                            @if($parameters && isset($parameters['smallsatt']) && $parameters['smallsatt'] !== '')
                                <a class="btn btn-default"  href="{{ route('download',$parameters['smallsatt']) }}"><i class="fa fa-download"></i>{{ __('Download current file') }}</a>
                            @endif
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <input type="submit" class="btn btn-success font-weight-bold" value="{{ __('Validate') }}">
                    </div>-->
                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection