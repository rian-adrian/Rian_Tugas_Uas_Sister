@extends('public.layouts.app')

@section('content')
    <section class="products">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('/images/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Rp.{{ $product->harga }}</p>
                            <p class="card-text">{{ $product->description }}</p>
                            <div class="row d-flex justify-between gap-3">
                                <a href="#" class="btn btn-primary">Beli</a>
                                <form action="" method="post">
                                    <input type="hidden" name="user_id" id="">
                                    <input type="hidden" name="name" id="">
                                    <input type="hidden" name="image" id="">
                                    <input type="hidden" name="harga" id="">
                                    <a href="#" class="btn btn-success">Keranjang<i
                                            class="bi bi-cart-check-fill"></i></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
