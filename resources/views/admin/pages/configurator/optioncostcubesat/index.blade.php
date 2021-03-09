@extends('layouts.admin')

@section('content')

<h3 class="card-title">
    {{ __('Costs of options whose price depends on the mass for Cubsat') }}
</h3>

<div class="container" id="repeater"> 

    <div class="row">
        <form data-repeater-list="group-a" class="col-lg-12 d-flex flex-wrap draggable-zone" id="form-option-cost" data-action-store="{{route('option-cost-cubesat.store')}}">
            @csrf
            <input class="user_id d-none" name="user_id" value="{{Auth::user()->id}}">
            @if(count($costCubesats)>0)
                @foreach ($costCubesats as $costCubsat)
                <div class="col-lg-12 card card-custom gutter-b draggable option-cost-draggable-item first-event">
                    <div class="card-body">
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="{{ $costCubsat['id'] }}">
                        
                        <h3 class="form-label">{{ $costCubsat->name }}</h3>
                        <input type="hidden" class="cost-name {{ $costCubsat->name }}" name="name[]" value="{{ $costCubsat->name }}">
                        <div class="input-group">
                            @foreach($costCubsat->options as $option)
                                <div class="form-group cost-option">
                                    <label class="col-form-label">{{ $option->option->name }} <span class="text-danger">*</span></label>
                                    <input type="hidden" class="option-cost-id option{{$option->option->id}}" data-option_cost_id="{{ $option->id }}">
                                    <input type="hidden" class="option-id " data-option_id="{{ $option->option->id}}">
                                    <div class="input-group">
                                        <input type="text" class="cost form-control form-control-solid col-md-6" name="cost[]" value="{{ $option->cost }}">
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
            @else
                @for($i=1; $i<=7 ;$i++)
                <div class="col-lg-12 card card-custom gutter-b draggable option-cost-draggable-item first-event">
                    <div class="card-body">
                        <input type="text" class="index form-control form-control-solid d-none" name="id" value="">
                        @switch($i)
                            @case(1)
                                <h3 class="form-label">{{ __('1U') }}</h3>
                                <input type="hidden" class="cost-name 1U" name="name[]" value="1U">
                                @break
                            @case(2)
                                <h3 class="form-label">{{ __('2U') }}</h3>
                                <input type="hidden" class="cost-name 2U" name="name[]" value="2U">
                                @break
                            @case(3)
                                <h3 class="form-label">{{ __('3U') }}</h3>
                                <input type="hidden" class="cost-name 3U" name="name[]" value="3U">
                                @break
                            @case(4)
                                <h3 class="form-label">{{ __('6U') }}</h3>
                                <input type="hidden" class="cost-name 6U" name="name[]" value="6U">
                                @break
                            @case(5)
                                <h3 class="form-label">{{ __('12U') }}</h3>
                                <input type="hidden" class="cost-name 12U" name="name[]" value="12U">
                                @break
                            @case(6)
                                <h3 class="form-label">{{ __('16U') }}</h3>
                                <input type="hidden" class="cost-name 16U" name="name[]" value="16U">
                                @break
                            @case(7)
                                <h3 class="form-label">{{ __('24U') }}</h3>
                                <input type="hidden" class="cost-name 24U" name="name[]" value="24U">
                                @break
                        @endswitch
                        <div class="input-group">
                            @foreach($options as $option)
                                <div class="form-group cost-option">
                                    <label class="col-form-label">{{ $option->name }} <span class="text-danger">*</span></label>
                                    <input type="hidden" class="option-cost-id option{{$option->id}}" data-option_cost_id="">
                                    <input type="hidden" class="option-id " data-option_id="{{ $option->id}}">
                                    <div class="input-group">
                                        <input type="text" class="cost form-control form-control-solid col-md-6" name="cost[]">
                                        <div class="input-group-prepend ">
                                            <button class="btn btn-secondary" type="button">{{ __('€') }}</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endfor
            @endif
  
            <div class="col-lg-12" id="btn-option-cost-add">
                <button type="submit" class="validate-option-cost btn btn-success font-weight-bold mr-2">
                    <i class="la la-check"></i> {{ __('Validate') }}
                </button>
            </div>   
        </form>
    </div> 
 
</div>
@endsection

@section('scripts')

<script type="text/javascript">
    jQuery(document).ready(function () {
        var form_button = '';

        //Form repeater

        $('#repeater').on('click', '.validate-option-cost', function(event) {
            event.preventDefault();
            
            var form = $('#form-option-cost');            
            var url = form.data('action-store');
            
            var data = [];
            $('.option-cost-draggable-item').each(function(i, el){
                id = $(el).find('.index').val();
                name = $(el).find('.cost-name').val();
                data_cost = [];
                $(el).find('.cost-option').each(function(index,element){
                    option_id = $(element).find('.option-id').data('option_id');
                    option_cost_id = $(element).find('.option-cost-id').data('option_cost_id');
                    cost = $(element).find('.cost').val();
                    data_cost.push({option_id: option_id, cost: cost, id: option_cost_id});
                });

                data.push({ id: id, name: name, data_cost: data_cost });
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
                            let item = $('.option-cost-draggable-item').find('.'+data.name);

                            item.siblings('.index').val(data.id);
                            $.each(data.option_cost_cubesats,function(i,resp){
                                item.siblings('.input-group').find('.option'+resp.option_id).data('option_cost_id')=resp.option_cost_id;
                            });
                            
                        });
                    }
                    else if(response.error) {
                        toastr.error(response.message, "{{ __('Error!') }}");
                    }
                    
                }
            }) 
            
        });

    });

</script>
@endsection