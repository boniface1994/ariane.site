@extends('layouts.admin')

@section('content')

<div class="row ">
    <div class="col-lg-12 gutter-b">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <label >{{ __('Editing a text') }}</label>
                </div>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('text.index') }}"> <h4><i class="icon-xl la la-long-arrow-alt-left"></i> {{ __('Back to list texts') }}</h4></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="quarter_available" class="form" action="{{ isset($text) ? route('text.update',['text'=>$text->id]) : route('text.store') }}" method="POST">
                    @csrf
                    @if(isset($text))
                        @method('PATCH')
                    @endif
                    <div class="form-group row">
                        <div class="input-group col-lg-12">
                            <label class="col-form-label mr-2" for="">{{ __('Slug : ') }}</label>
                            <input type="text" class="form-control col-md-2 slug" name="slug" value="{{ isset($text) ? $text->slug : '' }}"  readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="">{{ __('Description *') }}</label>
                        <input type="text" class="form-control  form-control-lg col-lg-12 description" name="description" value="{{ isset($text) ? $text->description : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Text *') }}</label><br>
                    </div>
                    <div class="form-group">
                        <textarea class="col-lg-12" name="contenue" rows="10">{{ isset($text) ? $text->contenue : '' }}</textarea>
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
        $('#quarter_available').find('.description').on('keyup',function(){
            $('#quarter_available').find('.slug').val(convertToSlug($(this).val()));
        });
        function convertToSlug(Text){
            return Text
                .toLowerCase()
                .replace(/ /g,'-')
                .replace(/[^\w-]+/g,'')
                ;
        }
    });
</script>
@endsection