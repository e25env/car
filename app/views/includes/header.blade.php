
<?php if ( Session::get('name') == '' ) {?>
	<div class="login-mobile uk-visible-small">
	{{ Form::open( array( 'url' => 'users/login', 'class' => 'uk-form  uk-width-medium-1-1' ) ) }}														
			<div class="uk-grid uk-grid-small uk-margin uk-margin-bottom uk-margin-left uk-margin-right">
			<div class="uk-width-10-10">
                <div class="uk-form-row uk-width-1-1">
                    <label class="uk-form-label" for="cid">รหัสบัตรประชาชน:</label>
				    {{ Form::text( 'cid', Input::old('cid'), array( 'placeholder' => 'รหัสบัตรประชาชน', 'class' => 'uk-width-medium-1-1' ) ) }}	
                </div>
                <div class="uk-form-row uk-width-1-1">
                    <label class="uk-form-label" for="password">รหัสผ่าน:</label>
                    {{ Form::password( 'password', array( 'placeholder' => 'รหัสผ่าน', 'class' => 'uk-width-medium-1-1' ) ) }}
                </div>
			</div>
			<div class="uk-width-10-10">
                <div class="uk-form-row uk-margin-top">
				    {{ Form::submit( 'เข้าสู่ระบบ', array( 'class'=>'uk-button uk-button-primary uk-float-right' ) ) }}	
                </div>
			</div>
			</div>							
	{{ Form::close() }}	
	</div>	
<?php } ?>		

