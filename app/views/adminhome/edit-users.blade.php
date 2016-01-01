@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('users') }}">ข้อมูลผู้ใช้งานระบบ</a></li>   
    <li><span>แก้ไขข้อมูลผู้ใช้งาน</span></li> 
    <li class="uk-active"><span>{{ $user->pname }} {{ $user->fname }} {{ $user->lname }}</span></li>
</ul>
</h4>
	
<?php
	$url = 'users/edit/'.$user->cid;
?>	
{{ Form::open( array( 'url' => $url , 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">แก้ไขข้อมูล</div>  
	{{ Form::token() }}		

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'username', 'ชื่อผู้ใช้', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ $user->cid }} {{ $user->pname }}{{ $user->fname }} {{ $user->lname }}				
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'level', 'สถานะ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <select id="level" name="level" class="uk-width-1-3">		  			        
		   		<option <?php if($user->level == 1) {echo "selected";}else{echo "";}  ?> value="1">เจ้าหน้าที่ฝ่ายบริหาร</option>
		        <option <?php if($user->level == 2) {echo "selected";}else{echo "";}  ?> value="2">พนักงานขับรถ</option>	 
			</select>  
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'level', 'สิทธิ์การอนุมัติ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <input <?php  echo (($user->c1 == 1) ? 'checked="checked"':''); ?> id="c1" name="c1" value="1" type="checkbox"><label for="c1"> มีสิทธิ์</label>	  
		</div>		
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'level', 'สิทธิ์ควบคุมรถยนต์', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <input <?php  echo (($user->c2 == 1) ? 'checked="checked"':''); ?> id="c2" name="c2" value="1" type="checkbox"><label for="c2"> มีสิทธิ์</label>	  
		</div>		
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'level', 'สิทธิ์จุดประสานงาน', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <input <?php  echo (($user->c3 == 1) ? 'checked="checked"':''); ?> id="c3" name="c3" value="1" type="checkbox"><label for="c3"> มีสิทธิ์</label>	  
		</div>		
	</div>
	<div class="uk-form-row uk-text-center">
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('users') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}
	
@stop
