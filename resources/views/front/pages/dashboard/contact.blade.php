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
                                            <div class="form-group">
                                                <h3 class="form-label">Votre contact Arianespace pour votre projet</h3>
                                            </div>
                                            <div class="input-group">
                                                <textarea name="contact_ariane" id="kt-ckeditor-2" readonly>
                                                    {{$detail->contact_ariane}}
                                                </textarea>
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
                    <a href="{{route('connect')}}"> <label class="form-label"><-Back</label></a>
                </div>
            </div>
        </div>
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
                        $('.ck-rounded-corners').css('width','80%');
                        $('.ck-sticky-panel').css('display','none');
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
        KTCkeditor.init();

        $('.ck-sticky-panel').css('display','none');
    });
</script>
@endsection