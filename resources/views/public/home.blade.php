@extends('public.layouts.app')

@section('content')
    <section class="hero">
        <img src="https://via.placeholder.com/1500x600" alt="Model Fashion">
        <div class="hero-text">
            <h2>Tampil Anggun dan Menawan</h2>
        </div>
    </section>

    <section class="welcome">
        <h2>Selamat Datang</h2>
    </section>
    <section class="products">
        <div class="product">
            <img src="https://via.placeholder.com/300x400" alt="Produk 1">
            <h3>Produk 1</h3>
        </div>
        <div class="product">
            <img src="https://via.placeholder.com/300x400" alt="Produk 2">
            <h3>Produk 2</h3>
        </div>
        <div class="product">
            <img src="https://via.placeholder.com/300x400" alt="Produk 3">
            <h3>Produk 3</h3>
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
