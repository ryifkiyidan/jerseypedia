<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-dark">List Jersey</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jersey Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card gambar-product">
                <div class="card-body text-center">
                    <img src="{{ url('assets/jersey') }}/{{ $product->gambar }}" alt="liga" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2 style="display: inline;"><b>{{ $product->nama }}</b></h2>
            <div class="float-right">
                @if ($product->is_ready)
                <span class="badge badge-success"><i class="fas fa-check"></i> Ready Stock</span>
                @else
                <span class="badge badge-danger"><i class="fas fa-times"></i> Stock Habis</span>
                @endif
            </div>
            <h4>Rp{{ number_format($product->harga) }}</h4>
            <div class="row">
                <div class="col">
                    <form wire:submit.prevent="masukanKeranjang">
                        <table class="table table-hover" style="border-top: hidden">
                            <tr>
                                <td>Liga</td>
                                <td>:</td>
                                <td><img src="{{ url('assets/liga') }}/{{ $product->liga->gambar }}" alt="liga" class="img-fluid" width="50"></td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>:</td>
                                <td>{{ $product->jenis }}</td>
                            </tr>
                            <tr>
                                <td>Berat</td>
                                <td>:</td>
                                <td>{{ $product->berat }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>:</td>
                                <td>
                                    <input id="jumlah_pesanan" type="number" class="form-control @error('jumlah_pesanan') is-invalid @enderror" wire:model="jumlah_pesanan" value="{{ old('jumlah_pesanan') }}" required>
                                    @error('jumlah_pesanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                        <table class="table" style="border-top: hidden">
                            @if ($jumlah_pesanan <= 1) <tr>
                                <td colspan="3"><b>Name Set (isi jika ingin tambah Nameset)</b></td>
                                </tr>
                                <tr>
                                    <td>Harga Nameset</td>
                                    <td>:</td>
                                    <td>Rp{{ number_format($product->harga_nameset) }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>
                                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" wire:model="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nomor</td>
                                    <td>:</td>
                                    <td>
                                        <input id="nomor" type="number" class="form-control @error('nomor') is-invalid @enderror" wire:model="nomor" value="{{ old('nomor') }}">
                                        @error('nomor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3">
                                        <button type="submit" class="btn btn-dark btn-block" @if(!$product->is_ready) disabled @endif><i class="fad fa-shopping-cart mr-1"></i> Masukkan Keranjang</button>
                                    </td>
                                </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
