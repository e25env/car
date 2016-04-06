@extends('layouts.sidebar')
@section('content')
	
	<h4 class="tm-article-subtitle">รายการขออนุญาตใช้รถยนต์</h4>

	<?php 
		$success_message = Session::get('success_message');
		$error_message = Session::get('error_message');
	?>
	@if(!empty($success_message))
		<div class="uk-alert uk-alert-success"><a href="" class="uk-alert-close uk-close"></a>{{ $success_message }}</div>
	@endif
	 @if(!empty($error_message))
		<div class="uk-alert uk-alert-danger"><a href="" class="uk-alert-close uk-close"></a>{{ $error_message }}</div>
	@endif
	
	<div class="uk-grid">
		<div class="uk-width-medium-1-2">			
			<a data-uk-tooltip="{pos:'right'}" data-uk-tooltip title="เพิ่มรายการขออนุญาตใช้รถยนต์" class="uk-button uk-button-success" href="{{ URL::to('reqcar/create') }}"><i class="uk-icon-plus"></i></a>
			<a class="uk-button uk-button-primary" href="{{ URL::to('reqcar/resend') }}">เพิ่มจากรายการขอล่าสุด</a>			
		</div>		
		<div class="uk-width-medium-1-2">	
			<div class="uk-navbar-flip" data-uk-tooltip title="ค้นหาข้อมูล">			
				{{ Form::open( array( 'url' => 'search' , 'method' => 'GET' , 'class' => 'uk-search uk-hidden-small', 'data-uk-search' => '' ) ) }}				
					<input class="uk-search-field" type="search" id="search" name="search" placeholder="ค้นหา..." autocomplete="off">
					<button class="uk-search-close" type="reset"></button>
					<div class="uk-dropdown uk-dropdown-search"></div>
				{{ Form::close() }}
			</div>
		</div>
	</div>

	<div class="uk-overflow-container">
		<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
		<thead>
			<tr>
			<th>ลำดับ</th>			
			<th>ฝ่าย</th>		
			<th>สถานที่ไป</th>
			<th>เรื่อง</th>	
			<th>วันที่ไป</th>
			<th>เวลาไป</th>	
			<th>กลับจริง</th>		
			<th></th>	
			<th></th>			
			
			<?php if( Session::get('level') == 1 || Session::get('level') == 2 || Session::get('level') == 3 ){ ?>
			<th></th>
			<th></th>
			<?php } ?>	

			<?php if( Session::get('level') == 1 || Session::get('level') == 3 ){ ?>
			<th></th>
			<th></th>
			<?php } ?>	
			
			</tr>
		</thead>
		<tbody>		
			<?php $i=0; ?>	
			@foreach( $data as $a )			
			<tr class="uk-table-middle">			
	        	<td class="<?php echo ($a->req_status=='')?'0':''; echo ($a->req_status=='1')?'trcolor_ok':''; echo ($a->req_status=='2')?'trcolor_cancle':''; echo ($a->req_status=='3')?'trcolor_no':'';  ?>" width="45"><?php echo $data->getFrom()+$i; ?></td>	        	
				<td width="140">{{ $a->department }}</td>
				<td width="140">{{ $a->location }}</td>	
				<td width="190">{{ $a->detail }}</td>	
				<td width="90"><?php echo date("d-m", strtotime($a->godate)).'-'.(date("Y", strtotime($a->godate))+543); ?></td>
				<td width="20">{{ $a->gotime_start }}</td>

				<td width="20" class="uk-text-danger">
					@if( $a->backtime == '00:00:00' )
						-
					@else
						{{ $a->backtime }}	
					@endif
				</td>

				<?php if( $a->nn != '' ) { ?>
				<td width="30"><span data-uk-tooltip="{pos:'top-left'}" title="{{ $a->nn }}" class="uk-button uk-text-primary"><i class="uk-icon-tags"></i></span></td>
				<?php }else{ echo '<td></td>'; } ?>

				<?php if( $a->driver != '' ) { ?>
				<td width="30"><span data-uk-tooltip="{pos:'top-left'}" title="<i class='uk-icon-user'></i> : {{ $a->driver }} <br /> <i class='uk-icon-car'></i> : {{ $a->car_number }}" class="<?php echo ($a->req_status==2)?'closebtn':''; ?> <?php echo ($a->nn != '')?'closebtn':''; ?> uk-button uk-text-warning"><i class="uk-icon-user"></i></span></td>
				<?php }else{ echo '<td></td>'; } ?>

				<?php if( Session::get('level') == 1 || Session::get('level') == 2 || Session::get('level') == 3 ){ ?>	
				<td width="30"><a data-uk-tooltip title="รายละเอียด" class="<?php echo ($a->req_status==2)?'closebtn':'' ?> uk-button uk-button-success" target="_blank" href="{{ URL::to('reqcar/view') }}/{{ $a->req_car_id }}"><i class="uk-icon-search"></i></a></td>			
				<td width="30"><a data-uk-tooltip title="แก้ไขข้อมูล" class="<?php echo ($a->req_status==2)?'closebtn':'' ?> uk-button uk-button-primary" href="{{ URL::to('reqcar/edit') }}/{{ $a->req_car_id }}"><i class="uk-icon-edit"></i></a></td>	
				<?php } ?>

				<?php if( Session::get('level') == 1 || Session::get('level') == 3 ){ ?>
				<td width="30"><a data-uk-tooltip title="ยกเลิกการขอ" class="<?php echo ($a->req_status==2)?'closebtn':'' ?> uk-button uk-text-danger" onclick="if(!confirm('ต้องการยกเลิกข้อมูลหรือไม่?')){return false;};" href="{{ URL::to('reqcar/cancle') }}/{{ $a->req_car_id }}"><i class="uk-icon-thumbs-o-down"></i></a></td>	
				<td width="30"><a data-uk-tooltip title="ลบข้อมูล" class="<?php echo ($a->req_status==2)?'closebtn':'' ?> uk-button uk-button-danger" onclick="if(!confirm('ต้องการลบข้อมูลหรือไม่?')){return false;};" href="{{ URL::to('reqcar/delete') }}/{{ $a->req_car_id }}"><i class="uk-icon-trash-o"></i></a></td>	
				<?php } ?>

			</tr>	
			 <?php $i++; ?>
			@endforeach		
		</tbody>
		</table>
	</div>

<?php if( count($data) > 0 ) { ?>
<br />	
<div class="uk-grid">
    <div class="uk-width-medium-1-6">
    	<span class="uk-thumbnail uk-border-circle b-g"></span> 
    	<span>: อนุมัติ</span>
    </div>
    <div class="uk-width-medium-1-6">
    	<span class="uk-thumbnail uk-border-circle b-r"></span> 
    	<span>: ไม่อนุมัติ</span>
    </div>
     <div class="uk-width-medium-1-6">
    	<span class="uk-thumbnail uk-border-circle b-y"></span> 
    	<span>: ยกเลิกการขอ</span>
    </div>
    <div class="uk-width-medium-1-5">
    	<span class="uk-text-warning"><i class="uk-icon-user"></i></span> 
    	<span>: พนักงานขับรถยนต์</span>
    </div>
     <div class="uk-width-medium-1-5">
    	<span class="uk-text-primary"><i class="uk-icon-tags"></i></span> 
    	<span>: ไปกับฝ่ายอื่น</span>
    </div>
</div>
<br />
<?php } ?>

<?php 
	//echo $data->links(); 
	echo $data->appends(Request::except('page'))->links();
?>

@stop