@extends('layouts.admin')

@section('content')

<div class="row ">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <label >{{ __('Projects list') }}</label>
                </div>
                <!-- <div><a href="{{ route('document') }}">Document</a></div> -->
            </div>
            <div class="card-body">
                <form  class="form" data-url="" action="{{ route('customer_search') }}" method="POST">
                    @csrf
                    <h4 class="form-label">{{ __('Search / Filter') }}</h4><br>
                    <div class="form-group row ml-14">
                        <div class="input-group col-lg-4">
                            <label class="col-form-label mr-2">{{ __('Customer') }}</label>
                            <select class="form-control" name="customer">
                                <option>{{ __('Choose one customer') }}</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row row ml-14">
                        <div class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio radio-success">
                                    <input type="radio" name="radios5"/>
                                    <span></span>
                                    {{ __('All') }}
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="radios5"/>
                                    <span></span>
                                    {{ __('Step 1') }}
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="radios5"/>
                                    <span></span>
                                    {{ __('Step 2') }}
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="radios5" />
                                    <span></span>
                                    {{ __('Step 3') }}
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="radios5" />
                                    <span></span>
                                    {{ __('Step 4') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group row row ml-14">
                        <div class="col-9 col-form-label">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-success">
                                    <input type="checkbox" name="Checkboxes5"/>
                                    <span></span>
                                    {{ __('NDA received') }}
                                </label>
                                <label class="checkbox checkbox-success">
                                    <input type="checkbox" name="Checkboxes5"/>
                                    <span></span>
                                    {{ __('NDA validated by Arianespace') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-light-danger" href="{{ route('reset_search') }}"> {{ __('Reset search') }}</a>
                        <input type="submit" class="btn btn-light-primary font-weight-bold" value="{{ __('Search') }}">
                    </div>
                </form>
                <h4 class="form-label" >{{ __('Number of elements : ') }} [{{ $projects ? count($projects) : 0 }}]</h4><br>
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Customer') }}</th>
                            <th scope="col">{{ __('NDA') }}</th>
                            <th scope="col">{{ __('Project name') }}</th>
                            <th scope="col">{{ __('Date type') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($projects)
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->company }}</td>
                                    <td>{{$project->received ? __('NDA received') : ''}} {{($project->received && $project->valid) ? '/' : ''}} {{$project->valid ? __('NDA validated') : ''}}</td>
                                    <td>{{ $project->name }}</td>
                                    <td></td>
                                    <td class="datatable-cell">
                                        <span style="overflow: visible; position: relative;">
                                            <a class="btn btn-sm btn-light-primary btn-icon mr-2" href="{{ route('project.edit',['project' => $project->id]) }}"> <i class="fa fa-pen"></i> </a>
                                            <a class="btn btn-sm btn-light-primary btn-icon mr-2" href="{{ route('project/document') }}"> <i class="icon-xl far fa-file-alt"></i> </a>
                                            <a class="btn btn-sm btn-light-danger btn-icon" data-toggle="modal" data-target="#modal{{$project->id}}" data-href="{{ route('project.destroy',['project' => $project->id]) }}"> <i class="fa fa-trash"></i> </a>
                                            <div class="modal fade" id="modal{{$customer->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('project.destroy',['project' => $project->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                {{ __('Do you want to delete ') }} {{ $project->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default font-weight-bold" data-dismiss="modal">{{ __('Cancel') }}</button>
                                                                <button type="submit" class="btn btn-danger font-weight-bold">{{ __('Delete') }}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {!! $projects->links() !!}

            </div>
        </div>
        <!--end::Card-->
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    jQuery(document).ready(function () {

    });
</script>
@endsection