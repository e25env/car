<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
<thead>
	<tr>
	<th>#</th>	
	<th>เล่มที่</th>	
	<th>เลขที่</th>			
	<th>วันที่</th>		
	<th>รายการ</th>
	<th>เลขไมค์</th>	
	<th>กิโลเมตร</th>
	<th>ราคา/ลิตร</th>
	<th>ลิตร</th>	
	<th>ยอดเงิน</th>		
	<th>จัดการ</th>
	</tr>
</thead>
<tbody>		
	<?php $i=0; ?>	
	@foreach( $data as $a )		
	<?php $i++; ?>	
	<tr class="uk-table-middle">			
    	<td><?php echo $i; ?></td>	
    	<td>{{ $a->bookoil }}</td>	
    	<td>{{ $a->numberoil }}</td>	        	
		<td><?php echo date("d-m", strtotime($a->oildate)).'-'.(date("Y", strtotime($a->oildate))+543); ?></td>
		<td>{{ $a->typeoil }}</td>	
		<td>{{ $a->mioil }}</td>	
		<td>{{ $a->kmoil }}</td>
		<td>{{ $a->pwoil }}</td>
		<td>{{ $a->woil }}</td>
		<td>{{ $a->moneyoil }}</td>
		<td><a data-uk-tooltip title="ลบข้อมูล" class="uk-button uk-button-danger" onclick="oildel('{{ $a->car_number }}', {{ $a->id }})" href="javascript:void(0)"><i class="uk-icon-trash-o"></i></a></td>	
	</tr>	
	@endforeach		
</tbody>
</table>