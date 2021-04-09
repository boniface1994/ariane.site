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
                                        <div class="input-group allquarter" data-route="{{route('allquarter')}}" data-year={{$year}} data-sess_quarter="{{session('quarter') ? session('quarter') : ''}}">
                                            <!-- @foreach($datas as $data)
                                            @if($data->annee <= $year)
                                            <div class="card card-custom col-md-3 mr-2 mb-2 quarter" style="background-color: {{(session('quarter') == $data->date) ? '#2176bd' : ''}}" >
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <h3 class="mr-2">
                                                            {{ $data->q_dispo }}.{{ $data->annee }}
                                                        </h3>
                                                        <input class="radio radio-success trimester" type="radio" name="quarter" value="{{$data->date}}" {{(session('quarter') == $data->date) ? 'checked' : ''}}>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach -->

                                            
                                        </div>
                                    <!-- </div> -->
                                    <!-- <div class="input-group">
                                        <button class="col-md-2">Prev</button>
                                        <button class="col-md-2">Next</button>
                                    </div> -->
                                    <div id="pagination-bar"></div>
                                <!-- </div> --><br>

                                <div class="form-group" style="float: right; margin-right: 175px">
                                    <button href="{{route('step_two')}}" class="btn btn-primary " disabled>Suivant >></button>
                                </div>
                            </form>
                        </div>
                        <!-- <div id="pagination-data-container"></div>
                        <div id="pagination-bar"></div> -->
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
<<<<<<< HEAD
=======
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery-paginate@1.0.1/jquery-paginate.min.js"></script> -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        var all = null;
        var year = $('.allquarter').data('year');
        var session = $('.allquarter').data('sess_quarter');
        $.ajax({
            url: $('.allquarter').data('route'),
            method: 'GET',
            success: function(response){
                all = response;
            }
        });
        function template(data) {
            var html='';
            $.each(data, function(index, item){
                if(item.annee <= year){
                    html += '<div class="card card-custom col-md-3 mr-2 mb-2 quarter" style="background-color: {{(session("quarter") =='+item.date+') ? "#2176bd" : ""}}" ><div class="card-body"><div class="input-group"><h3 class="mr-2">'+ item.q_dispo+'.'+item.annee +'</h3><input class="radio radio-success trimester" type="radio" data-sess="{{session("quarter")}}" name="quarter" value="'+item.date+'" {{(session("quarter") == '+item.date+') ? "checked" : ""}}></div></div></div>';
                }
                
            });
                  html+='';                                      
            return html;
        }
        setTimeout(function() {
            $(function(){
               var container = $('#pagination-bar');
                container.pagination({
                    dataSource: all,
                    pageSize: 6,
                    showPageNumbers: false,
                    showNavigator: true,
                    autoHidePrevious: false,
                    autoHideNext: false,
                    pageRange: null,
                    callback: function(data, pagination) {
                        var html = template(data);
                        var all_data = [];
                        var min_data = data[0].q_dispo+'.'+data[0].annee;
                        var max_data = data[data.length - 1].q_dispo+'.'+data[data.length - 1].annee;
                        for(var i=0; i<all.length ; i++){
                            if(all[i].annee <=year){
                                all_data.push(all[i]);
                            }
                        }

                        $('.paginationjs-prev').find('a').css('font-size','40px');
                        $('.paginationjs-next').find('a').css('font-size','40px');
                        $('.paginationjs-next').css('margin-top','-46px');
                        for(var j=0;j<all_data.length;j++){

                            if(j>0 && min_data == (all_data[j].q_dispo+'.'+all_data[j].annee)){
                                $('.paginationjs-prev').find('a').text('<'+all_data[j-1].q_dispo+'.'+all_data[j-1].annee);
                                $('.paginationjs-prev').find('a').css('font-size','17px');
                            }
                            if(j<all_data.length && max_data == (all_data[j].q_dispo+'.'+all_data[j].annee)){
                                $('.paginationjs-next').find('a').text(all_data[j+1].q_dispo+'.'+all_data[j+1].annee+'>');
                                $('.paginationjs-next').find('a').css('font-size','17px');
                                if(j>=6){
                                    $('.paginationjs-next').css('margin-top','-24px');
                                }
                            }
                        }
                        $('.container').find('#quarter .allquarter').html(html);
                        $('.J-paginationjs-nav').addClass('d-none');
                        $('.paginationjs-next').find('a').css('float','right');
                        $('.paginationjs-next').find('a').css('margin-right','232px');
                        $('.container').find('#quarter .quarter').each(function(i,el){
                            $(el).on('click',function(){
                                $(this).find('.trimester').attr('checked',true);
                                $(this).css("background-color","#2176bd");
                                // $(this).closest('#quarter').find('.btn').removeAttr('disabled');
                                $(el).closest('#quarter').find('.btn').removeAttr('disabled');
                                sessionStorage.setItem('quarter',$(this).find('.trimester').val());
                                $(this).siblings().css("background-color","");
                                $(this).siblings().find(".trimester").attr('checked',false);
                                
                            });
                            $('ul').css('list-style','none');
                            $('li').css('list-style','none');
                            if($(el).find('.trimester').val() == session){
                                $(el).css("background-color","#2176bd");
                                $(el).find('.trimester').attr('checked',true);
                                $(el).closest('#quarter').find('.btn').removeAttr('disabled');
                            }else{
                                $(el).css("background-color","");
                                $(el).find('.trimester').attr('checked',false);
                            }
                        });
                        
                    }
                });
              
            });
                

        },1000)
        
    });
</script>
>>>>>>> 600ef55e706ee7bc0ecea4b3e5c77e3cc4f6aa3b
@endsection