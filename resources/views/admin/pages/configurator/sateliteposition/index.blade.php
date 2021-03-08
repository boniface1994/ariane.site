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
    <div class="card-body sateliteposition">
        <div class="tab-content">
            <form class="form" action="{{ route('sateliteposition.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead>
                            <!--<tr>
                                
                            </tr>-->
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control" name="lip1" value="{{ isset($sateliteposition['lip1']) ? $sateliteposition['lip1'] : '' }}" placeholder="[{{ __('L x I x P') }}]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="lip2" value="{{ isset($sateliteposition['lip2']) ? $sateliteposition['lip2'] : '' }}" placeholder="[{{ __('L x I x P') }}]">
                                </td>
                                <td class="d-flex flex-center">
                                    <label class="col-form-label">3U</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="bear1" value="{{ isset($sateliteposition['bear1']) ? $sateliteposition['bear1'] : '' }}" placeholder="[{{ __('mass bearing val') }}]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bear1_value1" value="{{ isset($sateliteposition['bear1_value1']) ? $sateliteposition['bear1_value1'] : '' }}" placeholder="[x]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bear1_value2" value="{{ isset($sateliteposition['bear1_value2']) ? $sateliteposition['bear1_value2'] : '' }}" placeholder="[x]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bear1_value3" value="{{ isset($sateliteposition['bear1_value3']) ? $sateliteposition['bear1_value2'] : '' }}" placeholder="[x]">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="bear2" value="{{ isset($sateliteposition['bear2']) ? $sateliteposition['bear2'] : '' }}" placeholder="[{{ __('mass bearing val') }}]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bear2_value1" value="{{ isset($sateliteposition['bear2_value1']) ? $sateliteposition['bear2_value1'] : '' }}" placeholder="[x]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bear2_value2" value="{{ isset($sateliteposition['bear2_value2']) ? $sateliteposition['bear2_value2'] : '' }}" placeholder="[x]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bear2_value3" value="{{ isset($sateliteposition['bear2_value3']) ? $sateliteposition['bear2_value3'] : '' }}" placeholder="[x]">
                                </td>
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
    jQuery(document).ready(function () {
        $('.sateliteposition').find('form').each(function(i,element){
            $(element).find('input[type="submit"]').on('click',function(e){
                e.preventDefault();
                let form = $(this).closest('form');
                let url = form.attr('action');
                let method = form.attr('method');
                $.ajax({
                    url: url,
                    method: method,
                    data : form.serialize(),
                    success: function(response){
                        toastr.success("Success !");
                    }
                })
            });
        })

    });
</script>
@endsection