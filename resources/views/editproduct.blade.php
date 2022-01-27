@extends('master')
@section('content')
<div class="container jumbotron">
<h2>Edit Product</h2>
<br>
<form method="post" action="/updateproduct/{{$product->id}}" enctype="multipart/form-data">
   @csrf()    
   @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success ">{{Session::get('success')}}</div>
    @endif

    <div class="form-group">
          <label>Product Category</label>
          <select class="form-control" name="type">
            <!-- <option > Select </option> -->
            @foreach($category as $cat)
              <option value="{{$cat->id}}" selected>{{$cat->categoryname}}</option>
            @endforeach
          </select>
            @if($errors->has('type')) <div class="alert alert-danger">{{$errors->first('type')}}</div>
          @endif
        </div>

    <div class="form-group">
          <label>Product Name </label>
          <input type="text" class="form-control" name="productname"  value="{{$product->productname}}"/>
          @if($errors->has('productname'))
          <div class="alert alert-danger">{{$errors->first('productname')}}</div>
          @endif
      </div>
      
      <div class="form-group">
          <label>Product Description </label>
          <input type="text" class="form-control" name="productdescription" value="{{$product->productdescription}}" />
          @if($errors->has('productdescription'))
          <div class="alert alert-danger">{{$errors->first('productdescription')}}</div>
          @endif
      </div>

        <div class="form-group">
          <label>Product Images </label><br>
          <input type="file" class="form-contol" name="images[]" multiple/>
        </div>

        
        <div class="form-group">
          <label>Product Quantity </label>
          <input type="text" class="form-control" name="productquantity" value="{{$product->quantity}}" />
          @if($errors->has('productquantity'))
          <div class="alert alert-danger">{{$errors->first('productquantity')}}</div>
          @endif
      </div>

      <div class="form-group">
          <label>Product Price </label>
          <input type="text" class="form-control" name="productprice" value="{{$product->price}}" />
          @if($errors->has('productprice'))
          <div class="alert alert-danger">{{$errors->first('productprice')}}</div>
          @endif
      </div>


      <input type="submit" value="Submit" class="btn btn-success"/>
  </form>
</div>
@endsection