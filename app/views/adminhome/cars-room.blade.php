@extends('layouts.sidebar')
@section('content')
	
	

		<div class="grid">		
			<?php $i=0; ?>
			@foreach( $data as $a )
				<?php if( $a->car_img != '' ){  $i++;  ?>
				<figure class="effect-julia" >
					<?php $urlimg = 'uploads/'.$a->car_number.'/'.$a->car_img3; ?>																
					{{ HTML::image($urlimg, '', array('class' => '', 'height' => '', 'width' => '' ) ); }}
					<figcaption>
						<h2>ทะเบียน <span>{{ $a->car_number }}</span></h2>
						<div>
							<p>ยี่ห้อ: {{ $a->brand }}</p><br />
							<p>รุ่น: <?php echo ( $a->model == '')?'-':$a->model; ?></p><br />
							<p>สถานะรถ: <?php echo ( $a->status == 1 )?'<span class="uk-text-bold uk-text-danger">ไม่ว่าง</span>':'<span class="uk-text-bold uk-text-success">ว่าง</span>'; ?></p>							
						</div>
						<a href="#">View more</a>
					</figcaption>										
				</figure>
				<?php } ?>
			@endforeach	
		
		</div>

	

@stop