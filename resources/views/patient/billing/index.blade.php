@extends('layouts.navbar')
@section('content')
    
<style>
      th, td{
            text-align: center; 
      }
</style>

<div class="container" >
      <h1 class="text-center text-[30px]">Billing</h1>
      <div class="card"style="background:#EDDBC0;border:none;height:700px " >
            <div class="transaction" style="padding:0%">
                  <div class="card-body" style="height:70vh width:100%; min-height:10vh; display: flex; overflow-x: auto;  font-size: 15px; ">
                        <table  class=" table table-bordered border border-dark table-striped" >
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
                                                <a href="/patient/billing/printinvoice/{{$billing->transno}}" class="btn btn-secondary" >Print</a>
                                          </td>
                                    </tr>
                                    @endforeach
                              @else
                                    <tr class="overflow-auto">
                                          <td colspan="5" >No available bill</td>
                                    </tr>
                              @endif
                              </tbody>
                        </table>
                  </div>
                  <div style="">
                        {!! $billings->links() !!}
                  </div>
            </div>
      </div>
</div>
@endsection