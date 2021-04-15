@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-group">
                                    <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" />
                                </div>
                                <div class="form-group" style="height: 100%;overflow-y: auto;">
                                    @foreach($projects as $project)
                                        <div class="form-group ml-4">
                                            <label class="form-label">{{$project->name}}</label><br>
                                            <a href="{{route('timeline',['project_id'=>$project->id])}}">Timelines</a><br>
                                            <a href="{{route('caracteristic',['id'=>$project->id])}}">Informations</a><br>
                                            <a href="{{route('option',['project_id'=>$project->id])}}">Options</a><br>
                                            <a href="">Synthèse</a><br>
                                            <a href="{{route('project.document',['project_id'=>$project->id])}}">Documents</a><br>
                                            <a href="{{route('contact.ariane',['project_id'=>$project->id])}}">Votre contacts</a><br>
                                            <a href="{{route('nda',['project_id'=>$project->id])}}">NDA</a><br>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-9"  >
                            <div class="input-group col-md-12" >
                                <div class="form-group col-md-6">
                                    <select class="form-control select_project">
                                        <option value="">Select project</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}" {{($detail && $detail->id == $project->id) ? 'selected' : ''}}>{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group col-md-6">
                                    <div class="form-group">
                                        <label>{{Auth::guard('customer')->user()->name}}</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <a class="form-label" href="{{route('beforelogin')}}">Deconnexion</a>
                                    </div>
                                </div>
                            </div>
                            @if(count($projects) > 0)
                                @if($detail)
                                    <div class="col-md-12">
                                        <div class="form-group">
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
                                            </div>
                                            <div class="card-body document">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="ref" role="tabpanel" aria-labelledby="ref">
                                                    
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Retrouvez ici les documents Arianespace pour projet.') }}</label>
                                                        </div>
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
                                                                            <!-- <button class="btn btn-danger"><a href="{{ route('document.destroy',['document_id'=> $document->id])}}"><i class="icon-2x fas fa-times"></i></a></button> -->
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer">
                                                        <form class="form" action="{{ route('upload-doc') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <h4>Vous pouvez déposer ici vos modèles (CAD, FEM)</h4>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">{{ __('Add a new document') }}</label>
                                                            </div>
                                                            <div class="input-group">
                                                                <input type="hidden" name="type" value="customer">
                                                                <input type="hidden" name="project_id" value="{{$detail->id}}">
                                                                <input type="text" class="form-control mr-2" name="name" required>
                                                                <input type="file" class="form-control mr-2" name="document" required>
                                                                <button type="submit" class="validate-option btn btn-warning font-weight-bold mr-2">
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
                                                                            <button class="btn btn-danger"><a href="{{ route('delete-doc',['id'=> $document->id])}}"><i class="icon-2x fas fa-times"></i></a></button>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="form-group">
                                    <label class="form-label">Select an project</label>
                                </div>
                                @endif
                            @else
                                <div class="col-lg-3">
                                    <label class="btn btn-warning"><a href="">CRÉER VOTRE PREMIER PROJET</a></label>
                                </div>
                            @endif
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
        $('.select_project').on('change',function(){
            var project_id = $(this).val();
            setTimeout(function(){
                var path='';
                var old_path = window.location.pathname.split('/');
                for(var i=0;i<old_path.length;i++){
                    if(i>0 && i<(old_path.length-1)){
                        path+='/'+old_path[i];
                    }
                }
                window.location.replace(window.location.origin+path+'/'+project_id);
            },1000);
        });
    });
</script>
@endsection