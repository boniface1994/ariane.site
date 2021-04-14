@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

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
                                <div class="col-md-12">
                                    <form class="form" method="POST" action="{{route('toLogin')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" style="font-size: 30px"> {{ __('Project name') }}</label>
                                            <div class="form-group">
                                                <input class="form-control col-lg-6" type="text" name="project">
                                            </div>
                                            <div class="form-group">
                                                <label class="radio">
                                                    <input type="radio"  name="itar"/>
                                                    <span class="mr-2"></span>
                                                    ITAR Information
                                                </label>
                                            </div>
                                            
                                            <div class="form-group">
                                                <button class="btn btn-primary" style="float: center;">I connect</button>
                                            </div>
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