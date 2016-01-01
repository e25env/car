@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('users') }}">ข้อมูลผู้ใช้งานระบบ</a></li>   
    <li class="uk-active"><span>เพิ่มข้อมูลผู้ใช้งาน</span></li>
</ul>
</h4>
	
{{ Form::open( array( 'url' => 'users/create', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">เพิ่มข้อมูล</div>  

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'cid', 'ชื่อผู้ใช้', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			<div  class="uk-width-1-1 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($datageneral); ?> }'>
			    <input class="uk-width-1-1" name="cid" type="text" placeholder="ค้นหาด้วยชื่อหรือนามสกุลหรือรหัสบัตรประชาชน">
			</div>
			@if ($errors->has('cid')) <p class="g-text-error uk-text-danger">{{ $errors->first('cid') }}</p> @endif
		</div>	
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'level', 'สถานะ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <select id="level" name="level" class="uk-width-1-3">		  				        
		        <option value="1">เจ้าหน้าที่ฝ่ายบริหาร</option>
		        <option value="2">พนักงานขับรถ</option>	   		
			</select>  
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'level', 'สิทธิ์การอนุมัติ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <input id="c1" name="c1" value="1" type="checkbox"><label for="c1"> มีสิทธิ์</label>	  
		</div>		
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'level', 'สิทธิ์ควบคุมรถยนต์', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <input id="c2" name="c2" value="1" type="checkbox"><label for="c2"> มีสิทธิ์</label>	  
		</div>		
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'level', 'สิทธิ์จุดประสานงาน', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <input id="c3" name="c3" value="1" type="checkbox"><label for="c3"> มีสิทธิ์</label>	  
		</div>		
	</div>
	<hr />
	<div class="uk-form-row uk-text-center">
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('users') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}



<?php
	//print_r($datageneral);
?>
	
@stop
