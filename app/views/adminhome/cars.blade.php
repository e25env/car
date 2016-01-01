@extends('layouts.sidebar')
@section('content')
	
<div class="uk-margin-top uk-margin-bottom">
	<h4 class="tm-article-subtitle">ข้อมูลรถยนต์</h4>
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
			<?php if( Session::get('level') == '1' ) { ?>
			<a data-uk-tooltip="{pos:'right'}" data-uk-tooltip title="เพิ่มข้อมูลรถยนต์" class="uk-button uk-button-success" href="{{ URL::to('cars/create') }}"><i class="uk-icon-plus"></i></a>
			<?php } ?>
		</div>
		<?php if( Session::get('level') == '1' ) { ?>
		<div class="uk-width-medium-1-2">
		<?php } else { ?>
		<div class="uk-width-medium-1-1">
		<?php } ?>
			<div class="uk-navbar-flip" data-uk-tooltip title="ค้นหาข้อมูล">			
				{{ Form::open( array( 'url' => 'cars/search' , 'class' => 'uk-search uk-hidden-small', 'data-uk-search' => '' ) ) }}				
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
			<th>ทะเบียนรถ</th>
			<th>ยี่ห้อ</th>		
			<th>รุ่น</th>			
			<th>รูป</th>
			<th>สถานะ</th>
			
			<?php if( Session::get('level') == '1' ) { ?>
			<th></th>
			<th></th>	
			<th></th>	
			<?php } ?>

			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			@foreach( $carall as $a )
			<?php 				
				$urlimg = 'uploads/'.$a->car_number.'/'.$a->car_img; 
				$urlimg2 = 'uploads/'.$a->car_number.'/'.$a->car_img2; 
				$urlimg3 = 'uploads/'.$a->car_number.'/'.$a->car_img3; 
			?>
			<tr class="uk-table-middle">			
	        	<td width="50"><?php echo $carall->getFrom()+$i; ?></td>
	        	<td>{{ $a->car_number }}</td>
				<td>{{ $a->brand }}</td>
				<td>{{ $a->model }}</td>					
				<td>
					<?php if( $a->car_img != '' ){ ?>
						<a class="uk-overlay group<?php echo $i; ?>" href="<?php echo $urlimg; ?>" title="{{ $a->car_number }}">
						{{ HTML::image($urlimg, '', array('class' => 'uk-border-rounded', 'height' => '150', 'width' => '150' ) ); }}
						<div class="uk-overlay-area"></div>
						</a>
					<?php } ?>
					<?php if( $a->car_img2 != '' ){ ?>
						<a class="uk-overlay group<?php echo $i; ?>" href="<?php echo $urlimg2; ?>" title="{{ $a->car_number }}"><div class="uk-overlay-area"></div></a>
					<?php } ?>
					<?php if( $a->car_img3 != '' ){ ?>
						<a class="uk-overlay group<?php echo $i; ?>" href="<?php echo $urlimg3; ?>" title="{{ $a->car_number }}"><div class="uk-overlay-area"></div></a>
					<?php } ?>
				</td>		
								
				<?php if( $a->status == 1 ){ ?>
					<td><?php  echo '<span class="uk-text-danger">ไม่ว่าง</span>'; ?></td>
				<?php } else { ?>
					<td><?php  echo '<span class="uk-text-success">ว่าง</span>'; ?></td>
				<?php } ?>			

				<?php if( Session::get('level') == '1' ) { ?>
				<td width="30"><a data-uk-tooltip title="รายละเอียด" class="uk-button uk-button-success" href="{{ URL::to('cars/view') }}/{{ $a->car_id }}"><i class="uk-icon-search"></i></a></td>			
				<td width="30"><a data-uk-tooltip title="แก้ไขข้อมูล" class="uk-button uk-button-primary" href="{{ URL::to('cars/edit') }}/{{ $a->car_id }}"><i class="uk-icon-edit"></i></a></td>	
				<td width="30"><a data-uk-tooltip title="ลบข้อมูล" class="uk-button uk-button-danger" onclick="if(!confirm('ต้องการลบข้อมูลหรือไม่?')){return false;};" href="{{ URL::to('cars/delete') }}/{{ $a->car_id }}"><i class="uk-icon-trash-o"></i></a></td>						   
				<?php } ?>				

			</tr>
			<?php $i++; ?>	
			@endforeach		
		</tbody>
		</table>
	</div>

<?php echo $carall->links(); ?>
</div>	

@stop