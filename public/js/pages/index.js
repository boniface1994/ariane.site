$('.card').each(function(i,el){
	$(el).find('.ki-arrow-down').closest('a').on('click',function(){
		if($(this).closest('.card').hasClass('card-collapse') || $(this).closest('.card').hasClass('card-collapsed')){
			$(this).find('.ki-arrow-down').css('transform',"rotate(180deg)");
		}else{
			$(this).find('.ki-arrow-down').css('transform',"rotate(0deg)");
		}
	});

	if($(el).hasClass('card-collapsed')){
		$(el).find('.ki-arrow-down').css('transform',"rotate(0deg)");
	}
})