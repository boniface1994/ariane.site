@extends('layouts.admin')

@section('content')

<div class="row ">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <label >{{ __('Editing a customer') }}</label>
                </div>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('customer.index') }}"> <h4><i class="icon-xl la la-long-arrow-alt-left"></i> {{ __('Back to list customers') }}</h4></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="quarter_available" class="form" action="{{ isset($customer) ? route('customer.update',['customer'=>$customer->id]) : route('customer.store') }}" method="POST">
                    @csrf
                    @if(isset($customer))
                        @method('PATCH')
                    @endif
                    <h4 class="form-label">{{ __('Your company / Institution') }}</h4><br>
                    <div class="form-group row">
                        <div class="input-group col-lg-12">
                            <input type="text" class="form-control mr-2" name="company" placeholder="{{ __('Company name') }}" value="{{ isset($customer) ? $customer->company : '' }}">
                            <input type="text" class="form-control" name="phone_company" placeholder="{{ __('Phone') }}" value="{{ isset($customer) ? $customer->phone_company : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group col-lg-12">
                            <input type="text" class="form-control mr-2" name="street" placeholder="{{ __('Street adress') }}" value="{{ isset($customer) ? $customer->street : '' }}">
                            <input type="text" class="form-control" name="city" placeholder="{{ __('City') }}" value="{{ isset($customer) ? $customer->city : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group col-lg-12">
                            <input type="text" class="form-control mr-2" name="state" placeholder="{{ __('State') }}" value="{{ isset($customer) ? $customer->state : '' }}">
                            <input type="text" class="form-control" name="postal_code" placeholder="{{ __('Postal code') }}" value="{{ isset($customer) ? $customer->postal_code : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group col-lg-12">
                            <input type="text" class="form-control col-lg-6" name="country" placeholder="{{ __('Country') }}" value="{{ isset($customer) ? $customer->country : '' }}">
                        </div>
                    </div>
                    <h4 class="form-label" >{{ __('Your coordonates') }}</h4><br>
                    <div class="form-group row">
                        <div class="input-group col-lg-12">
                            <input type="text" class="form-control mr-2" name="name" placeholder="{{ __('Name') }}" value="{{ isset($customer) ? $customer->name : '' }}">
                            <input type="text" class="form-control" name="function" placeholder="{{ __('Function') }}" value="{{ isset($customer) ? $customer->function : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group col-lg-12">
                            <input type="text" class="form-control mr-2" name="email" placeholder="{{ __('Email') }}" value="{{ isset($customer) ? $customer->email : '' }}">
                            <input type="text" class="form-control" name="phone" placeholder="{{ __('Phone') }}" value="{{ isset($customer) ? $customer->phone : '' }}">
                        </div>
                    </div>

                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form>
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    jQuery(document).ready(function () {

    });
</script>
@endsection