<?php

class Car extends Eloquent  {

  protected $table  = "c_cars";

  protected $fillable = array( 'car_id', 'car_number', 'brand', 'model', 'car_detail', 'car_img', 'car_img2', 'car_img3', 'carin', 'carout', 'car_status' );

  public static $rules = array(
    'car_number'  => 'required',
    'brand'       => '',
    'model'       => '',
    'car_detail'  => 'required',
    'car_img'     => '',
    'car_img2'     => '',
    'car_img3'     => '',
    'carin'     => '',
    'carout'     => '',
    'car_status'  => ''
  );

   public static $messages = array(
    'car_number.required' => '** กรุณากรอกเลขทะเบียนรถยนต์ **',
    'car_detail.required' => '** กรุณากรอกรายละเอียดรถยนต์ **'
  ); 
  


}
