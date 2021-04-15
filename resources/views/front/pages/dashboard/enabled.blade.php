@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" />
                            </div>
                        </div>
                        <div class="form-group col-lg-9"  >
                            <div class="input-group">
                                <div class="form-group col-lg-3">
                                    <label class="form-label">Your account are created</label>
                                </div>
                                <div class="form-group col-lg-9">
                                    <label class="form-label"> An email has been sent with link enable you to confirm that your Ariane Espace dashboard has been created</label>
                                    <p>Please check your spam folder if email has not arrived within 2 minutes</p>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-md-12">
                                    
                                </div>
                            </div><br>
                        </div>
                        <div class="col-lg-3">
                        </div>
                    </div>
                    <a href="{{route('connect')}}"> <label class="form-label"><-Back</label></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {
        
    });
</script>
@endsection