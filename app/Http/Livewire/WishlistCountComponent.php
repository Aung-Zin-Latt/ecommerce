<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WishlistCountComponent extends Component
{
    // auto refresh wishlist
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.wishlist-count-component');
    }
}
