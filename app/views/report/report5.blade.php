@extends('layouts.sidebar')
@section('content')
	
<h4 class="tm-article-subtitle">รายงานใบสั่งซื้อ/ใบสั่งจ้าง ค่าน้ำมัน</h4>	

<center>
<div class="uk-panel uk-panel-box box-primary">
	{{ Form::open( array( 'url' => 'report5/export', 'enctype' => 'multipart/form-data', 'class' => 'uk-form' ) ) }}
		<fieldset data-uk-margin>   
			<label> เดือน: </label>
	        {{ Form::select('month', $month, null, ['class' => 'form-control', 'id' => '']) }}
	        <label> ปี: </label>
	        {{ Form::select('year', $year, null, ['class' => 'form-control', 'id' => '']) }}
	        <label> ประเภท: </label>
	        <select name="typecaroil" >
		   		<option value="งานยานพาหนะ">งานยานพาหนะ</option>
		   		<option value="งานซ่อมบำรุง">งานซ่อมบำรุง</option>
		   		<option value="งานกลุ่มเวชฯ">งานกลุ่มเวชฯ</option>
			</select> 
	    </fieldset>
	    <button class="uk-button">ตกลง</button>								
	 {{ Form::close() }}
</div>
</center>

@stop

