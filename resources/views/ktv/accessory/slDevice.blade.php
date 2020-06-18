@extends('ktv.index')
@section('content')

<br>
<div>
	<form class="form-group" action="" method="get">
		<table>
			<tr>
				<td width="25%">
					<div style="margin-left: 50px;"><input type="text" name="dvId" class="form-control" placeholder="Nhập mã thiết bị "></div>
				</td>
				<td width="15%"> 
           		 <div style="margin-left: 5px;" >
            	<input  type="text" class="form-control" placeholder="Nhập Model thiết bị" name="model" >
            	</div>
         		 </td>
          		<td width="15%">
            		<div style="margin-left: 5px;">
            	<input  type="text" class="form-control" placeholder="Nhập Serial thiết bị" name="serial" >
            		</div>
          		</td>
				<td width="15%">
					<div style="margin-left: 5px;">
						<select name="dept" class="form-control">
							<?php $depts = DB::table('department')->get(); ?>
						<option value="">Chọn khoa phòng</option>
						@foreach($depts as $d)
						<option value="{{ $d->id }}">{{ $d->department_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="15%">
					<div style="margin-left: 5px;">
						<select  name="dvt" class="form-control">
						<option value="">Chọn loại thiết bị</option>
						<?php $dvts = DB::table('device_type')->get(); ?>
						@foreach($dvts as $r1)
						<option value="{{ $r1->dv_type_id }}">{{ $r1->dv_type_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="25%">
					<div style="margin-left: 5px;"> <button class="btn btn-primary">Tìm kiếm </button></div>
				</td>
			</tr>
		</table>
	</form>
	
	</div>
<div style="margin-left: 50px;width: 95%">
		@if(count($devices))
	<div >
		<h3><b>Chọn các thiết bị có thể tương thích với vật tư</b> </h3>
	</div>
	<form method="post" action="{{ route('acc.postSelectDev',['id'=>$id]) }}">
		@csrf
		<button class="btn btn-success" style="float: right;">Lưu lựa chọn</button>
		<br><br>
		<table class="table table-condensed table-bordered table-hover">
			<thead style="background-color: #D8D8D8">
				<th width="15%">Mã thiết bị</th>
				<th width="25%">Tên thiết bị</th>
				<th width="10%">Model</th>
				<th width="10%">Serial</th>
				<th width="20%">Loại thiết bị</th>
				<th width="5%">Năm SX</th>
				<th width="5%"></th>
			</thead>
			<tbody>
				
				@foreach($devices as $r)
				<tr>
					<td>{{ $r->dv_id }}</td>
					<td>{{ $r->dv_name }}</td>
					<td>{{ $r->dv_model }}</td>
					<td>{{ $r->dv_serial }}</td>
					<td>{{ \App\Device_type::where(['dv_type_id'=>$r->dv_type_id])->pluck('dv_type_name')->first() }}</td>
					<td>{{ $r->produce_date }}</td>
					<td style="text-align: center;">
						<input class="form-control" type="checkbox" name="selected[]" value="{{$r->id}}">
					</td>
					
				</tr>
				@endforeach
				
			</tbody>
		</table>
		</form>
		@endif
</div>
<br><br>

<div style="margin-left: 50px;width: 95%">
	<h3><b>Danh sách thiết bị có thể sử dụng vật tư</b></h3>
	<table class="table table-condensed table-bordered table-hover">
			<thead style="background-color: #D8D8D8">
				<th width="15%">Mã thiết bị</th>
				<th>Tên thiết bị</th>
				<th>Model</th>
				<th>Serial</th>
				<th>Năm sản xuất</th>
				
			</thead>
			<tbody>
				@if(isset($accDevices))
				@foreach($accDevices as $r)
				<tr>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('dv_id')->first() }}</td>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('dv_name')->first() }}</td>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('dv_model')->first() }}</td>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('dv_serial')->first() }}</td>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('produce_date')->first() }}</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
</div>

@endsection