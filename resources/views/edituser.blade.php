@extends('master')
@section('content')

<div class="container jumbotron">
<h2>Edit User</h2>
<br>
<form method="post" action="/updateuser/{{$edituser->id}}">
    
   @csrf()    
   @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success  text-success">{{Session::get('success')}}</div>
    @endif
    <div class="form-group">
          <label>First Name </label>
          <input type="text" class="form-control" name="firstname" value="{{$edituser->firstname}}" />
          @if($errors->has('firstname'))
          <div class="alert alert-danger">{{$errors->first('firstname')}}</div>
          @endif
      </div>
    
      <div class="form-group">
          <label>Last Name </label>
          <input  type="text" class="form-control " name="lastname" value="{{$edituser->lastname}}" />  
          @if($errors->has('lastname'))
          <div class="alert alert-danger">{{$errors->first('lastname')}}</div>
          @endif
      </div>

      <div class="form-group">
          <label>Email </label>
          <input  type="email" class="form-control " name="email" value="{{$edituser->email}}" />  
          @if($errors->has('email'))
          <div class="alert alert-danger">{{$errors->first('email')}}</div>
          @endif
      </div>

    

      <div class="form-group">
            <label>Status </label><br>
            &nbsp;<input type="radio" name="radio" id="yes" value="1" checked>
            <label for="active">Active</label>&nbsp;&nbsp;
            <input type="radio" name="radio" id="no" value="0">
            <label for="inactive">Inactive</label>
        </div>

      <div class="form-group">
          <label>Role</label>
          <select class="form-control" name="type">
            <option value=""> Select </option>
            @foreach($roledata as $catname)
              <option value="{{$catname->id}}">{{$catname->role_name}}</option>
            @endforeach
          </select>
            @if($errors->has('type')) <div class="alert alert-danger">{{$errors->first('type')}}</div>
          @endif
        </div>


        

      <input type="submit" value="Update" class="btn btn-success"/>
  </form>
</div>
@endsection