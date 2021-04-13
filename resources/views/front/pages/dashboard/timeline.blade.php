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
                                @foreach($projects as $project)
                                    <div class="form-group ml-4">
                                        <label class="form-label">{{$project->name}}</label><br>
                                        <a href="{{route('timeline',['project_id'=>$project->id])}}">Timelines</a><br>
                                        <a href="{{route('caracteristic',['id'=>$project->id])}}">Informations</a><br>
                                        <a href="">Options</a><br>
                                        <a href="">Synthèse</a><br>
                                        <a href="">Documents</a><br>
                                        <a href="">Votre contacts</a><br>
                                        <a href="">NDA</a><br>
                                    </div>
                                @endforeach
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
                                        <a class="form-label" href="{{route('front.logout')}}">Deconnexion</a>
                                    </div>
                                </div>
                            </div>
                            @if(count($projects) > 0)
                                @if($detail)
                                <div class="input-group">
                                    <div class="form-group col-lg-3">
                                        <label class="form-label">Vous n'avez pas signé le NDA</label>
                                    </div>
                                    <div class="form-group col-lg-9">
                                        <a href="{{route('nda')}}" target="_blank" class="btn btn-warning"> TELECHARGER LE NDA</a>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="col-md-12">
                                        <form class="form">
                                            @csrf
                                            

                                            <div class="timeline timeline-6 mt-3">
                                                <!--begin::Item-->
                                                <div class="timeline-item align-items-start">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                    <!--end::Label-->

                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-warning icon-xl"></i>
                                                    </div>
                                                    <!--end::Badge-->

                                                    <!--begin::Text-->
                                                    <div class="font-weight-mormal font-size-lg timeline-content text-warning pl-3">
                                                        You are here
                                                    </div>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="timeline-item align-items-start">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                    <!--end::Label-->

                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-warning icon-xl"></i>
                                                    </div>
                                                    <!--end::Badge-->

                                                    <!--begin::Content-->
                                                    <div class="timeline-content d-flex">
                                                        <span class="font-weight-bolder text-warning pl-3 font-size-lg">WELCOME PACKAGE</span>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="timeline-item align-items-start">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                    <!--end::Label-->

                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless icon-xl {{($detail && ($detail->step == 2 || $detail->step == 3 || $detail->step == 4)) ? 'text-warning' : ''}}"></i>
                                                    </div>
                                                    <!--end::Badge-->

                                                    <!--begin::Desc-->
                                                    <div class="timeline-content font-weight-bolder font-size-lg  {{($detail && ($detail->step == 2 || $detail->step == 3 || $detail->step == 4)) ? 'text-warning' : 'text-dark-75'}}">
                                                        GET YOUR CONTRACT
                                                    </div>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="timeline-item align-items-start">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                    <!--end::Label-->

                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless icon-xl {{($detail && ($detail->step == 4 || $detail->step == 3)) ? 'text-warning' : ''}}" ></i>
                                                    </div>
                                                    <!--end::Badge-->

                                                    <!--begin::Desc-->
                                                    <div class="timeline-content font-weight-bolder {{($detail && ($detail->step == 4 || $detail->step == 3)) ? 'text-warning' : 'text-dark-75'}} font-size-lg">
                                                        FAISABILITY ANALYSIS
                                                        <div class="timeline timeline-6 " style="margin-left: -41px;margin-top: -4px;">
                                                            <div class="timeline-item align-items-start">
                                                                <!--begin::Label-->
                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                                <!--end::Label-->

                                                                <!--begin::Badge-->
                                                                
                                                                <!--end::Badge-->
                                                            </div>
                                                            <!--begin::Item-->
                                                            <div class="timeline-item align-items-start">
                                                                <!--begin::Label-->
                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                                <!--end::Label-->

                                                                <!--begin::Badge-->
                                                                <div class="timeline-badge">
                                                                    <i class="{{($detail && ($detail->step == 4 || $detail->step == 3)) ? 'text-warning' : ''}}">-</i>
                                                                </div>
                                                                <!--end::Badge-->

                                                                <!--begin::Text-->
                                                                <div class="font-weight-mormal font-size-lg timeline-content {{($detail && ($detail->step == 4 || $detail->step == 3)) ? 'text-warning' : 'text-muted'}} pl-3">
                                                                    You provid us with your model
                                                                </div>
                                                                <!--end::Text-->
                                                            </div>
                                                            <!--end::Item-->

                                                            <!--begin::Item-->
                                                            <div class="timeline-item align-items-start">
                                                                <!--begin::Label-->
                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                                <!--end::Label-->

                                                                <!--begin::Badge-->
                                                                <div class="timeline-badge">
                                                                    <i class="{{($detail && ($detail->step == 4 || $detail->step == 3)) ? 'text-warning' : 'text-muted'}}">-</i>
                                                                </div>
                                                                <!--end::Badge-->

                                                                <!--begin::Content-->
                                                                <div class="font-weight-mormal font-size-lg timeline-content {{($detail && ($detail->step == 4 || $detail->step == 3)) ? 'text-warning' : 'text-muted'}} pl-3">
                                                                    We do accomodation analysis
                                                                </div>
                                                                <!--end::Content-->
                                                            </div>
                                                            <!--end::Item-->

                                                            <!--begin::Item-->
                                                            <div class="timeline-item align-items-start">
                                                                <!--begin::Label-->
                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                                <!--end::Label-->

                                                                <!--begin::Badge-->
                                                                <div class="timeline-badge">
                                                                    <i class="{{($detail && ($detail->step == 4 || $detail->step == 3)) ? 'text-warning' : ''}}">-</i>
                                                                </div>
                                                                <!--end::Badge-->

                                                                <!--begin::Desc-->
                                                                <div class="font-weight-mormal font-size-lg timeline-content pl-3 {{($detail && ($detail->step == 4 || $detail->step == 3)) ? 'text-warning' : 'text-muted'}}">
                                                                    We define your SC qualification level
                                                                </div>
                                                                <!--end::Desc-->
                                                            </div>
                                                            <!--end::Item-->

                                                            
                                                        </div>
                                                    </div>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="timeline-item align-items-start">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                                    <!--end::Label-->

                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless icon-xl {{($detail && $detail->step == 4) ? 'text-warning' : ''}}"></i>
                                                    </div>
                                                    <!--end::Badge-->

                                                    <!--begin::Desc-->
                                                    <div class="timeline-content font-weight-bolder font-size-lg {{($detail && $detail->step == 4) ? 'text-warning' : 'text-dark-75'}} pl-3">
                                                        QUALIFICATION STATUS
                                                    </div>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Item-->
                                            </div>


                                        </form>
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
<script type="text/javascript">
    jQuery(document).ready(function () {
        
    });
</script>
@endsection