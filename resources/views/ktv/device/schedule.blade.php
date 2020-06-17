@extends('ktv.index')
@section('content')
<style type="text/css">
  h2{
    margin-left: 40px;
    font-weight: bold;
  }
  hr{
  	height: 2px;
  	background-color: green;
  	margin-left: 40px;
  }
  #sl_dv{
  	margin-left: 40px;
  }
  .form{
  	margin-left: 40px;
  	font-size: 20px;
  }
  .fa-trash:hover{
    background-color: red;
  }
</style>

<div class="container2">
	<h2>Tạo Quy Trình Bảo Dưỡng Cho Thiết Bị</h2>
	<hr>
	
 	<form class="form" action="{{ route('device.postScheduleAct')}}" method="post">
 		@csrf
 		<div >
 		<select name="sl_dv" id="searchDv" class="form-control" style="width: 90%;"  >
 			<option disabled="" value="">Lựa chọn thiết bị cần tạo lịch</option>
 			@if(isset($devices))
 			@foreach($devices as $row)
 			<option value="{{$row->dv_id}}">{{ $row->dv_model }}--{{ $row->dv_serial }}--{{ $row->dv_name }}</option>
 			@endforeach
 			@endif
 		</select><br>
    <small style="margin-left: 5px;">Nhập model ,serial thiết bị, tên thiết bị</small>
 	</div>
  <br>
  	<div>
    <label >Hoạt động bảo dưỡng</label>
    <input style="width: 90%" type="text" name="nameAct" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập hoạt động cần bảo dưỡng">
    <small id="emailHelp" class="form-text text-muted">VD: Kiểm tra buồng kính chiếu tia X</small>
  	</div>
  	<div class="form-group">
    <label for="exampleInputPassword1">Tần suất thực hiện</label>
    <select style="width: 90%" type="text" name="timeAct" class="form-control">
      <option>1 tuần</option>
      <option>1 tháng</option>
      <option>2 tháng</option>
      <option>3 tháng</option>
      <option>4 tháng</option>
      <option>5 tháng</option>
      <option>6 tháng</option>
      <option>12 tháng</option>
    </select>
  	</div>
  	<div class="form-group">
    	<label for="exampleInputEmail1">Ghi chú</label>
    	<input style="width: 90%" type="text" name="note" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  	</div>
  	<div>
  		<button style="width: 70px; float: left;" id="luu" type="submit" class="btn btn-primary">Lưu</button>
  		<div style="float: left;margin-left: 10px;"><a class="btn btn-primary" href="{{route('device.schedule')}}">Hoàn tất</a></div>
  	</div>
  		
	</form>
<br><br>
	<div style="margin-left: 50px; width: 95%">
	<table class="table table-condensed table-bordered table-hover ">
		<thead>
			<th>Hạng mục công việc</th>
			<th>Tần suất bảo dưỡng</th>
			<th>Ghi chú</th>
			<th width="10%"></th>
		</thead>
		@if(isset($schedules))
		<tbody>
			@foreach($schedules as $row)
			<tr>
				<td>$row->scheduleAct</td>
				<td>$row->scheduleTime</td>
				<td>$row->note</td>
				<td>
					<a href="{{route('device.delScheduleAct',['id'=>$row->id] )}}" onclick="return confirm('Bạn có chắc chắn xóa?')" ><i class="fa fa-trash" title="Xóa" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
		@endif
	</table>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#searchDv').select2({});
  })
</script>
@endsection




