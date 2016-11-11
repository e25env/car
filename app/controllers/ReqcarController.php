<?php

class ReqcarController extends BaseController {

	/**
	 * function name : home
	 * view page c_req_car
	 * add data to grid
	 * get
	*/
	public function home()
	{
		
		if ( Session::get('level') == '1' )
    	{	
    		$data = DB::table( 'c_req_cars' )
    				//->orderBy( 'req_car_id','desc' )
    				->orderBy( 'req_status','asc' )
		    		->orderBy( 'godate','asc' )	
    				->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
    				->paginate( 20 );		
	    	return View::make( 'req_cars.index', array( 'data' => $data) );	
    	}
    	else if( Session::get('level') == '2' )
    	{
    		$data = DB::table( 'c_req_cars' )
		    		->where( 'req_status', '<>', '2' )
		    		//->where( 'godate', '>=', date('Y-m-d') )
		    		->orderBy( 'req_status','asc' )
		    		->orderBy( 'godate','asc' )	
		    		->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
		    		->paginate( 20 );		
	    	return View::make( 'req_cars.index', array( 'data' => $data) );	
    	}
    	else if( Session::get('level') == '3' )
    	{
			$data = DB::table( 'c_req_cars' )
					->where( 'regis_user', '=', Session::get('cid') )
					//->where( 'godate', '>=', date('Y-m-d') )
					->orderBy( 'req_status','asc' )
					->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
					->paginate( 10 );		    	
	    	return View::make( 'req_cars.index', array( 'data' => $data) );	
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )
    		//->where( 'godate', '>=', date('Y-m-d') )
    		->orderBy( 'req_status','asc' )
    		->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
    		->paginate( 10 );		
	    	return View::make( 'req_cars.index', array( 'data' => $data) );	
    	}     				    		 					
	}

	/**
    * function name : post_search_reqcar
    * search data c_req_cars
    * post
    */
    public function post_search_reqcar()
    {   

	   if ( Session::get('level') == '1' )
		{
			$search  = Input::get( 'search' ); 

			$data = DB::table( 'c_req_cars' )	 
			 ->where( 'department', 'like', "%$search%" )
		     ->orWhere( 'detail', 'like', "%$search%" )	 
		     ->orWhere( 'user_req', 'like', "%$search%" )
		     ->orWhere( 'location', 'like', "%$search%" )
	         ->orderBy( 'req_car_id', 'desc' )
	         ->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
	         ->paginate( 50 )
	         ->appends(['search' => $search]);	        
	       
		    return View::make( 'req_cars.index',  compact('data') );	
		}
		else if( Session::get('level') == '2' )
		{
			$search  = Input::get( 'search' );	    		    

			$data = DB::table( 'c_req_cars' )
			 ->where( 'req_status', '<>', '2' )
	         ->where( 'godate', '>=', date('Y-m-d') )	 
			 ->where(function($query) use ( $search )
	            {
	                $query->where( 'department', 'like', "%$search%" )
					      ->orWhere( 'detail', 'like', "%$search%" )
					      ->orWhere( 'location', 'like', "%$search%" )	 
					      ->orWhere( 'user_req', 'like', "%$search%" );	 					     
	            })	        
	         ->orderBy( 'godate','asc' )
	         ->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
	         ->paginate( 50 )
	         ->appends(['search' => $search]);	        
	       
		    return View::make( 'req_cars.index',  compact('data') );
		}
		else if( Session::get('level') == '3' )
		{
			$search  = Input::get( 'search' );	    		    

			$data = DB::table( 'c_req_cars' )	 
			 ->where( 'regis_user', '=', Session::get('cid') )          	         
	         ->where(function($query) use ( $search )
	            {
	                $query->where( 'department', 'like', "%$search%" )
					      ->orWhere( 'detail', 'like', "%$search%" )
					      ->orWhere( 'location', 'like', "%$search%" )	 
					      ->orWhere( 'user_req', 'like', "%$search%" );	 					     
	            })
	         ->where( 'regis_user', '=', Session::get('cid') )
	         ->where( 'godate', '>=', date('Y-m-d') )
	         ->orderBy( 'godate','asc' )
	         ->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )	       
	         ->paginate( 50 )
	         ->appends(['search' => $search]);	        
	       
		    return View::make( 'req_cars.index',  compact('data') );
		}	
		else
		{
			$search  = Input::get( 'search' );	    		    

			$data = DB::table( 'c_req_cars' )	 
			  ->where(function($query) use ( $search )
	            {
	                $query->where( 'department', 'like', "%$search%" )
					      ->orWhere( 'detail', 'like', "%$search%" )
					      ->orWhere( 'location', 'like', "%$search%" )	 
					      ->orWhere( 'user_req', 'like', "%$search%" );	 					     
	            })
			 ->where( 'godate', '>=', date('Y-m-d') )
			 ->where( 'req_status', '<>', '2' )
			 ->orderBy( 'godate','asc' )
			 ->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )	        
	         ->paginate( 50 )
	         ->appends(['search' => $search]);	        
	       
		    return View::make( 'req_cars.index',  compact('data') );
		}	
    }

	public function create_req( $id=null )
	{
		if ( Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' )
    	{

    		$dataDep = DB::table('n_department')->get(array( DB::raw('departmentName as value') ) );  		
			foreach ($dataDep as $k => $v) {		       
				$return_array[] = $v;    
		    }	
		    if( !isset(  $return_array ) ) { $return_array[]=''; }

		    $dataUser = DB::table('n_datageneral')->get(array( DB::raw('CONCAT(pname,"",fname, " ", lname) as value') ) );  		
			foreach ($dataUser as $k2 => $v2) {		       
				$return_array2[] = $v2;    
		    }
		    if( !isset(  $return_array2 ) ) { $return_array2[]=''; }	

		    $dataLocation = DB::table('c_req_cars')->groupBy('location')->get(array( DB::raw('location as value') ) );  		
			foreach ($dataLocation as $k2 => $v2) {		       
				$return_array3[] = $v2;    
		    }
		    if( !isset(  $return_array3 ) ) { $return_array3[]=''; }

		    $dataDetail = DB::table('c_req_cars')->groupBy('detail')->get(array( DB::raw('detail as value') ) );  		
			foreach ($dataDetail as $k2 => $v2) {		       
				$return_array4[] = $v2;    
		    }
		    if( !isset(  $return_array4 ) ) { $return_array4[]=''; }
		   		   
		   	return View::make( 'req_cars.create', array( 'dataDep' => $return_array, 'dataUser' => $return_array2, 'reserve_id' => $id, 'location' => $return_array3, 'detail' => $return_array4 ) );		   
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 
    	}  			   
	}

	public function testsend()
	{		
	    return Input::get('reserve_id');
	}

	public function post_new_reqcar()
	{		
		//data form ajax
    	$inputData = Input::get('formData');
	    parse_str($inputData, $formFields);  	
	    
		$reserve_id = $formFields[ 'reserve_id' ];		
		
	    if ( $formFields['req_date'] == '' || $formFields['req_name'] == '' || $formFields['department'] == '' || $formFields['location'] == '' || $formFields['detail'] == '' || $formFields['qty'] == '' || $formFields['godate'] == '' || $formFields['gotime_start'] == '' || $formFields['gotime_end'] == '' || $formFields['responsible'] == '' || $formFields['upcar1'] == '' || $formFields['user_req'] == '' )
	    {			
	        return Response::json(array(
		          'fail' => true		                       
		        ));				
	    }
	    else
	    {	    	
	    	if( $formFields[ 'req_date' ] != '' && strlen( str_replace( '-', '', $formFields[ 'req_date' ] ) ) == 8 ){
				$newDate1 		= explode( '-', $formFields[ 'req_date' ] );
				$req_date  		= ($newDate1[2]-543).'-'.$newDate1[1].'-'.$newDate1[0];
			}else{				
				return Response::json(array(
		          'error_date' => true,
		          'msg' => 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล วันที่'		                       
		        )); 
			}

	    	$req_name  		 = $formFields[ 'req_name' ];
	    	$position  		 = $formFields[ 'position' ];
	    	$department  	 = $formFields[ 'department' ];
	    	$location  		 = $formFields[ 'location' ];
	    	$detail  		 = $formFields[ 'detail' ];
	    	$qty  			 = $formFields[ 'qty' ];
	    	
	    	if( $formFields[ 'godate' ] != '' && strlen( str_replace( '-', '', $formFields[ 'godate' ] ) ) == 8 ){
				$newDate2 		= explode( '-', $formFields[ 'godate' ] );
				$godate  		= ($newDate2[2]-543).'-'.$newDate2[1].'-'.$newDate2[0];
			}else{
				return Response::json(array(
		          'error_date' => true,
		          'msg' => 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล วันที่'		                       
		        )); 
			}

	    	$gotime_start  	 = $formFields[ 'gotime_start' ];
	    	$gotime_end  	 = $formFields[ 'gotime_end' ];
	    	$responsible  	 = $formFields[ 'responsible' ];
	    	$writetime  	 = $formFields[ 'writetime' ];
	    	$upcar1  		 = $formFields[ 'upcar1' ];
	    	$upcar2  		 = $formFields[ 'upcar2' ];
	    	$upcar3  		 = $formFields[ 'upcar3' ];
	    	$user_req  		 = $formFields[ 'user_req' ];

	    	if( isset($formFields[ 'car_number' ]) ){
	    		$car_number  	 = $formFields[ 'car_number' ];
	    	}else{
	    		$car_number = '';
	    	}

	    	if( isset($formFields[ 'driver' ]) ){
	    		$driver  		 = $formFields[ 'driver' ];
	        }else{
	        	$driver = '';
	        }
	    	
	    	if( isset($formFields[ 'km_driver' ]) ){
	    		$km_driver  	 = $formFields[ 'km_driver' ];
	    	}else{
	    		$km_driver = '';
	    	}
	    	
	    	if( isset($formFields[ 'driver_control' ]) ){
	    		$driver_control  = $formFields[ 'driver_control' ];
	    	}else{
	    		$driver_control = '';
	    	}
	    	
	    	if( isset($formFields[ 'comment' ]) ){
	    		$comment  	 	 = $formFields[ 'comment' ];
	    	}else{
	    		$comment = '';
	    	}

	    	$regis_date 	 = date('Y-m-d H:i:s');
	    	$regis_user 	 = Session::get('cid');
	    	
	    	if( isset($formFields[ 'k1' ]) ){
		    	if( $formFields[ 'k1' ] == 1 ){
		    		$req_status		 = $formFields[ 'k1' ];
		    	}
	    	}else{
	    		$req_status = 0;
	    	}

	    	if( isset($formFields[ 'k2' ]) ){
		    	if( $formFields[ 'k2' ] == 3 ){
		    		$req_status		 = $formFields[ 'k2' ];
		    	}
	    	}else{
	    		$req_status = 0;
	    	}

	    	$result = DB::insert( 'insert into c_req_cars ( reserve_id, req_date, req_name, position, department, location, detail, qty, godate, gotime_start, gotime_end, responsible, writetime, upcar1, upcar2, upcar3, user_req, car_number,driver, km_driver, driver_control, comment, regis_date, regis_user, req_status  ) values ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )', 
            		array( 
            			  $reserve_id,
            			  $req_date,
            			  $req_name,
            			  $position,
            			  $department,
            			  $location,
            			  $detail,
            			  $qty,
            			  $godate,
            			  $gotime_start,
            			  $gotime_end,
            			  $responsible,
            			  $writetime,
            			  $upcar1,
            			  $upcar2,
            			  $upcar3,
            			  $user_req,
            			  $car_number,
            			  $driver,
            			  $km_driver,
            			  $driver_control,
            			  $comment,
            			  $regis_date,
            			  $regis_user,
            			  $req_status
            	     ));

			if( $result )
			{	
				$r_id = DB::Select( 'select req_car_id  from c_req_cars order by req_car_id desc limit 1 ' );				
				foreach ($r_id as $kr_id) {
					$r_id = $kr_id->req_car_id;				
				}

				//return Redirect::to( 'reqcar' )->with( 'success_message', 'เพิ่มข้อมูลเรียบร้อยแล้ว' ); 
				return Response::json(array(
		          'success' => true,
		          'msg' => 'เพิ่มข้อมูลเรียบร้อยแล้ว',
		          'r_id' => $r_id		         	                       
		        ));     										
			}
			else
			{
				//return Redirect::to( 'reqcar' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล' ); 
				return Response::json(array(
		          'success' => false,
		          'msg' => 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล'				                       
		        ));	
			}  			
	    }

	}



	/**
    * function name : edit_reqcar
    * edit data c_req_cars
    * get
    */
    public function edit_reqcar( $id ) 
    {
    	if ( Session::get('level') == '1' || Session::get('level') == '2' ||Session::get('level') == '3' )
    	{   		
    		$data = DB::table( 'c_req_cars' )	              
	        ->where( 'req_car_id', '=', $id )
	        ->select( '*', DB::raw(' concat( DATE_FORMAT(req_date,"%d-%m"),"-",(year(req_date)+543) ) as req_date')  ,DB::raw(' concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ) as godate') )
	        ->first(); 

    		$dataDep = DB::table('n_department')->get(array( DB::raw('departmentName as value') ) );  
    		$return_array[]='';		
			foreach ($dataDep as $k => $v) {		       
				$return_array[] = $v;    
		    }
		    if( !isset(  $return_array ) ) { $return_array[]=''; }	

		    $dataUser = DB::table('n_datageneral')->get(array( DB::raw('CONCAT(pname,"",fname, " ", lname) as value') ) );  		
			$return_array2[]='';
			foreach ($dataUser as $k2 => $v2) {		       
				$return_array2[] = $v2;    
		    }
		    if( !isset(  $return_array2 ) ) { $return_array2[]=''; }

		    $dataCar = DB::table('c_cars')->get(array( DB::raw('car_number as value') ) ); 
		    $return_array3[]=''; 		
			foreach ($dataCar as $k3 => $v3) {		       
				$return_array3[] = $v3;    
		    }	
		    if( !isset(  $return_array3 ) ) { $return_array3[]=''; }

		    $dataReq = DB::table('c_req_cars')->where( 'req_car_id', '<>', $id )->where( 'req_status', '<>', '2' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->get(array( DB::raw('CONCAT(req_car_id, " ","ฝ่าย:", " ", department, " ", "สถานที่ไป:", " ", location,  " ", "ไปวันที่:", " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ),   " ", "เวลาไป:", " ", gotime_start) as value') ) );  		
			$return_array4[]='';
			foreach ($dataReq as $k4 => $v4) {		       
				$return_array4[] = $v4;    
		    }	
		    if( !isset(  $return_array4 ) ) { $return_array4[]=''; }

		    $dataLocation = DB::table('c_req_cars')->groupBy('location')->get(array( DB::raw('location as value') ) );  		
			foreach ($dataLocation as $k2 => $v2) {		       
				$return_array5[] = $v2;    
		    }
		    if( !isset(  $return_array5 ) ) { $return_array5[]=''; }

		    $dataDetail = DB::table('c_req_cars')->groupBy('detail')->get(array( DB::raw('detail as value') ) );  		
			foreach ($dataDetail as $k2 => $v2) {		       
				$return_array6[] = $v2;    
		    }
		    if( !isset(  $return_array6 ) ) { $return_array6[]=''; }

		    $dataDeposit = DB::Select( ' select * from  c_deposit c1 left join c_req_cars c2 on c2.req_car_id=c1.req_sub_id where c1.req_main_id='.$id.'  ' );		   	

		    return View::make(
		        'req_cars.edit', 
		        array(
		            'data'      	=> $data,
		            'dataDep' 		=> $return_array, 
		            'dataUser'  	=> $return_array2,
		            'dataCar'   	=> $return_array3,
		            'dataReq'   	=> $return_array4,
		            'location'   	=> $return_array5,
		            'detail'   		=> $return_array6,
		            'dataDeposit' 	=> $dataDeposit		                    		                
		            )
		    );
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 
    	}      
    }

     /**
    * function name : post_edit_reqcar
    * edit data c_req_cars
    * post
    */
    public function post_edit_reqcar( $id )
    {
    	if( Session::get('level') == 3 )
    	{	
			$rules = array(
			'req_date'    		=> 'required',
			'req_name'    		=> 'required',
			'department'    	=> 'required',
			'location'    		=> 'required',
			'detail'      		=> 'required',
			'qty'      	  		=> 'required',
			'godate'      	 	=> 'required',
			'gotime_start'   	=> 'required',
			'gotime_end'   		=> 'required',
			'responsible'   	=> 'required',
			'upcar1'   			=> 'required'			
			);
			$messages = array(
				'req_date.required'   	 => '*',
				'req_name.required'   	 => '*',
				'department.required'    => '*',
				'location.required'   	 => '*',
				'detail.required'     	 => '*',
				'qty.required'     		 => '*',
				'godate.required'     	 => '*',
				'gotime_start.required'  => '*',
				'gotime_end.required'  	 => '*',
				'responsible.required'   => '*',
				'upcar1.required'     	 => '*'			
			);	  				  	
		}
		else if( Session::get('level') == 2 )
		{
			$rules = array(								
				'car_number'		=> 'required',
				'driver'			=> 'required',
				'driver_control'	=> 'required'		
			);
			$messages = array(							
				'car_number.required'  	 => '*',
				'driver.required'  	 	 => '*',
				'driver_control.required'  => '*'						
			);	
		}
		else if( Session::get('level') == 1 )
		{
			$rules = array();
			$messages = array();
		}	

		$validator = Validator::make( Input::all(), $rules, $messages );
	    if ( $validator->fails() )
	    {				        
	        return Redirect::to( 'reqcar/edit/'.$id )->withErrors( $validator );        					
	    }
	    else
	    {
	    	if( Session::get('level') == 3 )
	    	{	    		
    			if( Input::get( 'req_date' ) != '' && strlen(str_replace('-', '', Input::get( 'req_date' ))) == 8 ){
				$newDate1 		= explode('-', Input::get( 'req_date' ));
				$req_date  		= ($newDate1[2]-543).'-'.$newDate1[1].'-'.$newDate1[0];
				}else{
					return Redirect::to( 'reqcar' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล วันที่' ); 
				}

		    	$req_name  		 = Input::get( 'req_name' );
		    	$position  		 = Input::get( 'position' );
		    	$department  	 = Input::get( 'department' );
		    	$location  		 = Input::get( 'location' );
		    	$detail  		 = Input::get( 'detail' );

		    	if( Input::get( 'godate' ) != '' && strlen(str_replace('-', '', Input::get( 'godate' ))) == 8 ){
				$newDate2 		= explode('-', Input::get( 'godate' ));
				$godate  		= ($newDate2[2]-543).'-'.$newDate2[1].'-'.$newDate2[0];
				}else{
					return Redirect::to( 'reqcar' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล วันที่' ); 
				}

				$qty  			 = Input::get( 'qty' );	    		    	
		    	$gotime_start  	 = Input::get( 'gotime_start' );
		    	$gotime_end  	 = Input::get( 'gotime_end' );    	
				$writetime  	 = Input::get( 'writetime' ); 
				$upcar1  		 = Input::get( 'upcar1' );
		    	$upcar2  		 = Input::get( 'upcar2' );
		    	$upcar3  		 = Input::get( 'upcar3' );	
		    	$responsible  	 = Input::get( 'responsible' );	
		    	$backtime		 = Input::get( 'backtime' );
		    	$backcomment	 = Input::get( 'backcomment' );		    	   	  				    		
	    	}
	    	
	    	if( Session::get('c1') == 1 )
	    	{	    		
	    		$comment  	 	 = Input::get( 'comment' );	
	    		if( Input::get( 'k1' ) == 1 && Input::get( 'k2' ) == '' )
		    	{
		    		$req_status		 = Input::get( 'k1' );
		    	}
		    	else if( Input::get( 'k1' ) == '' && Input::get( 'k2' ) == 3 )
		    	{
		    		$req_status		 = Input::get( 'k2' );
		    	}
		    	else
		    	{
		    		$req_status = 0;
		    	} 
	    	}
	    	
	    	if( Session::get('c2') == 1 )
	    	{		    		  			    		
		    	$car_number  	 = Input::get( 'car_number' );
		    	$driver  		 = Input::get( 'driver' );
		    	$km_driver  	 = Input::get( 'km_driver' );
		    	$driver_control  = Input::get( 'driver_control' );
		    	$backtime		 = Input::get( 'backtime' );
		    	$backcomment	 = Input::get( 'backcomment' );		
	    	}    	    		    	   	  		    		    	

	    	if( Session::get('level') == 3 )
	    	{	    		
    			$user_data = array(
		    		'req_date' 		=> $req_date,
		    		'req_name' 		=> $req_name,
		    		'position' 		=> $position,
		    		'department' 	=> $department,
		    		'location' 		=> $location,
		    		'detail' 		=> $detail,
		    		'qty' 			=> $qty,
		    		'godate' 		=> $godate,
		    		'gotime_start' 	=> $gotime_start,
		    		'gotime_end' 	=> $gotime_end,
		    		'responsible' 	=> $responsible,
		    		'writetime' 	=> $writetime,
		    		'upcar1' 		=> $upcar1,
		    		'upcar2' 		=> $upcar2,
		    		'upcar3' 		=> $upcar3,
		    		'backtime'		=> $backtime,
		    		'backcomment'	=> $backcomment	    		
	    		); 	    			    	
	    	}
	    	
	    	if( Session::get('c1') == 1 )
	    	{
	    		$user_data = array(		    				    		
		    		'comment' 		=>  $comment,
		    		'req_status' 	=>  $req_status
		    	); 
	    	}
	    	
	    	if( Session::get('c2') == 1 )
	    	{	    		
		    	$user_data = array(		    				    			    				    	
		    		'car_number' 	=> $car_number,
		    		'driver' 		=> $driver,
		    		'km_driver' 	=> $km_driver,
		    		'driver_control' => $driver_control,
		    		'backtime'		 => $backtime,
		    		'backcomment'	=> $backcomment			    	  		
		    	); 
	    	}
	    	
	    	if( Session::get('c1') == 1 && Session::get('c2') == 1 )
	    	{
	    		$user_data = array(		    				    			    				    	
		    		'car_number' 	=> $car_number,
		    		'driver' 		=> $driver,
		    		'km_driver' 	=> $km_driver,
		    		'driver_control' => $driver_control,
		    		'comment' 		=>  $comment,
		    		'req_status' 	=>  $req_status,
		    		'backtime'		=> $backtime,
		    		'backcomment'	=> $backcomment			    	  		
		    	); 
	    	}	    	

	    	if( Session::get('c2') == 1 )
	    	{
		    	$c = DB::Select( ' select godate, gotime_start, gotime_end from c_req_cars where req_car_id='.$id.' ' );
		    	foreach ($c as $ck ) {		    		
		    		$c2 = DB::Select( ' select * from c_req_cars where godate="'.$ck->godate.'" and car_number="'.$car_number.'" and req_car_id <> '.$id.' ' );			    		

		    		if( count($c2) == 4 ){

			    		//return strtotime( $ck->gotime_start );
			    		//foreach ( $c2 as $ck2 ) {
			    		//	if( strtotime( $ck->gotime_end ) >= strtotime( $ck2->gotime_start ) ){
			    				return Redirect::to( 'reqcar' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ รถยนต์มีการจองในวัน 4 รอบแล้ว กรุณาตรวจสอบข้อมูล' ); 
			    		//	}
			    		//}// foreach 2
			    		
			    	}  
		    	}// foreach 1
	    	}

	    	$result = DB::table( 'c_req_cars' )->where( 'req_car_id', '=', $id )->update( $user_data );	        
	        if( $result )
	        {
	        	return Redirect::to( 'reqcar' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'reqcar' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	    	
	    }
    }





     /**
    * function name : resend_req
    * resend data last
    * pos
    */
    public function resend_req()
    {
    	$cid = Session::get('cid');

    	$rid = DB::Select('select req_car_id from c_req_cars where regis_user='.$cid.' order by req_car_id desc limit 1 ');
    	foreach ($rid as $kid) {
    		$id=$kid->req_car_id;
    	}

    	if( !isset($id) ){
    		return Redirect::to('reqcar/create');
    	}

    	if ( Session::get('level') == '1' || Session::get('level') == '2' ||Session::get('level') == '3' )
    	{   		
    		$data = DB::table( 'c_req_cars' )	              
	        ->where( 'req_car_id', '=', $id )
	        ->select( '*', DB::raw(' concat( DATE_FORMAT(req_date,"%d-%m"),"-",(year(req_date)+543) ) as req_date')  ,DB::raw(' concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ) as godate') )
	        ->first(); 

    		$dataDep = DB::table('n_department')->get(array( DB::raw('departmentName as value') ) );  
    		$return_array[]='';		
			foreach ($dataDep as $k => $v) {		       
				$return_array[] = $v;    
		    }
		    if( !isset(  $return_array ) ) { $return_array[]=''; }	

		    $dataUser = DB::table('n_datageneral')->get(array( DB::raw('CONCAT(pname,"",fname, " ", lname) as value') ) );  		
			$return_array2[]='';
			foreach ($dataUser as $k2 => $v2) {		       
				$return_array2[] = $v2;    
		    }
		    if( !isset(  $return_array2 ) ) { $return_array2[]=''; }
		    

		    $dataLocation = DB::table('c_req_cars')->groupBy('location')->get(array( DB::raw('location as value') ) );  		
			foreach ($dataLocation as $k2 => $v2) {		       
				$return_array5[] = $v2;    
		    }
		    if( !isset(  $return_array5 ) ) { $return_array5[]=''; }

		    $dataDetail = DB::table('c_req_cars')->groupBy('detail')->get(array( DB::raw('detail as value') ) );  		
			foreach ($dataDetail as $k2 => $v2) {		       
				$return_array6[] = $v2;    
		    }
		    if( !isset(  $return_array6 ) ) { $return_array6[]=''; }

		   
		    return View::make(
		        'req_cars.resend', 
		        array(
		            'data'      	=> $data,
		            'reserve_id' 	=> 0,
		            'dataDep' 		=> $return_array, 
		            'dataUser'  	=> $return_array2,		           
		            'location'   	=> $return_array5,
		            'detail'   		=> $return_array6		           	                    		                
		            )
		    );
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 
    	}   

    }




     /**
    * function name : add_deposit
    * edit data c_deposit
    * get
    */
    public function add_deposit( $req_main_id, $req_sub_id )
    {
    	$c = DB::Select( ' select * from c_deposit where req_main_id='.$req_main_id.' and req_sub_id='.$req_sub_id.' ' );
    	if( count($c) > 0 )
    	{
    		$data = DB::Select( ' select * from  c_deposit c1 left join c_req_cars c2 on c2.req_car_id=c1.req_sub_id where c1.req_main_id='.$req_main_id.' ' );
    		$t = '<ul class="uk-list uk-list-striped">';
   		
    		foreach ( $data as $k ) {
    			$t .= '<li>';
    			$t .= '<span class="uk-text-warning">ฝ่ายที่ไป:</span> '.$k->department.' <span class="uk-text-warning">สถานที่ไป:</span> '.$k->location.' <span class="uk-text-warning">วันที่ไป:</span> '.$k->godate.' <span class="uk-text-warning">เวลาไป:</span> '.$k->gotime_start.' '.'<span>'.'<a href="#" title="ลบข้อมูล" onclick="del_deposit('.$k->req_car_id.')" > '.'<i class="uk-icon-trash-o"></i>'.' </a>'.'</span>';
    			$t .= '</li>';
    		}

    		$t .='</ul>';
    		return $t;
    	}

    	$result = DB::insert( 'insert into c_deposit ( req_main_id, req_sub_id ) values ( ?, ? )', 
        		array( 
        			  $req_main_id,
        			  $req_sub_id       			 
        	    ));

    	if( $result )
    	{
    		$data = DB::Select( ' select * from  c_deposit c1 left join c_req_cars c2 on c2.req_car_id=c1.req_sub_id where c1.req_main_id='.$req_main_id.' ' );
    		$t = '<ul class="uk-list uk-list-striped">';
   		
    		foreach ( $data as $k ) {
    			$t .= '<li>';
    			$t .= '<span class="uk-text-warning">ฝ่ายที่ไป:</span> '.$k->department.' <span class="uk-text-warning">สถานที่ไป:</span> '.$k->location.' <span class="uk-text-warning">วันที่ไป:</span> '.$k->godate.' <span class="uk-text-warning">เวลาไป:</span> '.$k->gotime_start.' '.'<span>'.'<a href="#" title="ลบข้อมูล" onclick="del_deposit('.$k->req_car_id.')" > '.'<i class="uk-icon-trash-o"></i>'.' </a>'.'</span>';
    			$t .= '</li>';
    		}

    		$t .='</ul>';
    		return $t;
    	}
    	else
    	{
    		return 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
    	}
    }

    public function del_deposit( $id )
    {
    	$result = Deposit::where( 'req_sub_id', $id )->delete();

	   if( $result )
        {        	
        	$data = DB::Select( ' select * from  c_deposit c1 left join c_req_cars c2 on c2.req_car_id=c1.req_sub_id where c1.req_main_id='.$id.'  ' );
    		$t = '<ul class="uk-list uk-list-striped">';
   		
    		foreach ( $data as $k ) {
    			$t .= '<li>';
    			$t .= '<span class="uk-text-warning">ฝ่ายที่ไป:</span> '.$k->department.' <span class="uk-text-warning">สถานที่ไป:</span> '.$k->location.' <span class="uk-text-warning">วันที่ไป:</span> '.$k->godate.' <span class="uk-text-warning">เวลาไป:</span> '.$k->gotime_start.' '.'<span>'.'<a href="#" title="ลบข้อมูล" onclick="del_deposit('.$k->req_car_id.')" > '.'<i class="uk-icon-trash-o"></i>'.' </a>'.'</span>';
    			$t .= '</li>';
    		}

    		$t .='</ul>';
    		return $t;
        }      
    }

     /**
    * function name : del_reqcar
    * edit data c_req_cars
    * get
    */
    public function del_reqcar( $id ) 
    {
    	if ( Session::get('level') == '1' || Session::get('level') == '2' ||Session::get('level') == '3' )
    	{    	    		
           $result = Reqcar::where( 'req_car_id', $id )->delete();

		   if( $result )
	        {        	
	        	return Redirect::to( 'reqcar' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'reqcar' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }   
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 
    	}      
    }

    public function cancle_reqcar( $id ) 
    {
    	if ( Session::get('level') == '1' || Session::get('level') == '3' )
    	{    	    		
           $user_data = array( 'req_status' => '2' );

           $result = DB::table( 'c_req_cars' )->where( 'req_car_id', '=', $id )->update( $user_data );	 

		   if( $result )
	        {        	
	        	return Redirect::to( 'reqcar' )->with( 'success_message', 'ยกเลิกข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'reqcar' )->with( 'error_message', 'ไม่สามารถยกเลิกข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }   
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 
    	}      
    }

     private function get_monthyearThai( $date )
	{
		$y = date("Y", strtotime($date));
		$m = date("m", strtotime($date));
		$d = date("d", strtotime($date));

		$thaiweek=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัส","วันศุกร์","วันเสาร์");
     	$thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","      มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    	
     	return $d.' '.$thaimonth[$m-1].' '.( $y+543 );
	}




	/*
	*
	* ใบขอรถแบบใหม่ A5
	*
	*/
    public function  view_reqcar( $id )
    {
    	if ( Session::get('level') == '1' || Session::get('level') == '2' ||Session::get('level') == '3' )
    	{
    		$sql  = ' select * from c_req_cars ';
    		$sql .= ' where req_car_id ='.$id.' ';

    		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		    $pdf->SetPrintHeader(false);
		    $pdf->SetPrintFooter(false);			      		   		   
			 
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			 
			// set margins
			$pdf->SetMargins(1, 1, 1);

		    $pdf->AddPage(); 		    
		    
			$pdf->SetFont('angsanaupc','B',13,'',true);
			$pdf->SetXY(15, 4);
			$pdf->MultiCell(180, 0, 'ใบขออนุญาตใช้รถยนต์โรงพยาบาลโนนไทย', 0, 'C', 0, 1, '', '', true);
			
			$result = DB::select( $sql );		
			foreach ( $result as $key ) 
			{
				$pdf->SetFont('angsanaupc','B',11,'',true);				
				$pdf->SetXY(125, 5);
				$pdf->MultiCell(80, 0, 'วันที่.......................................เวลา........................น.', 0, 'R', 0, 1, '', '', true);				
				$pdf->SetXY(150, 5);
				$pdf->MultiCell(38, 0, ($key->req_date=='0000-00-00')?'':$this->get_monthyearThai( $key->req_date ), 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(184, 5);
				$pdf->MultiCell(20, 0,  $key->writetime , 0, 'C', 0, 1, '', '', true);
								
				$pdf->SetXY(3, 5);
				$pdf->MultiCell(70, 0, 'เรียน   ผู้อำนวยการโรงพยาบาลโนนไทย', 0, 'L', 0, 1, '', '', true);
				
				$pdf->SetFont('angsanaupc','',11,'',true);

				$pdf->SetXY(3, 11);
				$pdf->MultiCell(200, 0, 'ข้าพเจ้า.............................................................ตำแหน่ง................................................................................................ฝ่าย.......................................................................................................................', 0, 'L', 0, 1, '', '', true);				
				$pdf->SetXY(12, 11);
				$pdf->MultiCell(45, 0, $key->req_name, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(60, 11);
				$pdf->MultiCell(57, 0, $key->position, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(125, 11);
				$pdf->MultiCell(50, 0, $key->department, 0, 'L', 0, 1, '', '', true);
				
				$pdf->SetXY(3, 17);
				$pdf->MultiCell(200, 0, 'ขออนุญาตใช้รถไป.....................................................................................................................................................................................................................................................................................', 0, 'L', 0, 1, '', '', true);				
				$pdf->SetXY(26, 17);
				$pdf->MultiCell(180, 0, $key->location, 0, 'L', 0, 1, '', '', true);
				
				$pdf->SetXY(3, 23);
				$pdf->MultiCell(201, 0, 'เพื่อ.............................................................................................................................................................................................................................................................................................................', 0, 'L', 0, 1, '', '', true);			
				$pdf->SetXY(7, 23);
				$pdf->MultiCell(170, 0, $key->detail, 0, 'L', 0, 1, '', '', true);				
				
				$pdf->SetXY(3, 30);
				$pdf->MultiCell(181, 0, 'มีคนนั่ง................คน  ในวันที่.....................................................................  เวลา...........................................น.', 0, 'L', 0, 1, '', '', true);				
				$pdf->SetXY(6, 30);
				$pdf->MultiCell(20, 0, $key->qty, 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(20, 30);
				$pdf->MultiCell(70, 0, ($key->godate=='0000-00-00')?'':$this->get_monthyearThai( $key->godate ), 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(82, 30);
				$pdf->MultiCell(30, 0, $key->gotime_start, 0, 'C', 0, 1, '', '', true);
				
				$pdf->SetXY(3, 37);
				$pdf->MultiCell(181, 0, 'ถึงเวลา......................น.  โดยมี.....................................................................ผู้รับผิดชอบ', 0, 'L', 0, 1, '', '', true);				
				$pdf->SetXY(5, 37);
				$pdf->MultiCell(24, 0, $key->gotime_end, 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(17, 37);
				$pdf->MultiCell(62, 0, $key->responsible, 0, 'C', 0, 1, '', '', true);
				
				
				$pdf->SetFont('angsanaupc','',12,'',true);
				$pdf->SetXY(3, 45);
				$pdf->MultiCell(70, 0, 'ระบุสถานที่ขึ้นรถ', 0, 'L', 0, 1, '', '', true);				
				$pdf->SetXY(3, 50);
				$pdf->MultiCell(100, 0, '1....................................................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(10, 50);
				$pdf->MultiCell(70, 0, $key->upcar1, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(3, 55);
				$pdf->MultiCell(100, 0, '2....................................................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(10, 55);
				$pdf->MultiCell(70, 0, $key->upcar2, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(3, 60);
				$pdf->MultiCell(100, 0, '3....................................................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(10, 60);
				$pdf->MultiCell(70, 0, $key->upcar3, 0, 'L', 0, 1, '', '', true);

				$pdf->SetFont('angsanaupc','',12,'',true);
				$pdf->SetXY(4, 71);
				$pdf->MultiCell(100, 0, '(ลงชื่อ)...............................................................ผู้ขออนุญาต', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(10, 76);
				$pdf->MultiCell(50, 0, '(                                                                 )', 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(7, 76);
				$pdf->MultiCell(50, 0, $key->user_req, 0, 'C', 0, 1, '', '', true);		
				$pdf->SetXY(4, 91);
				$pdf->MultiCell(100, 0, '(ลงชื่อ)...............................................................หัวหน้าฝ่าย', 0, 'L', 0, 1, '', '', true);				
				$pdf->SetXY(10, 96);
				$pdf->MultiCell(50, 0, '(                                                                 )', 0, 'C', 0, 1, '', '', true);
				
				$h_re = DB::Select( 'select * from n_department_header where departmentName="'.$key->department.'" ' );
				foreach ($h_re as $k_h) {
					$header_name = $k_h->header_name;
				}
				if( !isset($header_name) ){ $header_name=''; }

				$pdf->SetXY(7, 96);	
				$pdf->MultiCell(50, 0, $header_name, 0, 'C', 0, 1, '', '', true);	

				$pdf->SetFont('angsanaupc','',11,'',true);
				$pdf->SetXY(90, 46);
				$pdf->MultiCell(180, 0, 'ความเห็นของผู้ควบคุมรถยนต์ เห็นควรอนุญาต โดยใช้รถยนต์หมายเลขทะเบียน..................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(167, 46);
				$pdf->MultiCell(45, 0, $key->car_number, 0, 'C', 0, 1, '', '', true);	
				$pdf->SetXY(90, 53);
				$pdf->MultiCell(180, 0, 'และให้................................................................เป็นพนักงานขับรถยนต์', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(98, 53);
				$pdf->MultiCell(73, 0, $key->driver, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(90, 60);
				$pdf->MultiCell(180, 0, 'ระยะทาง.................................กิโลเมตร', 0, 'L', 0, 1, '', '', true);				
				$pdf->SetXY(93, 60);
				$pdf->MultiCell(24, 0, $key->km_driver, 0, 'C', 0, 1, '', '', true);

				$pdf->SetFont('angsanaupc','',11,'',true);
				$pdf->SetXY(80, 70);
				$pdf->MultiCell(180, 0, '(ลงชื่อ)...............................................................ผู้ควบคุม', 0, 'C', 0, 1, '', '', true);				
				$pdf->SetXY(80, 75);
				$pdf->MultiCell(180, 0, '(                                                     )', 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(80, 75);
				$pdf->MultiCell(180, 0, $key->driver_control, 0, 'C', 0, 1, '', '', true);				

				$pdf->SetXY(93, 87);
				$pdf->MultiCell(180, 0, 'ความเห็นของผู้มีอำนาจสั่งใช้รถยนต์..................................................................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(93, 92);
				$pdf->MultiCell(180, 0, '............................................................................................................................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(133, 87);
				$pdf->MultiCell(65, 0, $key->comment, 0, 'L', 0, 1, '', '', true);
				
				$pdf->SetFont('angsanaupc','',12,'',true);
				$pdf->SetXY(80, 110);
				$pdf->MultiCell(180, 0, '(ลงชื่อ).................................................................ผู้อนุมัติ', 0, 'C', 0, 1, '', '', true);			
				$pdf->SetXY(80, 114);
				$pdf->MultiCell(180, 0, '(นายพิศิษฐ์ สมผดุง)', 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(80, 119);
				$pdf->MultiCell(180, 0, 'ทันตแพทย์เชี่ยวชาญ ปฎิบัติราชการแทน', 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(80, 123);
				$pdf->MultiCell(180, 0, 'ผู้อำนวยการโรงพยาบาลโนนไทย', 0, 'C', 0, 1, '', '', true);

			}

			$filename = storage_path() . '/report_reqcar.pdf';		   
		    $contents = $pdf->output($filename, 'I');
			$headers = array(
			    'Content-Type' => 'application/pdf',
			);
			return Response::make($contents, 200, $headers);
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 	
    	}  
    }


}

?>