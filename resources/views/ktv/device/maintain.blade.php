@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=text] {
    padding: 3px;
    font-size: 20px;
    border: #A4A4A4 solid 1px;
  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 20px;
    margin-top: 60px;
  }
  h2{
    margin-left: 20px;
    font-weight: bold;
  }
  .fa-cog:hover{
    background-color: yellow;
  }
  .fa-history:hover{
    background-color: green;
  }
  
</style>
<h2>Lịch Sử Sửa Chữa Và Bảo Dưỡng Định Kì Thiết Bị</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0">
        <tr>
          <td width="25%">
            <input class="form-control" style="width: 90%" type="text" name="dv_name" placeholder="nhập tên thiết bị">  
          </td>
          <td width="25%">
            <select class="form-control" id="searchDvt" value="{{ request()->dvt_id}}" name="dvt_id" style="background-color: #D8D8D8;width: 90%">
              <option value="">Loại thiết bị</option>
              @if(isset($dvts))
              @foreach($dvts as $rows)
              <option value="{{ $rows->id }}" >
                {{ $rows->dv_type_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td width="25%">
          <select class="form-control" name="provider" style="background-color: #D8D8D8;width: 90%">
              <option value="">Nhà cung cấp</option>
              @if(isset($providers))
              @foreach($providers as $row)
              <option value="{{ $row->id }}" >
                {{ $row->provider_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td>
            <button class="btnsearch" type="submit" style="width: 100px; margin-left: 5px;padding: 4px;"><i class="fa fa-search">&nbsp;Tìm kiếm</i></button>
          </td>
          
        </tr>
        <tr><td colspan="4"><br></td></tr>
        <tr>
          <td width="25%"> 
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Model thiết bị" name="model" value="{{request()->model}}">
          </td>
          <td>
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Serial thiết bị" name="serial" value="{{request()->serial}}">
          </td>
          <td colspan="2">
            <input style="width: 90%;" type="text" class="form-control" placeholder="Dự án thầu" name="import_id" value="{{request()->import_id}}">
          </td>
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  @if(isset($devices))
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 18px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Serial</th>
        <th>Khoa phòng</th>
        <th>Nhà cung cấp</th>
        <th>Bảo dưỡng đk</th>
        <th width="10%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
      @foreach($devices as $row)
      <tr style="font-size: 15px;cursor: pointer;" ondblclick='location.href=("{{ route('device.maintainCheck', ['id' => $row->dv_id]) }}")' >
        <td>{{ $row->dv_id }}</td>
        <td>{{$row->dv_name}}</td>
        <td>{{$row->dv_model}}</td>
        <td>{{$row->dv_serial}}</td>
        <td>{{ \App\Department::where(['id' => $row->department_id])->pluck('department_name')->first() }}</td>
        <td>{{ \App\Provider::where(['id' => $row->provider_id])->pluck('provider_name')->first() }}</td>
        <td>{{ $row->maintain_date }}</td>
        <td>
            <a href="{{ route('device.history',['id'=>$row->id])}}" style="text-decoration: none;"><i class="fa fa-history " style="font-size: 22px" title="Lịch sử sửa chữa" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('device.maintainCheck', ['id' => $row->dv_id]) }}" style="text-decoration: none;"><i class="fa fa-cog"style="font-size: 22px" title="Lịch sử bảo dưỡng" aria-hidden="true"></i></a>

        </td>
      </tr>
      @endforeach
  @endif
  
</div>
@endsection
<script type="text/javascript">
  $(document).ready(function(){
    $('#searchT').select2({});
    $('#searchDvt').select2({});
  })
</script>

