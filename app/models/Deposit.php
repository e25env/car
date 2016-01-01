<?php

class Deposit extends Eloquent  {

  protected $table  = "c_deposit";

  protected $fillable = array( 'de_id', 'req_main_id', 'req_sub_id' );

}
