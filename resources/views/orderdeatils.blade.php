@extends('master')
@section('content')
<div class="jumbotron container">
  <h1 class="text-center mt-3 mb-3"> User Order Deatils </h1>
  @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success ">{{Session::get('success')}}</div>
    @endif
  <table class="table table-bordered table-hover">
  <thead class="thead-dark">
      
      <tr>
          <th scope="col">S.no</th>
          <th scope="col">Email Address</th>
          <th scope="col"> Product Name</th>
          <th scope="col"> Price</th>
          <th scope="col"> Quantity</th>
          
      </tr>
  </thead>
      @php 
       $sn=1;
      @endphp
      @foreach($orderdeatils as $cat)
        <tr>
            <td>{{$sn}}</td>
            <td>{{$cat->uid}}</td>
            <td>{{$cat->productname}}</td>
            <td>{{$cat->price}}</td>
            <td>{{$cat->quantity}}</td>
    
        </tr>
      @php 
       $sn++;
      @endphp
      @endforeach
  </table>
</div>
@endsection 