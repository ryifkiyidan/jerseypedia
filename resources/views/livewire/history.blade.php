<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
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

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Tanggal Pesan</td>
                            <td>Kode Pemesanan</td>
                            <td align="left">Pesanan</td>
                            <td>Status</td>
                            <td><b>Total Harga</b></td>
                            <td><b>Total Bayar</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $pesanans as $pesanan )
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $pesanan->created_at }}</td>
                            <td>{{ $pesanan->kode_pemesanan }}</td>
                            <td align="left">
                                <?php $pesanan_details = \App\Models\PesananDetail::where('pesanan_id', $pesanan->id)->get(); ?>
                                @foreach ($pesanan_details as $pesanan_detail)
                                <img src="{{ url('assets/jersey') }}/{{ $pesanan_detail->product->gambar }}" alt="Product" class="img-fluid" width="50">
                                {{ $pesanan_detail->product->nama }}
                                <br>
                                @endforeach
                            </td>
                            <td>{{ $pesanan->status == 1 ? 'Belum Lunas' : 'Lunas' }}</td>
                            <td align="right"><b>Rp{{ number_format($pesanan->total_harga) }}</b></td>
                            <td align="right"><b>Rp{{ number_format($pesanan->total_harga + $pesanan->kode_unik) }}</b></td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="7" class="text-secondary">Data Kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <p>Untuk pembayaran silahkan transfer ke rekening di bawah ini:</p>
                    <div class="media mt-3">
                        <a class="pr-3" href="#">
                            <img src="{{ url('assets/bri.png') }}" alt="Bank BRI" width="60">
                        </a>
                        <div class="media-body">
                            <h5 class="mt-0">Bank BRI</h5>
                            No. Rekening <b>012345-678-910</b> a/n <b>Ryifki Yidan</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
