@extends('dashboard.index');
@section('title', 'Edit Product');
@section('card-color', 'card-warning');

@section('content')
    {{-- include messages file --}}
    @include('dashboard.includes.messages')
    {{-- to display errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ( $errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('update.product',$product->id)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="oldPhoto" value="{{$product->image}}">
        <div class="form-row">
            <div class="form-group col-md-1">
                <label>Id</label>
                <input type="text" name="id" class="form-control" disabled
                    value="{{ $product->id }}">
            </div>
            <div class="form-group col-md-11">
                <label>Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ $product->name }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Details</label>
                <input type="text" name="details" class="form-control @error('details') is-invalid @enderror"
                    value="{{ $product->details }}">
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-6">
                <label>Price</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                    value="{{ $product->price }}">
            </div>
            <div class="form-group col-md-6">
                <label>shipping cost</label>
                <input type="text" class="form-control @error('shipping_cost') is-invalid @enderror" name="shipping_cost"
                    value="{{ $product->shipping_cost }}">
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Brand</label>
                <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand"
                    value="{{ $product->brand }}">
            </div>
            <div class="form-group col-md-6">
                <label>Product Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active</option>
                    <option {{ $product->status == 2 ? 'selected' : '' }} value="2">Not Active</option>
                    <option {{ $product->status == 3 ? 'selected' : '' }} value="3">Deleted</option>
                </select>
            </div>
        </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="10"
                        cols="200">{{ $product->description }}</textarea>
                </div>
            </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Image</label>
                <img src=" {{ asset($product->image_path) }} "  width="500"
                alt=" {{$product->name}} ">
            </div>
            <div class="form-group col-md-12">
                <label>Update Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
            </div>
        </div>
        <button type="submit" name="update" class="btn btn-outline-warning">Update</button>

    </form>
@endsection
