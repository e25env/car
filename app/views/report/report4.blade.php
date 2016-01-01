@extends('layouts.sidebar')
@section('content')
	
<h4 class="tm-article-subtitle">รายงานการใช้พลังงานน้ำมันเชื้อเพลิง</h4>	

<center>
<div class="uk-panel uk-panel-box box-primary">
	{{ Form::open( array( 'url' => 'report4/export', 'enctype' => 'multipart/form-data', 'class' => 'uk-form' ) ) }}
		<fieldset data-uk-margin>   
	        <label> ปีงบประมาณ </label>
	        {{ Form::select('year', $year, null, ['class' => 'form-control', 'id' => '']) }}
	    </fieldset>
	    <button class="uk-button">ตกลง</button>								
	 {{ Form::close() }}
</div>
</center>

@stop

