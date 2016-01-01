@extends('layouts.sidebar')
@section('content')
	
	<h4 class="tm-article-subtitle">จุดประสานงาน</h4>	
	
	<div id="blog-content">

		@if( count($data) == 0 )
			<h2>-ไม่มีข้อมูล</h2>
		@endif

		@foreach( $data as $p )
			<div class="post">
				<article class="uk-article">
					<h1 class="uk-article-title">
						@if( $p->status == 0 )
							<i class="uk-text-danger uk-icon-thumb-tack"></i>
						@endif
						@if( $p->status == 1 )
							<i class="uk-text-success uk-icon-thumbs-o-up"></i>
						@endif
						{{ $p->postTitle }}
					</h1>
					<p class="uk-article-meta">สร้างโดย {{ $p->fullname }} วันที่ <?php echo date("d-m", strtotime($p->postDate)).'-'.(date("Y", strtotime($p->postDate))+543); ?> เวลา <?php echo date("H:i:s", strtotime($p->postDate)) ?></p>
					<p>
						{{ $p->postDesc }}
					</p>
					@if( Session::get('c3') == 1 )
						<a target="_blank" href="{{ url('contact/print', $p->postID) }}">พิมพ์</a> /
						<a href="{{ url('contact/okwork', $p->postID) }}">ทำแล้ว</a> /
						<a href="{{ url('contact/nowork', $p->postID) }}">ยังไม่ทำ</a>
					@endif
				</article>
			</div>
		@endforeach

		<?php echo $data->links(); ?>

	</div>

	@if( Session::get('c3') == 1 )
	<div class="blogwrite uk-panel uk-panel-box uk-panel-box-primary uk-width-1-2 uk-container-center">
		{{ Form::open( array( 'url' => 'contact', 'class' => 'uk-form uk-form-horizontal' ) ) }}
			<fieldset>
				<div class="g-header-from uk-text-danger">เพิ่มข้อมูล</div>
				<div class="uk-form-row">
					<input type="text" class="uk-width-1-1" id="postTitle" name="postTitle" placeholder="เรื่อง" />
					@if ($errors->has('postTitle')) <p class="g-text-error uk-text-danger">{{ $errors->first('postTitle') }}</p> @endif
				</div>  
			    <div class="uk-form-row">
					<div class="blogwrite-text">
						<textarea class="uk-width-1-1" name="postDesc" id="postDesc" cols="" rows="" placeholder="ข้อความ"></textarea>
						@if ($errors->has('postDesc')) <p class="g-text-error uk-text-danger">{{ $errors->first('postDesc') }}</p> @endif
					</div>
				</div>
				<div class="uk-form-row uk-text-center">
					{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
				</div>
			</fieldset>
		{{ Form::close() }}
	</div>
	@endif
	
@stop
