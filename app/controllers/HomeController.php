<?php

class HomeController extends BaseController {
	
	public function index()
	{
		if ( Session::get('level') == '1' )
		{	
			$data = DB::table( 'c_req_cars' )
    				//->orderBy( 'req_car_id','desc' )
					->where('godate', '>', DB::Raw('DATE_ADD(now(), INTERVAL -30 DAY)'))
    				->orderBy( 'req_status','asc' )
		    		->orderBy( 'godate','asc' )	
    				->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
					->paginate( 30 );				
		    return View::make( 'adminhome.index' , array( 'data' => $data ) );	

			//DATE_ADD(now(), INTERVAL -60 DAY)		    		 		
		}
		else if( Session::get('level') == '2' )
		{
			$data = DB::table( 'c_req_cars' )
		    		->where( 'req_status', '<>', '2' )
		    		->where('godate', '>', DB::Raw('DATE_ADD(now(), INTERVAL -30 DAY)'))
		    		->orderBy( 'req_status','asc' )
		    		->orderBy( 'godate','asc' )		    		
		    		->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
					->paginate( 30 );		
			return View::make( 'adminhome.index' , array( 'data' => $data ) );	
		}	
		else if( Session::get('level') == '3' )
		{
			$data = DB::table( 'c_req_cars' )
					->where( 'regis_user', '=', Session::get('cid') )
					->where('godate', '>', DB::Raw('DATE_ADD(now(), INTERVAL -30 DAY)'))
					->orderBy( 'req_status','asc' )
					->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
					->paginate( 30 );	
			return View::make( 'adminhome.index' , array( 'data' => $data ) );	
		}	
		else
		{
			return View::make( 'leaves.index' );
			
			/*$data = DB::table( 'c_req_cars' )
    		->where( 'godate', '>=', date('Y-m-d') )
    		->where( 'req_status', '<>', '2' )
    		->orderBy( 'req_car_id','desc' )
    		->select( '*', DB::Raw( '(select (select concat(department, " ", concat( DATE_FORMAT(godate,"%d-%m"),"-",(year(godate)+543) ), " ", gotime_start) from c_req_cars where req_car_id=c_deposit.req_main_id) from c_deposit where req_sub_id=c_req_cars.req_car_id) as nn' ) )
    		->paginate( 10 );
    		return View::make( 'home.index' , array( 'data' => $data ) ); */
		}	    		
	}

	
}
