@extends('master')
@section('content')

<div class="container jumbotron">
<h2>Add User</h2>
<br>
<form method="post" action="/postuser">
    
   @csrf()    
   @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success  text-success">{{Session::get('success')}}</div>
    @endif
    <div class="form-group">
          <label>First Name </label>
          <input type="text" class="form-control" name="firstname" />
          @if($errors->has('firstname'))
          <div class="alert alert-danger">{{$errors->first('firstname')}}</div>
          @endif
      </div>
    
      <div class="form-group">
          <label>Last Name </label>
          <input  type="text" class="form-control " name="lastname" />  
          @if($errors->has('lastname'))
          <div class="alert alert-danger">{{$errors->first('lastname')}}</div>
          @endif
      </div>

      <div class="form-group">
          <label>Email </label>
          <input  type="email" class="form-control " name="email" />  
          @if($errors->has('email'))
          <div class="alert alert-danger">{{$errors->first('email')}}</div>
          @endif
      </div>

      <div class="form-group">
          <label>Password </label>
          <input  type="password" class="form-control " name="password" />  
          @if($errors->has('password'))
          <div class="alert alert-danger">{{$errors->first('password')}}</div>
          @endif
      </div>

      <div class="form-group">
          <label>Confirm Password </label>
          <input  type="password" class="form-control " name="cpassword" />  
          @if($errors->has('cpassword'))
          <div class="alert alert-danger">{{$errors->first('cpassword')}}</div>
          @endif
      </div>

      <div class="form-group">
            <label>Status </label><br>
            &nbsp;<input type="radio" name="radio" id="yes" value="1" default checked>
            <label for="active">Active</label>&nbsp;&nbsp;
            <input type="radio" name="radio" id="no" value="0">
            <label for="inactive">Inactive</label>
        </div>

      <div class="form-group">
          <label>Role</label>
          <select class="form-control" name="type">
            <option value="5" default selected> Customer </option>
            @foreach($roledata as $catname)
              <option value="{{$catname->id}}">{{$catname->role_name}}</option>
            @endforeach
          </select>
            @if($errors->has('type')) <div class="alert alert-danger">{{$errors->first('type')}}</div>
          @endif
        </div>


        

      <input type="submit" value="Submit" class="btn btn-success"/>
  </form>
</div>
@endsection