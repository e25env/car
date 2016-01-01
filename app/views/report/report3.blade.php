@extends('layouts.sidebar')
@section('content')
	
<h4 class="tm-article-subtitle">รายงานสรุปบิลค่าน้ำมัน</h4>	

<center>
<div class="uk-panel uk-panel-box box-primary">
	{{ Form::open( array( 'url' => 'report3/export', 'enctype' => 'multipart/form-data', 'class' => 'uk-form' ) ) }}
		<fieldset data-uk-margin>   
	        <label> วันที่(ว-ด-ป) </label>
	        <input type="text" placeholder="__-__-____" id="datestart1" name="datestart1" class="datestart1">
	        <label> ถึงวันที่(ว-ด-ป) </label>
	        <input type="text" placeholder="__-__-____" id="dateend1" name="dateend1" class="dateend1">
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

