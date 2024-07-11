@extends('public.layouts.app')

@section('content')
    <section class="products">
        <div class="row">
            @foreach ($keranjangs as $keranjang)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('/images/' . $keranjang->image) }}"
                            alt="{{ $keranjang->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $keranjang->name }}</h5>
                            <p class="card-text">{{ Rp($keranjang->harga) }}</p>
                            <p class="card-text">{{ $keranjang->description }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary">Detail</a>
                                <a href="#" class="btn btn-success">
                                    <i class="bi bi-cart"></i> Keranjang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="products">
        <div class="product-container">
            <div class="product">
                <img src="{{ asset('images/2.jpeg') }}" alt="Produk 1">
                <div class="product-info">

                    <h3>Pakaian tradisional jawa</h3>
                    <p>dengan warna hitam dan terdapat berbagai macam ukuran dari kecil dan sedang</p>
                    <p>Rp 500.00</p>
                    <button class="btn btn-primary btn-buy">Beli</button>
                </div>
            </div>
            <div class="product">
                <img src="{{ asset('images/3.jpeg') }}" alt="Produk 3">
                <div class="product-info">

                    <h3>Pakaian tradisional bali</h3>
                    <p>dengan warna keemasan dan terdapat mahkota pada perempuan</p>
                    <p>Rp 700.00</p>
                    <button class="btn btn-primary btn-buy">Beli</button>
                </div>
            </div>
        </div>
    </section>

    <style>
        .products .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .products .product img {
            width: 200px;
            /* Adjust the width as needed */
            height: 200px;
            object-fit: cover;
            margin: 0 20px;
        }

        .products .product {
            display: flex;
            align-items: center;
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .products .product .btn-buy {
            margin-right: 20px;
        }

        .products .product .product-info {
            flex: 1;
        }

        .products .product-container {
            display: flex;
            flex-direction: column;
        }

        .products .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .products .product h3 {
            margin: 0;
            font-size: 1.5rem;
        }

        .products .product p {
            margin: 5px 0;
            font-size: 1rem;
        }

        .products .btn {
            margin-top: 10px;
        }
    </style>
@endsection
