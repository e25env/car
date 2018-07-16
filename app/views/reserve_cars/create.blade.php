@extends('layouts.sidebar')
@section('content')
<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('reserve') }}">ขอไปราชการ</a></li>   
    <li class="uk-active"><span>เพิ่มรายการขอไปราชการ</span></li>
</ul>
</h4>


{{ Form::open( array( 'url' => 'reserve/create', 'id'=>'form-reserve', 'enctype' => 'multipart/form-data', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">เพิ่มข้อมูล</div>  

	<div class="uk-text-center uk-text-large uk-text-bold">บันทึกข้อความ</div>
	<div class="uk-margin-top">
		<span class="uk-text-bold">ส่วนราชการ</span>
		<span>ฝ่าย</span>
		<span class="g-text">	
			<span  class="uk-width-1-3">
			    <input class="uk-width-1-3" style="color:#000;" readonly value="<?php echo Session::get('departmentName'); ?>" name="fb1" type="text">		    
			</span>			
		</span>
		<span>โรงพยาบาลโนนไทย อำเภอโนนไทย จังหวัดนครราชสีมา</span>
	</div>
	<div class="uk-margin-top">
		<span class="uk-text-bold">ที่</span>
		<span>นม 0032.301/</span>
		<span class="g-text"><Input type="text" id="fb2" name="fb2" class="uk-form-small uk-form-width-medium" /></span>
		<span>วันที่(ว-ด-ป)</span>
		<span class="g-text"><Input type="text" placeholder="__-__-____" id="fb3" name="fb3" class="fb3 uk-form-small uk-form-width-medium" /></span>
	</div>
	<div class="uk-margin-top">
		<span class="uk-text-bold">เรื่อง</span>	
		<span>ขออนุมัติไปราชการ</span>
	</div>
	<hr />
	<div class="uk-margin-top">
		<span class="uk-text-bold">เรียน</span>	
		<span>ผู้อำนวยการโรงพยาบาลโนนไทย</span>
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span>ด้วยข้าพเจ้า</span>	
		<span class="g-text uk-width-1-3">
			<Input type="text" id="fb4" name="fb4" style="color:#000;" readonly value="<?php echo Session::get('name'); ?>" class="uk-form-small uk-width-1-3" />			
		</span>		
		<span>ตำแหน่ง</span>
		<span class="g-text uk-width-1-3"><Input type="text" id="fb5" name="fb5" style="color:#000;" readonly value="<?php echo Session::get('positionName'); ?>" class="uk-form-small uk-width-1-3" /></span>
	</div>
	<div class="uk-margin-top">		
		<span>พร้อมด้วย</span>
	</div>

	<input type="button" onclick="addElement()" value="เพิ่ม จำนวนคน">
	<input type="button" onclick="removeElement()" value="ลบ จำนวนคน">

	<div class="uk-margin-top" style="margin-left:20px;">
		<span>1.</span>	
		<span class="g-text uk-width-1-3 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataUser); ?> }'>
			<Input type="text" name="fb6[]" class="uk-form-small uk-width-1-1" />
		</span>
		<span>ตำแหน่ง</span>
		<span class="g-text"><Input type="text" name="fb7[]" class="uk-form-small uk-width-1-3" /></span>
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span>2.</span>	
		<span class="g-text uk-width-1-3 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataUser); ?> }'>
			<Input type="text"  name="fb6[]" class="uk-form-small uk-width-1-1" />
		</span>
		<span>ตำแหน่ง</span>
		<span class="g-text"><Input type="text" name="fb7[]" class="uk-form-small uk-width-1-3" /></span>
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span>3.</span>	
		<span class="g-text uk-width-1-3 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataUser); ?> }'>
			<Input type="text" name="fb6[]" class="uk-form-small uk-width-1-1" />
		</span>
		<span>ตำแหน่ง</span>
		<span class="g-text"><Input type="text" name="fb7[]" class="uk-form-small uk-width-1-3" /></span>
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span>4.</span>	
		<span class="g-text uk-width-1-3 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataUser); ?> }'>
			<Input type="text" name="fb6[]" class="uk-form-small uk-width-1-1" />
		</span>
		<span>ตำแหน่ง</span>
		<span class="g-text"><Input type="text" name="fb7[]" class="uk-form-small uk-width-1-3" /></span>
	</div>	
	<div id="content-box" ></div>
	
	<div class="uk-margin-top">
		<span>ขออนุมัติเดินทางไปราชการที่</span>	
		<span class="g-text uk-width-1-3 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataLocation); ?> }'>
			<Input type="text" id="fb8" name="fb8" class="uk-form-small uk-width-3-3" />						
		</span>	
		<span class="g-text-error uk-text-danger">*</span>
		<span>หน่วยงานผู้จัด</span>
		<span class="g-text uk-width-1-3 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($datainstitution); ?> }'>
			<Input type="text" id="fb9" name="fb9" class="uk-form-small uk-width-3-3" />			
		</span>
		<span class="g-text-error uk-text-danger">*</span>
	</div>
	<div class="uk-margin-top">
		<span>เรื่อง</span>	
		<span class="g-text uk-width-9-10 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($datatitle); ?> }'>
			<Input type="text" id="fb10" name="fb10" class="uk-form-small uk-width-1-1" />		
		</span>	
		<span class="g-text-error uk-width-1-3 uk-text-danger">*</span>	
	</div>
	<div class="uk-margin-top">
		<span>ตามหนังสือที่</span>	
		<span class="g-text"><Input type="text" id="fb11" name="fb11" class="uk-form-small uk-width-1-3" /></span>
		<span>ลงวันที่(ว-ด-ป)</span>
		<span class="g-text"><Input type="text" placeholder="__-__-____" id="fb12" name="fb12" class="fb12 uk-form-small uk-width-1-3" /></span>
	</div>
	<div class="uk-margin-top">
		<span>ทั้งนี้ตั้งแต่วันที่(ว-ด-ป)</span>	
		<span class="g-text">
			<Input type="text" placeholder="__-__-____" id="fb13" name="fb13" class="fb13 uk-form-small uk-width-1-5" />
			<span class="g-text-error uk-width-1-3 uk-text-danger">*</span>
		</span>
		<span>ถึงวันที่(ว-ด-ป)</span>
		<span class="g-text">
			<Input type="text" placeholder="__-__-____" id="fb14" name="fb14" class="fb14 uk-form-small uk-width-1-5" />
			<span class="g-text-error uk-width-1-3 uk-text-danger">*</span>
		</span>
		<span>รวม</span>
		<span class="g-text"><Input type="text" id="fb15" name="fb15" class="uk-form-small uk-width-1-5" /></span>
		<span>วัน</span>
	</div>
	<div class="uk-margin-top">
		<span>สำหรับค่าใช้จ่ายในการเดินทางไปราชการขอเบิกจ่ายเงินบำรุงของโรงพยาบาล และขอใช้รถยนต์เดินทางไปราชการครั้งนี้</span>				
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span> <input id="c1" name="c1" value="1" type="checkbox"><label for="c1"> ใช้รถยนต์ของทางโรงพยาบาลโนนไทย</label></span>					
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span> <input id="c2" name="c2" value="1" type="checkbox"><label for="c2"> ใช้รถยนต์ส่วนตัว</label></span>	
		<span>หมายเลขทะเบียน</span>
		<span class="g-text"><Input type="text" id="fb16" name="fb16" class="uk-form-small uk-width-1-4" /></span>	
		<span>ตามหลักเกณฑ์การเบิกค่ายานพาหนะส่วนตัวในการเดินทางไปราชการ กิโลเมตรละ 4 บาท เป็นเงิน</span>	
		<span class="g-text"><Input type="text" id="fb17" name="fb17" class="uk-form-small uk-width-1-6" /></span>
		<span>บาท</span>		
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span> <input id="c3" name="c3" value="1" type="checkbox"><label for="c3"> อื่น ๆ (ระบุ)</label></span>	
		<span class="g-text"><Input type="text" id="fb18" name="fb18" class="uk-form-small uk-width-1-2" /></span>				
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span>จึงเรียนมาเพื่อทราบ และโปรดพิจารณาอนุมัติด้วย จะเป็นพระคุณ</span>				
	</div>

	<div class="uk-margin-top uk-text-center">
		<span>(ลงชื่อ)</span>	
		<span class="g-text uk-width-1-3">
			<Input type="text" readonly  class="uk-form-small uk-width-1-3" />			
		</span>			
		<span>ผู้ขอ</span>			
	</div>
	<div class="uk-margin-top uk-text-center">			
		(<span class="g-text uk-width-1-3" >
			<Input type="text" id="fb19" name="fb19" style="color:#000;" readonly value="<?php echo Session::get('name'); ?>" class="uk-form-small uk-width-1-3" />		
		</span>)					
	</div>

	<div class="uk-margin-top" style="margin-left:20px;">
		<span>เสนอ ผู้อำนวยการโรงพยาบาลโนนไทย</span>				
	</div>

	<div class="uk-grid">
	    <div class="uk-width-medium-1-2">
	    	<div class="uk-margin-top uk-text-center">			
				<span class="g-text"><Input <?php echo (Session::get('level')==3)?'readonly':''; ?> type="text" class="uk-form-small uk-width-1-2" /></span>					
			</div>
			<div class="uk-margin-top uk-text-center">
				<span>(ลงชื่อ)</span>	
				<span class="g-text"><Input <?php echo (Session::get('level')==3)?'readonly':''; ?> type="text" class="uk-form-small uk-width-1-2" /></span>	
				<span>หัวหน้าฝ่าย</span>			
			</div>
			<div class="uk-margin-top uk-text-center">			
				<span class="g-text">(<Input <?php echo (Session::get('level')==3)?'readonly':''; ?> style="color:#000;"  value="<?php echo Session::get('header_name'); ?>" type="text" class="uk-form-small uk-width-1-2" />)</span>					
			</div>
	    </div>
	    <div class="uk-width-medium-1-2">
	        <div class="uk-margin-top" style="margin-left:20px;">
				<span> <input <?php echo (Session::get('level')==3)?'disabled':''; ?> id="c4" name="c4" value="1" type="checkbox"><label for="c4"> ไม่เป็นวันทำการ</label></span>					
			</div>
			<div class="uk-margin-top" style="margin-left:20px;">
				<span> <input <?php echo (Session::get('level')==3)?'disabled':''; ?> id="c5" name="c5" value="1" type="checkbox"><label for="c5"> เป็นวันทำการ</label></span>					
			</div>
	    </div>
	</div>

	<div class="uk-margin-large-top uk-text-center">
		<span>(ลงชื่อ)</span>	
		<span class="g-text"><Input <?php echo (Session::get('level')==3)?'readonly':''; ?> type="text" class="uk-form-small uk-width-1-3" /></span>	
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
		{{ Form::button( 'บันทึก', array( 'class'=>'uk-button uk-button-primary', 'id' => 'save_reserve' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('reserve') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}





@stop
