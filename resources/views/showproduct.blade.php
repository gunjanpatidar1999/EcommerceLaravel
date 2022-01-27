@extends('master')
@section('content')
<div class="jumbotron container">
  <h1 class="text-center mt-3 mb-3"> Product </h1>
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
          <th scope="col"> Category Name</th>
          <th scope="col">Product Name</th>
          <th scope="col">Product Description </th>
          <th scope="col"> Product Price</th>
          <th scope="col"> Product Quantity</th>
          <th scope="col"> Product Images</th>
          <th scope="col"> Actions</th>
      </tr>
  </thead>
      @php 
       $sn=1;
      @endphp
      @foreach($productdata as $product)
        <tr>
            <td>{{$sn}}</td>
            <td>{{$product->categoryname}}</td>
            <td>{{$product->productname}}</td>
            <td>{{$product->productdescription}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->price}}</td>
            <td><a href="/displayProductImages/{{$product->id}}" class="btn btn-success">Show images</a></td>
            <td><a href="/editproduct/{{$product->id}}" class="btn btn-primary">Edit</a>&nbsp;
                <a href="/deleteproduct/{{$product->id}}"  class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a></td>
        </tr>
      @php 
       $sn++;
      @endphp
      @endforeach
  </table>
</div>
@endsection 