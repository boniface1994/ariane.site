@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Management of propellant types') }}
</h3>

<div class="container" id="repeater">
    <button data-repeater-create class="btn btn-success font-weight-bold mb-4">
        <i class="la la-plus font-size-h1"></i>
        {{ __('Add new propellant type') }}
    </button> 

    <div class="row">
        <div data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone">

            @foreach($propellanttypes as $propellanttype)
            <div class="col-lg-12 card card-custom gutter-b draggable propellanttype-draggable-item card-collapsed">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ $propellanttype['name'] }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="propellanttype-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __('Collapse or expand Card') }}">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form interface-form" data-action-store="{{ route('propellanttype.store') }}" data-action-remove="{{ route('propellanttype.destroy', $propellanttype['id']) }}">
                        @csrf
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="">
                        <div class="form-group">
                            <label>{{ __('Propellant type') }} <span class="text-danger">*</span></label>
                            <div></div>
                            <input type="text" class="name form-control form-control-solid" name="name" placeholder="{{ __('Name') }}" value="{{ $propellanttype['name'] }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Explanation') }}</label>
                            <div></div>
                            <textarea class="explication form-control form-control-solid" name="explication" rows="3">{{ $propellanttype['explication'] }}</textarea>
                        </div>
                        <button type="submit" class="validate-propellanttype btn btn-success font-weight-bold mr-2">
                            <i class="la la-check"></i> {{ __('Validate') }}
                        </button>

                        <a class="confirm-remove-propellanttype btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                    </form>
                </div>
            </div>
            @endforeach

            <div data-repeater-item class="d-none col-lg-12 card card-custom gutter-b draggable propellanttype-draggable-item first-event">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ __('Propellant type name') }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="appended propellanttype-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __('Collapse or expand Card') }}">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="appended btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form interface-form" data-action-store="{{ route('propellanttype.store') }}">
                        @csrf
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="">
                        <div class="form-group">
                            <label>{{ __('Propellant type') }} <span class="text-danger">*</span></label>
                            <div></div>
                            <input type="text" class="name form-control form-control-solid" name="name" placeholder="{{ __('Name') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Explanation') }}</label>
                            <div></div>
                            <textarea class="explication form-control form-control-solid" name="explication" rows="3"></textarea>
                        </div>
                        <button type="submit" class="validate-propellanttype btn btn-success font-weight-bold mr-2">
                            <i class="la la-check"></i> {{ __('Validate') }}
                        </button>

                        <a data-repeater-delete class="confirm-remove-propellanttype btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </div> 
 
</div>

<div class="modal fade bs-modal-sm" id="confirmation-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Confirmation') }}</h4>
            </div>
            <div class="modal-body"> {{ __('Are you sure you want to delete this item?') }} </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase mr-2" data-dismiss="modal">
                    <i class="la la-undo"></i> {{ __('Cancel') }}
                </button>
                <button type="button" class="action-remove-propellanttype btn btn-outline-danger font-weight-bold">
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

        //ToolTips
        // $('#repeater').on('mouseenter', '.appended.propellanttype-collapse, .appended.draggable-handle', function(event) {
        //     $(this).tooltip('show');
        // })

        //Collapse Expand card
        $('.propellanttype-draggable-item').each(function(i, element) {
            var id = randstr('card_');
            $(element).attr('id', id);
            var card = new KTCard(id);
        })

        $('#repeater').on('click', '.appended.propellanttype-collapse', function() {
            var item = $(this).closest('.propellanttype-draggable-item');
            var body = item.find('.card-body');
            var id = randstr('card_');

            item.attr('id', id);
            var card = new KTCard(id);

            //Event doesn't fire on first time
            if(item.hasClass('first-event')) card.toggle(); item.removeClass('first-event');

        })

        //Form repeater
        $('#repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).removeClass('d-none');
                $(this).slideDown();
            },
            hide: function () {
                $(this).slideUp();
            },
            ready: function (setIndexes) {
                var id = randstr('card_');
                $(this).attr('id', id);
                var card = new KTCard(id);
            },
            isFirstItemUndeletable: true
        })

        $('#repeater').on('click', '.validate-propellanttype', function(event) {
            event.preventDefault();
            
            var form = $(this).closest('form');
            var position = $(this).closest('.propellanttype-draggable-item').index();
            
            var url = form.data('action-store');
            var id = form.find('.index').val();
            var name = form.find('.name').val();
            var explication = form.find('.explication').val();
            
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id, 'name': name, 'explication': explication, 'position': position},
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        toastr.success("{{ __('Action completed with success') }}", "{{ __('Success!') }}" );
                        
                        form.find('.index').val(response.id);
                        form.closest('.propellanttype-draggable-item').find('.card-title h3').text(response.name);
                        form.find('.confirm-remove-propellanttype').removeAttr('data-repeater-delete');
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

        $('#repeater').on('click', '.confirm-remove-propellanttype', function(event) {
            event.preventDefault();

            $('#confirmation-delete').modal('show')

            form_button = event.target;
        })

        $('.action-remove-propellanttype').on('click', function() {
            let form = form_button.closest('form');            
            let url = $(form).attr('data-action-remove');
            let id = $(form).find('.index').val();
                       
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id},
                type: 'DELETE',
                success: function (response) {
                    $('#confirmation-delete').modal('hide');

                    let item = $(form).closest('.propellanttype-draggable-item');
                    item.slideUp("normal", function() {
                        item.remove();
                    });
                    toastr.success("{{ __('Data removed') }}", "{{ __('Success!') }}")
                }
            })
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

                swappable.on('sortable:stop', function(sortableEvent) {
                    setTimeout(() => {
                        var data = [];
                        $('.propellanttype-draggable-item').each(function(i, el) {
                            var id = $(el).find('.index').val();
                            //i=position
                            data[i] = id;

                        })
                        
                        $.ajax({
                            url: "{{ route('propellanttype.position') }}",
                            data: {'_token': '{{ csrf_token() }}', 'data': data},
                            type: 'POST',
                            success: function(response) {
                               toastr.success("{{ __('Position changed') }}", "{{ __('Success!') }}");
                            }
                        }) 
                    }, 0)
                })
                
            }
        };
    }();

    function randstr(prefix) {
        return Math.random().toString(36).replace('0.',prefix || '');
    }
</script>
@endsection