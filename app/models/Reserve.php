<?php

class Reserve extends Eloquent  {

  protected $table  = "c_reserve_cars";

  protected $fillable = array( 'reserve_id', 'department', 'num_nm', 'date_nm', 'req_name', 'position', 'together_id', 'location', 'institution', 'title', 'ref_book_number', 'ref_book_date', 'startdate', 'enddate', 'allday', 'usecar1', 'usecar2', 'usecar2_car_number', 'usecar2_km_money', 'usecar3', 'usecar3_detail', 'regis_user_req', 'daytrue', 'dayflase', 'book_status', 'reserve_date', 'user_regis' );

}
