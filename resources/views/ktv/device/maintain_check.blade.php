@extends('ktv.index')
@section('content')
<style type="text/css">
   .form-popup {
    display: none;
    position: fixed;
    top: 150px;
    bottom: 200px;
    left: 400px;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }
  .form-container {
    max-width: 800px;
    padding: 10px;
    background-color: #BDBDBD;
    max-height: 500px;
    border-radius: 5px;
  }
  /* Full-width input fields */
  .form-container input[type=text], .form-container input[type=date], .form-container input[type=password], .form-container select[type=text] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 5px 0;
    border: none;
    background: #f1f1f1;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus, .form-container input[type=password]:focus,.form-container select[type=text]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-container .btn {
    background-color: #4CAF50;
    font-size: 20px;
    color: white;
    padding: 10px 10px;
    border: none;
    cursor: pointer;
    width: 150px;
    margin-left:10px;
    opacity: 0.7;
  }

  /* Add a red background color to the cancel button */
  .form-container .cancel {
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover, .open-button:hover {
    opacity: 1;
  }
  .bod{
    border: 1px solid black;
    text-align: center;
  }
</style>
@php
  $months =[ '01','02','03','04','05','06','07','08','09','10','11','12'];
@endphp
<body>
<div style="margin-left: 10px;">
  <h2 ><b>Thống Kê Lịch Trình Bảo Dưỡng Định Kì </b></h2>
  <table style="font-size: 20px;width: 100%">
    <tr>
      <td>Tên thiết bị:  <b>{{ $device->dv_name }}</b></td>
      <td>Model: <b>{{ $device->dv_model }}</b></td>
      <td>Serial: <b>{{ $device->dv_serial }}</b></td>
    </tr>
  </table>
  
</div>
<div style="margin-top: 50px;">
  <form method="get" action="{{ route('device.maintainCheck',['id'=>$device->dv_id ]) }}">
  <div style="float: left;margin-left: 10px;" >
  		<select style="width: 250px;" id="slMonth" class="form-control" name="month"  >
		  <option value="{{ date ('m')}}">Tháng {{ date ('m')}}</option>
      @for($i =0; $i < count($months); $i++)
      @if($months[$i] != date ('m') )
		  <option value="{{ $months[$i] }}" {{ (request()->month == $months[$i] ) ? 'selected': ""}}>Tháng {{ $months[$i] }}</option>
      @endif
		  @endfor
		  </select>
  </div>
  <div style="float: left; margin-left: 10px;">
  <select class="form-control" id="slYear" style="width: 250px;" name="year">
    <option value="{{ date('Y') }}" {{ (request()->year == date('Y') ) ? 'selected': ""}}>Năm {{ date('Y') }}</option>
    @for($i =2020; $i<=2050; $i++)
    @if( $i != date('Y') )
    <option value="{{$i}}" {{ (request()->year == $i ) ? 'selected': ""}}> Năm {{$i}}</option>
    @endif
    @endfor
  </select>
  </div>
  <div style="float: left;margin-left: 10px;">
    <button class="btn btn-success" >Kiểm tra</button>
  </div>
  </form>
</div>
<div style="float: left;margin-left: 300px">
  <form action="{{ route('device.detailCheck') }}" method="get">
    <div style="float: left;"><input type="text" required="" name="cid" placeholder="Nhập mã kiểm tra hoạt động" class="form-control"></div>
    <div style="float: left;"><button class="btn btn-primary" style="margin-left: 30px;">Tìm kiếm</button></div>
  </form>
</div>
<br><br><br>

<div>
<div>
	<table width="98%" id="m30" style="margin-left: 7px;display: none;">
			<tr style="background-color: #DBA901">
				<td class="bod" style="text-align: left;width: 20%;"><div style="padding: 7px;"><b>Hoạt động bảo dưỡng\Ngày trong tháng</b></div></td>
				@for($i =1; $i<=30; $i++)
				<td class="bod">{{ $i }}</td>
				@endfor	
			</tr>
    @if(isset($maintainAct))
    @foreach($maintainAct as $row)
			<tr>
				<td class="bod" style="text-align: left;"><b>{{ $row -> scheduleAct}}</b></td>
				@for($i = 1; $i<=30; $i++)
				<td  style="text-align: center; width: 1.5%;cursor: pointer;border: 1px solid black" class="check" data-deviceid="{{ $row->id.$i }}" id="{{ $row->id.$i }}">
          @if($checked != null) 
            @foreach($checked as $ch)
                @if( $ch->check_id == $row->id.$i.$ms.$ys )
                    @if($ch->type_check == 'C') 
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: green">{{$ch->type_check}} </button>
                    @elseif($ch->type_check == 'M')
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: yellow">{{$ch->type_check}} </button>
                    @else
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: violet">{{$ch->type_check}} </button>
                    @endif
                @endif
            @endforeach
          @endif    
        </td>
				@endfor
			</tr>
    @endforeach
    @endif
	</table>
</div>
<div>
  <table width="98%"  id="m31" style="margin-left: 7px;display: none;">
      <tr style="background-color: #DBA901">
        <td class="bod" style="text-align: left;width: 20%;"><div style="padding: 7px;"><b>Hoạt động bảo dưỡng\Ngày trong tháng</b></div></td>
        @for($i =1; $i<=31; $i++)
        <td class="bod">{{ $i }}</td>
        @endfor 
      </tr>
    @if(isset($maintainAct))
    @foreach($maintainAct as $row)
      <tr>
        <td class="bod" style="text-align: left;"><b>{{ $row -> scheduleAct}}</b></td>
        @for($i = 1; $i<=31; $i++)
        <td style="text-align: center; width: 1.5%;cursor: pointer; border: 1px solid black" class="check" data-deviceid="{{ $row->id.$i }}" id="{{ $row->id.$i}}">
          @if($checked != null) 
            @foreach($checked as $ch)
                @if( $ch->check_id == $row->id.$i.$ms.$ys )
                    @if($ch->type_check == 'C') 
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: green">{{$ch->type_check}} </button>
                    @elseif($ch->type_check == 'M')
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: yellow">{{$ch->type_check}} </button>
                    @else
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: violet">{{$ch->type_check}} </button>
                    @endif
                @endif
            @endforeach
          @endif    
        </td>
        @endfor
      </tr>
    @endforeach
    @endif
  </table>
</div>
<div>
  <table width="98%" id="m28" style="margin-left: 7px;display: none;">
      <tr style="background-color: #DBA901">
        <td class="bod" style="text-align: left;width: 20%;"><div style="padding: 7px;"><b>Hoạt động bảo dưỡng\Ngày trong tháng</b></div></td>
        @for($i =1; $i<=28; $i++)
        <td class="bod">{{ $i }}</td>
        @endfor 
      </tr>
    @if(isset($maintainAct))
    @foreach($maintainAct as $row)
      <tr>
        <td class="bod" style="text-align: left;"><b>{{ $row -> scheduleAct}}</b></td>
        @for($i = 1; $i<=28; $i++)
        <td  style="text-align: center; width: 1.5%;cursor: pointer;border: 1px solid black" class="check" data-deviceid="{{ $row->id.$i }}" id="{{ $row->id.$i }}">
          @if($checked != null) 
            @foreach($checked as $ch)
                @if( $ch->check_id == $row->id.$i.$ms.$ys )
                    @if($ch->type_check == 'C') 
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: green">{{$ch->type_check}} </button>
                    @elseif($ch->type_check == 'M')
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: yellow">{{$ch->type_check}} </button>
                    @else
                    <button data-deviceid="{{ $ch->check_id }}" class="editcheck" style="height: 20px;font-size: 9px;background-color: violet">{{$ch->type_check}} </button>
                    @endif
                @endif
            @endforeach
          @endif    
        </td>
        @endfor
      </tr>
    @endforeach
    @endif
  </table>
</div>
	
</div>	
	
  <div class="form-popup" id="myForm">
    <form action="{{ route('device.check','id')}}" class="form-container form1" method="post">
      @csrf
      <table style="font-size: 17px;" border="0" >
        <tr>
          <td colspan="2"><label style="text-align: center; font-size: 22px;"><b>Thông tin bảo dưỡng thiết bị</b></label></td>
        </tr>
        <tr>
          <td><input type="text" id="thang" name="thang" value="{{ date('m')}}" hidden=""  ></td>
          <td><input type="text" id="nam" name="nam" value="{{ date('Y')}}" hidden="" ></td>
        </tr>
        <tr>
          <td><label>Mã thiết bị</label></td>
          <td><input type="text" name="dv_id" value="{{$device->dv_id}}"></td>
        </tr>
        <tr>
          <td width="20%"><label>Mã kiểm tra</label></td>
          <td><input type="text" id="id_check" name="id_check"></td>
        </tr>
        
        <tr>
          <td ><label>Loại kiểm tra</label></td>
          <td>
            <select id="select_check" type="text" name="select_check" style="font-style: 17px;">
              <option value="" disabled="">Chọn loại bảo dưỡng</option>
              <option value="C">Kiểm tra</option>
              <option value="M">Bảo trì</option>
              <option value="I">Kiểm định</option>
            </select> 
          </td>
        </tr>
        <tr>
          <td><label>Ngày thực hiện</label></td>
          <td><input id="date_check" type="date" name="date_check" value="{{date('Y-m-d')}}"></td>
        </tr>
        <tr>
          <td><label>Người thực hiện</label></td>
          <td><input type="text" id="checker" name="checker" value="{{Auth::user()->fullname}}"></td>
        </tr>
        <tr>
          <td><label>Ghi chú</label></td>
          <td><input id="note" type="text" name="note"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><button id="luu" type="submit" class="btn">Lưu
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>

<div class="form-popup" id="myForm1">
    
    <form action="" class="form-container form2" method="">
      <table style="font-size: 17px;" border="0" >
        <tr>
          <td colspan="2"><label style="text-align: center; font-size: 22px;"><b>Cập nhật thông tin bảo dưỡng thiết bị</b></label></td>
        </tr>
        <tr>
          <td><label>Mã thiết bị</label></td>
          <td><input type="text" name="dv_id" value="" disabled=""></td>
        </tr>
        <tr>
          <td width="20%"><label>Mã kiểm tra</label></td>
          <td><input type="text" id="id_check1" name="id_check1" value="" disabled=""></td>
        </tr>
        
        <tr>
          <td ><label>Loại kiểm tra</label></td>
          <td>
            <select disabled="" id="select_check1" type="text" name="select_check1" style="font-style: 17px;">
              <option value=""></option>
            </select> 
          </td>
        </tr>
        <tr>
          <td><label>Ngày thực hiện</label></td>
          <td><input id="date_check" type="date" name="date_check" ></td>
        </tr>
        <tr>
          <td><label>Người thực hiện</label></td>
          <td><input type="text" id="checker" name="checker" ></td>
        </tr>
        <tr>
          <td><label>Ghi chú</label></td>
          <td><input id="note" type="text" name="note"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;">
          <button type="button" class="btn cancel" onclick="closeForm()">Đóng</button></td>
        </tr>
      </table>
    </form>
  </div>
</body>
<script type="text/javascript">
  var y = '{{ $ys }}';
  var m = '{{ $ms }}'; 
  function closeForm() {
        document.getElementById("myForm").style.display = "none";
        document.getElementById("myForm1").style.display = "none";

  }
	$(document).ready(function(){
    $('#nam').val(y);
    $('#thang').val(m);
    if(m == '02'){
        $('#m28').css("display", "block");
        $('#m31').css("display", "none");
        $('#m30').css("display", "none");
    }else if(m == '01' || m == '03' || m == '05' || m == '06' || m == '08' || m == '10' || m == '12' ){
        $('#m31').css("display", "block");
        $('#m28').css("display", "none");
        $('#m30').css("display", "none");
    }else{
      $('#m30').css("display", "block");
        $('#m31').css("display", "none");
        $('#m28').css("display", "none");
    }

    $('#slYear').on('change',function(){
      y = $("#slYear option:selected").val();
      
    });
		
		$('#slMonth').on('change',function(){
        //var optionValue = $(this).val();
        //var optionText = $('#dropdownList option[value="'+optionValue+'"]').text();
        m = $("#slMonth option:selected").val();
        //  alert("Selected Option Text: "+optionText);
    	
    	
    	});

  $(document).on('click', '.check', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form1').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form1').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm").style.display = "block";
    document.getElementById('id_check').value = id+m+y;
  });

//editcheck
    $(document).on('click', '.editcheck', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form2').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form2').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm1").style.display = "block";
    document.getElementById('id_check1').value = id;
  });
	})

</script>
@endsection