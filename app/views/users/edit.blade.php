@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('admin/users') }}">ข้อมูลผู้ใช้งานระบบ</a></li>   
    <li><span>แก้ไขข้อมูลผู้ใช้งาน</span></li> 
    <li class="uk-active"><span>{{ $user->pname }} {{ $user->fname }} {{ $user->lname }}</span></li>
</ul>
</h4>
	
<?php
	$url = 'admin/users/edit/'.$user->id;
?>	
{{ Form::open( array( 'url' => $url , 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">แก้ไขข้อมูล</div>  
	{{ Form::token() }}		

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'username', 'ชื่อผู้ใช้', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'username', $user->username, array( 'placeholder' => 'ชื่อผู้ใช้', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('username')) <p class="g-text-error uk-text-danger">{{ $errors->first('username') }}</p> @endif			
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'password', 'รหัสผ่าน', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">			
			{{ Form::input('password', 'password', $user->password , array( 'class' => 'uk-width-1-1' ) ) }}	
			@if ($errors->has('password')) <p class="g-text-error uk-text-danger">{{ $errors->first('password') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'pname', 'คำนำหน้า', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">			
		   {{ $user->pname }}			
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'fname', 'ชื่อ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'fname', $user->fname, array( 'placeholder' => 'ชื่อ', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('fname')) <p class="g-text-error uk-text-danger">{{ $errors->first('fname') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'lname', 'นามสกุล', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'lname', $user->lname, array( 'placeholder' => 'นามสกุล', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('lname')) <p class="g-text-error uk-text-danger">{{ $errors->first('lname') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'cid', 'รหัสบัตรประชาชน', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'cid', $user->cid, array( 'placeholder' => 'รหัสบัตรประชาชน', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('cid')) <p class="g-text-error uk-text-danger">{{ $errors->first('cid') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'position', 'ตำแหน่ง', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <select id="position_user" name="position" class="uk-width-1-1">
		  		@foreach($position as $b)
		        	<option <?php if($user->position == $b->position_id) {echo "selected";}else{echo "";}  ?> value="{{ $b->position_id }}">{{ $b->positionName }}</option>
		   		@endforeach
			</select>  
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'active', 'สถานะ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <select id="active_user" name="active" class="uk-width-1-3">
		  		@foreach($active as $c)
		        	<option <?php if($user->active == $c->activeID) {echo "selected";}else{echo "";}  ?> value="{{ $c->activeID }}">{{ $c->activeName }}</option>
		   		@endforeach
			</select>  
		</div>
	</div>
	<hr />
	<div class="uk-form-row uk-text-center">
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('admin/users') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}
	
@stop
