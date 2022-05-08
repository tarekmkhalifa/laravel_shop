@extends('dashboard.index');
@section('title', 'Add Product');
@section('card-color', 'card-success');

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

    <form method="POST" action=" {{ route('insert.product') }} " enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Details</label>
                <input type="text" class="form-control @error('details') is-invalid @enderror" name="details"
                    value="{{ old('details') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Price</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price') }}">
            </div>
            <div class="form-group col-md-6">
                <label>Shipping cost</label>
                <input type="number" name="shipping_cost" class="form-control @error('shipping_cost') is-invalid @enderror"
                    value="{{ old('shipping_cost') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Brand</label>
                <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror"
                    value="{{ old('brand') }}">
            </div>
            <div class="form-group col-md-6">
                <label>Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option>-</option>
                    <option value="1">Active</option>
                    <option value="2">Not active</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-row">
                <div class="form-group">
                    <label>Product Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="10"
                        cols="200">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            </div>
        </div>

        <button type="submit" name="add&new" class="btn btn-outline-success">Add & New</button>
        <button type="submit" name="add"  class="btn btn-success">Add Product</button>
    </form>
@endsection
