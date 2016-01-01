<?php
/**
 * Create ReserveController for car
 * version 1.0
 * create by ThemeSanasang
*/

class ReserveController extends BaseController {

	/**
	 * function name : home
	 * view page reserve car
	 * add data to grid
	 * get
	*/
	public function home()
	{
		if ( Session::get('level') == '1' || Session::get('level') == '2' )
    	{	
    		$data = DB::table('c_reserve_cars')
    				->select( '*', DB::raw('(select count(*) from c_req_cars where reserve_id=c_reserve_cars.reserve_id) as reqcar') )
    				->orderBy('reserve_id','desc')->paginate( 10 );	

	    	return View::make( 'reserve_cars.index', array('data' => $data) );	
    	}
    	else if( Session::get('level') == '3' )
    	{			
	    	$data = DB::table('c_reserve_cars')
    				->select( '*', DB::raw('(select count(*) from c_req_cars where reserve_id=c_reserve_cars.reserve_id) as reqcar') )
    				->where( 'user_regis', '=', Session::get('cid') )->orderBy( 'reserve_id','desc' )
    				->orderBy('reserve_id','desc')->paginate( 10 );	

	    	return View::make( 'reserve_cars.index', array('data' => $data) );	
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 
    	}     						    		 					
	}

	/**
    * function name : post_search_reserve
    * search data c_reserve_cars
    * post
    */
    public function post_search_reserve()
    {   		  
	   if ( Session::get('level') == '1' || Session::get('level') == '2' )
		{
			if( Input::get( 'search' ) != '' )
			{
				$search  = Input::get( 'search' );	    		    

				$data = DB::table( 'c_reserve_cars' )	           
		         ->where( 'department', 'like', "%$search%" )
		         ->orWhere( 'title', 'like', "%$search%" )	 
		         ->orWhere( 'regis_user_req', 'like', "%$search%" )	     
		         ->orderBy( 'reserve_id', 'desc')
		         ->paginate( 10 );	 		    
		     
				//view page create
			    return View::make( 'reserve_cars.index',  array( 'data' => $data ) );	
			}
			else
			{
				$data = DB::table('c_reserve_cars')
    				->select( '*', DB::raw('(select count(*) from c_req_cars where reserve_id=c_reserve_cars.reserve_id) as reqcar') )
    				->orderBy('reserve_id','desc')->paginate( 10 );	

	    		return View::make( 'reserve_cars.index', array('data' => $data) );	
			}		
		}
		else if( Session::get('level') == '3' )
		{
			if( Input::get( 'search' ) != '' )
			{
				$search  = Input::get( 'search' );	    		    

				$data = DB::table( 'c_reserve_cars' )	           	         
		         ->where( 'regis_user_req', '=', Session::get('cid') )          	         
		         ->where(function($query) use ( $search )
		            {
		                $query->where( 'department', 'like', "%$search%" )
						      ->orWhere( 'title', 'like', "%$search%" )	 
						      ->orWhere( 'regis_user_req', 'like', "%$search%" );	 					     
		            })   
		         ->orderBy( 'reserve_id', 'desc')
		         ->paginate( 10 );	 		    
		     
				//view page create
			    return View::make( 'reserve_cars.index',  array( 'data' => $data ) );	
			}
			else
			{
				$data = DB::table('c_reserve_cars')
    				->select( '*', DB::raw('(select count(*) from c_req_cars where reserve_id=c_reserve_cars.reserve_id) as reqcar') )
    				->where( 'user_regis', '=', Session::get('cid') )->orderBy( 'reserve_id','desc' )
    				->orderBy('reserve_id','desc')->paginate( 10 );	

	    		return View::make( 'reserve_cars.index', array('data' => $data) );	
			}		
		}	
		else
		{
			$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 			  		
		}	
    }


