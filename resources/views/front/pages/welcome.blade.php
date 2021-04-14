@extends('layouts.front')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
<div class="content-box">
    <div class="row">
        <section class="col-md-4 left-section">
            <div class="logo">
                <img src="{{ asset('media/logos/logo-easy.svg') }}" alt="logo easy">
            </div>
            <div class="launch-period">
                <div class="number">01</div>
                <div class="label-number">Choose your launch period</div>
            </div>
            <div class="read-more">
                <span class="text">Any questions? contact us</span>
                <span><img src="{{ asset('media/svg/icons/Navigation/Vector.svg') }}" alt="contact us"></span>
            </div>
            <ul class="pagination">
              <li class="number active" style="top: 207px">01</li>  
              <li class="number" style="top: 247px">02</li>  
              <li class="number" style="top: 287px">03</li>  
              <li class="number" style="top: 327px">04</li>  
              <li class="number" style="top: 367px">05</li>  
            </ul>
        </section>
        <section class="col-md-8 right-section">
            {{-- <div class="line-bar"></div> --}}
            <div class="book-your-launch">BOOK YOUR LAUNCH</div>
            <button class="close"><img src="{{ asset('media/svg/icons/Navigation/Cross.svg') }}" alt="close"></button>
            <div class="container-box">
                <label class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </label>
                <label class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </label>
                <label class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </label>
                <label class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </label>
                <label class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </label>
                <label class="card-box">
                    <div class="card-title">Q4.2021</div>
                    <input type="radio" name="q4" id="">
                </label>
                <div class="page-nav">
                    <div class="prev">
                        <span class="icon"><img src="{{ asset('media/svg/icons/Navigation/Vector-left.svg') }}" alt="previous"></span>
                        <span>Q3.2021</span>
                    </div>
                    <div class="next">
                        <span>Q2.2022</span>
                        <span class="icon"><img src="{{ asset('media/svg/icons/Navigation/Vector-right.svg') }}" alt="next"></span>
                    </div>
                </div>
            </div>
            <button class="btn next-btn">Continue</button>
        </section>
    </div>
</div>
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
    <script>
        $(document).ready(function() {
            $('.card-box input[type="radio"]').on('change', function() {
                $('.card-box').removeClass('active');
                $(this).parent().addClass('active');
            })
        })
    </script>
@endsection