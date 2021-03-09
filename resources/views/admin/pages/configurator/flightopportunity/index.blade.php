@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Flight opportunities') }}
</h3>

<div class="container" id="repeater">
    <button data-repeater-create class="btn btn-success font-weight-bold mb-4" id="">
        <i class="la la-plus font-size-h1"></i>
        {{ __('Add a new flight opportunity') }}
    </button> 

    <div class="row">
        <div data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone">
            
            @foreach ($flightopportunities as $flightopportunity)
            <div class="col-lg-12 card card-custom gutter-b draggable flightopportunity-draggable-item card-collapsed">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ $flightopportunity['name'] }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="appended flightopportunity-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __('Collapse or expand Card') }}">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="appended btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form interface-form" data-action-store="{{ route('flightopportunity.store') }}" data-action-remove="{{ route('flightopportunity.destroy', $flightopportunity['id']) }}">
                        @csrf
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="{{ $flightopportunity['id'] }}">
                        <div class="form-group row">
                            <label class="col-3 col-form-label text-right">{{ __('Month, Year') }} <span class="text-danger">*</span></label>
                            @php 
                                $month_year = null;
                                $month_year = $flightopportunity['year'].'-'.sprintf( "%02d", $flightopportunity['month']); 
                            @endphp
                            <input class="month_year form-control form-control-solid col-4" name="month_year" type="month" value="{{ $month_year }}">
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('Opportunity name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="name form-control form-control-solid col" name="name" placeholder="{{ __('Name') }}" value="{{ $flightopportunity['name'] }}">
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('Orbit type') }} <span class="text-danger">*</span></label>
                            <select class="orbit_type_id form-control form-control-solid  col-lg-5 col-md-9 col-sm-12" name="orbit_type_id">
                                @foreach ($orbittypes as $orbittype)
                                <option value="{{ $orbittype['id'] }}" @if($flightopportunity['orbit_type_id'] == $orbittype['id']) selected @endif>{{ $orbittype['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-form-label text-right col-lg-6 col-sm-12">{{ __('Altitude') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="altitude form-control form-control-solid col-lg-4 col-md-9 col-sm-12" name="altitude" placeholder="{{ __('Altitude') }}" value="{{ $flightopportunity['altitude'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('Inclination') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="inclination form-control form-control-solid col-lg-4 col-md-9 col-sm-12" name="inclination" placeholder="{{ __('Inclination') }}" value="{{ $flightopportunity['inclination'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-3 mt-2">{{ __('Local time') }}</label>
                            <div class="col-9 col-form-label d-flex flex-wrap row">
                                <div class="col-lg-4 col-md-9 col-sm-12 mr-6 row">
                                    @php 
                                        $local_time = null;
                                        $local_time = sprintf( "%02d", $flightopportunity['local_hour']).':'.sprintf( "%02d", $flightopportunity['local_minute']); 
                                    @endphp
                                    <input type="time" class="local_time form-control form-control-solid" name="local_time" value="{{ $local_time }}" />
                                </div>
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-success">
                                        <input class="local_time_type ltan" type="checkbox" name="time" @if($flightopportunity['ltan']) checked @endif/>
                                        <span></span>
                                        {{ __('LTAN') }}
                                    </label>
                                    <label class="checkbox checkbox-success">
                                        <input class="local_time_type ltdn" type="checkbox" name="time" @if($flightopportunity['ltdn']) checked @endif/>
                                        <span></span>
                                        {{ __('LTDN') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="validate-flightopportunity btn btn-success font-weight-bold mr-2">
                            <i class="la la-check"></i> {{ __('Validate') }}
                        </button>

                        <a class="confirm-remove-flightopportunity btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                    </form>
                </div>
            </div>
            @endforeach

            <!--begin::Card-->
            <div data-repeater-item class="d-none col-lg-12 card card-custom gutter-b draggable flightopportunity-draggable-item first-event">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ __('SC Interface name') }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="appended flightopportunity-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __('Collapse or expand Card') }}">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="appended btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form interface-form" data-action-store="{{ route('flightopportunity.store') }}">
                        @csrf
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="">
                        <div class="form-group row">
                            <label class="col-3 col-form-label text-right">Month, Year <span class="text-danger">*</span></label>
                            <input class="month_year form-control form-control-solid col-4" name="month_year" type="month">
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('Opportunity name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="name form-control form-control-solid col" name="name" placeholder="{{ __('Name') }}">
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('Orbit type') }} <span class="text-danger">*</span></label>
                            <select class="orbit_type_id form-control form-control-solid  col-lg-5 col-md-9 col-sm-12" name="orbit_type_id">
                                @foreach ($orbittypes as $orbittype)
                                <option value="{{ $orbittype['id'] }}">{{ $orbittype['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-form-label text-right col-lg-6 col-sm-12">{{ __('Altitude') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="altitude form-control form-control-solid col-lg-4 col-md-9 col-sm-12" name="altitude" placeholder="{{ __('Altitude') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('Inclination') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="inclination form-control form-control-solid col-lg-4 col-md-9 col-sm-12" name="inclination" placeholder="{{ __('Inclination') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-3 mt-2">{{ __('Local time') }}</label>
                            <div class="col-9 col-form-label d-flex flex-wrap row">
                                <div class="col-lg-4 col-md-9 col-sm-12 mr-6 row">
                                    <input type="time" class="local_time form-control form-control-solid" name="local_time" />
                                </div>
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-success">
                                        <input class="local_time_type ltan" type="checkbox" name="time"/>
                                        <span></span>
                                        {{ __('LTAN') }}
                                    </label>
                                    <label class="checkbox checkbox-success">
                                        <input class="local_time_type ltdn" type="checkbox" name="time" checked="checked" />
                                        <span></span>
                                        {{ __('LTDN') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="validate-flightopportunity btn btn-success font-weight-bold mr-2">
                            <i class="la la-check"></i> {{ __('Validate') }}
                        </button>

                        <a data-repeater-delete class="confirm-remove-flightopportunity btn btn-outline-danger font-weight-bold mr-2">
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
                <button type="button" class="action-remove-flightopportunity btn btn-outline-danger font-weight-bold">
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
        // $('#repeater').on('mouseenter', '.appended.flightopportunity-collapse, .appended.draggable-handle', function(event) {
        //     $(this).tooltip('show');
        // })

        //Collapse Expand card
        $('.flightopportunity-draggable-item').each(function(i, element) {
            var id = randstr('card_');
            $(element).attr('id', id);
            var card = new KTCard(id);
        })

        $('#repeater').on('click', '.appended.flightopportunity-collapse', function() {
            var item = $(this).closest('.flightopportunity-draggable-item');
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

        $('#repeater').on('click', '.validate-flightopportunity', function(event) {
            event.preventDefault();

            var form = $(this).closest('form');
            var position = $(this).closest('.flightopportunity-draggable-item').index();
            
            var url = form.data('action-store');
            var id = form.find('.index').val();
            var month_year = form.find('.month_year').val().split('-');
            var year = month_year[0];
            var month = month_year[1];
            var name = form.find('.name').val();
            var orbit_type_id = form.find('.orbit_type_id').val();
            var altitude = form.find('.altitude').val();
            var inclination = form.find('.inclination').val();
            var local_time = form.find('.local_time').val().split(':');
            var local_hour = local_time[0];
            var local_minute = local_time[1];
            var ltan = $('.ltan').is(':checked') ? 1 : null;
            var ltdn = $('.ltdn').is(':checked') ? 1 : null;
            
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id, 'month': month, 'year': year, 'name': name, 'orbit_type_id': orbit_type_id, 'altitude': altitude, 'inclination': inclination, 'local_hour': local_hour, 'local_minute': local_minute, 'ltan': ltan, 'ltdn': ltdn, 'position': position},
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        toastr.success("{{ __('Action completed with success') }}", "{{ __('Success!') }}" );
                        
                        form.find('.index').val(response.id);
                        form.closest('.flightopportunity-draggable-item').find('.card-title h3').text(response.name);
                        form.find('.confirm-remove-flightopportunity').removeAttr('data-repeater-delete');
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

        $('#repeater').on('click', '.confirm-remove-flightopportunity', function(event) {
            event.preventDefault();

            let attr = $(this).attr('data-repeater-delete');
            if (typeof attr == typeof undefined)
                $('#confirmation-delete').modal('show');

            form_button = event.target;
        })

        $('.action-remove-flightopportunity').on('click', function() {
            let form = form_button.closest('form');            
            let url = $(form).attr('data-action-remove');
            let id = $(form).find('.index').val();
                       
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id},
                type: 'DELETE',
                success: function (response) {
                    $('#confirmation-delete').modal('hide');

                    let item = $(form).closest('.flightopportunity-draggable-item');
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
                        $('.flightopportunity-draggable-item').each(function(i, el) {
                            var id = $(el).find('.index').val();
                            //i=position
                            data[i] = id;

                        })
                        
                        $.ajax({
                            url: "{{ route('flightopportunity.position') }}",
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