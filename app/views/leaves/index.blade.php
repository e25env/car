@extends('layouts.sidebar')
@section('content')
	
	<script type="text/javascript">
		/*$(document).ready(function() {
			$.pgwModal({
			    target: '#modalContent',
			    title: 'กรุณาตรวจสอบรายการของท่านด้วยตัวเอง',		   
			    maxWidth: 800
			});
		});*/
	</script>

	<!--<div id="modalContent" style="display: none;">
	    <strong style="color: #000000;">ตัวอย่างการแก้ไขการขอใช้รถยนต์</strong>
	    <hr />   
	    <center><img src="images/r1.jpg"></center>	 
	</div>-->
	

	<span id='loading'>loading...</span>

	<div class="uk-grid uk-margin-top">	
	    <div class="uk-width-medium-1-6">
	    	<span class="uk-thumbnail uk-border-circle b-b"></span> 
	    	<span>: งานปกติ</span>
	    </div>
	    <div class="uk-width-medium-1-6">
	    	<span class="uk-thumbnail uk-border-circle b-s"></span> 
	    	<span>: ไปกับฝ่ายอื่น</span>
	    </div>
	    <div class="uk-width-medium-1-6">
	    	<span class="uk-thumbnail uk-border-circle b-o"></span> 
	    	<span>: ยังไม่ระบุคนขับ</span>
	    </div> 
	</div>   

	<div class="uk-grid uk-margin-top">
		<div class="uk-width-medium-1-1">
			<div id='calendar'></div>
		</div>
	</div>	

	<div class="uk-margin-top"></div>	

	
@stop

