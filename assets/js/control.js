$(document).ready(function() {
 
	
    $(".group0").colorbox({rel:'group0'});
	$(".group1").colorbox({rel:'group1'});
	$(".group2").colorbox({rel:'group2'});
	$(".group3").colorbox({rel:'group3'});
	$(".group4").colorbox({rel:'group4'});
	$(".group5").colorbox({rel:'group5'});
	$(".group6").colorbox({rel:'group6'});
	$(".group7").colorbox({rel:'group7'});
	$(".group8").colorbox({rel:'group8'});
	$(".group9").colorbox({rel:'group9'});
	$(".group10").colorbox({rel:'group10'});
	$(".group11").colorbox({rel:'group11'});
	$(".group12").colorbox({rel:'group12'});
	$(".group13").colorbox({rel:'group13'});
	$(".group14").colorbox({rel:'group14'});
	$(".group15").colorbox({rel:'group15'});
	$(".group16").colorbox({rel:'group16'});
	$(".group17").colorbox({rel:'group17'});
	$(".group18").colorbox({rel:'group18'});
	$(".group19").colorbox({rel:'group19'});
	$(".group20").colorbox({rel:'group20'});
	$(".group21").colorbox({rel:'group21'});
	$(".group22").colorbox({rel:'group22'});
	$(".group23").colorbox({rel:'group23'});
	$(".group24").colorbox({rel:'group24'});
	$(".group25").colorbox({rel:'group25'});
	$(".group26").colorbox({rel:'group26'});
	$(".group27").colorbox({rel:'group27'});
	$(".group28").colorbox({rel:'group28'});	
	$(".group29").colorbox({rel:'group29'});
	$(".group30").colorbox({rel:'group30'});


	$('.fb3').mask("00-00-0000", {placeholder: "__-__-____"});
	$('.fb12').mask("00-00-0000", {placeholder: "__-__-____"});
	$('.fb13').mask("00-00-0000", {placeholder: "__-__-____"});
	$('.fb14').mask("00-00-0000", {placeholder: "__-__-____"});

	//$('.req_date').mask("00-00-0000", {placeholder: "__-__-____"});
	$('.godate').mask("00-00-0000", {placeholder: "__-__-____"});
	$('.gotime_start').mask("00:00", {placeholder: "__:__"});
	$('.gotime_end').mask("00:00", {placeholder: "__:__"});
	$('.backtime').mask("00:00", {placeholder: "__:__"});
	

	$('.datestart1').mask("00-00-0000", {placeholder: "__-__-____"});
	$('.dateend1').mask("00-00-0000", {placeholder: "__-__-____"});


	$('#c2').bind('change', function () {
	   if ($(this).is(':checked')){
	     
	   }
	   else{
	     $('#fb16').val('');
	     $('#fb17').val('');
	   }
	});

	$('#c3').bind('change', function () {
	   if ($(this).is(':checked')){
	     
	   }
	   else{
	     $('#fb18').val('');
	   }
	});



	var currentLangCode = 'th';
	$('#calendar').fullCalendar({
		header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
		},
        lang: currentLangCode,       
        timeFormat: 'H:mm',  
        height: 570,         
        editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: {
			url: 'leaves/get-events',
			error: function() {
				//$('#script-warning').show();
			}						
		},
		eventColor: '#000000',
		loading: function(bool) {
			$('#loading').toggle(bool);
		},
		eventClick: function(calEvent, jsEvent, view) {
	 
        	$.ajax({
				type:"GET",
				url:"leaves/view/"+calEvent.id,
				data:"", 
				cache: false,     
				success:function( result ){										   			   
				  	$.pgwModal({			       		
		                content: result
		            });		  
				}
			});	        

	        // change the border color just for fun
	        $(this).css('border-color', 'red');

    	}
    })


	$( '#add_deposit' ).click(function(){
		var req_main_id = $('#main_deposit').val();
		var dall = $('#data_deposit').val();
		if( dall != '' )
		{
			var d = dall.split(" ");
			//alert( d[0]+'-'+d[2]+'-'+d[4]+'-'+d[6]+'-'+d[8] );
			$.ajax({
					type:"GET",
					url:"add_deposit/"+req_main_id+"/"+d[0],
					data:"", 
					cache: false,     
					success:function( result ){										   			   
					  	$( '#view-deposit' ).html( result ); 
					  	$('#data_deposit').val(''); 
					}
			});	     
		}			
	});

	//-------------- บันทึก ขอไปราชการ --------------//
	$( '#save_reserve' ).click(function(){
		 
		 var $form = $( '#form-reserve' ), data = $form.serialize(), url = $form.attr( "action" );
		 var posting = $.post( url, { formData: data } );
		 posting.done(function( data ) {
	          if( data.fail ) 
	          {      
	          	 alert('กรุณากรอกข้อมูลส่วนที่จำเป็นให้ครบ');	          	            
	          } 
	          if( data.success == true ) 
	          {    
	          	window.open("/car/reserve/view/"+data.reserve_id);  
	          
	          	if( data.usecar1 == 1 ){
	          		window.location.href = "/car/reqcar/create/"+data.reserve_id;
	          	}else{	
	          		window.location.href = "/car/reserve"; 
	          	}	          	         	          	           	             	           
	          }
	          if( data.success == false )
	          {
	            alert( data.msg ); 
	            //location.reload(true); 
	          }
	          if( data.error_date == true ) 
	          {                 
	            alert( data.msg );  
	            //location.reload(true);       
	          }
        });   

	});

	//------------------ บันทึก ขอใช้รถยนต์ ----------------//
	$( '#save_reqcar' ).click(function(){		 
		 var $form = $( '#form-reqcar' ), data = $form.serialize(), url = $form.attr( "action" );
		 var posting = $.post( url, { formData: data } );
		 posting.done(function( data ) {
	          if( data.fail ) 
	          {      
	          	 alert('กรุณากรอกข้อมูลส่วนที่จำเป็นให้ครบ');	          	            
	          } 
	          if( data.success == true ) 
	          {    
	          	//window.open("/car/reqcar/view/"+data.r_id);  	          	          	
	          	window.location.href = "/car/reqcar"; 	          		          	         	          	           	             	           
	          }
	          if( data.success == false )
	          {
	            alert( data.msg ); 
	            //location.reload(true); 
	          }
	          if( data.error_date == true ) 
	          {                 
	            alert( data.msg );  
	            //location.reload(true);       
	          }
        });   
	});

	//------------------ บันทึก ขอใช้รถยนต์ และพิมพ์ ----------------//

	$( '#save_reqcar_print' ).click(function(){		 
		 var $form = $( '#form-reqcar' ), data = $form.serialize(), url = $form.attr( "action" );
		 var posting = $.post( url, { formData: data } );
		 posting.done(function( data ) {
	          if( data.fail ) 
	          {      
	          	 alert('กรุณากรอกข้อมูลส่วนที่จำเป็นให้ครบ');	          	            
	          } 
	          if( data.success == true ) 
	          {    
	          	window.open("/car/reqcar/view/"+data.r_id);  	          	          	
	          	window.location.href = "/car/reqcar"; 	          		          	         	          	           	             	           
	          }
	          if( data.success == false )
	          {
	            alert( data.msg ); 
	            //location.reload(true); 
	          }
	          if( data.error_date == true ) 
	          {                 
	            alert( data.msg );  
	            //location.reload(true);       
	          }
        });   
	});

	//--------------end-----------------------//

	$( '#save_resend' ).click(function(){		 
		var $form = $( '#form-resend' ), data = $form.serialize(), url = $form.attr( "action" );
		var posting = $.post( url, { formData: data } );
		 posting.done(function( data ) {
	          if( data.fail ) 
	          {      
	          	 alert('กรุณากรอกข้อมูลส่วนที่จำเป็นให้ครบ');	          	            
	          } 
	          if( data.success == true ) 
	          {    
	          	window.open("/car/reqcar/view/"+data.r_id);  	          	          	
	          	window.location.href = "/car/reqcar"; 	          		          	         	          	           	             	           
	          }
	          if( data.success == false )
	          {
	            alert( data.msg ); 
	            //location.reload(true); 
	          }
	          if( data.error_date == true ) 
	          {                 
	            alert( data.msg );  
	            //location.reload(true);       
	          }
        });  
	});







	//----------------เพิ่มน้ำมัน oil
	$('#formoil').hide();
	$('#viewoil').hide();	
	$('#caroil').val(0);
	$('#dateoil').mask("00-00-0000", {placeholder: "__-__-____"});
	$('#caroil').change(function(){
		var caroil  = $( '#caroil' ).val();	

		$('#oilnumber, #dateoil, #bookoil, #numberoil, #pwoil ,#mioil, #kmoil, #woil, #moneyoil').val('');

		if( caroil == 0 )
		{
			$('#formoil').hide();
			$('#viewoil').html('');
		}	
		else
		{
			$('#formoil').show();
			$('#oilnumber').val(caroil);
			$('#viewoil').hide();
			$('#viewoil').html('');
			
			$.ajax({
					type:"GET",
					url:"oil/viewoilcar/"+caroil,
					data:"", 
					cache: false,     
					success:function( result ){	
						$( '#viewoil' ).show();										   			   
					  	$( '#viewoil' ).html( result );		  	
					}
			});	   

		}		
	});

	//-----คำนวนกิโล
	$('#mioil').keyup(function(){
        if( $('#mioil').val() != '' ){           
            $.ajax({
					type:"GET",
					url:"oil/getoldmioil/"+$('#oilnumber').val(),
					data:"", 
					cache: false,     
					success:function( result ){	
						var summioil =  eval($('#mioil').val())-eval(result); 
						if( summioil >= 0 ){
							$('#kmoil').val(summioil);	
						}else{
							$('#kmoil').val('');
						}
					}
			});	  
        }else{
			$('#kmoil').val('');
        }
    });

	//-----คำนวนลิตร
	$('#pwoil').keyup(function(){
        if( $('#pwoil').val() != '' ){   
        	if( $('#pwoil').val() != '' && $('#woil').val() != '' ){
        		var summoney =  eval($('#pwoil').val())*eval($('#woil').val());       
            	$('#moneyoil').val(Math.round(summoney));  
        	}else{
				$('#moneyoil').val('');
        	}
        }else{
			$('#moneyoil').val('');
        }
    });
    $('#woil').keyup(function(){
        if( $('#woil').val() != '' ){  
        	if( $('#pwoil').val() != '' && $('#woil').val() != '' ){
        		var summoney =  eval($('#pwoil').val())*eval($('#woil').val());       
            	$('#moneyoil').val(Math.round(summoney));    
        	}else{
				$('#moneyoil').val('');
        	} 
        }else{
        	$('#moneyoil').val('');
        }
    });

	$('#addoil').click(function(){
		if( $('#dateoil').val() == '' || $('#woil').val() == '' || $('#moneyoil').val() == '' ){
			alert('กรุณากรอกข้อมูลให้ครบ');
		}else{

			if( $('#mioil').val() == '' ){
				$('#mioil').val('0');
			}

			if( $('#kmoil').val() == '' ){
				$('#kmoil').val('0');
			}

			$.ajax({
				type:"GET",
				url:"oil/addoil/"+$('#oilnumber').val()+'/'+$('#dateoil').val()+'/'+$('#listoil').val()+'/'+$('#mioil').val()+'/'+$('#kmoil').val()+'/'+$('#woil').val()+'/'+$('#moneyoil').val()+'/'+$('#bookoil').val()+'/'+$('#numberoil').val()+'/'+$('#pwoil').val(),
				data:"", 
				cache: false,     
				success:function( result ){	
					if( result == 'ok' ){
						
						$.ajax({
								type:"GET",
								url:"oil/viewoilcar/"+$('#oilnumber').val(),
								data:"", 
								cache: false,     
								success:function( result ){	
									$( '#viewoil' ).show();									   			   
								  	$( '#viewoil' ).html( result );		  	
								}
						});	 

						$('#dateoil').val(null);
						$('#bookoil, #numberoil ,#mioil, #kmoil, #pwoil ,#woil, #moneyoil').val(''); 

					}else{
						alert('ไม่สามารถเพิ่มข้อมูลได้');
					}					
				}
			});
		}
	});






	$('#postTitle').val('');
	$('#postDate').val('');



	

});



