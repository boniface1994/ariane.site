@extends('layouts.admin')

@section('content')

<div class="row ">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <label >{{ __('Editing a project') }}</label>
                </div>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('project.index') }}"> <h4><i class="icon-xl la la-long-arrow-alt-left"></i> {{ __('Back to projects list') }}</h4></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form  class="form" action="{{ route('project.update',['project'=>$project->id]) }}" method="POST">
                    @csrf
                    @if(isset($project))
                        @method('PATCH')
                    @endif
                    <h4 class="form-label">{{ __('Contact Arianespace for this project') }}</h4><br>
                    <div class="form-group">
                        <textarea name="contact_ariane" id="kt-ckeditor-2">
                        {{ $project->contact_ariane ? $project->contact_ariane : '' }}
                        </textarea>
                    </div>
                    
                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form><br>
                <div class="form-group">
                    <div class="checkbox-list">
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" name="received" {{ $project->received ? 'checked' : '' }} />
                            <span></span>
                            {{ __('NDA received') }}
                        </label>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox"  name="valid" {{ $project->valid ? 'checked' : '' }}/>
                            <span></span>
                            {{ __('NDA validated by Arianespace') }}
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-9 col-form-label">
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-success">
                                <input type="checkbox" name="step_1" {{ $project->step_1 ? 'checked' : '' }}/>
                                <span></span>
                                {{ __('Step 1') }}
                            </label>
                            <label class="checkbox checkbox-success">
                                <input type="checkbox" name="step_2" {{ $project->step_2 ? 'checked' : '' }}/>
                                <span></span>
                                {{ __('Step 2') }}
                            </label>
                            <label class="checkbox checkbox-success">
                                <input type="checkbox" name="step_3" {{ $project->step_3 ? 'checked' : '' }}/>
                                <span></span>
                                {{ __('Step 3') }}
                            </label>
                            <label class="checkbox checkbox-success">
                                <input type="checkbox" name="step_4" {{ $project->step_4 ? 'checked' : '' }}/>
                                <span></span>
                                {{ __('Step 4') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-label">{{ __('Your characteristics for this flight') }}</label>
                </div>
                <div class="form-group row">
                    <h3 class="form-label">{{ __('Obtite type') }} <span class="text-danger">*</span></h3>
                    <select class="form-control">
                        <option>{{ __('Choose one orbit type') }}</option>
                        @foreach($orbitTypes as $orbit)
                            <option>{{ $orbit->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <h3 class="form-label">{{ __('Altitude') }} <span class="text-danger">*</span></h3>
                </div>
                <div class="form-group row">
                    <button class="btn btn-default mr-3">Palier</button><button class="btn btn-default">Palier</button>
                </div>
                <div class="form-group row  mb-13">
                    <div class="col-lg-8 col-md-9 col-sm-12">
                        <div class="ion-range-slider">
                            <input type="hidden" id="kt_slider_4"/>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <h3 class="form-label">{{ __('Inclination') }} <span class="text-danger">*</span></h3>
                </div>
                <div class="form-group row">
                    <button class="btn btn-default mr-3">Palier</button><button class="btn btn-default">Palier</button>
                </div>
                <div class="form-group row  mb-13">
                    <div class="col-lg-8 col-md-9 col-sm-12">
                        <div class="ion-range-slider">
                            <input type="hidden" id="kt_slider_2"/>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label mr-3 mt-2">{{ __('Local time') }}</label>
                    <div class="col-9 col-form-label d-flex flex-wrap row">
                        <div class="col-lg-3 col-md-9 col-sm-12 mr-6 row">
                            <input type="time" class="local_time form-control form-control-solid" name="local_time" value="" />
                        </div>
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-success">
                                <input class="local_time_type ltan" type="checkbox" name="time" />
                                <span></span>
                                {{ __('LTAN') }}
                            </label>
                            <label class="checkbox checkbox-success">
                                <input class="local_time_type ltdn" type="checkbox" name="time" />
                                <span></span>
                                {{ __('LTDN') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <h3 class="form-label">{{ __('Your constraints') }} <span class="text-danger">*</span></h3>
                    <textarea class="form-control" name="constraint">
                    </textarea>
                </div>
                <div class="form-group row">
                    <h3 class="form-label">{{ __('SC Interfaces') }} <span class="text-danger">*</span></h3>
                    <select class="form-control">
                        <option>{{ __('Choose SC Interface') }}</option>
                        @foreach($scInterfaces as $scint)
                            <option>{{ $scint->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <select class="form-control">
                        <option>{{ __('Choose type of supplier') }}</option>
                        @foreach($supplierTypes as $supplier)
                            <option>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var KTCkeditor = function () {
        // Private functions
        var demos = function () {
            ClassicEditor
                .create( document.querySelector( '#kt-ckeditor-2' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );
        }

        return {
            // public functions
            init: function() {
                demos();
            }
        };
    }();
    var KTIONRangeSlider = function () {
        var demos = function () {
            $('#kt_slider_4').ionRangeSlider({
                type: "double",
                grid: true,
                min: 100,
                max: 1000,
                from: 50,
                to: 500
            });

            $('#kt_slider_2').ionRangeSlider({
                type: "double",
                grid: true,
                min: 100,
                max: 1000,
                from: 50,
                to: 500
            });
        }

         return {
          // public functions
          init: function() {
           demos();
          }
         };
        }();
    jQuery(document).ready(function () {
        KTCkeditor.init();
        KTIONRangeSlider.init();
    });
</script>
@endsection