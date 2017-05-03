<?php

class ReportController extends BaseController {




	/**
	 * [report1 เลือกช่วง] รายงานสรุประยะทางแต่ละจุดบริการ
	 * @return html home
	 */
	public function report1()
	{
		return View::make( 'report.report1' );
	}





	/**
	 * [report1_export ออกรายงาน] รายงานสรุประยะทางแต่ละจุดบริการ
	 * @return excel
	 */
	public function report1_export()
	{
		$date1 = Input::get('datestart1');
		$date2 = Input::get('dateend1');

		if( $date1 != '' && $date2 != '' )
		{
			$d1 = explode( "-", $date1 );
			$datestrart = ($d1[2]-543).'-'.$d1[1].'-'.$d1[0];

			$d2 = explode("-", $date2);
			$dateend = ($d2[2]-543).'-'.$d2[1].'-'.$d2[0];


			$sql1  = ' select department from c_req_cars ';
			$sql1 .= ' where godate between "'.$datestrart.'" and "'.$dateend.'" ';
			$sql1 .= ' group by department order by department asc';

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); 
		    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'แผนก');	
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);		
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'วันที่ไป');
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);	
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'ไปที่');	
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);	
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ผู้รับผิดชอบ');	
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);	
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'หมายเลขทะเบียน');	
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);	
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'ผู้ขับ');	
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'ระยะทาง');	
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getStyle('G')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
			

			$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->applyFromArray(
	            array(
	            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	            'startcolor' => array('rgb' => '60D0F2'),
	            'endcolor' => array('rgb' => '60D0F2')
	            )
			);

			//------fix tab
			$objPHPExcel->getActiveSheet()->freezePane('A2');	

			$row = 0;
			$sumall = 0;	

			$result1 = DB::Select( $sql1 );
			foreach ( $result1 as $k1 ) 
			{
				
				$sql2  = ' select department,godate,location,detail,car_number,km_driver,driver,responsible ';
				$sql2 .= ' from c_req_cars ';
				$sql2 .= ' where godate between "'.$datestrart.'" and "'.$dateend.'" ';
				$sql2 .= ' and department="'.$k1->department.'" and req_status <> 2 ';
				$sql2 .= ' order by godate asc ';

				$sumkm=0;								
					
				$result2 = DB::Select( $sql2 );
				foreach ($result2 as $k2) {	

					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+2, $k2->department);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, $row+2, date("d-m", strtotime($k2->godate)).'-'.(date("Y", strtotime($k2->godate))+543) );
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, $row+2, $k2->location);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, $row+2, $k2->responsible);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, $row+2, $k2->car_number);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (5, $row+2, $k2->driver);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (6, $row+2, $k2->km_driver);
					
					$sumkm += $k2->km_driver;

					$row = $row+1;;
				}	

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+2, 'รวม KM');	
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (6, $row+2, $sumkm);											
				$objPHPExcel->getActiveSheet()->getStyle('A'.($row+2).':G'.($row+2))->getFill()->applyFromArray(
		            array(
		            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
		            'startcolor' => array('rgb' => 'F6FC53'),
		            'endcolor' => array('rgb' => 'F6FC53')

		            )
		    	);	

				$row++;

				$sumall += $sumkm;

			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+3, 'รวม KM ทั้งหมด');	
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (5, $row+3, $sumall);											
			$objPHPExcel->getActiveSheet()->getStyle('A'.($row+3).':G'.($row+3))->getFill()->applyFromArray(
	            array(
	            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	            'startcolor' => array('rgb' => '66F968'),
	            'endcolor' => array('rgb' => '66F968')

	            )
	    	);	


			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // Set excel version 2007	  		
		    $objWriter->save(storage_path()."/excel/report1.xls");

		    return Response::download( storage_path()."/excel/report1.xls", "report1.xls");

		}
		else
		{
			return View::make( 'report.report1' );
		}
	}






	/**
	 * รายงานสรุประยะทางของรถยนต์
	 * @return [type] [description]
	 */
	public function report2()
	{
		return View::make( 'report.report2' );
	}




	/**
	 * รายงานสรุประยะทางของรถยนต์
	 * @return [type] [description]
	 */
	public function report2_export()
	{
		$date1  = Input::get('datestart1');
		$date2  = Input::get('dateend1');
	

		if( $date1 != '' && $date2 != '' )
		{
			$d1 = explode( "-", $date1 );
			$datestrart = ($d1[2]-543).'-'.$d1[1].'-'.$d1[0];

			$d2 = explode("-", $date2);
			$dateend = ($d2[2]-543).'-'.$d2[1].'-'.$d2[0];


			$sql  = ' select car_number, sum(km_driver) as kmtotal from c_req_cars  ';
			$sql .= ' where godate between "'.$datestrart.'" and "'.$dateend.'" ';
			$sql .= ' group by car_number order by car_number asc';

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); 
		    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			$objPHPExcel->setActiveSheetIndex(0);

			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'รายงานสรุประยะทางของรถยนต์ วันที่ '. $date1.' ถึง '.$date2);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);	

			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'หมายเลขทะเบียน');	
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);		
			$objPHPExcel->getActiveSheet()->setCellValue('B2', 'รวมระยะทาง(กิโลเมตร)');
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);	
			$objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
			
			$row = 1;
			$sumall = 0;	

			$result = DB::Select( $sql );
			foreach ( $result as $k ) 
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+2, $k->car_number);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, $row+2, $k->kmtotal);
					
				$row++;

				$sumall += $k->kmtotal;
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+3, 'รวม KM ทั้งหมด');	
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, $row+3, $sumall);											
			$objPHPExcel->getActiveSheet()->getStyle('A'.($row+3).':B'.($row+3))->getFill()->applyFromArray(
	            array(
	            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	            'startcolor' => array('rgb' => '66F968'),
	            'endcolor' => array('rgb' => '66F968')
	            )
	    	);	

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // Set excel version 2007	  		
		    $objWriter->save(storage_path()."/excel/report2.xls");

		    return Response::download( storage_path()."/excel/report2.xls", "report2.xls");

		}
		else
		{
			return View::make( 'report.report2' );
		}
	}






	/**
	 * รายงานสรุปบิลค่าน้ำมัน
	 * @return [type] [description]
	 */
	public function report3()
	{
		return View::make( 'report.report3' );
	}





	/**
	 * รายงานสรุปบิลค่าน้ำมัน
	 * @return [type] [description]
	 */
	public function report3_export()
	{
		$date1  = Input::get('datestart1');
		$date2  = Input::get('dateend1');
		$typecaroil = Input::get('typecaroil');

		if( $date1 != '' && $date2 != '' )
		{
			$d1 = explode( "-", $date1 );
			$datestrart = ($d1[2]-543).'-'.$d1[1].'-'.$d1[0];

			$d2 = explode("-", $date2);
			$dateend = ($d2[2]-543).'-'.$d2[1].'-'.$d2[0];

			if( $typecaroil == 'งานยานพาหนะ'){
				$type = ' not in ("งานปรับภูมิทัศน์", "งานพ่นหมอกควัน", "เครื่องกำเนิดไฟฟ้า") ';
			}else if( $typecaroil == 'งานซ่อมบำรุง' ){
				$type = ' in ("เครื่องกำเนิดไฟฟ้า") ';
			}else if( $typecaroil == 'งานกลุ่มเวชฯ' ){
				$type = ' in ("งานปรับภูมิทัศน์", "งานพ่นหมอกควัน") ';
			}

			$sql  = ' select car_number from c_caroil where car_number '.$type.' group by car_number  order by car_number asc';

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); 
		    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			$objPHPExcel->setActiveSheetIndex(0);

			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'รายงานสรุปบิลค่าน้ำมัน วันที่ '.$date1.' ถึง '.$date2.' ประเภท '.$typecaroil);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);

			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'วันที่');
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
			$objPHPExcel->getActiveSheet()->setCellValue('B2', 'รายการ');
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->setCellValue('C2', 'เลขไมล์');
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
			$objPHPExcel->getActiveSheet()->setCellValue('D2', 'กิโลเมตร');
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
			$objPHPExcel->getActiveSheet()->setCellValue('E2', 'น้ำมันใช้(ลิตร)');
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
			$objPHPExcel->getActiveSheet()->setCellValue('F2', 'จำนวนเงิน');
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);	
			$objPHPExcel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
			$objPHPExcel->getActiveSheet()->setCellValue('G2', 'เล่มที่');
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);	
			$objPHPExcel->getActiveSheet()->setCellValue('H2', 'เลขที่');
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);


			$objPHPExcel->getActiveSheet()->freezePane('A3');

			$row = 1;
			$total_money=0;
				
			$result = DB::Select( $sql );
			foreach ( $result as $k ) 
			{

				$sql2  = ' select * from c_caroil ';
				$sql2 .= ' where oildate between "'.$datestrart.'" and "'.$dateend.'" and car_number = "'.$k->car_number.'" ';
				$sql2 .= ' order by car_number, oildate asc ';

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+2, $k->car_number);
				$objPHPExcel->getActiveSheet()->getStyle('A'.($row+2))->getFill()->applyFromArray(
			            array(
			            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
			            'startcolor' => array('rgb' => '60D0F2'),
			            'endcolor' => array('rgb' => '60D0F2')
			            )
			    );

				$sumall = 0;
				$result2 = DB::Select( $sql2 );
				foreach ($result2 as $k2) {
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+3, date("d", strtotime($k2->oildate)).'-'.date("m", strtotime($k2->oildate)).'-'.(date("Y", strtotime($k2->oildate))+543) );
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, $row+3, $k2->typeoil);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, $row+3, $k2->mioil);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, $row+3, $k2->kmoil);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, $row+3, $k2->woil);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (5, $row+3, $k2->moneyoil);

					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (6, $row+3, $k2->bookoil);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (7, $row+3, $k2->numberoil);

					$sumall += $k2->moneyoil;
					$row++;
				}
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, $row+3, 'รวม');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (5, $row+3, $sumall);

				$total_money += $sumall;

				$row++;
				$row += 3;

			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (5, $row+2, $total_money);

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // Set excel version 2007	  		
		    $objWriter->save(storage_path()."/excel/report3.xls");

		    return Response::download( storage_path()."/excel/report3.xls", "report3.xls");

		}
		else
		{
			return View::make( 'report.report3' );
		}
	}




	/**
	 * รายงานการใช้พลังงานน้ำมันเชื้อเพลิง
	 * 
	 */
	public function report4()
	{
		$year = DB::table('c_caroil')
                    ->select(DB::raw('year(oildate) as y'))
                    ->groupby(DB::raw('year(oildate)'))
                    ->get();
            
            $yearlist=[];
            foreach($year as $key=>$value) {
               $yearlist[$value->y] = ($value->y)+543; 
               $yaddk = ($value->y)+1;
               $yaddt = (($value->y)+543)+1; 
            }
            $yearlist[$yaddk] = $yaddt; 

		return View::make( 'report.report4', array('year' => $yearlist) );
	}




	/**
	 * รายงานการใช้พลังงานน้ำมันเชื้อเพลิง
	 * 
	 */
	public function report4_export()
	{
		$y  = Input::get('year');		

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); 
	    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		$objPHPExcel->setActiveSheetIndex(0);

		$styleArray = array(
		      'borders' => array(
		          'allborders' => array(
		              'style' => PHPExcel_Style_Border::BORDER_THIN
		          )
		      )
		  );

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'รายงานการใช้พลังงานน้ำมันเชื้อเพลิง ปีงบ '.($y+543));
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);	

		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'เดือน');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
		//$objPHPExcel->getActiveSheet()->getDefaultStyle('A')->applyFromArray($styleArray);

		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'ดีเซล');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
		$objPHPExcel->getActiveSheet()->setCellValue('C2', 'จำนวนเงิน');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 			

		$objPHPExcel->getActiveSheet()->setCellValue('D2', 'เบนซิน');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
		$objPHPExcel->getActiveSheet()->setCellValue('E2', 'จำนวนเงิน');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
				
		$objPHPExcel->getActiveSheet()->setCellValue('F2', 'แก๊สโซฮอล์');
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
		$objPHPExcel->getActiveSheet()->setCellValue('G2', 'จำนวนเงิน');
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyle('G')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
		
		$objPHPExcel->getActiveSheet()->setCellValue('H2', 'รวมจำนวนลิตร');
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyle('H')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
		$objPHPExcel->getActiveSheet()->setCellValue('I2', 'รวมจำนวนเงิน');
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyle('I')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
			
		
		$row = 1;

		$sumtotal_w1 = 0;
		$sumtotal_m2 = 0;
		$sumtotal_w3 = 0;
		$sumtotal_m4 = 0;
		$sumtotal_w5 = 0;
		$sumtotal_m6 = 0;

		$sumall1 = 0;
		$sumall2 = 0;

		foreach ($this->get_month() as $key => $value) {

			$sumright0 = 0;
			$sumright1 = 0;
			
			//---ดีเซล
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+2, $value);
			$dw = $this->calwoil($y, $key, 'ดีเซล');
			$dm = $this->calmoneyoil($y, $key, 'ดีเซล');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, $row+2, $dw);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, $row+2, $dm);

			$sumtotal_w1 += $dw;
			$sumtotal_m2 += $dm;

			//---เบนซิน
			$bw = $this->calwoil($y, $key, 'เบนซิน');
			$bm = $this->calmoneyoil($y, $key, 'เบนซิน');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, $row+2, $bw);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, $row+2, $bm);

			$sumtotal_w3 += $bw;
			$sumtotal_m4 += $bm;

			//---แก๊สโซฮอล
			$gw = $this->calwoil($y, $key, 'แก๊สโซฮอล');
			$gm = $this->calmoneyoil($y, $key, 'แก๊สโซฮอล');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (5, $row+2, $gw);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (6, $row+2, $gm);

			$sumtotal_w5 += $gw;
			$sumtotal_m6 += $gm;

			//---รวมด้านขวา
			$sumright0 = $dw+$bw+$gw;
			$sumright1 = $dm+$bm+$gm;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (7, $row+2, $sumright0);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (8, $row+2, $sumright1);

			$sumall1 += $sumright0;
			$sumall2 += $sumright1; 

			$row++;
		}

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, $row+3, $sumtotal_w1);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, $row+3, $sumtotal_m2);

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, $row+3, $sumtotal_w3);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, $row+3, $sumtotal_m4);

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (5, $row+3, $sumtotal_w5);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (6, $row+3, $sumtotal_m6);

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (7, $row+3, $sumall1);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (8, $row+3, $sumall2);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // Set excel version 2007	  		
	    $objWriter->save(storage_path()."/excel/report4.xls");

	    return Response::download( storage_path()."/excel/report4.xls", "report4.xls");

	}






	/**
	 * รายงานใบสั่งซื้อ/ใบสั่งจ้าง ค่าน้ำมัน
	 * 
	 */
	public function report5()
	{
		$year = DB::table('c_caroil')
                    ->select(DB::raw('year(oildate) as y'))
                    ->groupby(DB::raw('year(oildate)'))
                    ->get();
            
            $yearlist=[];
            foreach($year as $key=>$value) {
               $yearlist[$value->y] = ($value->y)+543; 
               $yaddk = ($value->y)+1;
               $yaddt = (($value->y)+543)+1; 
            }
            $yearlist[$yaddk] = $yaddt; 

		return View::make( 'report.report5', array('year' => $yearlist, 'month' => $this->get_month()) );
	}





	/**
	 * รายงานใบสั่งซื้อ/ใบสั่งจ้าง ค่าน้ำมัน
	 * 
	 */
	public function report5_export()
	{
		$y  = Input::get('year');
		$m  = Input::get('month');
		$typecaroil = Input::get('typecaroil');

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); 
	    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		$objPHPExcel->setActiveSheetIndex(0);	

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ใบสั่งซื้อ/ใบสั่งจ้าง ปี '.($y+543).' เดือน '.$m.' ประเภท '.$typecaroil);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);	

		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'ลำดับ');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);	
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'รายการ');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->setCellValue('C2', 'ราคาต่อหน่วย');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 			
		$objPHPExcel->getActiveSheet()->setCellValue('D2', 'จำนวนสิ่งของ');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 			
		$objPHPExcel->getActiveSheet()->setCellValue('E2', 'หน่วย');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('F2', 'จำนวนเงินทั้งสิ้น');
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 
		$objPHPExcel->getActiveSheet()->setCellValue('G2', 'หมายเหตุ');
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

		$row = 2;


		if( $typecaroil == 'งานยานพาหนะ'){
			$type = ' not in ("งานปรับภูมิทัศน์", "งานพ่นหมอกควัน", "เครื่องกำเนิดไฟฟ้า") ';
		}else if( $typecaroil == 'งานซ่อมบำรุง' ){
			$type = ' in ("เครื่องกำเนิดไฟฟ้า") ';
		}else if( $typecaroil == 'งานกลุ่มเวชฯ' ){
			$type = ' in ("งานปรับภูมิทัศน์", "งานพ่นหมอกควัน") ';
		}

		$sql  = ' select typeoil, pwoil, sum(woil) as totalwoil,sum(moneyoil) as totalmoney from c_caroil ';
		$sql .= ' where year(oildate)='.$y;
		$sql .= ' and month(oildate)='.$m;
		$sql .= ' and car_number '. $type;
		$sql .= ' group by typeoil, pwoil';

		$result = DB::select($sql);
		$i=0;
		foreach ($result as $key => $value) {
			$i++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+2, $i);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, $row+2, $value->typeoil);

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, $row+2, $value->pwoil);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, $row+2, $value->totalwoil);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, $row+2, 'ลิตร');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (5, $row+2, $value->totalmoney);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (6, $row+2, '');
			
			$row++;
		}


		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // Set excel version 2007	  		
	    $objWriter->save(storage_path()."/excel/report5.xls");

	    return Response::download( storage_path()."/excel/report5.xls", "report5.xls");
	}





	/**
	 * [calwoil คำนวนจำนวน ลิตร]
	 * @param  [type] $y    [description]
	 * @param  [type] $m    [description]
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	public function calwoil($y, $m, $type)
	{
		if( $m == 10 || $m == 11 || $m == 12 ){
			$y = ($y-1);
		}		

		$data = DB::table('c_caroil')
				->where(DB::raw('year(oildate)'), $y)
				->where(DB::raw('month(oildate)'), $m)
				->where('typeoil', 'LIKE', '%' . $type . '%')
				->select(DB::raw('sum(woil) as totalwoil'))
				->groupby('typeoil')
				->get();

		foreach ($data as $key => $value) {
			return $value->totalwoil;	
		}		
	}




	/**
	 * [calmoneyoil คำนวนจำนวนเงิน]
	 * @param  [type] $y    [description]
	 * @param  [type] $m    [description]
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	public function calmoneyoil($y, $m, $type)
	{
		if( $m == 10 || $m == 11 || $m == 12 ){
			$y = ($y-1);
		}		

		$data = DB::table('c_caroil')
				->where(DB::raw('year(oildate)'), $y)
				->where(DB::raw('month(oildate)'), $m)
				->where('typeoil', 'LIKE', '%' . $type . '%')
				->select(DB::raw('sum(moneyoil) as totalmoneyoil'))
				->groupby('typeoil')
				->get();

		foreach ($data as $key => $value) {
			return $value->totalmoneyoil;	
		}		
	}





	//เดือน ปีงบ
	public function get_month()
	{
		$data = array(
			'10' => 'ต.ค.',
			'11' => 'พ.ย.',
			'12' => 'ธ.ค.',
			'01' => 'ม.ค.',
			'02' => 'ก.พ.',
			'03' => 'มี.ค.',
			'04' => 'เม.ย.',
			'05' => 'พ.ค.',
			'06' => 'มิ.ย.',
			'07' => 'ก.ค.',
			'08' => 'ส.ค.',
			'09' => 'ก.ย.'
		);

		return $data;
	}





}

?>