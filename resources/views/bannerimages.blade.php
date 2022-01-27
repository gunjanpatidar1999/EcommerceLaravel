@extends('master')
@section('content')
<div class="container">
    <h1 class="text-center"> Banner Images </h1>
@php 
$id = $catid;
@endphp
    @foreach($bannerimages as $images)
        @if($id == $images->BannerImageId)
        <div class="container" style="float:left;width: 25%;padding: 10px;">
            <img src="{{asset('/uploads/'.$images->url)}}" width=200 height=200 />
        </div>
        @endif
    @endforeach
</div>
@endsection
