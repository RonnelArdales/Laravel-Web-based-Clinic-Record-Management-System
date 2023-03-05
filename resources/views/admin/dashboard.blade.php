@extends('layouts.admin_navigation')

@section('content')
    <div class="row m-4">
        <h4>dashboard</h4>
        <p>
          
        </p>
    </div>

    @foreach ($patients as $patient)
    <p>{{$patient->fname}}</p>
        
    @endforeach
@endsection

