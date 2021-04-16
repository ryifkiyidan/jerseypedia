<?php

namespace App\Http\Livewire;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product, $jumlah_pesanan, $nama, $nomor;

    public function mount($productId)
    {
        $this->updatingSearch();
        $productDetail = Product::find($productId);

        if ($productDetail) {
            $this->product = $productDetail;
        }
    }

    public function masukanKeranjang()
    {
        $this->validate([
            'jumlah_pesanan' => 'required',
        ]);

        // Validasi jika belum login
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        // Menghitung total harga
        if (!empty($this->nama) && $this->jumlah_pesanan == 1) {
            $total_harga = $this->jumlah_pesanan * ($this->product->harga + $this->product->harga_nameset);
        } else {
            $total_harga = $this->jumlah_pesanan * $this->product->harga;
            $this->nama = null;
            $this->nomor = null;
        }

        //Cek apakah user punya data pesanan sebelumnya yg statusnya 0
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (empty($pesanan)) {
            Pesanan::create([
                'user_id' => Auth::user()->id,
                'total_harga' => $total_harga,
                'status' => 0,
                'kode_unik' => mt_rand(100, 999),
            ]);

            $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
            $pesanan->kode_pemesanan = 'JP-' . $pesanan->id;
            $pesanan->update();
        } else {
            $pesanan->total_harga = $pesanan->total_harga + $total_harga;
            $pesanan->update();
        }

        PesananDetail::create([
            'product_id'  => $this->product->id,
            'pesanan_id' => $pesanan->id,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'namaset' => $this->nama ? true : false,
            'nama' => $this->nama,
            'nomor' => $this->nomor,
            'total_harga' => $total_harga,
        ]);

        $this->emit('masukKeranjang');

        session()->flash('message', 'Sukses masuk keranjang');
        $this->jumlah_pesanan = null;
        $this->nama = null;
        $this->nomor = null;

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
