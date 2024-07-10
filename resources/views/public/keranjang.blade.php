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
@endsection
