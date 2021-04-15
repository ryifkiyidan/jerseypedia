<?php

namespace App\Http\Livewire;

use App\Models\Liga;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductLiga extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '', $liga;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($ligaId)
    {
        $this->updatingSearch();
        $liga = Liga::find($ligaId);

        if ($liga) {
            $this->liga = $liga;
        }
    }

    public function render()
    {
        if ($this->search !== null) {
            $products = Product::where('liga_id', $this->liga->id)->where('nama', 'like', '%' . $this->search . '%')->paginate(8);
        } else {
            $products = Product::where('liga_id', $this->liga->id)->paginate(8);
        }
        return view('livewire.product-index', [
            'products' => $products,
            'title' => 'Jersey ' . $this->liga->nama,
        ]);
    }
}
