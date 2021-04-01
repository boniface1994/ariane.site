@extends('layouts.admin')

@section('content')
<div class="card card-custom ">
    <div class="card-header card-header-tabs-line">
        <div class="card-header">
            <div class="card-title">
                <label >{{ __('Management of satellite positions') }}</label>
            </div>
        </div>
    </div>
    <div class="card-body satelliteposition">
        <div class="tab-content">
            <form class="form" action="{{ route('satelliteposition.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    @php $smallsat_number = 3; @endphp
                    <table class="table table-responsive-sm table-bordered">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Cubsats</td>
                                @for ($i = 1; $i <= $smallsat_number; $i++)
                                <td>Smallsat {{ $i }}</td>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Max height (mm)</td>
                                <td>
                                    <input type="text" class="d-none index cubsat" name="data[cubsat][id]" value="{{ isset($satellitepositions['cubsat']['id']) ? $satellitepositions['cubsat']['id'] : '' }}">
                                    <input type="text" class="form-control" name="data[cubsat][max_height]" value="{{ isset($satellitepositions['cubsat']['max_height']) ? $satellitepositions['cubsat']['max_height'] : '' }}" placeholder="[x]">
                                </td>
                                @for ($i = 1; $i <= $smallsat_number; $i++) 
                                <td>
                                    <input type="text" class="d-none index {{ 'smallsat_' . $i }}" name="data[smallsat_{{ $i }}][id]" value="{{ isset($satellitepositions['smallsat_' . $i]['id']) ? $satellitepositions['smallsat_' . $i]['id'] : '' }}">
                                    <input type="text" class="form-control" name="data[smallsat_{{ $i }}][max_height]" value="{{ isset($satellitepositions['smallsat_' . $i]['max_height']) ? $satellitepositions['smallsat_' . $i]['max_height'] : '' }}" placeholder="[x]">
                                </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>Max length (mm)</td>
                                <td>
                                    <input type="text" class="form-control" name="data[cubsat][max_length]" value="{{ isset($satellitepositions['cubsat']['max_length']) ? $satellitepositions['cubsat']['max_length'] : '' }}" placeholder="[x]">
                                </td>
                                @for ($i = 1; $i <= $smallsat_number; $i++)
                                <td>
                                    <input type="text" class="form-control" name="data[smallsat_{{ $i }}][max_length]" value="{{ isset($satellitepositions['smallsat_' . $i]['max_length']) ? $satellitepositions['smallsat_' . $i]['max_length'] : '' }}" placeholder="[x]">
                                </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>Max width (mm)</td>
                                <td>
                                    <input type="text" class="form-control" name="data[cubsat][max_width]" value="{{ isset($satellitepositions['cubsat']['max_width']) ? $satellitepositions['cubsat']['max_width'] : '' }}" placeholder="[x]">
                                </td>
                                @for ($i = 1; $i <= $smallsat_number; $i++)
                                <td>
                                    <input type="text" class="form-control" name="data[smallsat_{{ $i }}][max_width]" value="{{ isset($satellitepositions['smallsat_' . $i]['max_width']) ? $satellitepositions['smallsat_' . $i]['max_width'] : '' }}" placeholder="[x]">
                                </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>Max mass (mm)</td>
                                <td>
                                    <input type="text" class="form-control" name="data[cubsat][max_mass]" value="{{ isset($satellitepositions['cubsat']['max_mass']) ? $satellitepositions['cubsat']['max_mass'] : '' }}" placeholder="[x]">
                                </td>
                                @for ($i = 1; $i <= $smallsat_number; $i++)
                                <td>
                                    <input type="text" class="form-control" name="data[smallsat_{{ $i }}][max_mass]" value="{{ isset($satellitepositions['smallsat_' . $i]['max_mass']) ? $satellitepositions['smallsat_' . $i]['max_mass'] : '' }}" placeholder="[x]">
                                </td>
                                @endfor
                            </tr>
                            <tr class="bg-secondary">
                                <td></td><td></td>
                                @for ($i = 1; $i <= $smallsat_number; $i++)<td></td>@endfor
                            </tr>
                            <tr>
                                <td class="align-middle">Position No.<br/>(see image-diagram below)</td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox-list">
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="1" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(1, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                1
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="2" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(2, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                2
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="3" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(3, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                3
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="4" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(4, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                4
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="5" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(5, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                5
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="6" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(6, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                6
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="7" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(7, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                7
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="8" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(8, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                8
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="9" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(9, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                9
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[cubsat][position][]" value="10" @if(isset($satellitepositions['cubsat']['position'])) @if(in_array(10, $satellitepositions['cubsat']['position'])) checked @endif @endif/>
                                                <span></span>
                                                10
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                @for ($i = 1; $i <= $smallsat_number; $i++)
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox-list">
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="1" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(1, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                1
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="2" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(2, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                2
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="3" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(3, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                3
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="4" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(4, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                4
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="5" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(4, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                5
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="6" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(4, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                6
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="7" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(4, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                7
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="8" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(8, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                8
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="9" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(9, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                9
                                            </label>
                                            <label class="checkbox checkbox-success d-flex justify-content-center">
                                                <input type="checkbox" name="data[smallsat_{{ $i }}][position][]" value="10" @if(isset($satellitepositions['smallsat_' . $i]['position'])) @if(in_array(10, $satellitepositions['smallsat_' . $i]['position'])) checked @endif @endif/>
                                                <span></span>
                                                10
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>

                <input type="submit" class="btn btn-success font-weight-bold" value="{{ __('Validate') }}">
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.satelliteposition form').on('submit', function(e) {
            e.preventDefault();
            
            let url = $(this).attr('action');
            let method = $(this).attr('method');

            $.ajax({
                url: url,
                method: method,
                data : $(this).serialize(),
                success: function(response){
                    if(response.success) {
                        toastr.success("Success !");
                        $.each(response.response_data, function( index, data ) {
                            $('.index.' + data.name).val(data.id);
                        })
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

    });
</script>
@endsection