<div class="g-header uk-clearfix" data-uk-sticky>
		
		<!-- ********************************************* menu Left ********************************************************* -->
		<div style="padding:10px;" class="uk-hidden-large uk-hidden-medium">
			<button class="uk-button" data-uk-offcanvas="{target:'#my-offcanvas'}"><i class="uk-icon-bars"></i></button>	
		</div>
		<div id="my-offcanvas" class="uk-offcanvas">
		    <div class="uk-offcanvas-bar">
		    	<ul class="uk-nav uk-nav-side uk-nav-parent-icon uk-width-medium-1-1" data-uk-nav="{multiple:true}">
					<li class="uk-nav-divider"></li>
					<li class="" >
						<a href="{{ URL::to('/') }}">หน้าหลัก</a>
					</li>
					@if( Session::get('c2') == 1 || Session::get('c3') == 1 )
					<li>
						<a href="{{ URL::to('contact') }}"><i class="uk-icon-bullhorn"></i> ประสานงาน</a>
					</li>
					@endif
					<li class="uk-nav-divider"></li>
					<?php if ( Session::get('level') == '1' ) {?>
						<li class="uk-parent" >
						<a href="#">จัดการข้อมูลระบบ</a>		
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
						<li class="uk-nav-divider"></li>
						<li class="uk-parent" >
						<a href="#">รายงาน</a>		
						<ul class="uk-nav-sub">					
							<li>
								<a href="{{ URL::to('report1') }}">รายงานสรุประยะทางแต่ละจุดบริการ</a>
							</li>
							<li>
								<a href="{{ URL::to('report2') }}">รายงานสรุประยะทางของรถยนต์</a>
							</li>
							<li>
								<a href="{{ URL::to('report3') }}">รายงานสรุปบิลค่าน้ำมัน</a>
							</li>	
							<li>
								<a href="{{ URL::to('report4') }}">รายงานการใช้พลังงานน้ำมันเชื้อเพลิง</a>
							</li>	
							<li>
								<a href="{{ URL::to('report5') }}">รายงานใบสั่งซื้อ/ใบสั่งจ้าง ค่าน้ำมัน</a>
							</li>										
						</ul>		
						</li>					
					<?php } else if ( Session::get('level') == '2' ) {?>	
						<li class="uk-parent" >
						<a href="#">จัดการข้อมูลระบบ</a>		
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
						<li class="uk-nav-divider"></li>
						<li class="uk-parent" >
						<a href="#">รายงาน</a>		
						<ul class="uk-nav-sub">					
							<li>
								<a href="{{ URL::to('report1') }}">รายงานสรุประยะทางแต่ละจุดบริการ</a>
							</li>		
							<li>
								<a href="{{ URL::to('report2') }}">รายงานสรุประยะทางของรถยนต์</a>
							</li>
							<li>
								<a href="{{ URL::to('report3') }}">รายงานสรุปบิลค่าน้ำมัน</a>
							</li>
							<li>
								<a href="{{ URL::to('report4') }}">รายงานการใช้พลังงานน้ำมันเชื้อเพลิง</a>
							</li>		
							<li>
								<a href="{{ URL::to('report5') }}">รายงานใบสั่งซื้อ/ใบสั่งจ้าง ค่าน้ำมัน</a>
							</li>								
						</ul>		
						</li>		
					<?php } else if ( Session::get('level') == '3' ) {?>		
						<li class="uk-parent" >
						<a href="#">จัดการข้อมูลระบบ</a>		
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
							<li>
								<a href="{{ URL::to('rooms') }}">รายละเอียดรถยนต์</a>
							</li>								
					<?php } ?>
					<li class="uk-nav-divider"></li>
					<li>
						<a href="{{ URL::to('help') }}">การใช้งานเบื่องต้น</a>
					</li>	
					<li class="uk-nav-divider"></li>

				</ul>
		    </div>
		</div>

		<!-- ********************************************* menu top ********************************************************* -->

		<nav class="uk-navbar uk-hidden-small">			
			<a href="{{ URL::to('/') }}" class="uk-navbar-brand uk-hidden-small">ระบบขอใช้รถยนต์ </a>
			<?php if ( Session::get('level') != '' ) {?>
				<div class="uk-navbar-content uk-navbar-flip user-display">
					<i class="uk-icon-user"></i> {{ Session::get('name') }}
				</div>
			<?php } ?>
			<ul class="uk-navbar-nav uk-navbar-flip">
				<?php if ( Session::get('level') == '' ) {?>

				<li>
					<a href="{{ URL::to('/') }}"><i class="uk-icon-home"></i> หน้าหลัก</a>
				</li>

				@if( Session::get('c2') == 1 || Session::get('c3') == 1 )
				<li>
					<a href="{{ URL::to('contact') }}"><i class="uk-icon-bullhorn"></i> ประสานงาน</a>
				</li>
				@endif

				<li>
					<a href="{{ URL::to('rooms') }}"><i class="uk-icon-car"></i> รายละเอียดรถยนต์</a>
				</li>
				<li>
					<a href="{{ URL::to('help') }}"><i class="uk-icon-bell"></i> การใช้งานเบื่องต้น</a>
				</li>


				<li class="uk-parent uk-hidden-small g-b-login"  data-uk-dropdown="">
					<a href="" ><i class="uk-icon-lock"></i> เข้าสู่ระบบ</a>

					<div class="uk-dropdown uk-dropdown-flip" style="">																		
						{{ Form::open( array( 'url' => 'users/login', 'class' => 'uk-form uk-form-stacked  uk-width-medium-1-1' ) ) }}
                        <div class="uk-form-row uk-width-1-1">  
                            <label class="uk-form-label" for="cid">รหัสบัตรประชาชน:</label>                               
                            {{ Form::text('cid', Input::old('cid'), array('placeholder' => 'รหัสบัตรประชาชน', 'class' => 'uk-width-medium-1-1')) }}
                        </div>   
                        <div class="uk-form-row uk-width-1-1">  
                            <label class="uk-form-label" for="password">รหัสผ่าน:</label>
                            {{ Form::password( 'password', array( 'placeholder' => 'รหัสผ่าน', 'class' => 'uk-width-medium-1-1' ) ) }}	
                         </div>
                         <div class="uk-form-row">  
                         {{ Form::submit( 'เข้าสู่ระบบ', array( 'class'=>'uk-button uk-button-primary uk-float-right' ) ) }}
                         </div>
                         {{ Form::close() }}
					</div>					
				</li>					
				<?php } ?>
				<?php if ( Session::get('level') != '' ) {?>					

					<li>
						<a href="{{ URL::to('/') }}"><i class="uk-icon-home"></i> หน้าหลัก</a>
					</li>

					@if( Session::get('c2') == 1 || Session::get('c3') == 1 )
					<li>
						<a href="{{ URL::to('contact') }}"><i class="uk-icon-bullhorn"></i> ประสานงาน</a>
					</li>
					@endif

					<?php if ( Session::get('level') == '1' ) {?>
					<li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
					<a href="#"><i class="uk-icon-cog"></i> จัดการข้อมูลระบบ <i class="uk-icon-caret-down"></i></a>
						<div class="uk-dropdown uk-dropdown-navbar" style="">		
							<ul class="uk-nav uk-nav-navbar">		
								<li>
									<a href="{{ URL::to('users') }}">ข้อมูลผู้ใช้งานระบบ</a>
								</li>	
								<li>
									<a href="{{ URL::to('cars') }}">ข้อมูลรถยนต์</a>
								</li>	
								<li>
									<a href="{{ URL::to('oil') }}">วัสดุเชื้อเพลิง</a>
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
						</div>		
					</li>
					<li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
					<a href="#"><i class="uk-icon-file"></i> รายงาน <i class="uk-icon-caret-down"></i></a>
						<div class="uk-dropdown uk-dropdown-navbar" style="">
							<ul class="uk-nav uk-nav-navbar">					
								<li>
									<a href="{{ URL::to('report1') }}">รายงานสรุประยะทางแต่ละจุดบริการ</a>
								</li>	
								<li>
									<a href="{{ URL::to('report2') }}">รายงานสรุประยะทางของรถยนต์</a>
								</li>
								<li>
									<a href="{{ URL::to('report3') }}">รายงานสรุปบิลค่าน้ำมัน</a>
								</li>
								<li>
									<a href="{{ URL::to('report4') }}">รายงานการใช้พลังงานน้ำมันเชื้อเพลิง</a>
								</li>	
								<li>
									<a href="{{ URL::to('report5') }}">รายงานใบสั่งซื้อ/ใบสั่งจ้าง ค่าน้ำมัน</a>
								</li>										
							</ul>
						</div>
					</li>						
				<?php } else if ( Session::get('level') == '2' ) {?>	
					<li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
					<a href="#"><i class="uk-icon-cog"></i> จัดการข้อมูลระบบ <i class="uk-icon-caret-down"></i></a>
						<div class="uk-dropdown uk-dropdown-navbar" style="">
							<ul class="uk-nav uk-nav-navbar">					
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
						</div>
					</li>
					<li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
					<a href="#"><i class="uk-icon-file"></i> รายงาน <i class="uk-icon-caret-down"></i></a>
						<div class="uk-dropdown uk-dropdown-navbar" style="">
							<ul class="uk-nav uk-nav-navbar">					
								<li>
									<a href="{{ URL::to('report1') }}">รายงานสรุประยะทางแต่ละจุดบริการ</a>
								</li>	
								<li>
									<a href="{{ URL::to('report2') }}">รายงานสรุประยะทางของรถยนต์</a>
								</li>
								<li>
									<a href="{{ URL::to('report3') }}">รายงานสรุปบิลค่าน้ำมัน</a>
								</li>
								<li>
									<a href="{{ URL::to('report4') }}">รายงานการใช้พลังงานน้ำมันเชื้อเพลิง</a>
								</li>	
								<li>
									<a href="{{ URL::to('report5') }}">รายงานใบสั่งซื้อ/ใบสั่งจ้าง ค่าน้ำมัน</a>
								</li>										
							</ul>
						</div>
					</li>			
				<?php } else if ( Session::get('level') == '3' ) {?>		
					<li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
					<a href="#"> <i class="uk-icon-cog"></i> จัดการข้อมูลระบบ <i class="uk-icon-caret-down"></i></a>	
						<div class="uk-dropdown uk-dropdown-navbar" style="">	
							<ul class="uk-nav uk-nav-navbar">					
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
						</div>	
					</li>		
				<?php } ?>


					<li class="g-b-logout">
						<a href="{{ URL::to( 'users/logout' ) }}"><i class="uk-icon-unlock"></i> ออกระบบ</a>	
					</li>
				<?php } ?>
										        	       		   
			   		   					
			</ul>
								
			<div class="uk-height-1-1 uk-vertical-align uk-text-center">
				<div class="uk-vertical-align-middle">						
				<div class="uk-visible-small uk-text-large uk-navbar-brand">ระบบขออนุญาตใช้รถยนต์</div>				
				</div>
			</div>
		</nav>
				
</div>