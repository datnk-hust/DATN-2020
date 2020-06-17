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
  	width: 500px;
  	margin-left: 40px;
  }
  .form{
  	margin-left: 40px;
  	font-size: 20px;
  }
</style>

<div class="container2">
	<h2>Tạo Quy Trình Bảo Dưỡng Cho Thiết Bị</h2>
	<hr>
	
 	<form class="form" action="{{ route('device.postScheduleAct')}}" method="post">
 		@csrf
 		<div>
    <select name="sl_dv" id="sl_dv" class="form-control" required="">
      @foreach($device as $dv)
      <option value="{{$dv->dv_id}}">{{$dv->dv_name}}</option>
      @endforeach
    </select>
  </div><br>
  	<div class="form-group">
    <label for="exampleInputEmail1">Hoạt động bảo dưỡng</label>
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
	<div style="margin-left: 50px;">
	<table class="table table-condensed table-bordered table-hover ">
		<thead>
      <th>ID</th>
			<th>Hạng mục công việc</th>
			<th>Thời gian bảo dưỡng</th>
			<th>Ghi chú</th>
			<th></th>
		</thead>
		<tbody>
      @if(isset($schedules))
			@foreach($schedules as $row)
			<tr>
        <td>{{$row->id}}</td>
				<td>{{$row->scheduleAct}}</td>
				<td>{{$row->scheduleTime}}</td>
				<td>{{$row->note}}</td>
				<td></td>
			</tr>
			@endforeach
      @endif
		</tbody>
		
	</table>
</div>
</div>
@endsection



