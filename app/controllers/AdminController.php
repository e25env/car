<?php

/**
 * Create AdminsController for car
 * version 1.0
 * create by ThemeSanasang
*/

class AdminController extends BaseController {

	/**
	 * function name : users
	 * view page users
	 * add data to grid
	 * get
	*/
	public function users()
	{
		if ( Session::get('level') == '1' )
		{		
			$userall = DB::table( 'c_users' )
	         ->join( 'n_datageneral', 'n_datageneral.cid', '=', 'c_users.cid' )
	         ->orderBy( 'c_users.user_id', 'asc')
	         ->paginate( 10 );	

		    return View::make( 'adminhome.users',  array( 'userall' => $userall ) );			    		 		
		}	
		else
		{
			$data = DB::Select( 'select car_id, car_number, brand, model, car_img from c_cars' );
    		return View::make( 'home.index' , array( 'data' => $data ) );
		}				
	}

	/**
    * function name : post_search
    * search data c_users
    * post
    */
    public function post_search()
    {   		  
	   if ( Session::get('level') == '1' )
		{
			$search  = Input::get( 'search' );	    		    

			$userall = DB::table( 'c_users' )
	         ->join( 'n_datageneral', 'n_datageneral.cid', '=', 'c_users.cid' )	     
	         ->where( 'c_users.cid', 'like', "%$search%" )
	         ->orWhere( 'n_datageneral.fname', 'like', "%$search%" )	 
	          ->orWhere( 'n_datageneral.fname', 'like', "%$search%" )	     
	         ->orderBy( 'c_users.user_id', 'asc')
	         ->paginate( 10 );	 		    
	     
			//view page create
		    return View::make( 'adminhome.users',  array( 'userall' => $userall ) );	
		}	
		else
		{
			$data = DB::Select( 'select car_id, car_number, brand, model, car_img from c_cars' );
    		return View::make( 'home.index' , array( 'data' => $data ) );
		}	
    }

	/**
	 * function name : create
	 * view page create user
	 * add data to select option
	 * get
	*/
    public function create()
    {
    	if ( Session::get('level') == '1' )
    	{   
    		//http://packtlib.packtpub.com/library/9781782162827/ch02lvl1sec27
    		//https://github.com/uikit/uikit/issues/387

    		$datageneral = DB::table('n_datageneral')
    		               ->where('cid','<>','null')   		              
    		               ->get(array( DB::raw('CONCAT(cid," ",DATE_FORMAT(birthday,"%d"),DATE_FORMAT(birthday,"%m"),DATE_FORMAT(birthday,"%Y")+543," ",pname,"",fname, " ", lname) as value') ));  		

    		foreach ($datageneral as $k => $v) {		       
    			$return_array[] = $v;    
		    }			    	
		
	        return View::make( 'adminhome.create-users', array('datageneral' => $return_array) );
    	}
    	else
    	{
    		$data = DB::Select( 'select car_id, car_number, brand, model, car_img from c_cars' );
    		return View::make( 'home.index' , array( 'data' => $data ) );
    	}  	
    }

    /**
	 * function name : post_new_user
	 * reciep data post form create
	 * create new users
	 * post
	*/
    public function post_new_user()
    {
    	//get user details
	    $cid  		= Input::get( 'cid' );
	    $level 		= Input::get( 'level' );
	    $c1 		= Input::get( 'c1' );
	    $c2 		= Input::get( 'c2' );
	    $c3 		= Input::get( 'c3' );
			
		$rules = array(
			'cid'    => 'required'
		);
		$messages = array(
			'cid.required'    => '*** กรุณากรอกชื่อผู้ใช้ ***'
		);
  
	    $validator = Validator::make( Input::all(), $rules, $messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'users/create' )->withErrors( $validator );
	    }
	    else
	    {
	    	$cid = explode(' ',$cid);
	    	$user_data = array(
	            'cid' 		=> $cid[0],
	            'password'  => $cid[1],
	            'level' 	=> $level,
	            'c1' 		=> $c1,
	            'c2' 		=> $c2,
	            'c3' 		=> $c3	           
            );
           
	    	//create new user
            $users = DB::insert( 'insert into c_users ( cid, password, level, c1, c2, c3 ) values ( ?, ?, ?, ?, ?, ? )', 
            		array( 
            			  $cid[0],
            			  $cid[1],
            			  $level,
            			  $c1,
            			  $c2,
            			  $c3
            	     ));

            if( $users )
            {
            	return Redirect::to( 'users' )->with( 'success_message', 'เพิ่มผู้ใช้งานเรียบร้อยแล้ว' );    
            }
            else
            {
                return Redirect::to( 'users' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลผู้ใช้งานได้ กรุณาแจ้งผู้ดูแลระบบ' );   
	        }
        }
    }