	public function create_reserve()
	{
		if ( Session::get('level') == '1' || Session::get('level') == '3' )
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

		    $dataLocation = DB::table('c_reserve_cars')->groupBy('location')->get(array( DB::raw('location as value') ) );  		
			foreach ($dataLocation as $k2 => $v2) {		       
				$return_array3[] = $v2;    
		    }
		    if( !isset(  $return_array3 ) ) { $return_array3[]=''; }

		    $datainstitution = DB::table('c_reserve_cars')->groupBy('institution')->get(array( DB::raw('institution as value') ) );  		
			foreach ($datainstitution as $k2 => $v2) {		       
				$return_array4[] = $v2;    
		    }
		    if( !isset(  $return_array4 ) ) { $return_array4[]=''; }

		    $datatitle = DB::table('c_reserve_cars')->groupBy('title')->get(array( DB::raw('title as value') ) );  		
			foreach ($datatitle as $k2 => $v2) {		       
				$return_array5[] = $v2;    
		    }
		    if( !isset(  $return_array5 ) ) { $return_array5[]=''; }

		   
			return View::make( 'reserve_cars.create', array('dataDep' => $return_array, 'dataUser' => $return_array2, 'dataLocation' => $return_array3, 'datainstitution' => $return_array4, 'datatitle' => $return_array5) );	
    	}
    	else
    	{
    		$data = DB::table( 'c_req_cars' )->where( 'godate', '>=', date('Y-m-d') )->orderBy( 'godate','asc' )->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); 	
    	}  			   
	}



	public function post_new_reserve()
	{
		//data form ajax
    	$inputData = Input::get('formData');
	    parse_str($inputData, $formFields);  
		  
	    
	    if ( $formFields['fb1'] == '' || $formFields['fb4'] == '' || $formFields['fb8'] == '' || $formFields['fb9'] == '' || $formFields['fb10'] == '' || $formFields['fb13'] == '' || $formFields['fb14'] == '' || $formFields['fb19'] == '' )
	    {				        
			return Response::json(array(
		          'fail' => true		                       
		        ));					
	    }
	    else
	    {   	    		       
	    	$department  	= $formFields[ 'fb1' ];	
			$num_nm  		= $formFields[ 'fb2' ];

			if( $formFields[ 'fb3' ] != '' && strlen( str_replace( '-', '', $formFields[ 'fb3' ] ) ) == 8 ){
				$newDate1 		= explode( '-', $formFields[ 'fb3' ] );
				$date_nm  		= ($newDate1[2]-543).'-'.$newDate1[1].'-'.$newDate1[0];
			}else{
				$date_nm = '';
			}

			$req_name  		= $formFields[ 'fb4' ];  
			$position  		= $formFields[ 'fb5' ]; 

			$together_n  	= $formFields[ 'fb6' ]; 
			$together_p  	= $formFields[ 'fb7' ];

			$location  		= $formFields[ 'fb8' ];
			$institution  	= $formFields[ 'fb9' ];
			$title  		= $formFields[ 'fb10' ];
			$ref_book_number  	= $formFields[ 'fb11' ];

			if( $formFields[ 'fb12' ] != '' && strlen( str_replace( '-', '', $formFields[ 'fb12' ] ) ) == 8 ){
				$newDate4 		= explode('-', $formFields[ 'fb12' ] );
				$ref_book_date  = ($newDate4[2]-543).'-'.$newDate4[1].'-'.$newDate4[0];
			}else{
				$ref_book_date = '';
			}	

			if( $formFields[ 'fb13' ] != '' && strlen( str_replace( '-', '', $formFields[ 'fb13' ] ) ) == 8 ){
				$newDate2 		= explode( '-', $formFields[ 'fb13' ] );		
				$fb13  	= ($newDate2[2]-543).'-'.$newDate2[1].'-'.$newDate2[0];
			}else{
				return Response::json(array(
		          'error_date' => true,
		          'msg' => 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล วันที่'		                       
		        )); 
			}

			if( $formFields[ 'fb14' ] != '' && strlen( str_replace( '-', '', $formFields[ 'fb14' ] ) ) == 8 ){
				$newDate3 		= explode( '-', $formFields[ 'fb14' ] );		
				$fb14  		= ($newDate3[2]-543).'-'.$newDate3[1].'-'.$newDate3[0];
			}else{								
				return Response::json(array(
		          'error_date' => true,
		          'msg' => 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล วันที่'		                       
		        )); 
			}

			$allday  		= $formFields[ 'fb15' ];
			
			if( isset( $formFields[ 'c2' ] ) ){
				if( $formFields[ 'c2' ] == 1 ){
					$usecar2_car_number = $formFields[ 'fb16' ];
					$usecar2_km_money  	= $formFields[ 'fb17' ];
				}else{
					$usecar2_car_number = '';
					$usecar2_km_money = '';
				}
			}else{
				$usecar2_car_number= '';
				$usecar2_km_money = '';
			}

			if( isset( $formFields[ 'c3' ] ) ){
				if( $formFields[ 'c3' ] == 1 ){
					$usecar3_detail  	= $formFields[ 'fb18' ];
				}else{
					$usecar3_detail = '';
				}
			}else{
				$usecar3_detail = '';
			}

			$regis_user_req  	= $formFields[ 'fb19' ];

			if( isset( $formFields[ 'c1' ] ) ){
				$usecar1 = $formFields[ 'c1' ];
			}else{
				$usecar1 = '';
			}

			if( isset( $formFields[ 'c2' ] ) ){
				$usecar2 = $formFields[ 'c2' ];
			}else{
				$usecar2 = '';
			}

			if( isset( $formFields[ 'c3' ] ) ){
				$usecar3 = $formFields[ 'c3' ];
			}else{
				$usecar3 = '';
			}

			if( isset( $formFields[ 'c4' ] ) ){
				$daytrue = $formFields[ 'c4' ];
			}else{
				$daytrue = '';
			}

			if( isset( $formFields[ 'c5' ] ) ){
				$dayflase = $formFields[ 'c5' ];
			}else{
				$dayflase = '';
			}

			$reserve_date = date('Y-m-d H:i:s');
			$user_regis = Session::get('cid');

	    	$d = DB::Select( ' select max(together_id) as m from c_together ' );
	    	$together_id=0;
	    	foreach ($d as $dk) {
	    		$together_id = $dk->m;
	    	}

	    	$a = array_filter($together_n);
	    	if( $together_id == '' )
	    	{
	    		if( empty( $a ) == true )
	    		{
	    			$together_id = 0;
	    		}
	    		else
	    		{
					$together_id = 1;
	    		}	    		
	    	}
	    	else
	    	{
	    		if( empty( $a ) == true )
	    		{
					$together_id = 0;
	    		}
	    		else
	    		{
	    			$together_id = $together_id+1;
	    		}	    		
	    	}	    		

	    	 $result = DB::insert( 'insert into c_reserve_cars ( department, num_nm, date_nm, req_name, position, together_id, location, institution, title, ref_book_number, ref_book_date, startdate, enddate, allday, usecar1, usecar2, usecar2_car_number, usecar2_km_money, usecar3, usecar3_detail, regis_user_req, daytrue, dayflase, reserve_date, user_regis ) values ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )', 
            		array( 
            			  $department,
            			  $num_nm,
            			  $date_nm,
            			  $req_name,
            			  $position,
            			  $together_id,
            			  $location,
            			  $institution,
            			  $title,
            			  $ref_book_number,
            			  $ref_book_date,
            			  $fb13,
            			  $fb14,
            			  $allday,
            			  $usecar1,
            			  $usecar2,
            			  $usecar2_car_number,
            			  $usecar2_km_money,
            			  $usecar3,
            			  $usecar3_detail,
            			  $regis_user_req,
            			  $daytrue,
            			  $dayflase,
            			  $reserve_date,
            			  $user_regis 
            	     ));

			if( $result )
			{
				$i=0;
				foreach ($together_n as $k) {
					
					if( $k  != '' )
					{						
						$result2 = DB::insert( 'insert into c_together ( together_id, req_name, position ) values ( ?, ?, ? )', 
	            		array( 
	            			  $together_id,
	            			  $k,           			
	            			  $together_p[$i] 
	            	     ));
					}	

					$i++;		
				}	

				$r_id = DB::Select( 'select reserve_id, usecar1  from c_reserve_cars order by reserve_id desc limit 1 ' );
				$r_car = 0;
				foreach ($r_id as $kr_id) {
					$r_id = $kr_id->reserve_id;
					$r_car = $kr_id->usecar1;
				}
				
				//return Redirect::to( 'reserve' )->with( 'success_message', 'เพิ่มข้อมูลเรียบร้อยแล้ว' ); 
				return Response::json(array(
		          'success' => true,
		          'msg' => 'เพิ่มข้อมูลเรียบร้อยแล้ว',
		          'reserve_id' => $r_id,
		          'usecar1' => $r_car 		                       
		        ));   										
			}
			else
			{
				//return Redirect::to( 'reserve' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล' ); 
				return Response::json(array(
		          'success' => false,
		          'msg' => 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล'				                       
		        ));	
			}
				    	
	    }	
	}

	/**
    * function name : edit_reserve
    * edit data c_reserve_cars
    * get
    */
    public function edit_reserve( $id ) 
    {
    	if ( Session::get('level') == '1' || Session::get('level') == '3' )
    	{   		
    		$data = DB::table( 'c_reserve_cars' )	              
	        ->where( 'reserve_id', '=', $id )
	        ->select( '*', DB::raw(' concat( DATE_FORMAT(date_nm,"%d-%m"),"-",(year(date_nm)+543) ) as date_nm')  ,DB::raw(' concat( DATE_FORMAT(ref_book_date,"%d-%m"),"-",(year(ref_book_date)+543) ) as ref_book_date') ,DB::raw(' concat( DATE_FORMAT(startdate,"%d-%m"),"-",(year(startdate)+543) ) as startdate'),  DB::raw(' concat( DATE_FORMAT(enddate,"%d-%m"),"-",(year(enddate)+543) ) as enddate') )
	        ->first(); 

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

		    $user = DB::Select( ' select * from c_reserve_cars c inner join c_together t on t.together_id=c.together_id where c.reserve_id='.$id.'  ' );

		    return View::make(
		        'reserve_cars.edit', 
		        array(
		            'data'      => $data,
		            'dataDep' 	=> $return_array, 
		            'dataUser'  => $return_array2,
		            'user'		=> $user	          		                
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
    * function name : post_edit_reserve
    * edit data c_reserve_cars
    * post
    */
    public function post_edit_reserve( $id ) 
    {
    	$rules = array(
			'fb1'    => 'required',			
			'fb8'    => 'required',
			'fb9'    => 'required',
			'fb10'   => 'required',
			'fb13'   => 'required',
			'fb14'   => 'required'			
		);
		$messages = array(
			'fb1.required'    => '*',			
			'fb8.required'    => '*',
			'fb9.required'    => '*',
			'fb10.required'   => '*',
			'fb13.required'   => '*',
			'fb14.required'   => '*'					
		);
  
	    $validator = Validator::make( Input::all(), $rules, $messages );
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'reserve/edit/'.$id )->withErrors( $validator );
	    }
	    else
	    {

	    	$department  	= Input::get( 'fb1' );	
			$num_nm  		= Input::get( 'fb2' );

			if( Input::get( 'fb3' ) != '' && strlen(str_replace('-', '', Input::get( 'fb3' ))) == 8 ){
				$newDate1 		= explode('-', Input::get( 'fb3' ));
				$date_nm  		= ($newDate1[2]-543).'-'.$newDate1[1].'-'.$newDate1[0];
			}else{
				$date_nm = '';
			}			

			$location  		= Input::get( 'fb8' );
			$institution  	= Input::get( 'fb9' );
			$title  		= Input::get( 'fb10' );
			$ref_book_number  	= Input::get( 'fb11' );

			if( Input::get( 'fb12' ) != '' && strlen(str_replace('-', '', Input::get( 'fb12' ))) == 8 ){
				$newDate4 		= explode('-', Input::get( 'fb12' ));
				$ref_book_date  = ($newDate4[2]-543).'-'.$newDate4[1].'-'.$newDate4[0];
			}else{
				$ref_book_date = '';
			}	

			if( Input::get( 'fb13' ) != '' && strlen(str_replace('-', '', Input::get( 'fb13' ))) == 8 ){
				$newDate2 		= explode('-', Input::get( 'fb13' ));		
				$fb13  	= ($newDate2[2]-543).'-'.$newDate2[1].'-'.$newDate2[0];
			}else{
				return Redirect::to( 'reserve' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล วันที่' ); 
			}

			if( Input::get( 'fb14' ) != '' && strlen(str_replace('-', '', Input::get( 'fb14' ))) == 8 ){
				$newDate3 		= explode('-', Input::get( 'fb14' ));		
				$fb14  		= ($newDate3[2]-543).'-'.$newDate3[1].'-'.$newDate3[0];
			}else{					
				return Redirect::to( 'reserve' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูล วันที่' ); 
			}

			$allday  		= Input::get( 'fb15' );
			
			if( Input::get( 'c2' ) == 1 ){
				$usecar2_car_number = Input::get( 'fb16' );
				$usecar2_km_money  	= Input::get( 'fb17' );
			}else{
				$usecar2_car_number='';
				$usecar2_km_money='';
			}
		
			if( Input::get( 'c3' ) == 1 ){
				$usecar3_detail  	= Input::get( 'fb18' );
			}else{
				$usecar3_detail='';
			}
		
			$usecar1  		= Input::get( 'c1' );
			$usecar2  		= Input::get( 'c2' );
			$usecar3  		= Input::get( 'c3' );

			$daytrue  		= Input::get( 'c4' );
			$dayflase  		= Input::get( 'c5' );

			$reserve_date = date('Y-m-d');		

			$user_data = array(
            	'department' 		 => $department,
            	'num_nm' 		 	 => $num_nm,
            	'date_nm' 		 	 => $date_nm,	
            	'location' 		 	 => $location,
            	'institution' 		 => $institution,
            	'title' 		 	 => $title,	
            	'ref_book_number' 	 => $ref_book_number,	
            	'ref_book_date' 	 => $ref_book_date, 
            	'startdate' 	 	 => $fb13,
            	'enddate' 	 	 	 => $fb14, 
            	'allday' 	 	 	 => $allday, 
            	'usecar1' 	 	 	 => $usecar1, 
            	'usecar2' 	 	 	 => $usecar2, 
            	'usecar2_car_number' => $usecar2_car_number,
            	'usecar2_km_money' 	 => $usecar2_km_money, 
            	'usecar3' 	 		 => $usecar3,
            	'usecar3_detail' 	 => $usecar3_detail, 
            	'daytrue' 	 		 => $daytrue, 
            	'dayflase' 	 		 => $dayflase, 
            	'reserve_date' 	 	 => $reserve_date           	            	                       
        	);  
      
	        //update user details
	        $result = DB::table( 'c_reserve_cars' )->where( 'reserve_id', '=', $id )->update( $user_data );	        
	        if( $result )
	        {
	        	return Redirect::to( 'reserve' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'reserve' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	 

	    }
    }

     /**
    * function name : del_reserve
    * edit data c_reserve_cars
    * get
    */
    public function del_reserve( $id ) 
    {
    	if ( Session::get('level') == '1' || Session::get('level') == '3' )
    	{    	
    		$k = DB::Select( ' select together_id from c_reserve_cars where reserve_id='.$id.' ' );
    		foreach ($k as $d) {
    			$k=$d->together_id;
    		}

           $result = Reserve::where( 'reserve_id', $id )->delete();

		   if( $result )
	        {
	        	Together::where( 'together_id', $k )->delete();
	        	return Redirect::to( 'reserve' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'reserve' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
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


    public function view_reserve( $id )
    {
    	if ( Session::get('level') == '1' || Session::get('level') == '3' )
    	{  

    		$sql  = ' select * from c_reserve_cars ';
    		$sql .= ' where reserve_id ='.$id.' ';

    		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		    $pdf->SetPrintHeader(false);
		    $pdf->SetPrintFooter(false);	
			 
			// set header and footer fonts
			$pdf->setHeaderFont(array('angsanaupc','',PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array('angsanaupc','',PDF_FONT_SIZE_DATA));
			 
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			 
			// set margins
			$pdf->SetMargins(10, 10, 10);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	 
			$pdf->SetFont('angsanaupc','',14,'',true);

		    $pdf->AddPage();   

		    $pdf->SetXY(10, 10);		   
		    $pdf->Image('images/krut.jpg', '', '', 20, 20, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
			
			$pdf->SetFont('angsanaupc','B',18,'',true);
			$pdf->SetXY(75, 20);
			$pdf->MultiCell(60, 0, 'บันทึกข้อความ', 0, 'C', 0, 1, '', '', true);

			$result = DB::select( $sql );		
			foreach ( $result as $key ) 
			{

				$pdf->SetFont('angsanaupc','B',14,'',true);
				$pdf->SetXY(10, 32);
				$pdf->MultiCell(25, 0, 'ส่วนราชการ', 0, 'L', 0, 1, '', '', true);

				//$pdf->SetFont('angsanaupc','',14,'',true);
				$pdf->SetXY(35, 32);
				$pdf->MultiCell(160, 0, 'ฝ่าย........................................................................................โรงพยาบาลโนนไทย อำเภอโนนไทย จังหวัดนครราชสีมา', 0, 'L', 0, 1, '', '', true);				
				$pdf->SetXY(44, 31);
				$pdf->MultiCell(65, 0, $key->department, 0, 'L', 0, 1, '', '', true);

				//$pdf->SetFont('angsanaupc','B',14,'',true);
				$pdf->SetXY(10, 40);
				$pdf->MultiCell(10, 0, 'ที่', 0, 'L', 0, 1, '', '', true);
				//$pdf->SetFont('angsanaupc','B',14,'',true);
				$pdf->SetXY(20, 40);
				$pdf->MultiCell(170, 0, 'นม 0032.301/...........................................วันที่.............................................................................', 0, 'L', 0, 1, '', '', true);
			  	$pdf->SetXY(43, 39);
				$pdf->MultiCell(31, 0, $key->num_nm, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(83, 39);
				$pdf->MultiCell(44, 0, ($key->date_nm=='0000-00-00')?'':$this->get_monthyearThai( $key->date_nm ), 0, 'L', 0, 1, '', '', true);

				//$pdf->SetFont('angsanaupc','B',14,'',true);
			  	$pdf->SetXY(10, 48);
				$pdf->MultiCell(10, 0, 'เรื่อง', 0, 'L', 0, 1, '', '', true);				
				//$pdf->SetFont('angsanaupc','B',14,'',true);
				$pdf->SetXY(20, 48);
				$pdf->MultiCell(60, 0, ' ขออนุมัติไปราชการ', 0, 'L', 0, 1, '', '', true);

				$style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '', 'phase' => 5, 'color' => array(0, 0, 0));
				$pdf->Line(10, 57, 195, 57, $style);

				//$pdf->SetFont('angsanaupc','B',14,'',true);
				$pdf->SetXY(10, 62);
				$pdf->MultiCell(70, 0, 'เรียน ผู้อำนวยการโรงพยาบาลโนนไทย', 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(20, 72);
				$pdf->MultiCell(176, 0, 'ด้วยข้าพเจ้า..........................................................................ตำแหน่ง...........................................................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(39, 71);
				$pdf->MultiCell(55, 0, $key->req_name, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(108, 71);
				$pdf->MultiCell(70, 0, $key->position, 0, 'L', 0, 1, '', '', true);

				$sql2 = ' select * from c_together where together_id='.$key->together_id.' ';
				$result2 = DB::select( $sql2 );	
				$n=0;
				$r=0;	

				$pdf->SetXY(10, 80);
				$pdf->MultiCell(20, 0, 'พร้อมด้วย', 0, 'L', 0, 1, '', '', true);

				if( count($result2) > 0 )
				{
					foreach ( $result2 as $key2 ) 
					{
						$n++;
						$r = $r+7;						
						$pdf->SetXY(20, 84+$r);
						$pdf->MultiCell(176, 0, $n.'.................................................................................ตำแหน่ง.....................................................................................................................', 0, 'L', 0, 1, '', '', true);	
						$pdf->SetXY(25, 83+$r);
						$pdf->MultiCell(60, 0, $key2->req_name, 0, 'L', 0, 1, '', '', true);
						$pdf->SetXY(100, 83+$r);
						$pdf->MultiCell(90, 0, $key2->position, 0, 'L', 0, 1, '', '', true);			
					}
				}else{
					$pdf->SetXY(10, 85);
					$pdf->MultiCell(20, 0, '-', 0, 'L', 0, 1, '', '', true);
				}

				$pdf->SetXY(10, 91+$r);
				$pdf->MultiCell(186, 0, 'ขออนุมัติเดินทางไปราชการที่.............................................................................หน่วยงานผู้จัด...............................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(50, 90+$r);
				$pdf->MultiCell(59, 0, $key->location, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(130, 90+$r);
				$pdf->MultiCell(60, 0, $key->institution, 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(10, 97+$r);
				$pdf->MultiCell(186, 0, 'เรื่อง...........................................................................................................................................................................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(20, 96+$r);
				$pdf->MultiCell(175, 0, $key->title, 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(10, 103+$r);
				$pdf->MultiCell(187, 0, 'ตามหนังสือที่.........................................................................................................................ลงวันที่........................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(32, 102+$r);
				$pdf->MultiCell(74, 0, $key->ref_book_number, 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(136, 102+$r);
				$pdf->MultiCell(50, 0, ($key->ref_book_date=='0000-00-00')?'':$this->get_monthyearThai( $key->ref_book_date ), 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(10, 110+$r);
				$pdf->MultiCell(186, 0, 'ทั้งนี้ตั้งแต่วันที่.........................................................................ถึงวันที่...........................................................................รวม............................วัน', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(34, 109+$r);
				$pdf->MultiCell(55, 0, ($key->startdate=='0000-00-00')?'':$this->get_monthyearThai( $key->startdate ), 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(100, 109+$r);
				$pdf->MultiCell(53, 0, ($key->enddate=='0000-00-00')?'':$this->get_monthyearThai( $key->enddate ), 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(167, 109+$r);
				$pdf->MultiCell(20, 0, $key->allday, 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(10, 116+$r);
				$pdf->MultiCell(186, 0, 'สำหรับค่าใช้จ่ายในการเดินทางไปราชการขอเบิกจ่ายเงินบำรุงของโรงพยาบาล และขอใช้รถยนต์เดินทางไปราชการครั้งนี้', 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(20, 125+$r);
				$pdf->MultiCell(6, 0, ($key->usecar1==1)?'/':'', 1, 'C', 0, 1, '', '', true);
				$pdf->SetXY(29, 125+$r);
				$pdf->MultiCell(60, 0, 'ใช้รถยนต์ของทางโรงพยาบาลโนนไทย', 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(20, 135+$r);
				$pdf->MultiCell(6, 0, ($key->usecar2==1)?'/':'', 1, 'C', 0, 1, '', '', true);
				$pdf->SetXY(29, 135+$r);
				$pdf->MultiCell(170, 0, 'ใช้รถยนต์ส่วนตัว หมายเลขทะเบียน.......................................................................ตามหลักเกณฑ์การเบิกค่า', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(84, 134+$r);
				$pdf->MultiCell(40, 0, $key->usecar2_car_number, 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(29, 141+$r);
				$pdf->MultiCell(170, 0, 'ยานพาหนะส่วนตัวในการเดินทางไปราชการ กิโลเมตรละ 4 บาท เป็นเงิน................................................บาท', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(123, 140+$r);
				$pdf->MultiCell(38, 0, $key->usecar2_km_money, 0, 'C', 0, 1, '', '', true);

				$pdf->SetXY(20, 149+$r);
				$pdf->MultiCell(6, 0, ($key->usecar3==1)?'/':'', 1, 'C', 0, 1, '', '', true);
				$pdf->SetXY(29, 149+$r);
				$pdf->MultiCell(170, 0, 'อื่น ๆ (ระบุ)......................................................................................................................................................................................', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(50, 148+$r);
				$pdf->MultiCell(140, 0, $key->usecar3_detail, 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(29, 158+$r);
				$pdf->MultiCell(140, 0, 'จึงเรียนมาเพื่อทราบ และโปรดพิจารณาอนุมัติด้วย จะเป็นพระคุณ', 0, 'L', 0, 1, '', '', true);

				$pdf->SetXY(95, 168+$r);
				$pdf->MultiCell(100, 0, '(ลงชื่อ)...............................................................ผู้ขอ', 0, 'R', 0, 1, '', '', true);
				$pdf->SetXY(122, 167+$r);
				$pdf->MultiCell(64, 0, '', 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(128, 175+$r);
				$pdf->MultiCell(69, 0, '(............................................................)', 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(129, 174+$r);
				$pdf->MultiCell(64, 0, $key->regis_user_req, 0, 'C', 0, 1, '', '', true);

				$h_re = DB::Select( 'select * from n_department_header where departmentName="'.$key->department.'" ' );
				foreach ($h_re as $k_h) {
					$header_name = $k_h->header_name;
				}
				if( !isset($header_name) ){ $header_name=''; }

				$pdf->SetXY(10, 186+$r);
				$pdf->MultiCell(68, 0, 'เสนอ   ผู้อำนวยการโรงพยาบาลโนนไทย', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(11, 194+$r);
				$pdf->MultiCell(69, 0, '...................................................', 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(10, 204+$r);
				$pdf->MultiCell(90, 0, '(ลงชื่อ).........................................................หัวหน้าฝ่าย', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(18, 212+$r);
				$pdf->MultiCell(69, 0, '(.........................................................)', 0, 'L', 0, 1, '', '', true);
				$pdf->SetXY(20, 211+$r);
				$pdf->MultiCell(45, 0, $header_name, 0, 'C', 0, 1, '', '', true);


				$pdf->SetXY(120, 194+$r);
				$pdf->MultiCell(6, 0, ($key->daytrue==1)?'/':'', 1, 'C', 0, 1, '', '', true);
				$pdf->SetXY(123, 194+$r);
				$pdf->MultiCell(40, 0, 'ไม่เป็นวันทำการ', 0, 'C', 0, 1, '', '', true);

				$pdf->SetXY(120, 204+$r);
				$pdf->MultiCell(6, 0, ($key->dayflase==1)?'/':'', 1, 'C', 0, 1, '', '', true);
				$pdf->SetXY(123, 204+$r);
				$pdf->MultiCell(40, 0, 'เป็นวันทำการ', 0, 'C', 0, 1, '', '', true);


				$pdf->SetXY(105, 219+$r);
				$pdf->MultiCell(90, 0, '(ลงชื่อ)...........................................................ผู้อนุมัติ', 0, 'R', 0, 1, '', '', true);
				$pdf->SetXY(115, 227+$r);
				$pdf->MultiCell(90, 0, '( นายบุญชัย  ธนบัตรชัย )', 0, 'C', 0, 1, '', '', true);
				$pdf->SetXY(115, 235+$r);
				$pdf->MultiCell(90, 0, 'ผู้อำนวยการโรงพยาบาลโนนไทย', 0, 'C', 0, 1, '', '', true);



			}//end foreach

		    $filename = storage_path() . '/report_reserve.pdf';		   
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