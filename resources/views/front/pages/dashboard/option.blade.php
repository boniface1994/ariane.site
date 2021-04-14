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
                                    <div class="col-md-12 project-option">
                                        <form class="form">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <h4 class="form-label">Vos options</h4>
                                                </div>
                                                <div class="input-group">
                                                    @foreach($options as $option)
                                                        <div class="col-md-3 mr-2  option" >
                                                            <!-- <div class="card-body"> -->
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <h4 class="form-label mr-2">{{$option->name}}</h4>
                                                                        <label class="checkbox checkbox-primary" style="margin-top: -10px">
                                                                            <input type="checkbox" class="ml-3 checker" data-session="{{$option->id}}" name="alloptions[]" value="{{$option->id}}"/>
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                    <label class="form-label">{{$option->explication}}</label><br>
                                                                    <!-- <label class="form-label" style="font-size: 10px">{{$option->cost}}</label> -->
                                                                </div>
                                                            <!-- </div> -->
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <button class="btn btn-warning">Valider</button>
                                            </div>
                                        </form>
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
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.project-option').find('.option').each(function(i,el){
            $(el).on('click',function(){
                if($(this).find('.checker').is(':checked')){
                    $(this).find('.checker').attr('checked',false);
                    $(this).css('background-color',"");
                }else{
                    $(this).find('.checker').attr('checked',true);
                    $(this).css('background-color',"#2176bd");
                }
            });
        });
    });
</script>
@endsection