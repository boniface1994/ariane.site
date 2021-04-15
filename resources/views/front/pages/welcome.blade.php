@extends('layouts.front')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/step1.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card" style="background-color: #E5E5E5;">
                <div class="card-body" style="overflow: hidden">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="col-lg-3 left-section">
                            <div class="form-group">
                                <img src="{{ asset('media/logos/logo-easy.svg') }}" class="mr-2" style="max-width: 120px" alt="" /><br>
                                <label class="number">01</label>
                                <label class="title" style="font-size: 30px">{{ __('Choose your lauch period') }}</label>
                                <hr width="105%">
                                <div class="read-more">
                                    <span>Any questions?<br>contact us</span>
                                    <span><img src="{{ asset('media/svg/icons/Navigation/Vector.svg') }}" alt="contact us"></span>
                                </div>
                            </div>
                            <ul class="pagination">
                                <li class="num-page active" style="top: -32em">01</li>  
                                <li class="num-page" style="top: -29em">02</li>  
                                <li class="num-page" style="top: -26em">03</li>  
                                <li class="num-page" style="top: -23em">04</li>  
                                <li class="num-page" style="top: -20em">05</li>  
                            </ul>
                        </div>
                        <div class="form-group col-lg-9"  id="quarter">
                            <form action="{{route('session_one')}}" method="POST">
                                @csrf
                                <label class="form-label top-title"> {{ __('Book your launch') }}</label>
                                <a href="#"><i class="far fa-window-close fa-2x" style="color: var(--orange); float: right;"></i></a>
                                <div class="input-group allquarter content-right" data-route="{{route('allquarter')}}" data-year={{$year}} data-sess_quarter="{{session('quarter') ? session('quarter') : ''}}">
                                </div>
                                <div id="pagination-bar"></div>
                                <br>
                                <div class="form-group mt-5" style="float: right;">
                                    <button href="{{route('step_two')}}" class="btn btn-next" disabled>SUIVANT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
<script type="text/javascript">

    $( window ).resize(function() {
        $('.pagination').css('left', $('.left-section').width() + 12 * 1 );
    });
    jQuery(document).ready(function () {

        $('.pagination').css('left', $('.left-section').width() + 12 * 1 );

        var all = null;
        var year = $('.allquarter').data('year');
        var session = $('.allquarter').data('sess_quarter');
        $.ajax({
            url: $('.allquarter').data('route'),
            method: 'GET',
            success: function(response){
                all = response;
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

                            $('.paginationjs-prev').find('a').css('font-size','20px').html("<i class='fa fa-angle-double-left'></i>");
                            $('.paginationjs-next').find('a').css('font-size','20px').html("<i class='fa fa-angle-double-right'></i>");
                            $('.paginationjs-next').css('margin-top','-32px');
                            for(var j=0;j<all_data.length;j++){

                                if(j>0 && min_data == (all_data[j].q_dispo+'.'+all_data[j].annee)){
                                    $('.paginationjs-prev').find('a').html("<i class='fa fa-arrow-left'></i> " +all_data[j-1].q_dispo+'.'+all_data[j-1].annee);
                                    $('.paginationjs-prev').find('a').css('font-size','15px');
                                }
                                if(j<all_data.length && max_data == (all_data[j].q_dispo+'.'+all_data[j].annee)){
                                    $('.paginationjs-next').find('a').html(all_data[j+1].q_dispo+'.'+all_data[j+1].annee+" <i class='fa fa-arrow-right'></i>");
                                    $('.paginationjs-next').find('a').css('font-size','15px');
                                    if(j>=6){
                                        $('.paginationjs-next').css('margin-top','-24px');
                                    }
                                }
                            }
                            $('.container').find('#quarter .allquarter').html(html);
                            $('.J-paginationjs-nav').addClass('d-none');
                            $('.paginationjs-next').find('a').css('float','right');
                            $('.paginationjs-next').find('a').css('margin-right','');
                            $('.container').find('#quarter .quarter').each(function(i,el){
                                $(el).on('click',function(){
                                    $(this).find('.trimester').attr('checked',true);
                                    $(this).css("background-color","#000").css('color', '#fff');
                                    // $(this).closest('#quarter').find('.btn').removeAttr('disabled');
                                    $(el).closest('#quarter').find('.btn').removeAttr('disabled');
                                    sessionStorage.setItem('quarter',$(this).find('.trimester').val());
                                    $(this).siblings().css("background-color", "").css('color', '#000');
                                    $(this).siblings().find(".trimester").attr('checked',false);
                                    
                                });
                                $('ul').css('list-style','none');
                                $('li').css('list-style','none');
                                if($(el).find('.trimester').val() == session){
                                    $(el).css("background-color","#000").css('color', '#fff');
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
            }
        });
        function template(data) {
            var html='';
            $.each(data, function(index, item){
                if(item.annee <= year){
                    html += '<label class="card card-custom col-md-3 mr-2 mb-2 quarter" style="background-color: {{(session("quarter") =='+item.date+') ? "#2176bd" : ""}}" ><div class="card-body"><div class="input-group"><h3 class="mr-2">'+ item.q_dispo+'.'+item.annee +'</h3><input class="radio radio-success trimester" type="radio" data-sess="{{session("quarter")}}" name="quarter" value="'+item.date+'" {{(session("quarter") == '+item.date+') ? "checked" : ""}}></div></div></label>';
                }
            });
                  html+='';                                      
            return html;
        }
    });
</script>
@endsection
