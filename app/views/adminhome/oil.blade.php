@extends('layouts.sidebar')
@section('content')
	
<div class="uk-margin-top uk-margin-bottom">
	<h4 class="tm-article-subtitle">วัสดุเชื้อเพลิง</h4>
	
	<div class="uk-panel uk-panel-box uk-panel-box-primary uk-width-1-4 uk-container-center">
		<form class="uk-form">
			<div class="uk-form-row">
				<select id="caroil" name="caroil" class="uk-width-1-1" >
					<option value="0">--กรุณาเลือก รถยนต์ เพื่อลงข้อมูล--</option>
			  		@foreach($car as $a)
			        	<option value="{{ $a->car_number }}">{{ $a->car_number }}</option>
			   		@endforeach
			   		<option value="งานปรับภูมิทัศน์">งานปรับภูมิทัศน์</option>
			   		<option value="งานพ่นหมอกควัน">งานพ่นหมอกควัน</option>
			   		<option value="เครื่องกำเนิดไฟฟ้า">เครื่องกำเนิดไฟฟ้า</option>
			   		<option value="อื่นๆ">อื่นๆ</option>
				</select>  	
			</div>
		</form>
	</div>
	<br/>
	<div id="formoil" class="uk-panel uk-panel-box uk-panel-box-primary uk-width-1-1 uk-container-center">
		<form class="uk-form ">
			<input type="hidden" id="oilnumber" name="oilnumber">
			<label class="uk-form-label" for="bookoil">เล่มที่</label>
			<input name="bookoil" id="bookoil" type="text" placeholder="" class="uk-form-width-mini">
			<label class="uk-form-label" for="numberoil">เลขที่</label>
			<input name="numberoil" id="numberoil" type="text" placeholder="" class="uk-form-width-mini">
			<label class="uk-form-label" for="dateoil">วันที่</label>
			<input name="dateoil" id="dateoil" type="text" placeholder="วันที่" class="uk-form-width-small">
			<select name="listoil" id="listoil" >
		        <option value="ดีเซล">ดีเซล</option>
		   		<option value="แก๊สโซฮอล95">แก๊สโซฮอล95</option>
		   		<option value="แก๊สโซฮอล91">แก๊สโซฮอล91</option>
		   		<option value="เบนซิน">เบนซิน</option>
		   		<option value="ก๊าซ">ก๊าซ</option>
		   		<option value="น้ำมันเครื่อง">น้ำมันเครื่อง</option>
		   		<option value="น้ำมันเบรค">น้ำมันเบรค</option>
			</select>  
			<input name="mioil" id="mioil" type="text" placeholder="เลขไมค์" class="uk-form-width-small">
			<input name="kmoil" id="kmoil" type="text" placeholder="กิโลเมตร" class="uk-form-width-small">
			<input name="pwoil" id="pwoil" type="text" placeholder="ราคา/ลิตร" class="uk-form-width-small">
			<input name="woil" id="woil" type="text" placeholder="ลิตร" class="uk-form-width-small">
			<input name="moneyoil" id="moneyoil" type="text" placeholder="ยอดเงิน" class="uk-form-width-small">
			<a class="uk-button" id="addoil">บันทึก</a>
		</form>
	</div>

	<div id="viewoil" class="uk-overflow-container">
		
	</div>

</div>	

@stop