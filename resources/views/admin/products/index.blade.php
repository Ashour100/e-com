@extends('layouts\app')
@section('title','All Products')

@section('content')
<div class="container-fluid">
    <div class="row w-100 justify-content-center">
        <div class="col-11 mx-auto">
            @if (session('product-added'))
            <div class="alert alert-success">
                {{session('product-added')}}
            </div>
            @endif
            @if (session('product-edited'))
                <div class="alert alert-success">
                    {{session('product-edited')}}
                </div>
            @endif
            @if (session('product-deleted'))
                <div class="alert alert-success">
                    {{session('product-deleted')}}
                </div>
            @endif
            <table class="table w-100 table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Size</th>
                        <th scope="col">Price</th>
                        {{-- <th scope="col">created at</th> --}}
                        <th scope="col">updated at</th>
                        <th scope="col" colspan="3">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="products-index-table">
                            <th scope="row">{{$product['id']}}</th>
                            <td>{{$product['name']}}</td>
                            <td>{{$product['brand']}}</td>
                            <td class="overflow-hidden" style="max-width: 10rem;">
                                @if (str_starts_with($product->photo, 'https://') || str_starts_with($product->photo, 'http://'))
                                    <img class="w-100" src="{{$product['photo']}}" alt="{{$product['photo']}}">
                                @else
                                    <img class="w-100" src="{{ asset('/storage') . '/' . $product['photo'] }}" alt="{{$product['name']}}">
                                @endif
                            </td>
                            <td>{{$product['size']}}</td>
                            <td>{{$product['price']}}</td>
                            {{-- <td>{{$product['created_at']}}</td> --}}
                            <td>{{$product['updated_at']}}</td>
                            <td>
                                <a href="/admin/products/{{$product['id']}}">
                                    <button type="button" class="btn btn-dark shadow-none">View</button>
                                </a>
                            </td>
                            <td>
                                <a href="/admin/products/{{$product['id']}}/edit">
                                    <button type="button" class="btn btn-warning shadow-none">Edit</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    class="product-form-destroyer">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-white shadow-none">delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection