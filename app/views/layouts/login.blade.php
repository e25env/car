<!doctype html>
<html>
<head>
	@include('includes.head')
</head>
<body>

<div class="g-header-boxlogin">
	<div class="uk-container uk-container-center">														
		<div class="g-header-logologin">
			<div class="g-logologin uk-hidden-small uk-text-center">โรงพยาบาลโนนไทย อ.โนนไทย จ.นครราชสีมา.</div>										
			<div class="uk-visible-small uk-height-1-1 uk-vertical-align uk-text-center">
				<div class="uk-vertical-align-middle uk-text-center">						
					<div class="uk-text-large">ระบบขออนุญาตใช้รถยนต์</div>				
				</div>
			</div>
		</div>				
	</div>
</div>	

<div class="uk-container uk-container-center">	
	<div class="g-box-login">	    	
		<div class="uk-panel uk-panel-box uk-panel-box-primary uk-width-medium-1-3 uk-container-center">
			@yield('content')
		</div>				
	</div>
</div>

<div class="g-box-footerlogin uk-text-center uk-text-muted">
	Copyright 2014 By Theme Sanasang.
</div>


</body>
</html>