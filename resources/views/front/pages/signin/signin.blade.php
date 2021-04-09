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
                                <div class="col-md-12">
                                    <form class="form" action="{{route('customer_register')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <h3 class="form-label" style="font-size: 30px"> {{ __('YOUR PROJECT') }}</h3>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="project_name" placeholder="Project name">
                                            </div>
                                            <div class="input-group">
                                                <div class="form-group col-lg-6">
                                                    <input type="password" class="form-control" name="password" placeholder="Password"> 
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="password" class="form-control" name="confirm" placeholder="Confirm password">
                                                </div>
                                            </div>
                                            <h3 class="form-label" style="font-size: 30px"> {{ __('YOUR DETAIL') }}</h3>
                                            <div class="input-group">
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="name" placeholder="Name"> 
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="function" placeholder="Function">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="email" placeholder="Email"> 
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                                                </div>
                                            </div>
                                            <h3 class="form-label" style="font-size: 30px"> {{ __('YOUR COMPANY/INSTITUTION') }}</h3>
                                            <div class="input-group">
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="company" placeholder="Company name"> 
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="phone_company" placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="street_adress" placeholder="Street adress"> 
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="city" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="state" placeholder="State"> 
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="postal" placeholder="Postal code">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="form-group col-lg-6">
                                                    <input type="text" class="form-control" name="country" placeholder="Country"> 
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="radio">
                                                    <input type="radio"  name="itar"/>
                                                    <span class="mr-2"></span>
                                                    ITAR Information
                                                </label>
                                            </div><div class="form-group col-lg-6">
                                                <label class="radio">
                                                    <input type="radio" checked="checked" name="itar"/>
                                                    <span class="mr-2"></span>
                                                    I accept the conditions of use
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" style="float: right;">FINALIZE MY LAUNCH REQUEST</button>
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