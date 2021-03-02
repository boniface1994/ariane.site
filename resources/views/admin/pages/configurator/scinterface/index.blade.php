@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Management of SC Interfaces') }}
</h3>

<div class="container" id="repeater">
    <div class="row">
        <div data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone">
            @foreach ($interfaces as $interface)
            <!--begin::Card-->
            <div class="col-lg-12 card card-custom gutter-b draggable sc-draggable-item">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ __('SC Interface name') }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="sc-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="Toggle Card">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-light-success btn-sm draggable-handle">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Form-->
                    <form class="form" id="interface-form" data-action-create="{{ route('scinterface.store') }}" data-action-remove="{{ route('scinterface.destroy', $interface['id']) }}">
                        @csrf
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="{{ $interface['id'] }}">
                        <div class="form-group">
                            <label>{{ __('SC Interface') }} <span class="text-danger">*</span></label>
                            <div></div>
                            <input type="text" class="name form-control form-control-solid" name="name" placeholder="{{ __('Name') }}" value="{{ $interface['name'] }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Explanation') }}</label>
                            <div></div>
                            <textarea class="explication form-control form-control-solid" name="explication" rows="3">{{ $interface['explication'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-success">
                                    <input class="type" type="checkbox" name="type" @if($interface['sicubesat']) checked @endif>
                                    <span></span>{{ __('Si Cubesat') }}
                                </label>
                                <label class="checkbox checkbox-success">
                                    <input class="type" type="checkbox" name="type" @if($interface['sismallsat']) checked @endif>
                                    <span></span>{{ __('Si Smallsat') }}
                                </label>
                            </div>
                            <!-- <div class="invalid-feedback">Success! You've done it.</div> -->
                        </div>
                        <button type="submit" class="validate-scinterface btn btn-success font-weight-bold mr-2">
                            <i class="la la-check-o"></i> {{ __('Validate') }}
                        </button>

                        <a class="confirm-remove-scinterface btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Card-->
            @endforeach

            <!--begin::Card-->
            <div data-repeater-item class="col-lg-12 card card-custom gutter-b draggable sc-draggable-item">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ __('SC Interface name') }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="sc-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="Toggle Card">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="btn btn btn-icon btn-light-success btn-sm draggable-handle">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Form-->
                    <form class="form interface-form" data-action-create="{{ route('scinterface.store') }}">
                        @csrf
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="">
                        <div class="form-group">
                            <label>{{ __('SC Interface') }} <span class="text-danger">*</span></label>
                            <div></div>
                            <input type="text" class="name form-control form-control-solid" name="name" placeholder="{{ __('Name') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Explanation') }}</label>
                            <div></div>
                            <textarea class="explication form-control form-control-solid" name="explication" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-success">
                                    <input class="type" type="checkbox" name="type">
                                    <span></span>{{ __('Si Cubesat') }}
                                </label>
                                <label class="checkbox checkbox-success">
                                    <input class="type" type="checkbox" name="type">
                                    <span></span>{{ __('Si Smallsat') }}
                                </label>
                            </div>
                            <!-- <div class="invalid-feedback">Success! You've done it.</div> -->
                        </div>
                        <button type="submit" class="validate-scinterface btn btn-success font-weight-bold mr-2">
                            <i class="la la-check-o"></i> {{ __('Validate') }}
                        </button>

                        <a data-repeater-delete class="confirm-remove-scinterface btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
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
        {{ __('Add new SC Interface') }}
    </button>  
</div>

<div class="modal fade bs-modal-sm" id="confirmation-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Confirmation') }}</h4>
            </div>
            <div class="modal-body"> {{ __('Are you sure you want to delete data?') }} </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase mr-2" data-dismiss="modal">
                    <i class="la la-undo"></i> {{ __('Cancel') }}
                </button>
                <button type="button" class="action-remove-scinterface btn btn-outline-danger font-weight-bold">
                    <i class="la la-trash-o"></i> {{ __('Delete') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/custom/draggable/draggable.bundle.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        var form_button = '';

        //draggable
        KTCardDraggable.init();

        //Form repeater
        $('#repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
            },
            isFirstItemUndeletable: true
        })

        $('#repeater').on('click', '.validate-scinterface', function(event) {
            event.preventDefault();
            
            var form = $(this).closest('form');
            var position = $(this).closest('.sc-draggable-item').index();
            
            var url = form.data('action-create');
            var id = form.find('.index').val();
            var name = form.find('.name').val();
            var explication = form.find('.explication').val();
            var type = [];
            form.find('.type').each(function(i, el){
                type[i] = $(el).is(':checked') ? 1 : 0;
            });
            
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id, 'name': name, 'explication': explication, 'sicubesat': type[0], 'sismallsat': type[1], 'position': position},
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        form.find('.index').val(response.id);
                        toastr.success("{{ __('Action completed with success') }}", "{{ __('Success!') }}" );
                        form.find('.confirm-remove-scinterface').removeAttr('data-repeater-delete');
                        form.attr("data-action-remove", response.delete_url);
                    }
                    else if(response.error) {
                        let message = '';
                        $.each(response.errors, function( index, value ) {
                            message += value + ' <br/>';
                        });
                        toastr.error(message, "{{ __('Error!') }}");
                    }
                    
                }
            }) 
            
        })

        $('#repeater').on('click', '.confirm-remove-scinterface', function(event) {
            event.preventDefault();

            $('#confirmation-delete').modal('show')

            form_button = event.target;
        })

        $('.action-remove-scinterface').on('click', function() {
            var form = form_button.closest('form');            
            var url = $(form).attr('data-action-remove');
            var id = $(form).find('.index').val();

            console.log(id)
                       
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id},
                type: 'DELETE',
                success: function (response) {
                    $('#confirmation-delete').modal('hide');

                    let item = $(form).closest('.sc-draggable-item');
                    item.slideUp("normal", function() {
                        item.remove();
                    });
                    toastr.success("{{ __('Success!') }}", "{{ __('Data removed') }}")
                }
            })
        })

        //Expand card
        $('#repeater').on('click', '.sc-collapse', function() {
            var item = $(this).closest('.sc-draggable-item');
            item.toggleClass('expand');
            if(item.hasClass('expand')) item.find('.card-body').slideUp('normal');
            else item.find('.card-body').slideDown('normal');
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