@extends('layouts.admin')

@section('content')
<h3 class="card-title">
            {{ __('Gestion price list') }}
</h3>
<div class="card card-custom ">
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
    <div class="card-body pricelists">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="ref" role="tabpanel" aria-labelledby="ref">
                <form class="form" action="{{ route('pricelist.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-40 symbol-light-success mr-5">
                                <span class="symbol-label">
                                    <i class="icon-5x far fa-file-alt"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Nikky Peres</a>
                                <span class="text-muted font-weight-bold">Yestarday at 5:06 PM</span>
                            </div>
                            <div><i class="icon-2x fas fa-times"></i></div>
                        </div>
                    </div>

                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form>
            </div>
            <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer">
                <form class="form" action="{{ route('pricelist.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <table class="table table-bordered">
                            <thead>
                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ __('Mass bearings') }}</td>
                                    
                                </tr>
                                <tr>
                                    <td>{{ __('Price per kg LEO') }}</td>
                                    
                                </tr>
                                <tr>
                                    <td>{{ __('Price per kg GTO') }}</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form>
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