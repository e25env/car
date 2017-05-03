@extends('layouts.sidebar')
@section('content')
<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('reqcar') }}">ขออนุญาตใช้รถยนต์</a></li>   
    <li class="uk-active"><span>แก้ไขรายการขออนุญาตใช้รถยนต์</span></li>
</ul>
</h4>

{{ Form::open( array( 'url' => 'reqcar/resend', 'id' => 'form-resend', 'enctype' => 'multipart/form-data', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<Input type="hidden" name="reserve_id" id="reserve_id" value="{{ $reserve_id }}" />
<fieldset>
<div class="g-header-from uk-text-danger">เแก้ไขข้อมูล</div>  
<div class="uk-text-center uk-text-large uk-text-bold">ใบขออนุญาตใช้รถยนต์โรงพยาบาลโนนไทย</div>

<div class="uk-margin-top uk-float-right">	
	<span>วันที่(ว-ด-ป)</span>
	<span class="g-text">
		<Input type="text" style="color:#000;" readonly value="<?php echo date('d-m').'-'.(date('Y')+543); ?>" id="req_date" name="req_date" class="req_date uk-form-small uk-form-width-medium" />		
	</span>
	<span>เวลาเขียน</span>	
		<span class="g-text"><Input type="text" style="color:#000;" readonly  value="<?php echo date('H:i'); ?>"  id="writetime" name="writetime" class=" writetime uk-form-small uk-form-width-medium" />
	</span>
	<span>น.</span>
</div>


<br /><br />
<div class="uk-margin-top uk-text-bold">เรียน  ผู้อำนวยการโรงพยาบาลโนนไทย</div>

<div class="uk-margin-top" style="margin-left:20px;">
	<span>ด้วยข้าพเจ้า</span>	
	<span class="g-text uk-width-1-3">
		<Input type="text" style="color:#000;" readonly value="{{ $data->req_name }}" name="req_name" class="uk-form-small uk-width-1-4" />					
	</span>			
	<span>ตำแหน่ง</span>
	<span class="g-text uk-width-1-3">
		<Input type="text" style="color:#000;" readonly value="{{ $data->position }}" name="position" class="uk-form-small uk-width-1-3" />
	</span>
	<span>ฝ่าย</span>
	<span class="g-text">	
		<span  class="uk-width-1-3">
		    <input readonly style="color:#000;" class="uk-width-1-4" value="{{ $data->department }}" name="department" type="text">		    
		</span>				
	</span>
</div>

<div class="uk-margin-top">
	<span>ขออนุญาตใช้รถไป(ไปที่ไหน)</span>	
	<span class="g-text uk-width-8-10 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($location); ?> }'>
		<Input type="text" value="{{ $data->location }}" name="location" class="uk-form-small uk-width-1-1" />
	</span>
	<span class="g-text-error uk-text-danger">*</span>			
</div>
<div class="uk-margin-top">
	<span>เพื่อ</span>	
	<span class="g-text uk-width-9-10 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($detail); ?> }'>
		<Input type="text" value="{{ $data->detail }}" name="detail" class="uk-form-small uk-width-1-1" />
	</span>	
	<span class="g-text-error uk-text-danger">*</span>
</div>
<div class="uk-margin-top">
	<span>มีคนนั่ง</span>	
	<span class="g-text"><Input type="text" value="{{ $data->qty }}" name="qty" class="uk-form-small uk-width-1-5" />
	</span>
	<span class="g-text-error uk-text-danger">*</span>
	<span>คน</span>	

	<span> ในวันที่(ว-ด-ป)</span>	
	<span class="g-text">
		<Input type="text"  value="" placeholder="__-__-____" id="godate" name="godate" class="godate uk-form-small uk-width-1-5" />
	</span>
	<span class="g-text-error uk-text-danger">*</span>

	<span> ถึงวันที่(ว-ด-ป)</span>	
	<span class="g-text">
		<Input type="text"  value="" placeholder="__-__-____" id="todate" name="todate" class="godate uk-form-small uk-width-1-5" />
	</span>
	<span class="g-text-error uk-text-danger">*</span>	
	
			
</div>

<div class="uk-margin-top">
	<span>เวลา</span>	
	<span class="g-text"><Input type="text"  value="{{ $data->gotime_start }}" placeholder="__:__" id="gotime_start" name="gotime_start" class="gotime_start uk-form-small uk-width-1-5" /></span>
	<span class="g-text-error uk-text-danger">*</span>
	<span>น.</span>	
	<span>ถึงเวลา</span>	
	<span class="g-text"><Input type="text"  value="{{ $data->gotime_end }}" placeholder="__:__" id="gotime_end" name="gotime_end" class="gotime_end uk-form-small uk-width-1-5" /></span>
	<span class="g-text-error uk-text-danger">*</span>
	<span>น.</span>	

	<span> โดยมี</span>	
	<span class="g-text uk-width-1-4">
		<Input type="text" value="{{ $data->responsible }}" name="responsible" class="uk-form-small uk-width-1-4" />
	</span>
	
	<span>ผู้รับผิดชอบ</span>	
				
</div>

<div class="uk-margin-top uk-text-bold">ระบุสถานที่ขึ้นรถ</div>

<div class="uk-margin-top">
	<span>1.</span>	
	<span class="g-text"><Input type="text"  value="{{ $data->upcar1 }}"  name="upcar1" class="uk-form-small uk-width-1-3" />
	</span>	
	<span class="g-text-error uk-text-danger">*</span>				
</div>
<div class="uk-margin-top">
	<span>2.</span>	
	<span class="g-text"><Input type="text"  value="{{ $data->upcar2 }}"  name="upcar2" class="uk-form-small uk-width-1-3" /></span>					
</div>
<div class="uk-margin-top">
	<span>3.</span>	
	<span class="g-text"><Input type="text"  value="{{ $data->upcar3 }}"  name="upcar3" class="uk-form-small uk-width-1-3" /></span>					
</div>
<br />
<div class="uk-margin-top uk-text-center">    	
	<div class="uk-margin-top uk-text-center">
		<span>(ลงชื่อ)</span>	
		<span class="g-text">					
			<Input type="text" readonly class="uk-form-small uk-width-1-3" />
		</span>			
		<span>ผู้ขออนุญาต</span>			
	</div>
	<div class="uk-margin-top uk-text-center">			
		(<span class="g-text uk-width-1-3" >					
			<Input type="text" style="color:#000;" name="user_req" readonly value="<?php echo Session::get('name'); ?>" class="uk-form-small uk-width-1-3" />
		</span>)				
	</div>
</div>

<div class="uk-margin-top uk-text-center">    	
	<div class="uk-margin-top uk-text-center">
		<span>(ลงชื่อ)</span>	
		<span class="g-text"><Input type="text" readonly class="uk-form-small uk-width-1-3" /></span>	
		<span>หัวหน้าฝ่าย</span>			
	</div>
	<div class="uk-margin-top uk-text-center">			
		<span class="g-text">(<?php echo Session::get('header_name'); ?>)</span>					
	</div>
</div>
<br />
<div class="uk-margin-top">
	<span>ความเห็นของผู้ควบคุมรถยนต์ เห็นควรอนุญาต โดยใช้รถยนต์หมายเลขทะเบียน</span>		
	<span class="g-text uk-width-1-3 uk-autocomplete uk-form">
		<Input type="text" <?php echo (Session::get('c2')!=1)?'readonly style="color:#000;"':''; ?> value="" name="car_number" class="uk-form-small uk-width-1-1" />
	</span>
	@if ($errors->has('car_number')) <span class="g-text-error uk-text-danger">{{ $errors->first('car_number') }}</span> @endif					
</div>
<div class="uk-margin-top">
	<span>และให้</span>	
	<span class="g-text uk-width-1-4 uk-autocomplete uk-form" >
		<Input type="text" <?php echo (Session::get('c2')!=1)?'readonly style="color:#000;"':''; ?> value="" name="driver" class="uk-form-small uk-width-1-1" />
	</span>	
	@if ($errors->has('driver')) <span class="g-text-error uk-text-danger">{{ $errors->first('driver') }}</span> @endif	
	<span>เป็นพนักงานขับรถยนต์ ระยะทาง</span>	
	<span class="g-text"><Input type="text" <?php echo (Session::get('c2')!=1)?'readonly style="color:#000;"':''; ?> value="" name="km_driver" class="uk-form-small uk-width-1-4" /></span>
	<span>กิโลเมตร</span>					
</div>
<br />
<div class="uk-margin-top uk-text-center">    	
	<div class="uk-margin-top uk-text-center">
		<span>(ลงชื่อ)</span>	
		<span class="g-text uk-width-1-3 uk-autocomplete uk-form" >
			<Input type="text" <?php echo (Session::get('c2')!=1)?'readonly style="color:#000;"':''; ?> value="" name="driver_control" class="uk-form-small uk-width-1-1" />
		</span>
		@if ($errors->has('driver_control')) <span class="g-text-error uk-text-danger">{{ $errors->first('driver_control') }}</span> @endif	
		<span>ผู้ควบคุม</span>			
	</div>
	<div class="uk-margin-top uk-text-center">			
		(<span class="g-text uk-width-1-3 uk-autocomplete uk-form">
			<Input type="text" <?php echo (Session::get('c2')!=1)?'readonly style="color:#000;"':''; ?> value="" class="uk-form-small uk-width-1-1" />
		</span>)					
	</div>
</div>
<br />


<div class="uk-margin-top">
	<span>ความเห็นของผู้มีอำนาจสั่งใช้รถยนต์</span>	
	<span class="g-text"><Input type="text" <?php echo (Session::get('level')==3)?'readonly':''; ?> <?php echo (Session::get('level')==2)?'readonly':''; ?> value="{{ $data->comment }}" name="comment" class="uk-form-small uk-width-7-10" /></span>					
</div>

<?php if( Session::get('c1') == 1 ){ ?>
<br />
<div class="uk-margin-top uk-text-center">		
	<span class="g-text">
		<input <?php  echo (($data->req_status == 1) ? 'checked="checked"':''); ?> id="k1" name="k1" value="1" type="checkbox"><label for="k1"> อนุมัติให้ใช้รถยนต์</label>	
	</span>	
	:
	<span class="g-text">
		<input <?php  echo (($data->req_status == 3) ? 'checked="checked"':''); ?> id="k2" name="k2" value="3" type="checkbox"><label for="k2"> ไม่ อนุมัติให้ใช้รถยนต์</label>	
	</span>	
</div>
<?php } ?>

<div class="uk-margin-large-top uk-text-center">
	<span>(ลงชื่อ)</span>	
	<span class="g-text"><Input type="text" <?php echo (Session::get('level')==3)?'readonly':''; ?> <?php echo (Session::get('level')==2)?'readonly':''; ?> class="uk-form-small uk-width-1-3" /></span>	
	<span>ผู้อนุมัติ</span>			
</div>
<div class="uk-margin-top uk-text-center">			
	<span>(นายบุญชัย ธนบัตรชัย)</span>						
</div>
<div class="uk-margin-top uk-text-center">					
	<span>ผู้อำนวยการโรงพยาบาลโนนไทย</span>						
</div>	
	
	
<hr />
<div class="uk-form-row uk-text-center">	
	{{ Form::button( 'บันทึก', array( 'class'=>'uk-button uk-button-primary', 'id'=>'save_resend' ) ) }}	
	<a class="uk-button uk-button-success" href="{{ URL::to('reqcar') }}">กลับหน้าหลัก</a>
</div>

<hr />	 
</fieldset>
{{ Form::close() }}





@stop