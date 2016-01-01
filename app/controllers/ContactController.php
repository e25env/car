<?php

class ContactController extends BaseController {
	



	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$data = DB::table('c_blog_posts')
				->leftjoin('n_datageneral', 'n_datageneral.cid', '=', 'c_blog_posts.created_by')
				->orderBy('status', 'asc')
				->orderBy('postDate', 'desc')
				->select('c_blog_posts.*', DB::raw('concat(n_datageneral.pname,n_datageneral.fname," ",n_datageneral.lname) as fullname'))
				->paginate( 10 );

		return View::make('contact.index', array('data' => $data));  		
	}




	/**
	 * [addPost description]
	 */
	public function addPost()
	{
		if( Session::get('c3') == 1 ){
			$postTitle  = Input::get( 'postTitle' );
			$postDesc   = Input::get( 'postDesc' );

			$rules = array(
				'postTitle'    => 'required',
				'postDesc'    => 'required'
			);
			$messages = array(
				'postTitle.required'    => 'กรุณากรอก',
				'postDesc.required'     => 'กรุณากรอก'
			);
	  
		    $validator = Validator::make( Input::all(), $rules, $messages );
		    if ( $validator->fails() ) {			
		        $messages = $validator->messages();			
				return Redirect::to( 'contact' )->withErrors( $validator );
		    }
		    else{
		    	//create new post
	            $post = DB::insert( 'insert into c_blog_posts ( postTitle, postDesc, postDate, created_by ) values ( ?, ?, ?, ? )',
		            	array( 
	            			  $postTitle,
	            			  $postDesc,
	            			  date('Y-m-d H:i:s'),
	            			  Session::get('cid')
	            	     ));
		    }	

			return Redirect::to('contact');  
		}
		else{
			return Redirect::to('contact'); 
		}
	}





	/**
	 * [พิมพ์ post]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function printPost($id)
	{
		if( Session::get('c3') == 1 ){
			$sql  = ' select c.*, concat(n.pname,n.fname," ",n.lname) as fullname from c_blog_posts c left join n_datageneral n on n.cid=c.created_by';
    		$sql .= ' where postID ='.e($id).' ';

    		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		    $pdf->SetPrintHeader(false);
		    $pdf->SetPrintFooter(false);			      		   		   
			 
			// set header and footer fonts
			$pdf->setHeaderFont(array('angsanaupc','',PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array('angsanaupc','',PDF_FONT_SIZE_DATA));
			 
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			 
			// set margins
			$pdf->SetMargins(15, 15, 15);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 		

		    $pdf->AddPage(); 		    
		    
			$pdf->SetFont('angsanaupc','B',16,'',true);
			$pdf->SetXY(15, 15);
			$pdf->MultiCell(180, 0, 'ใบประสานงานขอรถ', 0, 'C', 0, 1, '', '', true);
			
			$data = DB::select( $sql );	

			$pdf->SetFont('angsanaupc','',14,'',true);

			$tbl = '<br /><br /><table style="width: 100%; padding:2px;" cellspacing="0">';
            
            foreach ($data as $key => $value) {
             $tbl = $tbl . '<tr>
                      <td style="border: 0px solid #000000; text-align:left"> เรื่อง '.$value->postTitle.'</td>
                  </tr>';

              $tbl = $tbl . '<tr>
                      <td style="border: 0px solid #000000; text-align:left"> สร้างโดย '. $value->fullname  .' วันที่ '. date("d-m", strtotime($value->postDate)).'-'.(date("Y", strtotime($value->postDate))+543).' เวลา '. date("H:i:s", strtotime($value->postDate)) .'</td>
                  </tr>';

              $tbl = $tbl . '<tr>
                      <td style="border: 0px solid #000000; text-align:left"> '.$value->postDesc.'</td>
                  </tr>';
            }  
            $tbl = $tbl . '</table>';
            $pdf->writeHTML($tbl, true, false, false, false, '');

			$filename = storage_path() . '/report_post.pdf';		   
		    $contents = $pdf->output($filename, 'I');
			$headers = array(
			    'Content-Type' => 'application/pdf',
			);
			return Response::make($contents, 200, $headers);
		}
		else{
			return Redirect::to('contact'); 
		}
	}




	/**
	 * [ทำงานนี้แล้ว]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function okWorkPost($id)
	{
		if( Session::get('c3') == 1 ){
			
			DB::table('c_blog_posts')
            ->where('postID', e($id))
            ->update(array('status' => 1));

			return Redirect::to('contact'); 
		}
		else{
			return Redirect::to('contact'); 
		}
	}





	/**
	 * [ยังไม่ได้ทำงานนี้]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function noWorkPost($id)
	{
		if( Session::get('c3') == 1 ){
			
			DB::table('c_blog_posts')
            ->where('postID', e($id))
            ->update(array('status' => 0));

			return Redirect::to('contact'); 
		}
		else{
			return Redirect::to('contact'); 
		}
	}


	
}
