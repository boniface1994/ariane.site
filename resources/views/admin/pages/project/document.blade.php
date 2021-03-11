@extends('layouts.admin')

@section('content')
<h3 class="card-title">
            {{ __('Project document management') }}
</h3>
<div class="card card-custom ">
    <div class="card-header card-header-tabs-line">
        <div class="card-toolbar">
            <ul class="nav nav-tabs  nav-tabs-line" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#ref">
                        <h5 class="card-label">{{ __('Reference documents') }}</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#customer">
                        <h5 class="card-label">{{ __('Customer documents') }}</h5>
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <a href="{{ route('project.index') }}"> <h4><i class="icon-xl la la-long-arrow-alt-left"></i> {{ __('Back to projects list') }}</h4></a>
            </div>
        </div>
    </div>
    <div class="card-body document">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="ref" role="tabpanel" aria-labelledby="ref">
                <form class="form" action="{{ route('document_create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">{{ __('Add a new reference document') }}</label>
                    </div>
                    <div class="input-group">
                        <input type="hidden" name="type" value="ref">
                        <input type="hidden" name="project_id" value="{{$project_id}}">
                        <input type="text" class="form-control mr-2" name="name" required>
                        <input type="file" class="form-control mr-2" name="document" required>
                        <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                            <i class="la la-check"></i> {{ __('Add') }}
                        </button>
                    </div>
                </form><br>
                <div class="input-group">
                    @foreach($documents as $document)
                        @if($document->type == 'ref')
                            <div class="form-group col-lg-6">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-light-success mr-5">
                                        <span class="symbol-label">
                                            <i class="icon-5x far fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{ $document->name }}</a>
                                        <span class="text-muted font-weight-bold">{{ __('Added at ') }} {{ date ("d/m/Y", strtotime($document->created_at)) }}</span>
                                    </div>
                                    <button class="btn btn-danger"><a href="{{ route('document.destroy',['document_id'=> $document->id])}}"><i class="icon-2x fas fa-times"></i></a></button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer">
                <form class="form" action="{{ route('document_create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">{{ __('Add a new document') }}</label>
                    </div>
                    <div class="input-group">
                        <input type="hidden" name="type" value="customer">
                        <input type="hidden" name="project_id" value="{{$project_id}}">
                        <input type="text" class="form-control mr-2" name="name" required>
                        <input type="file" class="form-control mr-2" name="document" required>
                        <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                            <i class="la la-check"></i> {{ __('Add') }}
                        </button>
                    </div>
                </form><br>
                <div class="input-group">
                    @foreach($documents as $document)
                        @if($document->type == 'customer')
                            <div class="form-group col-lg-6">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-light-success mr-5">
                                        <span class="symbol-label">
                                            <i class="icon-5x far fa-file-alt"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{ $document->name }}</a>
                                        <span class="text-muted font-weight-bold">{{ __('Added at ') }} {{ date ("d/m/Y", strtotime($document->created_at)) }}</span>
                                    </div>
                                    <button class="btn btn-danger"><a href="{{ route('document.destroy',['document_id'=> $document->id])}}"><i class="icon-2x fas fa-times"></i></a></button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {

    });
</script>
@endsection