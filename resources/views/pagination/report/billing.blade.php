<div class="card-body" style="width:100%; min-height:64vh; display: flex; overflow-x: auto;  font-size: 15px; ">
    <table class="table table-data table-bordered table-striped" style="background-color: white">
         <thead>
              <tr>
         
                   <th>Transaction no</th>
                   <th>Fullname</th>
                   <th>Service</th> 
                   <th>Total</th>
                   <th>Mode of payment</th>
                   <th>Status</th>
              </tr>
         </thead>
         <tbody id="tbody" >
              @if (count($billings) > 0)
                   @foreach ($billings as $billing)
                   <tr class="overflow-auto" id="nouser">
                        <td>{{$billing->transno}}</td>
                        <td>{{$billing->fullname}}</td>
                        <td>{{$billing->service}}</td>
                        <td>{{$billing->total}}</td>
                        <td>{{$billing->mode_of_payment}}</td>
                        <td>{{$billing->status}}</td>
                   </tr>
                   @endforeach
              @else
                   <tr id="nouser">
                        <td colspan="7" style="text-align: center;">No user Found</td>
                   </tr>
              @endif
         </tbody>
    </table>
</div>
<div>
    {{ $billings->appends(request()->query())->links() }}
</div>