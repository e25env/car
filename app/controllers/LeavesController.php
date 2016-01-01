<?php

class LeavesController extends BaseController {
	
	public function home()
	{
		return View::make( 'leaves.index' );
	}

	public function getEvents()
	{
		$data = DB::Select( ' select req_car_id as id , detail as title, concat( godate,"T",gotime_start ) as start, case when  (select count(*) from c_deposit c where req_sub_id=req_car_id) = 1 then "#4593B7" when  driver ="" then "#F26824" else "#1FAD13"  end as color from c_req_cars where req_status<>2 and godate >= CURDATE() ' );
		
	    return $data;
	}

	private function chk_subwork( $id )
	{
		$data = DB::Select( ' select department from c_deposit c inner join c_req_cars c2 on c2.req_car_id=c.req_main_id where  req_sub_id= '.$id.' ' );

		return $data;
	}

	public function viewEvents( $id )
	{
		$data = DB::Select( ' select * from c_req_cars where req_car_id='.$id.' ' );
		
		foreach ($data as $k) {
			$t  = '<h3>เรื่อง '.$k->detail.'</h3>';	
			$t .= '<ul class="uk-list uk-list-striped">';
			$t .= '<li>วันที่บันทึก(ว-ด-ป) : '.date("d-m",strtotime($k->regis_date)).'-'.(date("Y",strtotime($k->regis_date))+543).' เวลาบันทึก : '.date("H:i:s",strtotime($k->regis_date)).'</li>';	
			$t .= '<li>ชื่อผู้ขอ : '.$k->req_name.'</li>';	
			$t .= '<li>ตำแหน่ง : '.$k->position.'</li>';	
			$t .= '<li>ฝ่าย : '.$k->department.'</li>';	
			$t .= '<li class="uk-text-danger" >ไปที่ : '.$k->location.'</li>';	
			$t .= '<li class="uk-text-danger" >รายละเอียด : '.$k->detail.'</li>';
			$t .= '<li class="uk-text-danger" >ไปวันที่(ว-ด-ป) : '.date("d-m",strtotime($k->godate)).'-'.(date("Y",strtotime($k->godate))+543).'</li>';
			$t .= '<li class="uk-text-danger" >ไปเวลา : '.$k->gotime_start.'</li>';
			$t .= '<li class="uk-text-danger" >เลขทะเบียนรถ : '.$k->car_number.'</li>';
			$t .= '<li>ผู้ขับ : '.$k->driver.'</li>';
			if( count( $this->chk_subwork( $k->req_car_id ) ) > 0 ){
				foreach  ( $this->chk_subwork( $k->req_car_id ) as $c ) {
					$t .= '<li class="uk-text-primary" ><mark>ไปกับฝ่าย : '.$c->department.'</mark></li>';
				}
			}
			$t .= '</ul>';
		}	

		return $t;
	}

	
}
