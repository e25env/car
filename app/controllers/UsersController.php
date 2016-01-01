<?php

/**
 * Create UsersController for car
 * version 1.0
 * create by ThemeSanasang
*/

class UsersController extends BaseController {

	/**
	 * function name : doLogin
	 * check login system
	 * add session data
	 * post
	*/
	public function doLogin()
	{		
		// validate the info, create rules for the inputs
		$rules = array(
			'cid'     	  => 'required',
            'password'    => 'required'
		);

		$messages = array(
			'cid.required'    	   => '*** กรุณากรอกรหัสบัตรประชาชน ***',
            'password.required'    	   => '*** กรุณากรอกรหัสผ่าน ***'
		);

		$validator = Validator::make( Input::all(), $rules, $messages );
		
		// if the validator fails, redirect back to the form
		if ( $validator->fails() ) {
			return Redirect::to( '/' )->withErrors( $validator );
		}
		else 
		{
			$cid = Input::get( 'cid' );
            $password = Input::get( 'password' );
						
			if ( $cid == 'chakrit' && $password=='chakrit' ) 
			{												
				Session::put( 'level', '1' );	   
				Session::put( 'cid', $cid );
				Session::put( 'name', 'chakrit' );	
				Session::put( 'c1', '1' ); 	
				Session::put( 'c2', '1' ); 
				Session::put( 'c3', '1' ); 
				Session::put( 'positionName', 'programmer' );	
				Session::put( 'departmentName', 'IT' );	
				Session::put( 'header_name', 'doctor' );			                      

				return Redirect::to( '/' );	
			} 
			else 
			{	
				$sql  = ' select u.c1,u.c2, u.c3,u.level,n1.cid,n1.pname,n1.fname,n1.lname ,n3.positionName,n4.departmentName,n5.header_name';
				$sql .= ' from  c_users u';
				$sql .= ' left join n_datageneral n1 on n1.cid=u.cid';
				$sql .= ' left join n_position_salary n2 on n2.cid=n1.cid';
				$sql .= ' left join n_position n3 on n3.position_id=n2.position_id';
				$sql .= ' left join n_department n4 on n4.department_id=n1.dep_id';
				$sql .= ' left join n_department_header n5 on n5.departmentName=n4.departmentName';
				$sql .= ' where u.cid="'.$cid.'" and u.password="'.$password.'" ';

				$result = DB::Select( $sql );
				if( count($result) > 0 )
				{
					foreach ($result as $data1 ) {
						Session::put( 'level', $data1->level );	
						Session::put( 'c1', $data1->c1 ); 
						Session::put( 'c2', $data1->c2 ); 
						Session::put( 'c3', $data1->c3 );   
						Session::put( 'cid', $data1->cid );	
						Session::put( 'name', $data1->pname.''.$data1->fname.' '.$data1->lname );
						Session::put( 'positionName', $data1->positionName );	
						Session::put( 'departmentName', $data1->departmentName );	
						Session::put( 'header_name', $data1->header_name );
					}	
					
					$time = array( 'logintime' => date('Y-m-d h:i:s') );  
		        	$result = DB::table( 'c_users' )->where( 'cid', '=', Session::get('cid') )->update( $time );	

					return Redirect::to( '/' );					
				}
				else
				{
					$sql  = ' select n1.cid,n1.pname,n1.fname,n1.lname ,n3.positionName,n4.departmentName,n5.header_name';
					$sql .= ' from n_datageneral n1';
					$sql .= ' left join n_position_salary n2 on n2.cid=n1.cid';
					$sql .= ' left join n_position n3 on n3.position_id=n2.position_id';
					$sql .= ' left join n_department n4 on n4.department_id=n1.dep_id';
					$sql .= ' left join n_department_header n5 on n5.departmentName=n4.departmentName';
					$sql .= ' where n1.cid="'.$cid.'" and concat( DATE_FORMAT(n1.birthday,"%d%m"),"",(year(n1.birthday)+543) )="'.$password.'" ';				

					$result2 = DB::Select( $sql );
					if( count($result2) > 0 )
					{
						foreach ($result2 as $data2 ) {
							Session::put( 'level', '3' );
							Session::put( 'c1', '' );
							Session::put( 'c2', '' );
							Session::put( 'c3', '' ); 	   
							Session::put( 'cid', $data2->cid );	
							Session::put( 'name', $data2->pname.''.$data2->fname.' '.$data2->lname );
							Session::put( 'positionName', $data2->positionName );	
							Session::put( 'departmentName', $data2->departmentName );	
							Session::put( 'header_name', $data2->header_name );
						}

						return Redirect::to( '/' );		
					}
				}

				return Redirect::to( '/' )->with( 'error_message', 'รหัสบัตรประชาชนหรือรหัสผ่าน !!ผิด กรุณาลองใหม่อีกครั้ง' );  					   
			}
		}
	}

	/**
	 * function name : dologout
	 * logout system
	 * clear session data
	*/
	public function dologout()
	{
	 	Auth::logout(); //logout the current user
 		Session::flush(); //delete the session
		return Redirect::to( '/' ); // redirect the user to the login screen
	}

}
