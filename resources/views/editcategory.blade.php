@extends('master')
@section('content')
<div class="container jumbotron">
<h2>Edit Category</h2>
<br>
<form method="post" action="/updatecategory/{{$category->id}}" enctype="multipart/form-data">
   @csrf()    
   @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success ">{{Session::get('success')}}</div>
    @endif

    <div class="form-group">
          <label>Category Name </label>
          <input type="text" class="form-control" name="categoryname" value="{{$category->categoryname}}" />
          @if($errors->has('categoryname'))
          <div class="alert alert-danger">{{$errors->first('categoryname')}}</div>
          @endif
      </div>
      
      <input type="submit" value="Update" class="btn btn-success"/>
  </form>
</div>
@endsection