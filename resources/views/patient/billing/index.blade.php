@extends('layouts.navbar')
@section('content')
    



<div class="container">
    <h1 class="text-center text-[30px]">billing</h1>
    <div>
        <table class="table table-striped table-bordered border border-dark col-sm">
            <thead style="background-color: burlywood">
              <tr  style=" position: relative;">
                    <th>Transaction no.</th>
                    <th>Transaction date</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if (count($billings) > 0 )
                @foreach ($billings as $billing)
                  <tr class="overflow-auto">
                        <td>{{$billing->id}}</td>
                        <td>{{ date('M d, Y h:i A', strtotime($billing->created_at))}}</td>
                        <td>{{$billing->total}}</td>
                        <td>{{$billing->status}}</td>
                        <td>
                              <a href="/patient/billing/printinvoice/{{$billing->transno}}" class="btn" >Print</a>
                        </td>
                  </tr>
                  
                @endforeach
                    
                @else
                    
                @endif
          
            </tbody>
          </table> 
    </div>
</div>

@endsection