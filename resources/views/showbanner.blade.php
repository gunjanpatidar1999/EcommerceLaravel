@extends('master')
@section('content')
<div class="jumbotron container">
  <h1 class="text-center mt-3 mb-3"> Banner </h1>
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
          <th scope="col">Title</th>
          <th scope="col">Description </th>
          <th scope="col"> Images</th>
          <th scope="col"> Actions</th>
      </tr>
  </thead>
      @php 
       $sn=1;
      @endphp
      @foreach($catdata as $cat)
        <tr>
            <td>{{$sn}}</td>
            <td>{{$cat->title}}</td>
            <td>{{$cat->description}}</td>
            <td><a href="/displayBannerImages/{{$cat->id}}" class="btn btn-success">Show images</a></td>
            <td><a href="/editbanner/{{$cat->id}}" class="btn btn-primary">Edit</a>&nbsp;
                <a href="/deletebanner/{{$cat->id}}"  class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a></td>
        </tr>
      @php 
       $sn++;
      @endphp
      @endforeach
  </table>
</div>
@endsection 