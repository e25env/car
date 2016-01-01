@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('cars') }}">ข้อมูลรถยนต์</a></li>   
    <li class="uk-active"><span>แก้ไขข้อมูลรถยนต์</span></li>
</ul>
</h4>
<?php   $url = 'cars/edit/'.$car->car_id; ?>
{{ Form::open( array( 'url' => $url, 'enctype' => 'multipart/form-data', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">แก้ไขข้อมูล</div>  

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_number', 'ทะเบียนรถยนต์', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'car_number', $car->car_number, array( 'placeholder' => 'ทะเบียนรถยนต์', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('car_number')) <p class="g-text-error uk-text-danger">{{ $errors->first('car_number') }}</p> @endif
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'brand', 'ยี่ห้อ', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'brand', $car->brand, array( 'placeholder' => 'ยี่ห้อ', 'class' => 'uk-width-1-1' ) ) }}			
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'model', 'รุ่น', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'model', $car->model, array( 'placeholder' => 'รุ่น', 'class' => 'uk-width-1-1' ) ) }}
		</div>
	</div>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_detail', 'รายละเอียดรถยนต์', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'car_detail', $car->car_detail, array( 'placeholder' => 'รายละเอียดรถยนต์', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('car_detail')) <p class="g-text-error uk-text-danger">{{ $errors->first('car_detail') }}</p> @endif
		</div>
	</div>

	<div class="uk-form-row uk-width-1-2">
		{{ Form::label( 'carin', 'วันรับเข้า', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">		
			{{ Form::text( 'carin', $car->carin, array( 'data-uk-datepicker' => "{format:'YYYY-MM-DD'}", 'placeholder' => 'วันรับเข้า', 'class' => 'uk-width-1-1' ) ) }}			
		</div>
	</div>


	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_img', 'รูปถ่าย1', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">						
			{{ Form::file('car_img',  array(  'placeholder' => 'รูปถ่าย1', 'class' => 'uk-width-1-1' ) ) }}							
		</div>
	</div>
	<?php
		if( isset($car) ){
			if( $car->car_img != '' ){
				$urlimg = 'uploads/'.$car->car_number .'/'.$car->car_img ;
	?>
			<div class="uk-form-row uk-width-1-1">
				<div class="uk-form-controls">	
				    <input type="hidden" name="nameimghid" id="nameimghid" value="<?php echo $car->car_img; ?>" />
					{{ HTML::image($urlimg, '', array('class' => 'uk-border-rounded', 'height' => '250', 'width' => '250' ) ); }}
				</div>
			</div>
	<?php }} ?>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_img2', 'รูปถ่าย2', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">						
			{{ Form::file('car_img2',  array(  'placeholder' => 'รูปถ่าย2', 'class' => 'uk-width-1-1' ) ) }}							
		</div>
	</div>
	<?php
		if( isset($car) ){
			if( $car->car_img2 != '' ){
				$urlimg2 = 'uploads/'.$car->car_number .'/'.$car->car_img2 ;
	?>
			<div class="uk-form-row uk-width-1-1">
				<div class="uk-form-controls">	
				    <input type="hidden" name="nameimghid2" id="nameimghid2" value="<?php echo $car->car_img2; ?>" />
					{{ HTML::image($urlimg2, '', array('class' => 'uk-border-rounded', 'height' => '250', 'width' => '250' ) ); }}
				</div>
			</div>
	<?php }} ?>

	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'car_img3', 'รูปถ่าย3', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">						
			{{ Form::file('car_img3',  array(  'placeholder' => 'รูปถ่าย3', 'class' => 'uk-width-1-1' ) ) }}							
		</div>
	</div>
	<?php
		if( isset($car) ){
			if( $car->car_img3 != '' ){
				$urlimg3 = 'uploads/'.$car->car_number .'/'.$car->car_img3 ;
	?>
			<div class="uk-form-row uk-width-1-1">
				<div class="uk-form-controls">	
				    <input type="hidden" name="nameimghid3" id="nameimghid3" value="<?php echo $car->car_img3; ?>" />
					{{ HTML::image($urlimg3, '', array('class' => 'uk-border-rounded', 'height' => '250', 'width' => '250' ) ); }}
				</div>
			</div>
	<?php }} ?>
	
	
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
