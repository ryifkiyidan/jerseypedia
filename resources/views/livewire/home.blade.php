<div class="container">
    <!-- Banner -->
    <div class="banner">
        <img src="{{ url('assets/slider/slider1.png') }}" alt="slider">
    </div>

    <!-- Pilih Liga -->
    <section class="pilih-liga mt-4">
        <h3><b>Pilih Liga</b></h3>
        <div class="row mt-4">
            @foreach ($ligas as $liga)
            <div class="col">
                <a href="{{ route('products.liga', $liga->id) }}">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <img src="{{ url('assets/liga') }}/{{ $liga->gambar }}" alt="liga" class="img-fluid">
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Best Product -->
    <section class="products mt-5">
        <h3><b>Best Products</b>
            <a href="{{ route('products') }}" class="btn btn-dark float-right"><i class="fad fa-eye mr-1 mr-1"></i> Lihat Semua</a>
        </h3>
        <div class="row mt-4">
            @foreach ($products as $product)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ url('assets/jersey') }}/{{ $product->gambar }}" alt="liga" class="img-fluid">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <h5><b>{{ $product->nama }}</b></h5>
                                <h5>Rp{{ number_format($product->harga) }}</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <a href="{{ route('products.detail', $product->id) }}" class="btn btn-dark btn-block"><i class="fad fa-eye mr-1"></i> Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>