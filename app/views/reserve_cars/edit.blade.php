@extends('layouts.sidebar')
@section('content')
<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('reserve') }}">ขอไปราชการ</a></li>   
    <li class="uk-active"><span>แก้ไขรายการขอไปราชการ</span></li>
</ul>
</h4>

<?php
	$url = 'reserve/edit/'.$data->reserve_id;
?>
{{ Form::open( array( 'url' => $url, 'enctype' => 'multipart/form-data', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">เแก้ไขข้อมูล</div>  

	<div class="uk-text-center uk-text-large uk-text-bold">บันทึกข้อความ</div>
	<div class="uk-margin-top">
		<span class="uk-text-bold">ส่วนราชการ</span>
		<span>ฝ่าย</span>
		<span class="g-text">	
			<span  class="uk-width-1-3">
			    <input class="uk-width-1-3" style="color:#000;" readonly name="fb1" type="text" value="{{ $data->department }}">		    
			</span>
			@if ($errors->has('fb1')) <span class="g-text-error uk-text-danger">{{ $errors->first('fb1') }}</span> @endif
		</span>
		<span>โรงพยาบาลโนนไทย อำเภอโนนไทย จังหวัดนครราชสีมา</span>
	</div>
	<div class="uk-margin-top">
		<span class="uk-text-bold">ที่</span>
		<span>นม 0032.301/</span>
		<span class="g-text"><Input type="text" id="fb2" name="fb2" class="uk-form-small uk-form-width-medium" value="{{ $data->num_nm }}" /></span>
		<span>วันที่(ว-ด-ป)</span>		
		<span class="g-text"><Input type="text" placeholder="__-__-____" id="fb3" name="fb3" class="fb3 uk-form-small uk-form-width-medium" value="<?php echo (substr($data->date_nm, 0,1)=='00')?'':$data->date_nm; ?>" /></span>
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
		<span>ด้วยข้าพเจ้า </span>	
		<span class="g-text uk-width-1-3">{{ $data->req_name }}</span>
		<span> ตำแหน่ง </span>
		<span class="g-text uk-width-1-3">{{ $data->position }}</span>
	</div>

	<?php if( count($user) > 0 ) {?>
	<div class="uk-margin-top">		
		<span>พร้อมด้วย</span>
	</div>
	<?php } ?>

	<?php $r=0; ?>
	@foreach( $user as $a )	
		<?php $r++; ?>
		<div class="uk-margin-top" style="margin-left:20px;">
			<span><?php echo $r.'.'; ?></span>	
			<span class="g-text uk-width-1-3">{{ $a->req_name }}</span>		
			<span>ตำแหน่ง</span>
			<span class="g-text uk-width-1-3">{{ $a->position }}</span>
		</div>
	@endforeach		
	
	
	<div class="uk-margin-top">
		<span>ขออนุมัติเดินทางไปราชการที่</span>	
		<span class="g-text">
			<Input type="text" id="fb8" name="fb8" class="uk-form-small uk-width-1-3" value="{{ $data->location }}" />						
		</span>	
		<span class="g-text-error uk-text-danger">*</span>
		<span>หน่วยงานผู้จัด</span>
		<span class="g-text">
			<Input type="text" id="fb9" name="fb9" class="uk-form-small uk-width-1-3" value="{{ $data->institution }}" />			
		</span>
		<span class="g-text-error uk-text-danger">*</span>
	</div>
	<div class="uk-margin-top">
		<span>เรื่อง</span>	
		<span class="g-text">
			<Input type="text" id="fb10" name="fb10" class="uk-form-small uk-width-1-2" value="{{ $data->title }}" />			
		</span>	
		<span class="g-text-error uk-text-danger">*</span>	
	</div>
	<div class="uk-margin-top">
		<span>ตามหนังสือที่</span>	
		<span class="g-text"><Input type="text" id="fb11" name="fb11" class="uk-form-small uk-width-1-3" value="{{ $data->ref_book_number }}" /></span>
		<span>ลงวันที่(ว-ด-ป)</span>
		<span class="g-text"><Input type="text" placeholder="__-__-____" id="fb12" name="fb12" class="fb12 uk-form-small uk-width-1-3" value="<?php echo (substr($data->ref_book_date, 0,1)=='00')?'':$data->ref_book_date; ?>" /></span>
	</div>
	<div class="uk-margin-top">
		<span>ทั้งนี้ตั้งแต่วันที่(ว-ด-ป)</span>	
		<span class="g-text">
			<Input type="text" placeholder="__-__-____" id="fb13" name="fb13" class="fb13 uk-form-small uk-width-1-5" value="{{ $data->startdate }}" />
			<span class="g-text-error uk-text-danger">*</span>
		</span>
		<span>ถึงวันที่(ว-ด-ป)</span>
		<span class="g-text">
			<Input type="text" placeholder="__-__-____" id="fb14" name="fb14" class="fb14 uk-form-small uk-width-1-5" value="{{ $data->enddate }}" />
			<span class="g-text-error uk-text-danger">*</span>
		</span>
		<span>รวม</span>
		<span class="g-text"><Input type="text" id="fb15" name="fb15" class="uk-form-small uk-width-1-5" value="{{ $data->allday }}" /></span>
		<span>วัน</span>
	</div>
	<div class="uk-margin-top">
		<span>สำหรับค่าใช้จ่ายในการเดินทางไปราชการขอเบิกจ่ายเงินบำรุงของโรงพยาบาล และขอใช้รถยนต์เดินทางไปราชการครั้งนี้</span>				
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span> 
			<input <?php echo (($data->usecar1 == 1) ? 'checked="checked"':''); ?> id="c1" name="c1" value="1" type="checkbox"><label for="c1"> ใช้รถยนต์ของทางโรงพยาบาลโนนไทย</label>
		</span>					
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span> 
			<input <?php echo (($data->usecar2 == 1) ? 'checked="checked"':''); ?> id="c2" name="c2" value="1" type="checkbox"><label for="c2"> ใช้รถยนต์ส่วนตัว</label>
		</span>	
		<span>หมายเลขทะเบียน</span>
		<span class="g-text"><Input type="text" id="fb16" name="fb16" class="uk-form-small uk-width-1-4" value="{{ $data->usecar2_car_number }}" /></span>	
		<span>ตามหลักเกณฑ์การเบิกค่ายานพาหนะส่วนตัวในการเดินทางไปราชการ กิโลเมตรละ 4 บาท เป็นเงิน</span>	
		<span class="g-text"><Input type="text" id="fb17" name="fb17" class="uk-form-small uk-width-1-6" value="{{ $data->usecar2_km_money }}" /></span>
		<span>บาท</span>		
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span> 
			<input <?php echo (($data->usecar3 == 1) ? 'checked="checked"':''); ?> id="c3" name="c3" value="1" type="checkbox"><label for="c3"> อื่น ๆ (ระบุ)</label>
		</span>	
		<span class="g-text"><Input type="text" id="fb18" name="fb18" class="uk-form-small uk-width-1-2" value="{{ $data->usecar3_detail }}" /></span>				
	</div>
	<div class="uk-margin-top" style="margin-left:20px;">
		<span>จึงเรียนมาเพื่อทราบ และโปรดพิจารณาอนุมัติด้วย จะเป็นพระคุณ</span>				
	</div>

	<div class="uk-margin-top uk-text-center">
		<span style="padding-right:15px;"> (ลงชื่อ) </span>	
		<span class="g-text uk-width-1-3" >
			..................................................	
		</span>			
		<span style="padding-left:15px;">  ผู้ขอ </span>			
	</div>
	<div class="uk-margin-top uk-text-center">			
		( <span class="g-text uk-width-1-3" >
			{{ $data->regis_user_req }}
		</span> )					
	</div>

	<div class="uk-margin-top" style="margin-left:20px;">
		<span>เสนอ ผู้อำนวยการโรงพยาบาลโนนไทย</span>				
	</div>

	<div class="uk-grid">
	    <div class="uk-width-medium-1-2">
	    	<div class="uk-margin-top uk-text-center">			
				<span class="g-text"><Input <?php echo (Session::get('level')==3)?'disabled':''; ?> type="text" class="uk-form-small uk-width-1-2" /></span>					
			</div>
			<div class="uk-margin-top uk-text-center">
				<span>(ลงชื่อ)</span>	
				<span class="g-text"><Input <?php echo (Session::get('level')==3)?'disabled':''; ?> type="text" class="uk-form-small uk-width-1-2" /></span>	
				<span>หัวหน้าฝ่าย</span>			
			</div>
			<div class="uk-margin-top uk-text-center">			
				<span class="g-text">(<Input <?php echo (Session::get('level')==3)?'disabled':''; ?> type="text" class="uk-form-small uk-width-1-2" />)</span>					
			</div>
	    </div>
	    <div class="uk-width-medium-1-2">
	        <div class="uk-margin-top" style="margin-left:20px;">
				<span> 
					<input <?php echo (Session::get('c1')!=1)?'disabled':''; ?> <?php echo (($data->daytrue == 1) ? 'checked="checked"':''); ?> id="c4" name="c4" value="1" type="checkbox"><label for="c4"> ไม่เป็นวันทำการ</label>
				</span>					
			</div>
			<div class="uk-margin-top" style="margin-left:20px;">
				<span> 
					<input <?php echo (Session::get('c1')!=1)?'disabled':''; ?> <?php echo (($data->dayflase == 1) ? 'checked="checked"':''); ?> id="c5" name="c5" value="1" type="checkbox"><label for="c5"> เป็นวันทำการ</label>
				</span>					
			</div>
	    </div>
	</div>

	<div class="uk-margin-large-top uk-text-center">
		<span>(ลงชื่อ)</span>	
		<span class="g-text"><Input <?php echo (Session::get('level')==3)?'disabled':''; ?> type="text" class="uk-form-small uk-width-1-3" /></span>	
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
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('reserve') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}





@stop