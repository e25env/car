@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('cars') }}">ข้อมูลรถยนต์</a></li>   
    <li><span>รายละเอียด</span></li> 
    <li class="uk-active"><span>{{ $car->car_number }}</span></li>
</ul>
</h4>

<div class="uk-panel uk-panel-box uk-panel-box-primary">
	<span class="uk-float-right">
		<a data-uk-tooltip title="แก้ไขข้อมูล" class="uk-button uk-button-primary" href="{{ URL::to('cars/edit') }}/{{ $car->car_id }}"><i class="uk-icon-edit"></i></a>
		<a data-uk-tooltip title="กลับ" class="uk-button uk-button-success" href="{{ URL::to('cars') }}"><i class="uk-icon-arrow-circle-left"></i></a>
	</span>
	<br /><br />
	<div class="uk-grid uk-grid-divider">
		<div class="uk-width-medium-1-3">
			<div class="uk-text-center">
				<?php if( $car->car_img != '' ){ ?>
				<?php $urlimg = 'uploads/'.$car->car_number.'/'.$car->car_img; ?>
				{{ HTML::image($urlimg, '', array('class' => 'uk-border-rounded', 'height' => '250', 'width' => '250' ) ); }}
				<?php } ?>
			</div>
		</div>
		<div class="uk-width-medium-1-3">
			<div class="uk-text-center">
				<?php if( $car->car_img2 != '' ){ ?>
				<?php $urlimg2 = 'uploads/'.$car->car_number.'/'.$car->car_img2; ?>
				{{ HTML::image($urlimg2, '', array('class' => 'uk-border-rounded', 'height' => '250', 'width' => '250' ) ); }}
				<?php } ?>
			</div>
		</div>
		<div class="uk-width-medium-1-3">
			<div class="uk-text-center">
				<?php if( $car->car_img3 != '' ){ ?>
				<?php $urlimg3 = 'uploads/'.$car->car_number.'/'.$car->car_img3; ?>
				{{ HTML::image($urlimg3, '', array('class' => 'uk-border-rounded', 'height' => '250', 'width' => '250' ) ); }}
				<?php } ?>
			</div>
		</div>
	</div>	
	<ul class="uk-list uk-list-line">
		<li>เลขทะเบียนรถยนต์ : {{ $car->car_number }}</li>
		<li>ยี่ห้อรถยนต์ : {{ $car->brand }}</li>
		<li>รุ่นรถยนต์ : {{ $car->model }}</li>
		<li>รายละเอียดรถยนต์ : {{ $car->car_detail }}</li>
		<li>สถานะรถยนต์ : <?php  echo ($car->car_status == '1')?'<span class="uk-text-danger">ไม่ว่าง</span>':'<span class="uk-text-success">ว่าง</span>'; ?></li>
		<li>วันที่รับเข้า (ว-ด-ป) :  <?php echo date("d-m", strtotime($car->carin)).'-'.(date("Y", strtotime($car->carin))+543); ?></li>
	</ul>
</div>


@stop