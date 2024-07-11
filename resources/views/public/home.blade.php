@extends('public.layouts.app')

@section('content')
    <section class="hero">
        <img src="{{ asset('images/web.jpeg') }}" alt="Model Fashion">
    </section>

    <section class="welcome">
        <h2>Selamat Datang</h2>
    </section>
    <section class="products">
        <div class="product">
            <img src="{{ asset('images/2.jpeg') }}" alt="Produk 1">
            <h3>Pakaian tradisional jawa</h3>
        </div>
        <div class="product">
            <img src="{{ asset('images/4.jpg') }}" alt="Produk 2">
            <h3>Pakaian tradisional bali</h3>
        </div>
        <div class="product">
            <img src="{{ asset('images/3.jpeg') }}" alt="Produk 3">
            <h3>Pakaian tradisional bali</h3>
        </div>
    </section>
    <section class="products">
        @foreach ($products as $product)
            <div class="product">
                <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}">
                <h3>{{ $product->product_name }}</h3>
            </div>
        @endforeach
    </section>
@endsection
