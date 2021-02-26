@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Gestion des SC Interfaces') }}
</h3>

<div class="container" id="repeater">
    <div class="row">
        <div data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone">
            <!--begin::Card-->
            <div data-repeater-item class="col-lg-12 card card-custom gutter-b draggable">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">SC Interface name</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="Toggle Card">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Form-->
                    <form class="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label>SC Interface</label>
                                <div></div>
                                <input type="text" class="form-control form-control-solid" placeholder="Example input">
                            </div>
                            <div class="form-group">
                                <label>Explication</label>
                                <div></div>
                                <textarea class="form-control form-control-solid" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-success">
                                        <input type="checkbox" name="type[]">
                                        <span></span>Si Cubesat
                                    </label>
                                    <label class="checkbox checkbox-success">
                                        <input type="checkbox" name="type[]">
                                        <span></span>Si Smallsat
                                    </label>
                                </div>
                                <!-- <div class="invalid-feedback">Success! You've done it.</div> -->
                            </div>
                            <a href="#" class="btn btn-success font-weight-bold mr-2">
                                <i class="la la-check-o"></i> Valider
                            </a>

                            <a data-repeater-delete class="btn btn-outline-danger font-weight-bold mr-2">
                                <i class="la la-trash-o"></i> Supprimer
                            </a>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div> 

    <button data-repeater-create class="btn btn-text-dark font-weight-bold btn-hover-bg-light" id="">
        <span class="btn btn-icon font-size-h3 btn-light-dark btn-hover-bg-light-dark btn-sm btn-circle mr-2">
            <i class="la la-plus font-size-h1"></i>
        </span>
        Ajouter un nouveau SC Interface
    </button>  
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/custom/draggable/draggable.bundle.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        //draggable
        KTCardDraggable.init();

        //Form repeater
        $('#repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            isFirstItemUndeletable: true
        })
    });

    var KTCardDraggable = function () {
        return {
            //main function to initiate the module
            init: function () {
                var containers = document.querySelectorAll('.draggable-zone');

                if (containers.length === 0) {
                    return false;
                }

                var swappable = new Sortable.default(containers, {
                    draggable: '.draggable',
                    handle: '.draggable .draggable-handle',
                    mirror: {
                        appendTo: 'body',
                        constrainDimensions: true
                    }
                });
            }
        };
    }();

</script>
@endsection