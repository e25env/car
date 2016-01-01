@extends('layouts.sidebar')
@section('content')
	
<h4 class="tm-article-subtitle">รายงานสรุประยะทางของรถยนต์</h4>	

<center>
<div class="uk-panel uk-panel-box box-primary">
	{{ Form::open( array( 'url' => 'report2/export', 'enctype' => 'multipart/form-data', 'class' => 'uk-form' ) ) }}
		<fieldset data-uk-margin>   
	        <label> วันที่(ว-ด-ป) </label>
	        <input type="text" placeholder="__-__-____" id="datestart1" name="datestart1" class="datestart1">
	        <label> ถึงวันที่(ว-ด-ป) </label>
	        <input type="text" placeholder="__-__-____" id="dateend1" name="dateend1" class="dateend1">
	    </fieldset>
	    <button class="uk-button">ตกลง</button>
	 {{ Form::close() }}
</div>
</center>

@stop

