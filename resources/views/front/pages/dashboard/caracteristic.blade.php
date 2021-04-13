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
                                <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" />
                                @foreach($projects as $project)
                                    <div class="form-group ml-4">
                                        <label class="form-label">{{$project->name}}</label><br>
                                        <a href="">Timelines</a><br>
                                        <a href="{{route('caracteristic',['id'=>$project->id])}}">Informations</a><br>
                                        <a href="">Options</a><br>
                                        <a href="">Synthèse</a><br>
                                        <a href="">Documents</a><br>
                                        <a href="">Votre contacts</a><br>
                                        <a href="">NDA</a><br>
                                        <a href="">Supprimer ce projet</a><br>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group col-lg-9"  >
                            <div class="input-group">
                                <div class="form-group col-lg-3">
                                    <label class="form-label">Your account are created</label>
                                </div>
                                <div class="form-group col-lg-9">
                                    <label class="form-label"> An email has been sent with link enable you to confirm that your Ariane Espace dashboard has been created</label>
                                    <p>Please check your spam folder if email has not arrived within 2 minutes</p>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-md-12">
                                    
                                </div>
                            </div><br>
                        </div>
                        <div class="col-lg-3">
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