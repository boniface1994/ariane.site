@extends('layouts.admin')

@section('content')

<div class="row ">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <label >{{ __('Customers list') }}</label>
                </div>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('customer.create') }}"> <h4><i class="icon-xl la la-plus"></i> {{ __('New customer') }}</h4></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form  class="form" data-url="" action="{{ route('customer_search') }}" method="POST">
                    @csrf
                    <h4 class="form-label">{{ __('Search / Filter') }}</h4><br>
                    <div class="form-group row">
                        <div class="input-group col-lg-4">
                            <label class="col-form-label mr-2">{{ __('Society') }}</label>
                            <input type="text" class="form-control" name="company" value="{{ Session::has('company') ? session('company') : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group col-lg-4">
                            <label class="col-form-label mr-2">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ Session::has('name') ? session('name') : '' }}">
                        </div>
                    </div>
                    <div class=" form-group row checkbox-inline ml-14">
                        <label class="checkbox ">
                            <input type="checkbox" name="nda">
                            <span></span>{{('NDA signed not received')}}
                        </label>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-light-danger" href="{{ route('reset_search') }}"> {{ __('Reset search') }}</a>
                        <input type="submit" class="btn btn-light-primary font-weight-bold" value="{{ __('Search') }}">
                    </div>
                </form>
                <h4 class="form-label" >{{ __('Number of elements : ') }} [{{ $customers ? count($customers) : 0 }}]</h4><br>
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Company') }}</th>
                            <th scope="col">{{ __('NDA signed') }}</th>
                            <th scope="col">{{ __('Last name First Name') }}</th>
                            <th scope="col">{{ __('Projects') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($customers)
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->company }}</td>
                                    <td></td>
                                    <td>{{ $customer->name }}</td>
                                    <td>
                                        @foreach($customer->projects as $project)
                                            <label>{{ $project->name }}</label><br>
                                        @endforeach
                                    </td>
                                    <td class="datatable-cell">
                                        <span style="overflow: visible; position: relative;">
                                            <a class="btn btn-sm btn-light-primary btn-icon mr-2" href="{{ route('customer.edit',['customer' => $customer->id]) }}"> <i class="fa fa-pen"></i> </a>
                                            <a class="btn btn-sm btn-light-danger btn-icon" data-toggle="modal" data-target="#modal{{$customer->id}}" data-href="{{ route('customer.destroy',['customer' => $customer->id]) }}"> <i class="fa fa-trash"></i> </a>
                                            <div class="modal fade" id="modal{{$customer->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('customer.destroy',['customer' => $customer->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                {{ __('Do you want to delete ') }} {{ $customer->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default font-weight-bold" data-dismiss="modal">{{ __('Cancel') }}</button>
                                                                <button type="submit" class="btn btn-danger font-weight-bold">{{ __('Delete') }}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {!! $customers->links() !!}

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