@extends('layouts.sidebar')
@section('content')
<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('reqcar') }}">ขออนุญาตใช้รถยนต์</a></li>   
    <li class="uk-active"><span>เพิ่มรายการขออนุญาตใช้รถยนต์</span></li>
</ul>
</h4>


{{ Form::open( array( 'url' => 'reqcar/create', 'id' => 'form-reqcar', 'enctype' => 'multipart/form-data', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<Input type="hidden" name="reserve_id" value="{{ $reserve_id }}" />
<fieldset>
<div class="g-header-from uk-text-danger">เพิ่มข้อมูล</div>  

	<div class="uk-text-center uk-text-large uk-text-bold">ใบขออนุญาตใช้รถยนต์โรงพยาบาลโนนไทย</div>

	<div class="uk-margin-top uk-float-right">	
		<span>วันที่(ว-ด-ป)</span>
		<span class="g-text">
			<Input type="text" style="color:#000;" readonly value="<?php echo date('d-m').'-'.(date('Y')+543); ?>"  id="req_date" name="req_date" class="uk-form-small uk-form-width-medium" />			
		</span>
		<span>เวลาเขียน</span>	
		<span class="g-text">
			<Input type="text" style="color:#000;" readonly value="<?php echo date('H:i'); ?>" id="writetime" name="writetime" class=" uk-form-small uk-form-width-medium" />
		</span>
		<span>น.</span>
	</div>
	<br /><br />
	<div class="uk-margin-top uk-text-bold">เรียน  ผู้อำนวยการโรงพยาบาลโนนไทย</div>

	<div class="uk-margin-top" style="margin-left:20px;">
		<span>ด้วยข้าพเจ้า</span>	
		<span class="g-text uk-width-1-3">		
			<Input type="text" style="color:#000;" name="req_name" readonly value="<?php echo Session::get('name'); ?>" class="uk-form-small uk-width-1-4" />					
		</span>	
		<span>ตำแหน่ง</span>
		<span class="g-text uk-width-1-3">
			<Input type="text" style="color:#000;" name="position" readonly value="<?php echo Session::get('positionName'); ?>" class="uk-form-small uk-width-1-3" />
		</span>
		<span>ฝ่าย</span>
		<span class="g-text uk-width-1-3">				
			<input class="uk-width-1-4" style="color:#000;" readonly value="<?php echo Session::get('departmentName'); ?>" name="department" type="text">		    					
		</span>
	</div>

	<div class="uk-margin-top">
		<span>ขออนุญาตใช้รถไป(ไปที่ไหน)</span>			
		<span class="g-text uk-width-8-10 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($location); ?> }'>
			<Input type="text" name="location" class="uk-form-small uk-width-1-1" />
		</span>	
		<span class="g-text-error uk-text-danger">*</span>			
	</div>
	<div class="uk-margin-top">
		<span>เพื่อ</span>			
		<span class="g-text uk-width-9-10 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($detail); ?> }'>
			<Input type="text" name="detail" class="uk-form-small uk-width-1-1" />
		</span>	
		<span class="g-text-error uk-text-danger">*</span>	
	</div>
	<div class="uk-margin-top">
		<span>มีคนนั่ง</span>	
		<span class="g-text"><Input type="text" name="qty" class="uk-form-small uk-width-1-5" /></span>
		<span class="g-text-error uk-text-danger">*</span>
		<span>คน</span>		
		<span> ในวันที่(ว-ด-ป)</span>	
		<span class="g-text">
			<Input type="text" placeholder="__-__-____" id="godate" name="godate" class="godate uk-form-small uk-width-1-5" />
		</span>	
		<span class="g-text-error uk-text-danger">*</span>
		<span> ถึงวันที่(ว-ด-ป)</span>	
		<span class="g-text">
			<Input type="text" placeholder="__-__-____" id="todate" name="todate" class="godate uk-form-small uk-width-1-5" />
		</span>	
		<span class="g-text-error uk-text-danger">*</span>
				
	</div>

	<div class="uk-margin-top">
		<span>เวลา</span>	
		<span class="g-text"><Input type="text" placeholder="__:__" id="gotime_start" name="gotime_start" class="gotime_start uk-form-small uk-width-1-5" /></span>
		<span class="g-text-error uk-text-danger">*</span>
		<span>น.</span>	
		<span>ถึงเวลา</span>	
		<span class="g-text"><Input type="text" placeholder="__:__" id="gotime_end" name="gotime_end" class="gotime_end uk-form-small uk-width-1-5" /></span>
		<span class="g-text-error uk-text-danger">*</span>
		<span>น.</span>		
		<span> โดยมี</span>	
		<span class="g-text uk-width-1-4">
			<Input type="text" name="responsible" value="<?php echo Session::get('name'); ?>" class="uk-form-small uk-width-1-4" />
		</span>	
		<span>ผู้รับผิดชอบ</span>	
					
	</div>

	<div class="uk-margin-top uk-text-bold">ระบุสถานที่ขึ้นรถ</div>

	<div class="uk-margin-top">
		<span>1.</span>	
		<span class="g-text"><Input type="text"  name="upcar1" class="uk-form-small uk-width-1-3" /></span>	
		<span class="g-text-error uk-text-danger">*</span>				
	</div>
	<div class="uk-margin-top">
		<span>2.</span>	
		<span class="g-text"><Input type="text"  name="upcar2" class="uk-form-small uk-width-1-3" /></span>					
	</div>
	<div class="uk-margin-top">
		<span>3.</span>	
		<span class="g-text"><Input type="text"  name="upcar3" class="uk-form-small uk-width-1-3" /></span>					
	</div>
	<br />
	<div class="uk-margin-top uk-text-center">    	
			<div class="uk-margin-top uk-text-center">
				<span>(ลงชื่อ)</span>	
				<span class="g-text uk-width-1-3">					
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
				<span class="g-text">(<Input type="text" style="color:#000;" readonly value="<?php echo Session::get('header_name'); ?>" class="uk-form-small uk-width-1-3" />)</span>					
			</div>
	</div>
	<br />
	<div class="uk-margin-top">
		<span>ความเห็นของผู้ควบคุมรถยนต์ เห็นควรอนุญาต โดยใช้รถยนต์หมายเลขทะเบียน</span>	
		<span class="g-text"><Input type="text" <?php echo (Session::get('level')==3)?'disabled':''; ?> name="car_number" class="uk-form-small uk-width-1-4" /></span>					
	</div>
	<div class="uk-margin-top">
		<span>และให้</span>	
		<span class="g-text uk-width-1-4 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataUser); ?> }'>
			<Input type="text" <?php echo (Session::get('level')==3)?'disabled':''; ?> name="driver" class="uk-form-small uk-width-1-1" />
		</span>	
		<span>เป็นพนักงานขับรถยนต์ ระยะทาง</span>	
		<span class="g-text"><Input type="text" <?php echo (Session::get('level')==3)?'disabled':''; ?> name="km_driver" class="uk-form-small uk-width-1-4" /></span>
		<span>กิโลเมตร</span>					
	</div>
	<br />
	<div class="uk-margin-top uk-text-center">    	
			<div class="uk-margin-top uk-text-center">
				<span>(ลงชื่อ)</span>	
				<span class="g-text uk-width-1-3 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataUser); ?> }'>
					<Input type="text" <?php echo (Session::get('level')==3)?'disabled':''; ?> name="driver_control" class="uk-form-small uk-width-1-1" />
				</span>	
				<span>ผู้ควบคุม</span>			
			</div>
			<div class="uk-margin-top uk-text-center">			
				(<span class="g-text uk-width-1-3 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataUser); ?> }'>
					<Input type="text" <?php echo (Session::get('level')==3)?'disabled':''; ?> class="uk-form-small uk-width-1-1" />
				</span>)					
			</div>
	</div>
	<br />
	<div class="uk-margin-top">
		<span>ความเห็นของผู้มีอำนาจสั่งใช้รถยนต์</span>	
		<span class="g-text"><Input type="text" <?php echo (Session::get('level')==3)?'disabled':''; ?> name="comment" class="uk-form-small uk-width-7-10" /></span>					
	</div>

	<?php if( Session::get('c1') == 1 ){ ?>
	<br />
	<div class="uk-margin-top uk-text-center">		
		<span class="g-text">
			<input id="k1" name="k1" value="1" type="checkbox"><label for="k1"> อนุมัติให้ใช้รถยนต์</label>	
		</span>
		:	
		<span class="g-text">
			<input id="k2" name="k2" value="3" type="checkbox"><label for="k2"> ไม่ อนุมัติให้ใช้รถยนต์</label>	
		</span>	
	</div>
	<?php } ?>

	<div class="uk-margin-large-top uk-text-center">
		<span>(ลงชื่อ)</span>	
		<span class="g-text"><Input type="text" <?php echo (Session::get('level')==3)?'disabled':''; ?> class="uk-form-small uk-width-1-3" /></span>	
		<span>ผู้อนุมัติ</span>			
	</div>
	<div class="uk-margin-top uk-text-center">			
		<span>(นายสมเกียรติ สอดโคกสูง)</span>						
	</div>
	<div class="uk-margin-top uk-text-center">					
		<span>ผู้อำนวยการโรงพยาบาลโนนไทย</span>						
	</div>

	
	
	<hr />
	<div class="uk-form-row uk-text-center">
		<!--{{ Form::button( 'บันทึก', array( 'class'=>'uk-button uk-button-primary', 'id'=>'save_reqcar' ) ) }}-->
		{{ Form::button( 'บันทึกและพิมพ์', array( 'class'=>'uk-button uk-button-primary', 'id'=>'save_reqcar_print' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('reqcar') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}





@stop