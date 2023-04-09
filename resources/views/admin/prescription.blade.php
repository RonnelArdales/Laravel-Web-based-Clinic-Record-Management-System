@extends('layouts.admin_navigation')

@section('content')

<div class="card" style="height:420px">
    <div class="card-body" >
        <div class="data-patient">
        <table class="table addtocart table-bordered table-striped">
            <thead>
                <tr>
                    <th>Appointment no.</th>
                    <th>User id</th>
                    <th>Fullname</th>
                    <th>consultation date</th>
                    <th>service code</th>
                    <th>service</th>
                    <th>price</th>
                    <th>action</th> 
                </tr>
            </thead>
            <tbody >
                @if (count($patients)> 0 )
                @foreach ($patients as $patient)
                <tr class="overflow-auto">
                    <td>{{$patient->id}}</td>
                    <td>{{$patient->fname}}</td>
                    <td>{{$patient->lname}}</td>
                    <td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" style="text-align: center; height:280px ">No Service Found</td>
                  </tr>
                @endif
            </tbody>
        </table>
        <div>
            {!! $patients->links() !!}
         </div>
        </div>
    
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function (){


    });
</script>

    
@endsection