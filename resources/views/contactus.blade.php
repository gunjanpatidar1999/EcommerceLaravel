@extends('master')
@section('content')
<div class="jumbotron container">
  <h1 class="text-center mt-3 mb-3"> User Query </h1>
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
          <th scope="col"> Name</th>
          <th scope="col"> Email</th>
          <th scope="col"> Subject</th>
          <th scope="col"> Message</th>
      </tr>
  </thead>
      @php 
       $sn=1;
      @endphp
      @foreach($contact as $cat)
        <tr>
            <td>{{$sn}}</td>
            <td>{{$cat->name}}</td>
            <td>{{$cat->email}}</td>
            <td>{{$cat->subject}}</td>
            <td>{{$cat->message}}</td>
    
        </tr>
      @php 
       $sn++;
      @endphp
      @endforeach
  </table>
</div>
@endsection 