     /**
    * function name : edit
    * edit data c_users
    * get
    */
    public function edit( $id ) 
    {
    	if ( Session::get('level') == '1' )
    	{
    		$user = $this->_get_userdata( $id );      

		    return View::make(
		        'adminhome.edit-users', 
		        array(
		            'user'      => $user	          		                
		            )
		    );
    	}
    	else
    	{
    		$data = DB::Select( 'select car_id, car_number, brand, model, car_img from c_cars' );
    		return View::make( 'home.index' , array( 'data' => $data ) );
    	}      
    }

    /**
    * function name : post_edit_user
    * edit data c_users
    * post
    */
    public function post_edit_user( $id )
    {
    	//get user details
	    $level  = Input::get( 'level' );
	    $c1  	= Input::get( 'c1' );
	    $c2 	= Input::get( 'c2' );
	    $c3 	= Input::get( 'c3' );
	   
        $user_data = array(
            'level' 		 => $level,
            'c1' 			 => $c1,
            'c2' 			 => $c2,
            'c3' 			 => $c3			           		            	                       
        );  
      
        //update user details
        $result = DB::table( 'c_users' )->where( 'cid', '=', $id )->update( $user_data );	        
        if( $result )
        {
        	return Redirect::to( 'users' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
        }
        else
        {
        	return Redirect::to( 'users' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
        }	           
    }

    /**
    * function name : _get_userdata
    * get data c_users from id
    * 
    */
    private function _get_userdata( $id ){
	    $user_data = DB::table( 'c_users' )
	         ->join( 'n_datageneral', 'n_datageneral.cid', '=', 'c_users.cid' )	        
	        ->where( 'c_users.cid', '=', $id )
	        ->first();
	    return $user_data;  
	}  

	 /**
    * function name : delete
    * edit data c_users
    * get
    */
    public function delete( $id ) 
    {
    	if ( Session::get('level') == '1' )
    	{    		
            $result = User::where( 'cid', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'users' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'users' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	   
    	}
    	else
    	{
    		$data = DB::Select( 'select car_id, car_number, brand, model, car_img from c_cars' );
    		return View::make( 'home.index' , array( 'data' => $data ) );
    	}      
    }


    /*
	*
	* CAR
	*
    */
	public function cars()
	{			
		$userall = DB::table( 'c_cars' )	
		 ->Select( '*', DB::Raw('(select count(*) from c_req_cars where car_number=c_cars.car_number and godate="'.date('Y-m-d').'") as status') )     
         ->orderBy( 'c_cars.car_id', 'asc')
         ->paginate( 10 );	
      
	    return View::make( 'adminhome.cars',  array( 'carall' => $userall ) );			    		 						
	}

	/**
    * function name : post_search
    * search data c_users
    * post
    */
    public function post_search_cars()
    {   		     
		$search  = Input::get( 'search' );	    		    

		$carall = DB::table( 'c_cars' )     
         ->where( 'c_cars.car_id', 'like', "%$search%" )
         ->orWhere( 'c_cars.car_number', 'like', "%$search%" )	 
         ->orWhere( 'c_cars.brand', 'like', "%$search%" )	
         ->orWhere( 'c_cars.model', 'like', "%$search%" )	
         ->Select( '*', DB::Raw('(select count(*) from c_req_cars where car_number=c_cars.car_number and godate="'.date('Y-m-d').'") as status') )      
         ->orderBy( 'c_cars.car_id', 'asc')
         ->paginate( 10 );	 		    
     
		//view page create
	    return View::make( 'adminhome.cars',  array( 'carall' => $carall ) );		
    }

	/**
	 * function name : create_cars
	 * view page create_cars
	 * add data to select option
	 * get
	*/
    public function create_cars()
    {
    	if ( Session::get('level') == '1' )
    	{       								
	        return View::make( 'adminhome.create-cars' );
    	}
    	else
    	{
    		$data = DB::Select( 'select car_id, car_number, brand, model, car_img from c_cars' );
    		return View::make( 'home.index' , array( 'data' => $data ) );	
    	}  	
    }

    /**
	 * function name : post_new_cars
	 * reciep data post form create
	 * create new cars
	 * post
	*/
    public function post_new_cars()
    {
    	//get user details
	    $car_number  	= strtoupper( Input::get( 'car_number' ) );
	    $brand 			= Input::get( 'brand' );
	    $model  		= Input::get( 'model' );
	    $car_detail 	= Input::get( 'car_detail' );
	    $carin 			= Input::get( 'carin' );
	    $car_img  		= Input::file( 'car_img' );	
	    $car_img2  		= Input::file( 'car_img2' );	
	    $car_img3  		= Input::file( 'car_img3' );	 
			
		$validator = Validator::make( Input::all(),  Car::$rules, Car::$messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'cars/create' )->withErrors( $validator );
	    }
	    else
	    {    
	    	if( !empty($car_img) )
	    	{
	    		//$destinationPath =  iconv( 'utf-8', 'tis620', 'uploads/'. $car_number ) ;
	    		$destinationPath =  'uploads/'. $car_number;
				$filename = Input::file('car_img')->getClientOriginalName();		
				$uploadSuccess = Input::file('car_img')->move($destinationPath, $filename);
	    	}
	    	else
	    	{
	    		$filename = '';
	    	}	

	    	if( !empty($car_img2) )
	    	{
	    		//$destinationPath2 =  iconv( 'utf-8', 'tis620', 'uploads/'. $car_number ) ;
	    		$destinationPath2 =  'uploads/'. $car_number;
				$filename2 = Input::file('car_img2')->getClientOriginalName();		
				$uploadSuccess2 = Input::file('car_img2')->move($destinationPath2, $filename2);
	    	}
	    	else
	    	{
	    		$filename2 = '';
	    	}	 

	    	if( !empty($car_img3) )
	    	{
	    		//$destinationPath3 =  iconv( 'utf-8', 'tis620', 'uploads/'. $car_number ) ;
	    		$destinationPath3 =  'uploads/'. $car_number;
				$filename3 = Input::file('car_img3')->getClientOriginalName();		
				$uploadSuccess3 = Input::file('car_img3')->move($destinationPath3, $filename3);
	    	}
	    	else
	    	{
	    		$filename3 = '';
	    	}	     	    

	    	$ck = DB::Select( ' select * from c_cars where car_number="'.$car_number.'" ' );

	    	if( count( $ck ) == 0 )
	    	{
		    	//create new cars
	            $cars = DB::insert( 'insert into c_cars ( car_number, brand, model, car_detail, carin, car_img, car_img2, car_img3, car_status ) values ( ?, ?, ?, ?, ?, ?, ?, ?, ? )', 
	            		array( 
	            			$car_number,
				            $brand,
				            $model,
				            $car_detail,
				            $carin,
				            $filename,
				            $filename2,
				            $filename3,
				            '0'		           
	            	     ));

	            if( $cars )
	            {
	            	return Redirect::to( 'cars' )->with( 'success_message', 'เพิ่มรถยนต์เรียบร้อยแล้ว' );    
	            }
	            else
	            {          
	                return Redirect::to( 'cars' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลรถยนต์ได้ กรุณาแจ้งผู้ดูแลระบบ' );   
		        }
	    	}
	    	else
	    	{
	    		 return Redirect::to( 'cars' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลรถยนต์ได้ มีข้อมูลซ้ำ' ); 
	    	}
        }
    }

     /**
    * function name : edit_cars
    * edit data c_cars
    * get
    */
    public function edit_cars( $id ) 
    {
    	if ( Session::get('level') == '1' )
    	{
    		$car = $this->_get_cardata( $id );      

		    return View::make(
		        'adminhome.edit-cars', 
		        array(
		            'car'      => $car	          		                
		            )
		    );
    	}
    	else
    	{
    		$data = DB::Select( 'select car_id, car_number, brand, model, car_img from c_cars' );
    		return View::make( 'home.index' , array( 'data' => $data ) );	
    	}      
    }

    /**
    * function name : post_edit_cars
    * edit data c_cars
    * post
    */
    public function post_edit_cars( $id )
    {
    	//get user details
	    $car_number  	= Input::get( 'car_number' );
	    $brand 			= Input::get( 'brand' );
	    $model  		= Input::get( 'model' );
	    $car_detail 	= Input::get( 'car_detail' );
	    $carin 			= Input::get( 'carin' );
	    $car_img  		= Input::file( 'car_img' );	 
	    $nameimghid  	= Input::get( 'nameimghid' );
	    $car_img2  		= Input::file( 'car_img2' );	 
	    $nameimghid2  	= Input::get( 'nameimghid2' );
	    $car_img3  		= Input::file( 'car_img3' );	 
	    $nameimghid3  	= Input::get( 'nameimghid3' );
	       	
    	$validator = Validator::make( Input::all(),  Car::$rules, Car::$messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'cars/create' )->withErrors( $validator );
	    }
	    else
	    {
	    	if( !empty($car_img) )
	    	{
	    		//$destinationPath = iconv( 'utf-8', 'tis620', 'uploads/'. $car_number ) ;
	    		$destinationPath = 'uploads/'. $car_number;
				$filename = Input::file('car_img')->getClientOriginalName();		
				$uploadSuccess = Input::file('car_img')->move($destinationPath, $filename);
	    	}
	    	else
	    	{
	    		if( $nameimghid != '' )
	    		{
	    			$filename = $nameimghid;
	    		}
	    		else
	    		{
	    			$filename = '';
	    		}
	    	}	

	    	if( !empty($car_img2) )
	    	{
	    		//$destinationPath2 = iconv( 'utf-8', 'tis620', 'uploads/'. $car_number ) ;
	    		$destinationPath2 = 'uploads/'. $car_number;
				$filename2 = Input::file('car_img2')->getClientOriginalName();		
				$uploadSuccess2 = Input::file('car_img2')->move($destinationPath2, $filename2);
	    	}
	    	else
	    	{
	    		if( $nameimghid2 != '' )
	    		{
	    			$filename2 = $nameimghid2;
	    		}
	    		else
	    		{
	    			$filename2 = '';
	    		}
	    	}	

	    	if( !empty($car_img3) )
	    	{
	    		//$destinationPath3 = iconv( 'utf-8', 'tis620', 'uploads/'. $car_number ) ;
	    		$destinationPath3 = 'uploads/'. $car_number;
				$filename3 = Input::file('car_img3')->getClientOriginalName();		
				$uploadSuccess3 = Input::file('car_img3')->move($destinationPath3, $filename3);
	    	}
	    	else
	    	{
	    		if( $nameimghid3 != '' )
	    		{
	    			$filename3 = $nameimghid3;
	    		}
	    		else
	    		{
	    			$filename3 = '';
	    		}
	    	}	

	    	$car_data = array(
	            'car_number' 	 => $car_number,
	            'brand' 		 => $brand,
	            'model' 		 => $model,
	            'car_detail' 	 => $car_detail,
	            'carin' 	 	 => $carin,
	            'car_img' 		 => $filename,
	            'car_img2' 		 => $filename2,
	            'car_img3' 		 => $filename3		           		            	                       
	        );  
	      
	        //update user details
	        $result = DB::table( 'c_cars' )->where( 'car_id', '=', $id )->update( $car_data );	        
	        if( $result )
	        {
	        	return Redirect::to( 'cars' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'cars' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	 
	    }              
    }

     /**
    * function name : view_cars
    * view data c_cars
    * get
    */
    public function view_cars( $id ) 
    {  	
		$car = $this->_get_cardata( $id );      

	    return View::make(
	        'adminhome.view-cars', 
	        array(
	            'car'      => $car	          		                
	            )
	    );  	   
    }

    /**
    * function name : _get_cardata
    * get data c_cars from id
    * 
    */
    private function _get_cardata( $id ){
	    $car_data = DB::table( 'c_cars' )	       	        
	        ->where( 'c_cars.car_id', '=', $id )
	        ->first();
	    return $car_data;  
	}  

	/**
    * function name : delete
    * edit data c_cars
    * get
    */
    public function del_car( $id ) 
    {
    	if ( Session::get('level') == '1' )
    	{    		
            $result = Car::where( 'car_id', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'cars' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'cars' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	   
    	}
    	else
    	{
    		$data = DB::Select( 'select car_id, car_number, brand, model, car_img from c_cars' );
    		return View::make( 'home.index' , array( 'data' => $data ) );
    	}      
    }

    public function cars_room()
    {   	
    	$data = DB::table( 'c_cars' )	
		 ->Select( '*', DB::Raw('(select count(*) from c_req_cars where car_number=c_cars.car_number and godate="'.date('Y-m-d').'") as status') )     
         ->orderBy( 'car_id', 'asc')
         ->get();
    	return View::make( 'adminhome.cars-room' , array( 'data' => $data ) );
    }






    /**
     * [oil description]
     * @return [type] [description]
     */
    public function oil()
    {
    	$car = DB::table('c_cars')->select('car_number')->get();
    	return View::make( 'adminhome.oil', array('car'=>$car) );
    }





    /**
     * [getoldmioil description]
     * @return [type] [description]
     */
    public function getoldmioil($type)
    {
    	$data = DB::table('c_caroil')
    			->where('car_number', $type)
    			->select('mioil')
    			->orderby('id', 'desc')
    			->limit(1)
    			->first();

    	return $data->mioil;		
    }





    /**
     * [addoil description]
     * @return [type] [description]
     */
    public function addoil($oilnumber, $dateoil, $listoil, $mioil, $kmoil, $woil, $moneyoil, $bookoil, $numberoil, $pwoil)
    {
    	$d1 = explode( "-", $dateoil );
		$dateoil = ($d1[2]-543).'-'.$d1[1].'-'.$d1[0];

		$oilcars = DB::insert( 'insert into c_caroil ( car_number, bookoil, numberoil ,oildate, typeoil, mioil, kmoil, pwoil, woil, moneyoil, create_date ) values ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )', 
        		array( 
        			$oilnumber,
        			$bookoil,
        			$numberoil,
		            $dateoil,
		            $listoil,
		            $mioil,
		            $kmoil,
		            $pwoil,
		            $woil,
		            $moneyoil,
		            date('Y-m-d')
        	     ));

		if( $oilcars ){
			return 'ok';
		}else{
			return 'no';
		}
    }




    /**
     * [viewoilcar description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function viewoilcar($id)
    {
    	$data = DB::table('c_caroil')->where('car_number', $id)->orderby('oildate', 'desc')->get();
    	return View::make('adminhome.oilview', array('data'=>$data));
    }





    public function deloil($id)
    {
    	$result = DB::table('c_caroil')->where( 'id', $id )->delete();
    }




}

?>