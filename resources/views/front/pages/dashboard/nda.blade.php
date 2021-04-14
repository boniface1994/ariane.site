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
                                            <a href="">NDA</a><br>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-9"  >
                            <div class="input-group col-md-12" >
                                <div class="form-group col-md-6">
                                    <select class="form-control">
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
                                    @if($detail->nda != null)
                                        <div class="col-md-12">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Arianespace vous propose un modèle de NDA pré-rempli.Vous pouvez le signer et le renvoyer par le formulaire ci-dessous.</label>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{route('nda.generate',['id'=>$detail->id])}}" target="_blank">Télécharger le NDA</a>
                                            </div>
                                        </div>
                                        <form class="form">
                                            <div class="form-group">
                                                <label class="form-label">Envoyer le NDA signé à Ariane Espae :</label>
                                                <div class="input-group col-md-6">
                                                    <input type="file" name="nda" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-warning">Envoyer</button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="input-group">
                                            <div class="form-group mr-2">
                                                <h4 class="form-label">Vous pouvez télécharger le NDA signé</h4>
                                            </div>
                                            <div class="form-group">
                                                <a href="" class="btn btn-success">Télécharger le NDA</a>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                <div class="form-group">
                                    <label class="form-label">Select an project</label>
                                </div>
                                @endif
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
    });
</script>
@endsection