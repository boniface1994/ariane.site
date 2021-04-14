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
                                                    <i class="fa fa-genderless icon-xl"></i>
                                                </div>
                                                <!--end::Badge-->

                                                <!--begin::Desc-->
                                                <div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">
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
                                                    <i class="fa fa-genderless icon-xl"></i>
                                                </div>
                                                <!--end::Badge-->

                                                <!--begin::Desc-->
                                                <div class="timeline-content font-weight-bolder text-dark-75 pl-3 font-size-lg">
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
                                                                <i class="">-</i>
                                                            </div>
                                                            <!--end::Badge-->

                                                            <!--begin::Text-->
                                                            <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
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
                                                                <i class="">-</i>
                                                            </div>
                                                            <!--end::Badge-->

                                                            <!--begin::Content-->
                                                            <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                                                You are here
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
                                                                <i class="">-</i>
                                                            </div>
                                                            <!--end::Badge-->

                                                            <!--begin::Desc-->
                                                            <div class="font-weight-mormal font-size-lg timeline-content pl-3">
                                                                You are here
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
                                                    <i class="fa fa-genderless icon-xl"></i>
                                                </div>
                                                <!--end::Badge-->

                                                <!--begin::Desc-->
                                                <div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">
                                                    QUALIFICATION STATUS
                                                </div>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Item-->
                                        </div>


                                    </form>
                                </div>
                            </div><br>
                        </div>
                        <div class="col-lg-3">
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