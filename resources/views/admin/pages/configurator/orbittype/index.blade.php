@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Management of orbit types') }}
</h3>

<div class="container" id="repeater">
    <button data-repeater-create class="btn btn-success font-weight-bold mb-4" id="">
        <i class="la la-plus font-size-h1"></i>
        {{ __('Add a new orbit type') }}
    </button> 

    <div class="row">
        <form data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone" id="form-orbittype" data-action-store="{{route('orbittype.store')}}">
            @csrf

            @foreach($orbittypes as $orbittype)
            <div class="col-lg-12 card card-custom gutter-b draggable orbittype-draggable-item card-collapsed first-event" data-action-remove="{{route('orbittype.destroy', $orbittype['id'])}}">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ $orbittype['name'] }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="orbittype-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __('Collapse or expand Card') }}">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="text" class="orbittype_index form-control form-control-solid d-none" name="id" value="{{ $orbittype['id'] }}">
                    <div class="form-group">
                        <label>{{ __('Orbit type name') }} <span class="text-danger">*</span></label>
                        <div></div>
                        <input type="text" class="name form-control form-control-solid" name="name" placeholder="{{ __('Name') }}" value="{{ $orbittype['name'] }}">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Explanation') }} <span class="text-danger">*</span></label>
                        <div></div>
                        <textarea class="explanation form-control form-control-solid" name="explanation" rows="3">{{ $orbittype['explication'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-success">
                                <input class="orbit_leo" type="checkbox" name="orbit" @if($orbittype['orbit_leo']) checked @endif>
                                <span></span>{{ __('LEO Orbit') }}
                            </label>
                            <label class="checkbox checkbox-success">
                                <input class="orbit_sso" type="checkbox" name="orbit" @if($orbittype['orbit_sso']) checked @endif>
                                <span></span>{{ __('SSO Orbit') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-wrap">
                        <label class="col-form-label mr-12">{{ __('Linked tarif') }} :</label>
                        <div class="col-form-label">
                            <div class="radio-inline">
                                <label class="radio radio-success">
                                    <input class="tarif_leo" type="radio" name="tarif[{{$orbittype['id']}}]" @if($orbittype['tarif_leo']) checked @endif/>
                                    <span></span>
                                    {{ __('LEO') }}
                                </label>
                                <label class="radio radio-success">
                                    <input class="tarif_gto" type="radio" name="tarif[{{$orbittype['id']}}]" @if($orbittype['tarif_gto']) checked @endif />
                                    <span></span>
                                    {{ __('GTO') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    @foreach($orbittype['parameters'] as $option)
                        @php $option_altitude = null; @endphp
                        @php $option_inclination = null; @endphp

                        @if($option['type'] == 'altitude') @php $option_altitude = $option; @endphp 
                        @elseif($option['type'] == 'inclination') @php $option_inclination = $option; @endphp 
                        @endif 
                    @endforeach

                    <div class="form-group">
                        <div class="row">
                            <div class="parameter-option col-lg-6">
                                <label class="option bg-success-o-20">
                                    <div class="option-control">
                                        <div class="checkbox checkbox-outline checkbox-success">
                                            <input class="parameter_type" type="checkbox" name="parameter_type" value="altitude" @if(isset($option_altitude)) checked @endif/>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="option-label">
                                        <div class="option-head">
                                            <span class="option-title">
                                                {{ __('Altitude setting') }}
                                            </span>
                                        </div>
                                        <div class="option-body">
                                            <input type="text" class="option_index altitude form-control form-control-solid d-none" name="index['altitude']" @if(isset($option_altitude)) value="{{ $option_altitude['id'] }}" @endif>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('Start value') }} <span class="text-danger">*</span> </label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="start form-control" placeholder="Start" name="start['altitude']" @if(isset($option_altitude)) value="{{ $option_altitude['start'] }}" @endif />
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('End value') }} <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="end form-control" placeholder="End" name="end['altitude']" @if(isset($option_altitude)) value="{{ $option_altitude['end'] }}" @endif />
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('Jump') }} <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="jump form-control" placeholder="Jump" name="jump['altitude']" @if(isset($option_altitude)) value="{{ $option_altitude['jump'] }}" @endif />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="parameter-option col-lg-6">
                                <label class="option bg-success-o-20">
                                    <div class="option-control">
                                        <div class="checkbox checkbox-outline checkbox-success">
                                            <input class="parameter_type" type="checkbox" name="parameter_type" value="inclination" @if(isset($option_inclination)) checked @endif/>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="option-label">
                                        <div class="option-head">
                                            <span class="option-title">
                                                {{ __('Inclination setting') }}
                                            </span>
                                        </div>
                                        <div class="option-body">
                                            <input type="text" class="option_index inclination form-control form-control-solid d-none" name="index['inclination']" @if(isset($option_inclination)) value="{{ $option_inclination['id'] }}" @endif>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('Start value') }} <span class="text-danger">*</span> </label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="start form-control" placeholder="Start" name="start['inclination']" @if(isset($option_inclination)) value="{{ $option_inclination['start'] }}" @endif />
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('End value') }} <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="end form-control" placeholder="End" name="end['inclination']" @if(isset($option_inclination)) value="{{ $option_inclination['end'] }}" @endif />
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('Jump') }} <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="jump form-control" placeholder="Jump" name="jump['inclination']" @if(isset($option_inclination)) value="{{ $option_inclination['jump'] }}" @endif />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <a class="confirm-remove-orbittype btn btn-outline-danger font-weight-bold mr-2">
                        <i class="la la-trash-o"></i> {{ __('Delete') }}
                    </a>
                    
                </div>
            </div>
            @endforeach
            
            <div data-repeater-item class="d-none col-lg-12 card card-custom gutter-b draggable orbittype-draggable-item first-event">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ __('Orbit type name') }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="appended orbittype-collapse btn btn-icon btn-light-warning btn-sm mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __('Collapse or expand Card') }}">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                        <a href="#" class="appended btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="text" class="orbittype_index form-control form-control-solid d-none" name="id" value="">
                    <div class="form-group">
                        <label>{{ __('Orbit type name') }} <span class="text-danger">*</span></label>
                        <div></div>
                        <input type="text" class="name form-control form-control-solid" name="name" placeholder="{{ __('Name') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Explanation') }} <span class="text-danger">*</span></label>
                        <div></div>
                        <textarea class="explanation form-control form-control-solid" name="explanation" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-success">
                                <input class="orbit_leo" type="checkbox" name="orbit">
                                <span></span>{{ __('LEO Orbit') }}
                            </label>
                            <label class="checkbox checkbox-success">
                                <input class="orbit_sso" type="checkbox" name="orbit">
                                <span></span>{{ __('SSO Orbit') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-wrap">
                        <label class="col-form-label mr-12">{{ __('Linked tarif') }} :</label>
                        <div class="col-form-label">
                            <div class="radio-inline">
                                <label class="radio radio-success">
                                    <input class="tarif_leo" type="radio" name="tarif"/>
                                    <span></span>
                                    {{ __('LEO') }}
                                </label>
                                <label class="radio radio-success">
                                    <input class="tarif_gto" type="radio" name="tarif" checked="checked" />
                                    <span></span>
                                    {{ __('GTO') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="parameter-option col-lg-6">
                                <label class="option bg-success-o-20">
                                    <div class="option-control">
                                        <div class="checkbox checkbox-outline checkbox-success">
                                            <input class="parameter_type" type="checkbox" name="parameter_type" value="altitude"/>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="option-label">
                                        <div class="option-head">
                                            <span class="option-title">
                                                {{ __('Altitude setting') }}
                                            </span>
                                        </div>
                                        <div class="option-body">
                                            <input type="text" class="option_index form-control form-control-solid d-none" name="index['altitude']" value="">
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('Start value') }} <span class="text-danger">*</span> </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="start form-control" placeholder="Start" name="start['altitude']" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('End value') }} <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="end form-control" placeholder="End" name="end['altitude']" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('Jump') }} <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="jump form-control" placeholder="Jump" name="jump['altitude']" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="parameter-option col-lg-6">
                                <label class="option bg-success-o-20">
                                    <div class="option-control">
                                        <div class="checkbox checkbox-outline checkbox-success">
                                            <input class="parameter_type" type="checkbox" name="parameter_type" value="inclination"/>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="option-label">
                                        <div class="option-head">
                                            <span class="option-title">
                                                {{ __('Inclination setting') }}
                                            </span>
                                        </div>
                                        <div class="option-body">
                                            <input type="text" class="option_index form-control form-control-solid d-none" name="index['inclination']" value="">
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('Start value') }} <span class="text-danger">*</span> </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="start form-control" placeholder="Start" name="start['inclination']" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('End value') }} <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="end form-control" placeholder="End" name="end['inclination']" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 row">
                                                <label class="col-lg-4 col-form-label text-right">{{ __('Jump') }} <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="jump form-control" placeholder="Jump" name="jump['inclination']" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <a data-repeater-delete class="confirm-remove-orbittype btn btn-outline-danger font-weight-bold mr-2">
                        <i class="la la-trash-o"></i> {{ __('Delete') }}
                    </a>
                    
                </div>
            </div>
        </form>

        <div class="col-lg-12 @if(count($orbittypes) == 0) d-none @endif" id="btn-orbittype-add">
            <button type="submit" class="validate-orbittype btn btn-success font-weight-bold mr-2">
                <i class="la la-check"></i> {{ __('Validate') }}
            </button>
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
                <button type="button" class="action-remove-orbittype btn btn-outline-danger font-weight-bold">
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
        // $('#repeater').on('mouseenter', '.appended.orbittype-collapse, .appended.draggable-handle', function(event) {
        //     $(this).tooltip('show');
        // })

        //Collapse Expand card
        $('.orbittype-draggable-item').each(function(i, element) {
            var id = randstr('card_');
            $(element).attr('id', id);
            var card = new KTCard(id);
        })

        $('#repeater').on('click', '.appended.orbittype-collapse', function() {
            var item = $(this).closest('.orbittype-draggable-item');
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
                if($('#btn-orbittype-add').hasClass('d-none')) $('#btn-orbittype-add').removeClass('d-none');
            },
            hide: function () {
                $(this).slideUp();
                if($('.orbittype-draggable-item').length == 1) 
                        $('#btn-orbittype-add').addClass('d-none');
            },
            ready: function (setIndexes) {
                var id = randstr('card_');
                $(this).attr('id', id);
                var card = new KTCard(id);
            },
            isFirstItemUndeletable: true
        })

        $('#repeater').on('click', '.validate-orbittype', function(event) {
            event.preventDefault();
            
            var form = $('#form-orbittype');            
            var url = form.data('action-store');
            
            var data = [];
            $('.orbittype-draggable-item').each(function(i, el){
                let id          = $(el).find('.orbittype_index').val();
                let name        = $(el).find('.name').val();
                let explanation = $(el).find('.explanation').val();
                let orbit_leo   = $(el).find('.orbit_leo').is(':checked') ? 1 : 0;
                let orbit_sso   = $(el).find('.orbit_sso').is(':checked') ? 1 : 0;
                let tarif_leo   = $(el).find('.tarif_leo').is(':checked') ? 1 : 0;
                let tarif_gto   = $(el).find('.tarif_gto').is(':checked') ? 1 : 0;

                let parameters = []; 
                $(el).find('.parameter-option').each(function(k, option) {
                    if($(option).find('.parameter_type').is(':checked')) {
                        parameters.push({
                            id: $(option).find('.option_index').val(),
                            type: $(option).find('.parameter_type').val(),
                            start: $(option).find('.start').val(), 
                            end: $(option).find('.end').val(), 
                            jump: $(option).find('.jump').val() 
                        });
                    }
                })

                data.push({ 
                    id: id,
                    name: name, 
                    explanation: explanation, 
                    orbit_leo: orbit_leo,
                    orbit_sso: orbit_sso, 
                    tarif_leo: tarif_leo, 
                    tarif_gto: tarif_gto,
                    parameters: parameters, 
                    position: i+1 
                });
            });
            
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'data': data},
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        toastr.success("{{ __('Action completed with success') }}", "{{ __('Success!') }}" );

                        $.each(response.response_data, function( index, data ) {
                            
                            let item = $('.orbittype-draggable-item').eq(data.position - 1);
                            item.attr("data-action-remove", data.delete_url);
                            item.find('.orbittype_index').val(data.orbittype_id);
                            item.find('.card-title h3').text(data.name);

                            let delete_button = item.find('.confirm-remove-orbittype');
                            delete_button.removeAttr('data-repeater-delete');

                            if(data.id_option_altitude != null) item.find('.option_index.altitude').val(data.id_option_altitude);

                            if(data.id_option_inclination != null) item.find('.option_index.inclination').val(data.id_option_inclination);
                        });
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

        $('#repeater').on('click', '.confirm-remove-orbittype', function(event) {
            event.preventDefault();
            
            let attr = $(this).attr('data-repeater-delete');
            if (typeof attr == typeof undefined)
                $('#confirmation-delete').modal('show');

            form_button = event.target;
        })

        $('.action-remove-orbittype').on('click', function() {
            let parent = form_button.closest('.orbittype-draggable-item');            
            let url = $(parent).attr('data-action-remove');
            let id = $(parent).find('.orbittype_index').val();
                       
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'id': id},
                type: 'DELETE',
                success: function (response) {
                    $('#confirmation-delete').modal('hide');

                    if($('.orbittype-draggable-item').length == 1) 
                        $('#btn-orbittype-add').addClass('d-none');

                    let item = $(parent).closest('.orbittype-draggable-item');
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
                        $('.orbittype-draggable-item').each(function(i, el) {
                            var id = $(el).find('.orbittype_index').val();
                            //i=position
                            data[i] = id;

                        })
                        
                        $.ajax({
                            url: "{{ route('orbittype.position') }}",
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