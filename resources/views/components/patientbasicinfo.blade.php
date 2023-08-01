<div class="rounded    row col-md" style="height:420px; margin:0px;padding-top:10px ; margin-right:18px ;background: #EDDBC0;
box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); ">  
    <div class="col-sm " >
        <label style="font-size:  20px" for=""><b>Basic Information:</b> </label>
        <hr style="margin-top:10px">
        
        <label style="font-size: 13px;" for="">Address:</label><br>
        <label style="font-family: 'Poppins';font-style: normal; font-size:18px"  for="">{{$userinfo->address}} </label><br>

        <label style="font-size: 13px; margin-top:8px" for="">Age:</label><br>
        <label style="font-size: 18px" for="">{{$userinfo->age}} </label><br>

        <label style="font-size: 13px;  margin-top:8px" for="">Gender:</label><br>
        <label style="font-size: 18px" for="">{{$userinfo->gender}} </label><br>

        <label style="font-size: 13px;  margin-top:8px" for="">Contact no:</label><br>
        <label style="font-size: 18px" for="">{{$userinfo->mobileno}} </label><br>
            
        <label style="font-size: 13px; margin-top:8px" for="">Email:</label><br>
        <label style="font-size: 18px" for="">{{$userinfo->email}}</label><br>

        <label style="font-size: 13px; margin-top:8px" for="">Last appointment:</label><br>
        <label style="font-size: 18px" for="">{{ date('M d, Y ', strtotime($last->date))}}</label><br>
        <div class="d-flex justify-content-center row" style="text-align: center; margin-top:20px"></div>
    </div>
</div>