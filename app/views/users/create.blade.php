@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('admin/users') }}">ข้อมูลผู้ใช้งานระบบ</a></li>   
    <li class="uk-active"><span>เพิ่มข้อมูลผู้ใช้งาน</span></li>
</ul>
</h4>
	
{{ Form::open( array( 'url' => 'admin/users/create', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">เพิ่มข้อมูล</div>  
	{{ Form::token() }}		

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'username', 'ชื่อผู้ใช้', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'username', Input::old('username'), array( 'placeholder' => 'ชื่อผู้ใช้', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('username')) <p class="g-text-error uk-text-danger">{{ $errors->first('username') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'password', 'รหัสผ่าน', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">			
			{{ Form::input('password', 'password', '', array( 'placeholder' => 'รหัสผ่าน', 'class' => 'uk-width-1-1' ) ) }}	
			@if ($errors->has('password')) <p class="g-text-error uk-text-danger">{{ $errors->first('password') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'pname', 'คำนำหน้า', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">			
		    <select id="pname_user" name="pname" class="uk-width-1-3">
		  		@foreach($pname as $a)
		        	<option value="{{ $a->pname }}">{{ $a->pname }}</option>
		   		@endforeach
			</select>  			
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'fname', 'ชื่อ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'fname', Input::old('fname'), array( 'placeholder' => 'ชื่อ', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('fname')) <p class="g-text-error uk-text-danger">{{ $errors->first('fname') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'lname', 'นามสกุล', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'lname', Input::old('lname'), array( 'placeholder' => 'นามสกุล', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('lname')) <p class="g-text-error uk-text-danger">{{ $errors->first('lname') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'cid', 'รหัสบัตรประชาชน', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'cid', '', array( 'placeholder' => 'รหัสบัตรประชาชน', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('cid')) <p class="g-text-error uk-text-danger">{{ $errors->first('cid') }}</p> @endif
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'position', 'ตำแหน่ง', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <select id="position_user" name="position" class="uk-width-1-1">
		  		@foreach($position as $b)
		        	<option value="{{ $b->position_id }}">{{ $b->positionName }}</option>
		   		@endforeach
			</select>  
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'active', 'สถานะ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
		    <select id="active_user" name="active" class="uk-width-1-3">
		  		@foreach($active as $c)
		        	<option value="{{ $c->activeID }}">{{ $c->activeName }}</option>
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
