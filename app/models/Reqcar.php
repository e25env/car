<?php

class Reqcar extends Eloquent  {

  protected $table  = "c_req_cars";

  protected $fillable = array( 
    'req_car_id', 
    'reserve_id', 
    'req_date', 
    'req_name',
    'position',
    'department',
    'location',
    'detail',
    'qty',
    'godate',
    'gotime_start',
    'gotime_end',
    'responsible',
    'writetime',
    'upcar1',
    'upcar2',
    'upcar3',
    'user_req',
    'car_number',
    'driver',
    'km_driver',
    'driver_control',
    'comment',
    'regis_date',
    'regis_user',
    'req_status'
  );


}
