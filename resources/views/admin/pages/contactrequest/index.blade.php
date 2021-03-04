@extends('layouts.admin')

@section('content')

<div class="row ">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <label >{{ __('Contact requests made from the site') }}</label>
                </div>
            </div>
            <div class="card-body contact_request">
                <form  class="form" data-url="" action="{{ route('request_search') }}" method="POST">
                    @csrf
                    <h4 class="form-label">{{ __('Search / Filter') }}</h4><br>
                    <div class="form-group">
                        <div class="radio-list">
                            <label class="radio">
                                <input type="radio" {{ (session('status') && session('status') == 2) ? 'checked="checked"' : '' }}  name="status" value="2"/>
                                <span></span>
                                {{ __('All requests') }}
                            </label>
                            <label class="radio">
                                <input type="radio" {{ (!session('status') && session('status') == '0') ? 'checked="checked"' : '' }} name="status" value="0"/>
                                <span></span>
                                {{ __('That untreated requests') }}
                            </label>
                            <label class="radio">
                                <input type="radio" {{ (session('status') && session('status') == 1) ? 'checked="checked"' : '' }} name="status" value="1"/>
                                <span></span>
                                {{ __('That the requests processed') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-light-danger" href="{{ route('request_reset_search') }}"> {{ __('Reset search') }}</a>
                        <input type="submit" class="btn btn-light-primary font-weight-bold" value="{{ __('Search') }}">
                    </div>
                </form>
                <h4 class="form-label" >{{ __('Number of elements : ') }} [{{ $requests ? count($requests) : 0 }}]</h4><br>
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Date') }}</th>
                            <th scope="col">{{ __('Company') }}</th>
                            <th scope="col">{{ __('Contacts') }}</th>
                            <th scope="col">{{ __('Messages') }}</th>
                            <th scope="col">{{ __('Treaty') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($requests)
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{ date ("d/m/Y h:i:s", strtotime($request->created_at)) }}</td>
                                    <td>
                                        <div class="form-group">
                                            <p>{{ __('Company name : ') }}{{ $request->customer->company }}</p>
                                            <p>{{ __('Phone : ') }}{{ $request->customer->phone_company }}</p>
                                            <p>{{ __('Street address : ') }}{{ $request->customer->street }}</p>
                                            <p>{{ __('City : ') }}{{ $request->customer->city }}</p>
                                            <p>{{ __('State : ') }}{{ $request->customer->state }}</p>
                                            <p>{{ __('Postal code : ') }}{{ $request->customer->postal_code }}</p>
                                            <p>{{ __('Country : ') }}{{ $request->customer->country }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <p>{{ __('Name : ') }}{{ $request->customer->name }}</p>
                                            <p>{{ __('Phone : ') }}{{ $request->customer->phone }}</p>
                                            <p>{{ __('Function : ') }}{{ $request->customer->function }}</p>
                                            <p>{{ __('Email : ') }}{{ $request->customer->email }}</p>
                                        </div>
                                    </td>
                                    <td>{{ $request->message }} {{session('status')}}</td>
                                    <td class="datatable-cell">
                                        <div class="col-3">
                                            <span class="switch switch-outline switch-icon switch-primary">
                                                <label>
                                                    <input data-url="{{ route('request.update',['request'=>$request->id]) }}" type="checkbox" class="{{ $request->status ? 'checked' : '' }}" {{ $request->status ? "checked='checked'" : '' }} name="status"/>
                                                    <span></span>
                                                </label>
                                            </span>                                             
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {!! $requests->links() !!}

            </div>
        </div>
        <!--end::Card-->
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.contact_request').find('table input[type="checkbox"]').each(function(i,el){
            $(el).on('click',function(){
                if($(this).hasClass('checked')){
                    $(this).removeClass('checked');
                    $(this).val(0);
                }else{
                    $(this).addClass('checked');
                    $(this).val(1);
                }
                let url = $(this).data('url');
                let data = {"_token": "{{ csrf_token() }}","status":$(this).val()};
                $.ajax({
                    url: url,
                    data: data,
                    method: 'PATCH',
                    success: function(response){
                        if(response.status == 1){
                            toastr.success('Contact treaty successefully!');
                        }else{
                            toastr.success('Contact untreat!');
                        }
                    }
                });
            })
        })
    });
</script>
@endsection