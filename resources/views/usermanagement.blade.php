@extends('master')
@section('content')

<div class="jumbotron container">
  <h1 class="text-center mt-3 mb-3"> User Data </h1>
  <table class="table table-bordered table-hover">
  <a href="/createuser" align="center" class="btn btn-warning">Add User </a>
  <br>
  <br>
  <thead class="thead-dark">
      <tr>
          <th scope="col">S.no</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name </th>
          <th scope="col">Email </th>
          <th scope="col"> Status</th>
          <th scope="col"> Role</th>
          <th scope="col">Action</th>
      </tr>
  </thead>
      @php 
       $sn=1;
      @endphp
      @foreach($userdata as $cat)
        <tr>
            <td>{{$sn}}</td>
            <td>{{$cat->firstname}}</td>
            <td>{{$cat->lastname}}</td>
            <td>{{$cat->email}}</td>
            @if($cat->status==1)
              <td class="text-success">Active</td>
            @else
              <td class="text-danger">Inactive</td>
            @endif
            <td>{{$cat->role_name}}</td>
            <td><a href="/edituser/{{$cat->id}}" class="btn btn-primary">Edit</a>&nbsp;
                <a href="/deleteuser/{{$cat->id}}"  class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
            </td>
            
        </tr>
      @php 
       $sn++;
      @endphp
      @endforeach
  </table>
</div>
@endsection 