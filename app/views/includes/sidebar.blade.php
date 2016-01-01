
<?php
	$urlcheck =  explode("/", Request::path());
	$activeurl = $urlcheck[0];
?>

<?php if ( Session::get('level') != '' ) {?>
	<div class="user-display">
		<i class="uk-icon-user"></i> {{ Session::get('name') }}
	</div>
<?php } ?>


<ul class="uk-nav uk-nav-side uk-nav-parent-icon uk-width-medium-1-1" data-uk-nav="{multiple:true}">
	<li class="uk-nav-divider"></li>
	<li class="{{$activeurl == '' ? 'uk-active' : '';}}" >
		<a href="{{ URL::to('/') }}"><i class="uk-icon-home"></i> หน้าหลัก</a>
	</li>
	<li class="uk-nav-divider"></li>
	<?php if ( Session::get('level') == '1' ) {?>
		<li class="uk-parent  {{$activeurl == 'users' ? 'uk-active' : '';}} {{$activeurl == 'cars' ? 'uk-active' : '';}} {{$activeurl == 'reserve' ? 'uk-active' : '';}} {{$activeurl == 'reqcar' ? 'uk-active' : '';}} {{$activeurl == 'leaves' ? 'uk-active' : '';}} " >
		<a href="#"> <i class="uk-icon-cog"></i> จัดการข้อมูลระบบ</a>		
		<ul class="uk-nav-sub">		
			<li>
				<a href="{{ URL::to('users') }}">ข้อมูลผู้ใช้งานระบบ</a>
			</li>	
			<li>
				<a href="{{ URL::to('cars') }}">ข้อมูลรถยนต์</a>
			</li>	
			<li>
				<a href="{{ URL::to('reserve') }}">รายการขอไปราชการ</a>
			</li>	
			<li>
				<a href="{{ URL::to('reqcar') }}">รายการขออนุญาตใช้รถยนต์</a>
			</li>					
			<li>
				<a href="{{ URL::to('leaves') }}">ปฎิทินการใช้รถยนต์</a>
			</li>	
		</ul>		
		</li>				
	<?php } else if ( Session::get('level') == '2' ) {?>	
		<li class="uk-parent  {{$activeurl == 'cars' ? 'uk-active' : '';}} {{$activeurl == 'reqcar' ? 'uk-active' : '';}} {{$activeurl == 'leaves' ? 'uk-active' : '';}} " >
		<a href="#"> <i class="uk-icon-cog"></i> จัดการข้อมูลระบบ</a>		
		<ul class="uk-nav-sub">					
			<li>
				<a href="{{ URL::to('cars') }}">ข้อมูลรถยนต์</a>
			</li>				
			<li>
				<a href="{{ URL::to('reqcar') }}">รายการขออนุญาตใช้รถยนต์</a>
			</li>					
			<li>
				<a href="{{ URL::to('leaves') }}">ปฎิทินการใช้รถยนต์</a>
			</li>	
		</ul>		
		</li>		
	<?php } else if ( Session::get('level') == '3' ) {?>		
		<li class="uk-parent  {{$activeurl == 'rooms' ? 'uk-active' : '';}} {{$activeurl == 'reqcar' ? 'uk-active' : '';}} {{$activeurl == 'reserve' ? 'uk-active' : '';}} {{$activeurl == 'leaves' ? 'uk-active' : '';}} " >
		<a href="#"> <i class="uk-icon-cog"></i> จัดการข้อมูลระบบ</a>		
		<ul class="uk-nav-sub">					
			<li>
				<a href="{{ URL::to('rooms') }}">ข้อมูลรถยนต์</a>
			</li>
			<li>
				<a href="{{ URL::to('reserve') }}">รายการขอไปราชการ</a>
			</li>					
			<li>
				<a href="{{ URL::to('reqcar') }}">รายการขออนุญาตใช้รถยนต์</a>
			</li>					
			<li>
				<a href="{{ URL::to('leaves') }}">ปฎิทินการใช้รถยนต์</a>
			</li>	
		</ul>		
		</li>		
	<?php } else { ?>
		<li class="uk-parent {{$activeurl == 'rooms' ? 'uk-active' : '';}} {{$activeurl == 'leaves' ? 'uk-active' : '';}} " >
			<a href="#"> <i class="uk-icon-car"></i> ข้อมูลรถยนต์</a>		
			<ul class="uk-nav-sub">								
				<li>
					<a href="{{ URL::to('rooms') }}">รายละเอียดรถยนต์</a>
				</li>
				<li>
					<a href="{{ URL::to('leaves') }}">ปฎิทินการใช้รถยนต์</a>
				</li>
			</ul>		
		</li>
	<?php } ?>
	<li class="uk-nav-divider"></li>
	<li class="uk-parent  ">
		<a href="#"><i class="uk-icon-file-text"></i> คู่มือการใช้งาน</a>		
		<ul class="uk-nav-sub">
			<li>
				<a href="{{ URL::to('help') }}">การใช้งาน</a>
			</li>			
		</ul>		
	</li>
	<li class="uk-nav-divider"></li>

</ul>