function oildel(car, id)
{
	$.ajax({
			type:"GET",
			url:"oil/delete/"+id,
			data:"", 
			cache: false,     
			success:function( result ){										   			   
			  	$.ajax({
						type:"GET",
						url:"oil/viewoilcar/"+car,
						data:"", 
						cache: false,     
						success:function( result ){	
							$( '#viewoil' ).show();	
						  	$( '#viewoil' ).html( result );		  	
						}
				});	   		  	
			}
	});	  
}



function del_deposit( id )
{
	$.ajax({
			type:"GET",
			url:"del_deposit/"+id,
			data:"", 
			cache: false,     
			success:function( result ){										   			   
			  	$( '#view-deposit' ).html( result ); 			  	
			}
	});	    
}

var intTextBox=4;
function addElement()
{	
	intTextBox = intTextBox + 1;
	var contentID = document.getElementById("content-box");
	var newTBDiv = document.createElement("div");
	newTBDiv.setAttribute("id","strText"+intTextBox);
	newTBDiv.innerHTML = '<div class="uk-margin-top" style="margin-left:20px;">'+'<span>'+intTextBox+'.</span>'+"<sapn class='g-text'> <input type='text' class='uk-form-small uk-width-1-3' id='" + intTextBox + "' name='fb6[]'> </span>"+"<span>ตำแหน่ง</span>"+"<sapn class='g-text'> <input type='text' class='uk-form-small uk-width-1-3' id='2" + intTextBox + "' name='fb7[]'> </span> </div>";
	contentID.appendChild(newTBDiv);
}

function removeElement()
{
	if(intTextBox != 0)
	{
		var contentID = document.getElementById("content-box");
		contentID.removeChild(document.getElementById("strText"+intTextBox));
		intTextBox = intTextBox-1;
	}
}