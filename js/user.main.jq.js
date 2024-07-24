$(document).ready(function(e){

	$(document).on('click','a.mymenu',function(event) {
		$('a.mymenu').removeClass('active');
		$(this).addClass('active');
		$('.action').val($(this).attr('id'));
		$('.user').submit();		
	});

	$(document).on('submit','.user',function(event) {
		event.preventDefault();
		var userSerialize = $('.user').serialize();
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: userSerialize,
            success: function(msg){
                $(".divdisplay").html(msg);
            }
        });
	});
	
/*end*/
});