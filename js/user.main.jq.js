$(document).ready(function(e){

	$(document).on('click','a.mymenu',function(event) {
		$('a.mymenu').removeClass('active');
		$(this).addClass('active');
		$('.action').val($(this).attr('id'));
		$('.user').submit();		
	});

	$(document).on('submit','.user',function(event) {
		event.preventDefault();
		//alert ('here');
		//test
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

	$(document).on('submit','.newpatient',function(event) {
		event.preventDefault();
		var userSerialize = $('.newpatient').serialize();
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: userSerialize,
            success: function(msg){
                $(".divdisplay").html(msg);
            }
        });
	});

	$(document).on('keyup', '.lname', function(event) {
		event.preventDefault();
		//alert($('.lname').val() + $('.fname').val() + $('.mname').val());
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: 'lname=' + $('.lname').val() + '&fname=' + $('.fname').val() + '&mname=' + $('.mname').val() + '&action=searchpatient' ,
            success: function(msg){
                $(".displayPatientSearch").html(msg);
            }
        }); 
	});

	$(document).on('keyup', '.fname', function(event) {
		event.preventDefault();
		//alert($('.lname').val() + $('.fname').val() + $('.mname').val());
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: 'lname=' + $('.lname').val() + '&fname=' + $('.fname').val() + '&mname=' + $('.mname').val() + '&action=searchpatient' ,
            success: function(msg){
                $(".displayPatientSearch").html(msg);
            }
        }); 
	});

	$(document).on('keyup', '.mname', function(event) {
		event.preventDefault();
		//alert($('.lname').val() + $('.fname').val() + $('.mname').val());
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: 'lname=' + $('.lname').val() + '&fname=' + $('.fname').val() + '&mname=' + $('.mname').val() + '&action=searchpatient' ,
            success: function(msg){
                $(".displayPatientSearch").html(msg);
            }
        }); 
	});

	$(document).on('click','.addpatient',function(event) {
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: 'action=addpatient&ifupdate=' + $(this).attr('id'),
            success: function(msg){
                $(".divdisplay").html(msg);
            }
        }); 
	});

	$(document).on('click','.back',function(event) {
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: 'action=patient' ,
            success: function(msg){
                $(".divdisplay").html(msg);
            }
        }); 
	});

	$(document).on('submit','.form-addnew',function(event) {
  
  	event.preventDefault();
  	var userSerialize = $(this).serialize();

		$.ajax({
	    type: "POST",
	    url: "fn/user_postback_fn.php",
	    data: userSerialize,
	    success: function(msg){
	    	  console.log(msg);
		    	var array = JSON.parse(msg);
		      $(".alert-here").html(array['result']);
		      if (array['success']=='new') {
		      	$('.input-data').removeClass('is-valid');
		      	$('.input-data').val('');
		      	$('.hidbdate').val('0000-00-00');
		      }else if(array['success']=='old'){
		      	$('.input-data').removeClass('is-valid');
		      }
	    	}
    	});
  	});

  	$(document).on('change','#bdate',function(event) {
		if($(this).val()){
			$('.hidbdate').val($(this).val());
		}else{
			$('.hidbdate').val('0000-00-00');
		}
	});

  	//add,edit patient
	$(document).on('click','.imgedit',function(event) {
  		//console.log('action='+$(this).closest('td').attr('id')+'&dataid='+$(this).attr('id'));
  		var action = 'action='+$(this).closest('td').attr('id')+'&dataid='+$(this).attr('id');
  		//$('.user').submit();
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: action,
            success: function(msg){
                $(".divdisplay").html(msg);
            }
        }); 
	});

	//delete patient account
	$(document).on('click','.imgdel',function(event) {
		if (confirm('Are you sure to delete '+$(this).closest('tr').attr('id')+' '+$(this).attr('id')+'?')) {
	    	//console.log($(this).closest('td').attr('id')+'&dataid='+$(this).attr('id'));
			var action = 'action='+$(this).closest('td').attr('id')+'&dataid='+$(this).attr('id');
	    	//global_action = $(this).closest('td').attr('id')+'&dataid='+$(this).attr('id');
	    	//$('.user').submit();
	    	$.ajax({
	            type: "POST",
	            url: "fn/user_postback_fn.php",
	            data: action,
	            success: function(msg){
	                $(".divdisplay").html(msg);
	            }
	        }); 
		}
	});

	//view patient
	$(document).on('click','.imgview',function(event) {
  		//console.log('action='+$(this).closest('td').attr('id')+'&dataid='+$(this).attr('id'));
  		var action = 'action='+$(this).closest('td').attr('id')+'&dataid='+$(this).attr('id');
  		//$('.user').submit();
		$.ajax({
            type: "POST",
            url: "fn/user_postback_fn.php",
            data: action,
            success: function(msg){
                $(".divdisplay").html(msg);
            }
        }); 
	});

	$(document).on('click','.admit',function(event) {
		if (confirm('Are you sure to admit patient '+$(this).attr('id')+'?')) {
			$('.isadmitted').val(1);
	    	$('.form-addstatus').submit();
	    	/*$.ajax({
	            type: "POST",
	            url: "fn/user_postback_fn.php",
	            data: action,
	            success: function(msg){
	                $(".divdisplay").html(msg);
	            }
	        });*/ 
		}
	});
	$(document).on('click','.discharge',function(event) {
		if (confirm('Are you sure to discharge patient '+$(this).attr('id')+'?')) {
			$('.isadmitted').val(0);
	    	$('.form-addstatus').submit();
	    	/*$.ajax({
	            type: "POST",
	            url: "fn/user_postback_fn.php",
	            data: action,
	            success: function(msg){
	                $(".divdisplay").html(msg);
	            }
	        });*/ 
		}
	});

	$(document).on('submit','.form-addstatus',function(event) {
  
  	event.preventDefault();
  	var userSerialize = $(this).serialize();

		$.ajax({
	    type: "POST",
	    url: "fn/user_postback_fn.php",
	    data: userSerialize,
	    success: function(msg){
	    	  console.log(msg);
		    	var array = JSON.parse(msg);
		      $(".alert-herea").html(array['result']);
		      $('.form-displaypatient').submit();
/*		      if (array['success']=='new') {
		      	$('.input-data').removeClass('is-valid');
		      	$('.input-data').val('');
		      	$('.hidbdate').val('0000-00-00');
		      }else if(array['success']=='old'){
		      	$('.input-data').removeClass('is-valid');
		      }*/
	    	}
	   	});
  	});

  	$(document).on('submit','.form-displaypatient',function(event) {
  
  	event.preventDefault();
  	var userSerialize = $(this).serialize();

		$.ajax({
	    type: "POST",
	    url: "fn/user_postback_fn.php",
	    data: userSerialize,
	    success: function(msg){
                $(".divdisplay").html(msg);
            }
	   	});
  	});

  	$(document).on('click','.addencounter',function(event) {
		$('.form-addencounter').submit();
	});

	$(document).on('submit','.form-addencounter',function(event) {
		event.preventDefault();
  		var userSerialize = $(this).serialize();
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