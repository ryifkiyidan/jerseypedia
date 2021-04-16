<?php

namespace App\Http\Livewire;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class History extends Component
{

    public $pesanans;

    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        if (Auth::user()) {
            $this->pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', 1)->get();
        }
        return view('livewire.history');
    }
}
