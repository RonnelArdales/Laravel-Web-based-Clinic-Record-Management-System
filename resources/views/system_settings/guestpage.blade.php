@extends('layouts.admin_navigation')
@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
        <h1> <B>GUEST PAGE</B> </h1>
    </div>   
@if (session()->has('success'))
   <div class="alert alert-success success"  id="success" >{{ session('success') }}</div> 
@endif
    <table class="table" >
        <thead style="border-bottom-color: black">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Updated_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody style="border:none">
            @foreach ($guestpages as $guestpage)
            <tr class="overflow-auto align-middle" style="text-align: center">
                <td>{{$guestpage->title}}</td>
                <td>{!! \Illuminate\Support\Str::limit(strip_tags($guestpage->content), 20) !!}</td>
                <td>{{$guestpage->updated_at}}</td>
                <td>
                    @if (Auth::user()->usertype === "admin")
                        <a href="{{route('admin.guestpage.edit', $guestpage->id )}}" class="edit btn btn-primary btn-sm">Edit</a>
                    @else
                        <a href="{{route('secretary.guestpage.edit', $guestpage->id )}}" class="edit btn btn-primary btn-sm">Edit</a>
                    @endif
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')

@vite( 'resources/js/system_settings/guestpage/index.js')

@endsection