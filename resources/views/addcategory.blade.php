@extends('master')
@section('content')
<div class="container jumbotron">
<h2>Add Category</h2>
<br>
<form method="post" action="/postcategory" >
   @csrf()    
   @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success ">{{Session::get('success')}}</div>
    @endif

    <div class="form-group">
          <label>Category Name </label>
          <input type="text" class="form-control" name="categoryname" />
          @if($errors->has('categoryname'))
          <div class="alert alert-danger">{{$errors->first('categoryname')}}</div>
          @endif
      </div>
      

      <input type="submit" value="Submit" class="btn btn-success"/>
  </form>
</div>
@endsection