@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Management of technical maturities') }}
</h3>

<div class="container" id="repeater">
    <button data-repeater-create class="btn btn-success font-weight-bold mb-4" id="">
        <i class="la la-plus font-size-h1"></i>
        {{ __('Add new technical maturity') }}
    </button> 

    <div class="row">
        <form data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone" id="form-maturity" data-action-store="{{route('technical.store')}}">
            @csrf
            <input class="user_id d-none" name="user_id" value="{{Auth::user()->id}}">
            
            @foreach ($maturities as $maturity)
            <div class="col-lg-12 card card-custom gutter-b draggable maturity-draggable-item first-event">
                <div class="card-header">
                    <div class="card-title">
                        <label>{{ __('Technical maturity') }} <span class="text-danger">*</span></label>
                    </div>
                    <div class="card-toolbar">
                        <a class="confirm-remove-maturity btn btn-outline-danger font-weight-bold mr-2" data-action-remove="{{ route('technical.destroy', $maturity['id']) }}">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                        <a href="#" class="btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="text" class="index form-control form-control-solid d-none" name="id" value="{{ $maturity['id'] }}">
                    <div class="form-group">
                        <input type="text" class="title form-control form-control-solid" name="title[]" placeholder="{{ __('Name') }}" value="{{ $maturity['title'] }}">
                    </div>
                </div>
            </div>
            @endforeach

            <div data-repeater-item class="col-lg-12 card card-custom gutter-b draggable maturity-draggable-item first-event">
                <div class="card-header">
                    <div class="card-title">
                        <label>{{ __('Technical maturity') }} <span class="text-danger">*</span></label>
                    </div>
                    <div class="card-toolbar">
                        <a data-repeater-delete class="confirm-remove-maturity btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                        <a href="#" class="btn btn btn-icon btn-light-success btn-sm draggable-handle" data-toggle="tooltip" data-placement="top" title="{{ __('Change order by drag and drop') }}">
                            <i class="ki ki-menu "></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="text" class="index form-control form-control-solid d-none" name="id" value="">
                    <div class="form-group">
                        <input type="text" class="title form-control form-control-solid" name="title[]" placeholder="{{ __('Name') }}">
                    </div>
                </div>
            </div>
        </form>
  
        <div class="col-lg-12 @if(count($maturities) == 0) d-none @endif" id="btn-maturity-add">
            <button type="submit" class="validate-maturity btn btn-success font-weight-bold mr-2">
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
                <button type="button" class="action-remove-maturity btn btn-outline-danger font-weight-bold">
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
        // $('#repeater').on('mouseenter', '.appended.sc-collapse, .appended.draggable-handle', function(event) {
        //     $(this).tooltip('show');
        // }) btn-maturity-add

        //Form repeater
        $('#repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
            },
            hide: function () {
                $(this).slideUp();
                if($('.maturity-draggable-item').length == 0) $('#btn-maturity-add').addClass('d-none');
            },
            ready: function (setIndexes) {
                if($('#btn-maturity-add').hasClass('d-none')) $('#btn-maturity-add').removeClass('d-none');
            },
            isFirstItemUndeletable: true
        })

        $('#repeater').on('click', '.validate-maturity', function(event) {
            event.preventDefault();
            
            var form = $('#form-maturity');            
            var url = form.data('action-store');
            var user_id = form.find('.user_id').val();
            
            var data = [];
            $('.maturity-draggable-item').each(function(i, el){
                id = $(el).find('.index').val();
                title = $(el).find('.title').val();

                data.push({ id: id, title: title, position: i+1 });
            });
            
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'data': data, 'user_id': user_id},
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        $.each(response.response_data, function( index, data ) {
                            toastr.success("{{ __('Action completed with success') }}", "{{ __('Success!') }}" );
                            let item = $('.maturity-draggable-item').eq(data.position);
                            let delete_button = item.find('.confirm-remove-maturity');

                            item.find('.index').val(data.id);
                            delete_button.removeAttr('data-repeater-delete');
                            delete_button.attr("data-action-remove", data.delete_url);
                        });
                    }
                    else if(response.error) {
                        toastr.error(response.message, "{{ __('Error!') }}");
                    }
                    
                }
            }) 
            
        })

        $('#repeater').on('click', '.confirm-remove-maturity', function(event) {
            event.preventDefault();

            $('#confirmation-delete').modal('show');

            form_button = event.target;
        })

        $('.action-remove-maturity').on('click', function() {         
            let url = $(form_button).attr('data-action-remove');
            //var id = $(form).find('.index').val();
            console.log(url)

            //console.log(id)
                       
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}'},
                type: 'DELETE',
                success: function (response) {
                    $('#confirmation-delete').modal('hide');

                    let item = $(form_button).closest('.maturity-draggable-item');
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
                        $('.maturity-draggable-item').each(function(i, el) {
                            var id = $(el).find('.index').val();
                            //i=position
                            data[i] = id;

                        })
                        
                        $.ajax({
                            url: "{{ route('technical.position') }}",
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

</script>
@endsection