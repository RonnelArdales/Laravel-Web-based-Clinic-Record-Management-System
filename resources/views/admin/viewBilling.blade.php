@extends('layouts.admin_navigation')
@section('content')
<div class="row m-3">
    <div>
        <a class="btn btn-info" href="/admin/billing"> Back </a>
    </div>
    <hr>
    {{$infos->user->fname}}
</div>
@endsection