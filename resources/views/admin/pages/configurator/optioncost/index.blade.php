@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Costs of options whose price depends on mass') }}
</h3>

<div class="container" id="repeater">
    <button data-repeater-create class="btn btn-success font-weight-bold mb-4" id="">
        <i class="la la-plus font-size-h1"></i>
        {{ __('Add a new level') }}
    </button> 

    <div class="row">
        <form data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone" id="form-option-cost" data-action-store="{{route('option-cost.store')}}">
            @csrf
            <input class="user_id d-none" name="user_id" value="{{Auth::user()->id}}">
            
            @foreach ($optionCosts as $optionCost)
            <div class="col-lg-12 card card-custom gutter-b draggable option-cost-draggable-item first-event">
                <div class="card-header">
                    <div class="card-title">
                    </div>
                    <div class="card-toolbar">
                        <a class="confirm-remove-option-cost btn btn-outline-danger font-weight-bold mr-2" data-action-remove="{{ route('option-cost.destroy', $optionCost['id']) }}">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="text" class="index form-control form-control-solid d-none" name="id" value="{{ $optionCost['id'] }}">
                    <div class="input-group">
                        <label class="col-form-label mr-2">{{ __('From') }} <span class="text-danger">*</span></label>
                        <input type="text" class="mass-min form-control form-control-solid col-md-2" name="mass_min[]" value="{{ $optionCost['mass_min'] }}">
                        <div class="input-group-prepend mr-2">
                            <button class="btn btn-secondary" type="button">{{ __('Kg') }}</button>
                        </div>
                        <label class="col-form-label mr-2">{{ __('to') }} <span class="text-danger">*</span></label>
                        <input type="text" class="mass-max form-control form-control-solid col-md-2" name="mass_max[]" value="{{ $optionCost['mass_max'] }}">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary" type="button">{{ __('Kg') }}</button>
                        </div>
                    </div><br>
                    
                    <h3 class="form-label">{{ __('Options costs') }}</h3>
                    <div class="input-group">
                        @foreach($optionCost->options as $option)
                            <div class="form-group cost-option">
                                <label class="col-form-label">{{ $option->option->name }} <span class="text-danger">*</span></label>
                                <input type="hidden" class="option-cost-id" data-option_cost_id="{{ $option->id }}">
                                <input type="hidden" class="option-id" data-option_id="{{ $option->option->id}}">
                                <div class="input-group">
                                    <input type="text" class="cost form-control form-control-solid col-md-3" name="cost[]" value="{{ $option->cost }}">
                                    <div class="input-group-prepend ">
                                        <button class="btn btn-secondary" type="button">{{ __('€') }}</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach

            <div data-repeater-item class="col-lg-12 card card-custom gutter-b draggable option-cost-draggable-item first-event">
                <div class="card-header">
                    <div class="card-title">
                        
                    </div>
                    <div class="card-toolbar">
                        <a data-repeater-delete class="confirm-remove-option-cost btn btn-outline-danger font-weight-bold mr-2">
                            <i class="la la-trash-o"></i> {{ __('Delete') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="text" class="index form-control form-control-solid d-none" name="id" value="">
                    <div class="input-group">
                        <label class="col-form-label mr-2">{{ __('From') }} <span class="text-danger">*</span></label>
                        <input type="text" class="mass-min form-control form-control-solid col-md-2" name="mass_min[]" >
                        <div class="input-group-prepend mr-2">
                            <button class="btn btn-secondary" type="button">{{ __('Kg') }}</button>
                        </div>
                        <label class="col-form-label mr-2">{{ __('to') }} <span class="text-danger">*</span></label>
                        <input type="text" class="mass-max form-control form-control-solid col-md-2" name="mass_max[]" >
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary" type="button">{{ __('Kg') }}</button>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <h3 class="form-label">{{ __('Options costs') }}</h3>
                        <div class="input-group">
                            @if($options)
                                @foreach($options as $option)
                                    <div class="form-group cost-option">
                                        <label class="col-form-label">{{ $option->name }} <span class="text-danger">*</span></label>
                                        <input type="hidden" class="option-cost-id" data-option_cost_id="">
                                        <input type="hidden" class="option-id" data-option_id="{{ $option->id }}" name="option_id[]" value="{{ $option->id }}">
                                        <div class="input-group">
                                            <input type="text" class="cost form-control form-control-solid col-md-3" name="cost[]">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-secondary" type="button">{{ __('€') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
  
        <div class="col-lg-12 @if(count($optionCosts) < 0) d-none @endif" id="btn-option-cost-add">
            <button type="submit" class="validate-option-cost btn btn-success font-weight-bold mr-2">
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
                <button type="button" class="action-remove-option-cost btn btn-outline-danger font-weight-bold">
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

        //Form repeater
        $('#repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
            },
            hide: function () {
                $(this).slideUp();
                if($('.option-cost-draggable-item').length == 0) $('#btn-option-cost-add').addClass('d-none');
            },
            ready: function (setIndexes) {
                if($('#btn-option-cost-add').hasClass('d-none')) $('#btn-option-cost-add').removeClass('d-none');
            },
            isFirstItemUndeletable: true
        })

        $('#repeater').on('click', '.validate-option-cost', function(event) {
            event.preventDefault();
            
            var form = $('#form-option-cost');            
            var url = form.data('action-store');
            
            var data = [];
            $('.option-cost-draggable-item').each(function(i, el){
                id = $(el).find('.index').val();
                mass_min = $(el).find('.mass-min').val();
                mass_max = $(el).find('.mass-max').val();
                data_cost = [];
                $(el).find('.cost-option').each(function(index,element){
                    option_id = $(element).find('.option-id').data('option_id');
                    option_cost_id = $(element).find('.option-cost-id').data('option_cost_id');
                    cost = $(element).find('.cost').val();
                    data_cost.push({option_id: option_id, cost: cost, id: option_cost_id});
                });

                data.push({ id: id, mass_min: mass_min, mass_max: mass_max, data_cost: data_cost });
            });

            console.log('data',data);
            
            $.ajax({
                url: url,
                data: {'_token': '{{ csrf_token() }}', 'data': data},
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        $.each(response.response_data, function( index, data ) {
                            toastr.success("{{ __('Action completed with success') }}", "{{ __('Success!') }}" );
                            let item = $('.option-cost-draggable-item').eq(data.position);
                            let delete_button = item.find('.confirm-remove-option-cost');

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
            
        });

        $('#repeater').on('click', '.confirm-remove-option-cost', function(event) {
            event.preventDefault();

            $('#confirmation-delete').modal('show');

            form_button = event.target;
        });

        $('.action-remove-option-cost').on('click', function() {         
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

                    let item = $(form_button).closest('.option-cost-draggable-item');
                    item.slideUp("normal", function() {
                        item.remove();
                    });
                    toastr.success("{{ __('Success!') }}", "{{ __('Data removed') }}")
                }
            })
        });
    });

</script>
@endsection