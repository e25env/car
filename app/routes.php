<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//index
Route::get( '/', array( 'uses' => 'HomeController@index' ) );




//contact
Route::get( 'contact', array( 'uses' => 'ContactController@index' ) );
Route::post( 'contact', array( 'uses' => 'ContactController@addPost' ) );
Route::get( 'contact/print/{id}', array( 'uses' => 'ContactController@printPost' ) );
Route::get( 'contact/okwork/{id}', array( 'uses' => 'ContactController@okWorkPost' ) );
Route::get( 'contact/nowork/{id}', array( 'uses' => 'ContactController@noWorkPost' ) );




//login
Route::post( 'users/login', array( 'uses' => 'UsersController@doLogin' ) );
Route::get( 'users/logout', array( 'uses' => 'UsersController@doLogout' ) );





//admin/users
Route::get( 'users', array( 'uses' => 'AdminController@users' ) );
Route::get( 'users/create', array( 'uses' => 'AdminController@create' ) );
Route::post( 'users/create', array( 'uses' => 'AdminController@post_new_user' ) );
Route::get( 'users/search', array( 'uses' => 'AdminController@home' ) );
Route::post( 'users/search', array( 'uses' => 'AdminController@post_search' ) );
Route::get( 'users/edit/{id}', array( 'uses' => 'AdminController@edit' ) );
Route::post( 'users/edit/{id}', array( 'uses' => 'AdminController@post_edit_user' ) );
Route::get( 'users/delete/{id}', array( 'uses' => 'AdminController@delete' ) );





//admin/cars
Route::get( 'cars', array( 'uses' => 'AdminController@cars' ) );
Route::get( 'cars/create', array( 'uses' => 'AdminController@create_cars' ) );
Route::post( 'cars/create', array( 'uses' => 'AdminController@post_new_cars' ) );
Route::get( 'cars/search', array( 'uses' => 'AdminController@home' ) );
Route::post( 'cars/search', array( 'uses' => 'AdminController@post_search_cars' ) );
Route::get( 'cars/edit/{id}', array( 'uses' => 'AdminController@edit_cars' ) );
Route::post( 'cars/edit/{id}', array( 'uses' => 'AdminController@post_edit_cars' ) );
Route::get( 'cars/view/{id}', array( 'uses' => 'AdminController@view_cars' ) );
Route::get( 'cars/delete/{id}', array( 'uses' => 'AdminController@del_car' ) );
Route::get( 'rooms', array( 'uses' => 'AdminController@cars_room' ) );





//admin/oil
Route::get( 'oil', array( 'uses' => 'AdminController@oil' ) );
Route::get( 'oil/addoil/{id1}/{id2}/{id3}/{id4}/{id5}/{id6}/{id7}/{id8}/{id9}/{id10}', array( 'uses' => 'AdminController@addoil' ) );
Route::get( 'oil/viewoilcar/{id}', array( 'uses' => 'AdminController@viewoilcar' ) );
Route::get( 'oil/delete/{id}', array( 'uses' => 'AdminController@deloil' ) );
Route::get( 'oil/getoldmioil/{id}', array( 'uses' => 'AdminController@getoldmioil' ) );






//reserve/cars
Route::get( 'reserve', array( 'uses' => 'ReserveController@home' ) );
Route::get( 'reserve/create', array( 'uses' => 'ReserveController@create_reserve' ) );
Route::post( 'reserve/create', array( 'uses' => 'ReserveController@post_new_reserve' ) );
Route::get( 'reserve/search', array( 'uses' => 'ReserveController@home' ) );
Route::post( 'reserve/search', array( 'uses' => 'ReserveController@post_search_reserve' ) );
Route::get( 'reserve/edit/{id}', array( 'uses' => 'ReserveController@edit_reserve' ) );
Route::post( 'reserve/edit/{id}', array( 'uses' => 'ReserveController@post_edit_reserve' ) );
Route::get( 'reserve/delete/{id}', array( 'uses' => 'ReserveController@del_reserve' ) );
Route::get( 'reserve/view/{id}', array( 'uses' => 'ReserveController@view_reserve' ) );





//reqcar/cars
Route::get( 'reqcar', array( 'uses' => 'ReqcarController@home' ) );
Route::get( 'reqcar/create', array( 'uses' => 'ReqcarController@create_req' ) );
Route::get( 'reqcar/create/{id}', array( 'uses' => 'ReqcarController@create_req' ) );
Route::post( 'reqcar/create', array( 'uses' => 'ReqcarController@post_new_reqcar' ) );
Route::get( 'reqcar/search', array( 'uses' => 'ReqcarController@home' ) );
Route::post( 'reqcar/search', array( 'uses' => 'ReqcarController@post_search_reqcar' ) );
Route::get( 'reqcar/edit/{id}', array( 'uses' => 'ReqcarController@edit_reqcar' ) );
Route::post( 'reqcar/edit/{id}', array( 'uses' => 'ReqcarController@post_edit_reqcar' ) );
Route::get( 'reqcar/delete/{id}', array( 'uses' => 'ReqcarController@del_reqcar' ) );
Route::get( 'reqcar/cancle/{id}', array( 'uses' => 'ReqcarController@cancle_reqcar' ) );
Route::get( 'reqcar/view/{id}', array( 'uses' => 'ReqcarController@view_reqcar' ) );
Route::get( 'reqcar/edit/add_deposit/{req_main_id}/{req_sub_id}', array( 'uses' => 'ReqcarController@add_deposit' ) );
Route::get( 'reqcar/edit/del_deposit/{id}', array( 'uses' => 'ReqcarController@del_deposit' ) );
Route::get( 'reqcar/resend', array( 'uses' => 'ReqcarController@resend_req' ) );
Route::post( 'reqcar/resend', array( 'uses' => 'ReqcarController@post_new_reqcar' ) );





//leaves/cars
Route::get( 'leaves', array( 'uses' => 'LeavesController@home' ) );
Route::get( 'leaves/get-events', array( 'uses' => 'LeavesController@getEvents' ) );
Route::get( 'leaves/view/{id}', array( 'uses' => 'LeavesController@viewEvents' ) );




//help
Route::get( 'help', array( 'uses' => 'HelpController@help' ) );




//report
//รายงานสรุประยะทางแต่ละจุดบริการ
Route::get( 'report1', array( 'uses' => 'ReportController@report1' ) );
Route::post( 'report1/export', array( 'uses' => 'ReportController@report1_export' ) );
//รายงานสรุประยะทางของรถยนต์
Route::get( 'report2', array( 'uses' => 'ReportController@report2' ) );
Route::post( 'report2/export', array( 'uses' => 'ReportController@report2_export' ) );
//รายงานสรุปบิลค่าน้ำมัน
Route::get( 'report3', array( 'uses' => 'ReportController@report3' ) );
Route::post( 'report3/export', array( 'uses' => 'ReportController@report3_export' ) );
//รายงานการใช้พลังงานน้ำมันเชื้อเพลิง
Route::get( 'report4', array( 'uses' => 'ReportController@report4' ) );
Route::post( 'report4/export', array( 'uses' => 'ReportController@report4_export' ) );
//รายงานใบสั่งซื้อ/ใบสั่งจ้าง ค่าน้ำมัน
Route::get( 'report5', array( 'uses' => 'ReportController@report5' ) );
Route::post( 'report5/export', array( 'uses' => 'ReportController@report5_export' ) );

