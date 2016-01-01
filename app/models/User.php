<?php

class User extends Eloquent  {

  protected $table  = "c_users";

  protected $fillable = array( 'cid', 'password', 'level', 'c1', 'c2', 'logintime' );

  public static $rules = array(
    'cid' => 'required',
    'password' => 'required',
    'level' => '',
    'logintime' => ''
  );

   public static $messages = array(
    'cid.required' => '** กรุณากรอกรหัสบัตรประชาชน **',
    'password.required' => '** กรุณากรอกรหัสผ่าน **'
  ); 
  


}
