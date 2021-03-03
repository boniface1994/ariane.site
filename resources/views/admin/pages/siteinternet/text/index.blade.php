@extends('layouts.admin')

@section('content')

<div class="row ">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <label >{{ __('Texts list') }}</label>
                </div>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('text.create') }}"> <h4><i class="icon-xl la la-plus"></i> {{ __('New text') }}</h4></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form  class="form" data-url="" action="{{ route('customer_search') }}" method="POST">
                    @csrf
                    <h4 class="form-label">{{ __('Search / Filter') }}</h4><br>
                    <div class="form-group row">
                        <div class="input-group col-lg-4">
                            <label class="col-form-label mr-2">{{ __('Slug') }}</label>
                            <input type="text" class="form-control" name="slug" value="{{ Session::has('slug') ? session('slug') : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group col-lg-4">
                            <label class="col-form-label mr-2">{{ __('Contains') }}</label>
                            <input type="text" class="form-control" name="contenue" value="{{ Session::has('contenue') ? session('contenue') : '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-light-danger" href="{{ route('reset_search') }}"> {{ __('Reset search') }}</a>
                        <input type="submit" class="btn btn-light-primary font-weight-bold" value="{{ __('Search') }}">
                    </div>
                </form>
                <h4 class="form-label" >{{ __('Number of elements : ') }} [{{ $texts ? count($texts) : 0 }}]</h4><br>
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Slug') }}</th>
                            <th scope="col">{{ __('Descriptive') }}</th>
                            <th scope="col">{{ __('Texts (truncated to 300 characters)') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($texts)
                            @foreach($texts as $text)
                                <tr>
                                    <td>{{ $text->slug }}</td>
                                    <td>{{ $text->description }}</td>
                                    <td>{{ substr($text->contenue, 0, 300) }} ...</td>
                                    <td class="datatable-cell">
                                        <span style="overflow: visible; position: relative;">
                                            <a class="btn btn-sm btn-light-primary btn-icon mr-2" href="{{ route('text.edit',['text' => $text->id]) }}"> <i class="fa fa-pen"></i> </a>                                        
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {!! $texts->links() !!}

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