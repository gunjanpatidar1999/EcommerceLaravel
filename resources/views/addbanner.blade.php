@extends('master')
@section('content')
<div class="container jumbotron">
<h2>Add Banner</h2>
<br>
<form method="post" action="/postbanner" enctype="multipart/form-data">
   @csrf()    
   @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success ">{{Session::get('success')}}</div>
    @endif

    <div class="form-group">
          <label>Title </label>
          <input type="text" class="form-control" name="title" />
          @if($errors->has('title'))
          <div class="alert alert-danger">{{$errors->first('title')}}</div>
          @endif
      </div>
      
      <div class="form-group">
          <label>Description </label>
          <input type="text" class="form-control" name="description" />
          @if($errors->has('description'))
          <div class="alert alert-danger">{{$errors->first('description')}}</div>
          @endif
      </div>

        <div class="form-group">
          <label>Choose Images </label><br>
          <input type="file" class="form-contol" name="images[]" multiple/>
        </div>

      <input type="submit" value="Submit" class="btn btn-success"/>
  </form>
</div>
@endsection