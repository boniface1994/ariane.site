@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <img src="{{ asset('media/logos/logo-light.png') }}" class="mr-2" style="max-width: 120px" alt="" /><br>
                                <label class="number" style="font-size: 120px">01</label>
                                <label class="title" style="font-size: 30px">{{ __('Choose your lauch period') }}</label>
                            </div>

                        </div>
                        <div class="form-group col-lg-9"  id="quarter">
                            <form action="{{route('session_one')}}" method="POST">
                                @csrf
                                <label class="form-label" style="font-size: 30px"> {{ __('Book your launch') }}</label>
                                <!-- <div class="card card-custom" id="quarter">
                                    <div class="card-body"> -->
                                        <div class="input-group">
                                            @foreach($datas as $data)
                                            @if($data->annee <= $year)
                                            <div class="card card-custom col-md-3 mr-2 mb-2 quarter" style="background-color: {{(session('quarter') == $data->date) ? '#2176bd' : ''}}" >
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <h3 class="mr-2">
                                                            {{ $q }}.{{ $data->annee }}
                                                        </h3>
                                                        <input class="radio radio-success trimester" type="radio" name="quarter" value="{{$data->date}}" {{(session('quarter') == $data->date) ? 'checked' : ''}}>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    <!-- </div> -->
                                    <!-- <div class="input-group">
                                        <button class="col-md-2">Prev</button>
                                        <button class="col-md-2">Next</button>
                                    </div> -->
                                    
                                <!-- </div> --><br>

                                <div class="form-group" style="float: right; margin-right: 175px">
                                    <button href="{{route('step_two')}}" class="btn btn-primary " disabled>Suivant >></button>
                                </div>
                            </form>
                        </div>
                        <div id="pagination-container"></div>
                    </div>
                    <!-- @auth
                    {{ __('You are logged in!eee') }}
                    @endauth
                    @guest
                    {{ __('You are not logged in :(') }}
                    @endguest -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery-paginate@1.0.1/jquery-paginate.min.js"></script> -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        // var items = $('#quarter').find('.quarter');
        // var numItems = items.length;
        // var perPage = 6;

        // items.slice(perPage).hide();

        // $('#pagination-container').pagination({
        //     items: numItems,
        //     itemsOnPage: perPage,
        //     prevText: "&laquo;",
        //     nextText: "&raquo;",
        //     onPageClick: function (pageNumber) {
        //         var showFrom = perPage * (pageNumber - 1);
        //         var showTo = showFrom + perPage;
        //         items.hide().slice(showFrom, showTo).show();
        //     }
        // });
        $('#quarter').find('.quarter').each(function(i,el){
            $(el).on('click',function(){
                $(this).find('.trimester').attr('checked',true);
                $(this).css("background-color","#2176bd");
                // $(this).closest('#quarter').find('.btn').removeAttr('disabled');
                $(el).closest('#quarter').find('.btn').removeAttr('disabled');
                sessionStorage.setItem('quarter',$(this).find('.trimester').val());
                $(this).siblings().css("background-color","");
                $(this).siblings().find(".trimester").attr('checked',false);
                
            });
            // var data = $(el).find('.trimester').val();
            // if(sessionStorage.getItem("quarter") == data){
            //     // $(el).find('.trimester').attr('checked',true);
            //     $(el).css("background-color","#2176bd");
            //     // $(el).closest('#quarter').find('.btn').removeAttr('disabled');
            //     $(el).closest('#quarter').find('.btn').removeClass('disabled');
            // }
            if($(el).find('.trimester').is(':checked')){
                $(el).css("background-color","#2176bd");
                $(el).closest('#quarter').find('.btn').removeAttr('disabled');
            }
        })
    });
</script>
@endsection