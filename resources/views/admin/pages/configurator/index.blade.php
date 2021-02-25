@extends('layouts.admin')

@section('content')

    <!--begin::Form-->
    <form class="form" action="{{route('technical.store')}}" method="POST">
    @csrf
        <div class="card-body">

            <div class="form-group row">
                <label class="col-lg-2 col-form-label text-right"></label>
                <div class="col-lg-4">
                    <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                    <i class="la la-plus"></i>{{ __('Ajouter un nouvel maturité technique') }}</a>
                </div>
            </div>
            <div>
                <div class="form-group row">
                    <div class="col-lg-12 draggable-zone">
                    <div class="card card-custom gutter-b draggable">
                            <div class="card-header">
                                <div class="card-title">
                                    <label>{{ __('Maturité technique *') }}</label>
                                </div>
                                <div class="card-toolbar">
                                    <div >
                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light">
                                        <i class="icon-1x text-dark-50 ki ki-close"></i>{{ __('Supprimer') }}</a>
                                    </div>
                                    <div>
                                        <a href="#" class="btn btn-icon btn-hover-light-primary draggable-handle">
                                            <i class="ki ki-menu "></i>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row align-items-center">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="title[]">
                                        <input type="hidden" class="form-control" name="position[]">
                                        <div class="d-md-none mb-2"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom gutter-b draggable">
                            <div class="card-header">
                                <div class="card-title">
                                    <label>{{ __('Maturité technique *') }}</label>
                                </div>
                                <div class="card-toolbar">
                                    <div >
                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light">
                                        <i class="icon-1x text-dark-50 ki ki-close"></i>{{ __('Supprimer') }}</a>
                                    </div>
                                    <div>
                                        <a href="#" class="btn btn-icon btn-hover-light-primary draggable-handle">
                                            <i class="ki ki-menu "></i>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row align-items-center">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="title[]">
                                        <input type="hidden" class="form-control" name="position[]">
                                        <div class="d-md-none mb-2"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input class="btn btn-primary" type="submit" name="" value="Valider">
        </div>
        
    </form>

@endsection
@section('js')
<script src="assets/plugins/custom/draggable/draggable.bundle.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){

        $("#form-technical").validate({
        rules : {
            title : {
            required : true
            }
        },
        messages : {
            title : "Veuillez remplir une téchnique"
        },
        submitHandler: function(form) {
            form.submit();
        }
        });
    });

</script>
@endsection