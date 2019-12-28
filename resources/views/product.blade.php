@extends('layout')

@section('title')
{{ $product->name }}
@endsection

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="{{route('landing-page')}}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span><a href="{{route('shop.index')}}">Shop</a></span>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>{{ $product->name }}</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="product-section container">
        <div class="product-section-image">
            <img src="{{ asset('img/products/' . $product->slug .".jpg" ) }}" alt="product">
        </div>
        <div class="product-section-information">
        <h1 class="product-section-title">{{ $product->name}}</h1>
            <div class="product-section-subtitle">{{ $product->details}}</div>
            <div class="product-section-price">{{ $product->presentPrice() }}</div>
            {{ $product->description}}

            <p>&nbsp;</p>

            <a href="#" class="button">Add to Cart</a>
        </div>
    </div> <!-- end product-section -->
    

    @include('partials.might-like')


@endsection
