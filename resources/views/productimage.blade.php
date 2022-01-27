@extends('master')
@section('content')
<div class="container">
    <h1 class="text-center"> Product Images </h1>
@php 
$id = $productid;
@endphp
    @foreach($productimages as $images)
        @if($id == $images->productid)
        <div class="container" style="float:left;width: 25%;padding: 10px;">
            <img src="{{asset('/uploads/'.$images->productimagename)}}" width=200 height=200 />
        </div>
        @endif
    @endforeach
</div>
@endsection
