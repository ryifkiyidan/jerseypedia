<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if (!empty($pesanan_details))
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Gambar</td>
                            <td class="text-left">Nama Produk</td>
                            <td>Name Set</td>
                            <td>Jumlah</td>
                            <td>Harga</td>
                            <td>Harga Nameset</td>
                            <td><b>Total Harga</b></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $pesanan_details as $pesanan_detail )
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                                <img src="{{ url('assets/jersey') }}/{{ $pesanan_detail->product->gambar }}" alt="Product" class="img-fluid" width="200">
                            </td>
                            <td class="text-left">{{ $pesanan_detail->product->nama }}</td>
                            <td>
                                @if ($pesanan_detail->namaset)
                                Nama : {{ $pesanan_detail->nama }} <br>
                                Nomor : {{ $pesanan_detail->nomor }}
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ $pesanan_detail->jumlah_pesanan }}</td>
                            <td>Rp{{ number_format($pesanan_detail->product->harga) }}</td>
                            <td>
                                @if ($pesanan_detail->namaset)
                                Rp{{ number_format($pesanan_detail->product->harga_nameset) }}
                                @else
                                -
                                @endif
                            </td>
                            <td><b>Rp{{ number_format($pesanan_detail->total_harga) }}</b></td>
                            <td>
                                <a wire:click="destroy({{ $pesanan_detail->id }})" class="btn btn-outline-danger btn-sm border-0"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="7" align="right"><b>Total Harga : </b></td>
                            <td align="right"><b>Rp{{ number_format($pesanan->total_harga) }}</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="7" align="right"><b>Kode Unik : </b></td>
                            <td align="right"><b>Rp{{ number_format($pesanan->kode_unik) }}</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="7" align="right"><b>Total Bayar : </b></td>
                            <td align="right"><b>Rp{{ number_format($pesanan->total_harga + $pesanan->kode_unik) }}</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="7"></td>
                            <td colspan="2">
                                <a href="{{ route('checkout') }}" class="btn btn-success btn-block">
                                    <i class="fad fa-shopping-cart"></i>
                                    Check out
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
            <div class="container text-center my-5">
                <img src="{{ asset('assets/undraw/empty_cart.svg') }}" alt="empty" class="img-fluid mb-5" width="500">
                <br>
                Keranjang masih kosong nih ka, <a href="{{ route('home') }}"><b>Yuk Belanja!</b></a>
            </div>
            @endif
        </div>
    </div>
</div>
