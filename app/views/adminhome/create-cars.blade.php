@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('cars') }}">ข้อมูลรถยนต์</a></li>   
    <li class="uk-active"><span>เพิ่มข้อมูลรถยนต์</span></li>
</ul>
</h4>
	
{{ Form::open( array( 'url' => 'cars/create', 'enctype' => 'multipart/form-data', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">เพิ่มข้อมูล</div>  

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_number', 'ทะเบียนรถยนต์', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'car_number', Input::old('car_number'), array( 'placeholder' => 'ทะเบียนรถยนต์', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('car_number')) <p class="g-text-error uk-text-danger">{{ $errors->first('car_number') }}</p> @endif
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'brand', 'ยี่ห้อ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'brand', Input::old('brand'), array( 'placeholder' => 'ยี่ห้อ', 'class' => 'uk-width-1-1' ) ) }}			
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'model', 'รุ่น', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'model', Input::old('model'), array( 'placeholder' => 'รุ่น', 'class' => 'uk-width-1-1' ) ) }}
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_detail', 'รายละเอียดรถยนต์', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'car_detail', Input::old('car_detail'), array( 'placeholder' => 'รายละเอียดรถยนต์', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('car_detail')) <p class="g-text-error uk-text-danger">{{ $errors->first('car_detail') }}</p> @endif
		</div>
	</div>

	<div class="uk-form-row uk-width-1-2">
		{{ Form::label( 'carin', 'วันรับเข้า', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">		
			{{ Form::text( 'carin', '', array( 'data-uk-datepicker' => "{format:'YYYY-MM-DD'}", 'placeholder' => 'วันรับเข้า', 'class' => 'uk-width-1-1' ) ) }}			
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_img', 'รูปถ่าย1', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">						
			{{ Form::file('car_img',  array(  'placeholder' => 'รูปถ่าย1', 'class' => 'uk-width-1-1' ) ) }}							
		</div>
	</div>
	
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_img2', 'รูปถ่าย2', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">						
			{{ Form::file('car_img2',  array(  'placeholder' => 'รูปถ่าย2', 'class' => 'uk-width-1-1' ) ) }}							
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_img3', 'รูปถ่าย3', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">						
			{{ Form::file('car_img3',  array(  'placeholder' => 'รูปถ่าย3', 'class' => 'uk-width-1-1' ) ) }}							
		</div>
	</div>
	
	<hr />
	<div class="uk-form-row uk-text-center">
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('cars') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}



<?php
	//print_r($datageneral);
?>
	
@stop
