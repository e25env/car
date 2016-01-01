@extends('layouts.sidebar')
@section('content')
	
	<h4 class="tm-article-subtitle">รายการขอไปราชการ</h4>

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
			<?php if( Session::get('level') == '1' || Session::get('level') == '3' ) { ?>
			<a data-uk-tooltip="{pos:'right'}" data-uk-tooltip title="เพิ่มรายการขอไปราชการ" class="uk-button uk-button-success" href="{{ URL::to('reserve/create') }}"><i class="uk-icon-plus"></i></a>
			<?php } ?>
		</div>
		<?php if( Session::get('level') == '1' || Session::get('level') == '3' ) { ?>
		<div class="uk-width-medium-1-2">
		<?php } else { ?>
		<div class="uk-width-medium-1-1">
		<?php } ?>
			<div class="uk-navbar-flip" data-uk-tooltip title="ค้นหาข้อมูล">			
				{{ Form::open( array( 'url' => 'reserve/search' , 'class' => 'uk-search uk-hidden-small', 'data-uk-search' => '' ) ) }}				
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
			<th>วันที่บันทึก</th>
			<th>ฝ่าย</th>		
			<th>ผู้ขอ</th>
			<th>เรื่อง</th>
			<th></th>	
			<th></th>
			<th></th>
			<th></th>	
			</tr>
		</thead>
		<tbody>		
			<?php $i=0; ?>	
			@foreach( $data as $a )			
			<tr class="uk-table-middle">			
	        	<td width="50"><?php echo $data->getFrom()+$i; ?></td>
	        	<td width="90"><?php echo date("d-m", strtotime($a->reserve_date)).'-'.(date("Y", strtotime($a->reserve_date))+543); ?></td>
				<td width="170">{{ $a->department }}</td>
				<td width="200">{{ $a->regis_user_req }}</td>	
				<td>{{ $a->title }}</td>	

				<?php if( $a->usecar1 == 1 ) {?>
				<td width="30"><a data-uk-tooltip title="ขออนุญาตใช้รถยนต์" class="<?php echo ($a->reqcar==1)?'closebtn':''; ?> uk-button uk-text-warning" href="{{ URL::to('reqcar/create') }}/{{ $a->reserve_id }}"><i class="uk-icon-car"></i></a></td>	
				<?php } else {?>
				<td></td>
				<?php } ?>

				<td width="30"><a data-uk-tooltip title="พิมพ์รายละเอียด" class="uk-button uk-button-success" target="_blank" href="{{ URL::to('reserve/view') }}/{{ $a->reserve_id }}"><i class="uk-icon-print"></i></a></td>			
				<td width="30"><a data-uk-tooltip title="แก้ไขข้อมูล" class="uk-button uk-button-primary" href="{{ URL::to('reserve/edit') }}/{{ $a->reserve_id }}"><i class="uk-icon-edit"></i></a></td>	
				<td width="30"><a data-uk-tooltip title="ลบข้อมูล" class="uk-button uk-button-danger" onclick="if(!confirm('ต้องการลบข้อมูลหรือไม่?')){return false;};" href="{{ URL::to('reserve/delete') }}/{{ $a->reserve_id }}"><i class="uk-icon-trash-o"></i></a></td>						   
			</tr>	
			 <?php $i++; ?>
			@endforeach		
		</tbody>
		</table>
	</div>

<?php if( count($data) > 0 ) { ?>
<br />	
<div class="uk-grid">
    <div class="uk-width-medium-1-5">
    	<span class="uk-text-warning"><i class="uk-icon-car"></i></span> 
    	<span>: ขออนุญาตใช้รถยนต์</span>
    </div>  
</div>
<br />
<?php } ?>

<?php echo $data->links(); ?>

	



@stop