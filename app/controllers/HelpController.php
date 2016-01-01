<?php

class HelpController extends BaseController {

	public function help()
	{
		return View::make( 'help.index' );
	}

}

?>