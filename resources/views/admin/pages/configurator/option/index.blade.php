@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Management of options') }}
</h3>

<div class="container" id="repeater">
    <button data-repeater-create class="btn btn-success font-weight-bold mb-4" id="">
        <i class="la la-plus font-size-h1"></i>
        {{ __('Add new Option') }}
    </button> 

    <div class="row">
        <div data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone">
            @foreach ($options as $option)
            <!--begin::Card-->
            <div class="col-lg-12 card card-custom gutter-b draggable option-draggable-item card-collapsed">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ $option['name'] }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="option-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __('Collapse or expand Card') }}">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form option-form" data-action-create="{{ route('option.store') }}" data-action-remove="{{ route('option.destroy', $option['id']) }}">
                        @csrf
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="{{ $option['id'] }}">
                        <div class="form-group">
                            <label>{{ __('Option') }} <span class="text-danger">*</span></label>
                            <div></div>
                            <input type="text" class="name form-control form-control-solid" name="name" placeholder="{{ __('Name') }}" value="{{ $option['name'] }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Explanation') }}</label>
                            <div></div>
                            <textarea class="explication form-control form-control-solid" name="explication" rows="3">{{ $option['explication'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <h5 class="mb-4">{{ __('Condition of option availability') }}</h5>
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-success">
                                    <input class="type" type="checkbox" name="type" @if($option['cubsat']) checked @endif>
                                    <span></span>{{ __('Si Cubesat') }}
                                </label>
                                <label class="checkbox checkbox-success">
                                    <input class="type" type="checkbox" name="type" @if($option['smallsat']) checked @endif>
                                    <span></span>{{ __('Si Smallsat') }}
                                </label>
                            </div><br>
                            <h5 class="mb-4">{{ __('Option cost') }}</h5>
                            <div class="radio-list">
                                <label class="radio radio-success">
                                    <input class="weight_dependent" type="radio" @if(!$option['weight_dependent']) checked @endif name="weight_dependent" value="0"/>
                                    <span></span>
                                    {{ __('Cost depending on mass') }}
                                </label>
                                <div class="input-group">  
                                    <label class="radio radio-success mr-3">
                                        <input class="weight_dependent" type="radio" @if($option['weight_dependent']) checked @endif name="weight_dependent" value="1"/>
                                        <span></span>
                                        {{ __('Fixed cost') }}
                                    </label>
                                    <input type="text" class="form-control col-md-2 cost" name="cost" value="{{ $option['cost'] ? $option['cost'] : '' }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">???</button>
                                    </div>
                                </div>
                            </div><br>
                            <label class="checkbox checkbox-success">
                                <input class="type" type="checkbox" name="dashboard_available" @if($option['dashboard_available']) checked @endif>
                                <span class="mr-3"></span>{{ __('Available only in the dashboard') }}
                            </label>
                            <!-- <div class="invalid-feedback">Success! You've done it.</div> -->
                        </div>
                        <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                            <i class="la la-check"></i> {{ __('Validate') }}
                        </button>

                        <a class="confirm-remove-option btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                    </form>
                </div>
            </div>
            <!--end::Card-->
            @endforeach

            <!--begin::Card-->
            <div data-repeater-item class="d-none col-lg-12 card card-custom gutter-b draggable option-draggable-item first-event">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ __('Option name') }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="appended option-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __('Collapse or expand Card') }}">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="appended btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form option-form" data-action-create="{{ route('option.store') }}">
                        @csrf
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="">
                        <div class="form-group">
                            <label>{{ __('Option') }} <span class="text-danger">*</span></label>
                            <div></div>
                            <input type="text" class="name form-control form-control-solid" name="name" placeholder="{{ __('Name') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Explanation') }}</label>
                            <div></div>
                            <textarea class="explication form-control form-control-solid" name="explication" rows="3"></textarea>
                        </div>
                        <h5 class="mb-4">{{ __('Condition of option availability') }}</h5>
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
                            </div><br>
                            <h5 class="mb-4">{{ __('Option cost') }}</h5>
                            <div class="radio-list">
                                <label class="radio radio-success">
                                    <input  class="weight_dependent" type="radio"  name="weight_dependent" value="0"/>
                                    <span></span>
                                    {{ __('Cost depending on mass') }}
                                </label>
                                <div class="input-group">  
                                    <label class="radio radio-success mr-3">
                                        <input class="weight_dependent" type="radio" name="weight_dependent" value="1"/>
                                        <span></span>
                                        {{ __('Fixed cost') }}
                                    </label>
                                    <input type="text" class="form-control col-md-2 cost" name="cost" value="">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">???</button>
                                    </div>
                                </div>
                            </div><br>
                            <label class="checkbox checkbox-success">
                                <input class="dashboard_available" type="checkbox" name="dashboard_available">
                                <span class="mr-3"></span>{{ __('Available only in the dashboard') }}
                            </label>
                            <!-- <div class="invalid-feedback">Success! You've done it.</div> -->
                        </div>
                        <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                            <i class="la la-check"></i> {{ __('Validate') }}
                        </button>

                        <a data-repeater-delete class="confirm-remove-option btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                    </form>
                </div>
            </div>
            <!--end::Card-->
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
                <button type="button" class="action-remove-option btn btn-outline-danger font-weight-bold">
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


        //Collapse Expand card
        $('.option-draggable-item').each(function(i, element) {
            var id = randstr('card_');
            $(element).attr('id', id);
            var card = new KTCard(id);
        })

        $('#repeater').on('click', '.appended.option-collapse', function() {
            var item = $(this).closest('.option-draggable-item');
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
                $(this).slideUp("normal", function() {
                    $(this).remove();
                });
            },
            ready: function (setIndexes) {
                var id = randstr('card_');
                $(this).attr('id', id);
                var card = new KTCard(id);
            },
            isFirstItemUndeletable: true
        })

        $('#repeater').on('click', '.validate-option', function(event) {
            event.preventDefault();
            
            var form = $(this).closest('form');
            var position = $(this).closest('.option-draggable-item').index();
            
            var url = form.data('action-create');
            var id = form.find('.index').val();
            var name = form.find('.name').val();
            var explication = form.find('.explication').val();
            var cost = form.find('.cost').val(); 
            var dashboard_available = form.find('.dashboard_available').is(':checked') ? 1 : 0;
            var type = [];
            form.find('.type').each(function(i, el){
                type[i] = $(el).is(':checked') ? 1 : null;
            });
            
            var weight_dependent = null;
            form.find('.weight_dependent').each(function(i, el){
                if($(el).is(':checked')){
                    weight_dependent = $(el).val();
                }
            });
            
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id, 'name': name, 'explication': explication, 'cubesat': type[0], 'smallsat': type[1], 'position': position,'weight_dependent':weight_dependent,'cost':cost,'dashboard_available':dashboard_available},
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        toastr.success("{{ __('Action completed with success') }}", "{{ __('Success!') }}" );
                        
                        form.find('.index').val(response.id);
                        form.closest('.option-draggable-item').find('.card-title h3').text(response.name);
                        form.find('.confirm-remove-option').removeAttr('data-repeater-delete');
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

        $('#repeater').on('click', '.confirm-remove-option', function(event) {
            event.preventDefault();

            let attr = $(this).attr('data-repeater-delete');
            if (typeof attr == typeof undefined)
                $('#confirmation-delete').modal('show');

            form_button = event.target;
        })

        $('.action-remove-option').on('click', function() {
            let form = form_button.closest('form');            
            let url = $(form).attr('data-action-remove');
            let id = $(form).find('.index').val();
                       
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id},
                type: 'DELETE',
                success: function (response) {
                    $('#confirmation-delete').modal('hide');

                    let item = $(form).closest('.option-draggable-item');
                    item.slideUp("normal", function() {
                        item.remove();
                    });
                    toastr.success("{{ __('Success!') }}", "{{ __('Data removed') }}")
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
                        $('.option-draggable-item').each(function(i, el) {
                            var id = $(el).find('.index').val();
                            //i=position
                            data[i] = id;

                        })
                        
                        $.ajax({
                            url: "{{ route('option.position') }}",
                            data: {'_token': '{{ csrf_token() }}', 'data': data},
                            type: 'POST',
                            success: function(response) {
                               toastr.success("{{ __('Success!') }}", "{{ __('Position changed') }}");
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