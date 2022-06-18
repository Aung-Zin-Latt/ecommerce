<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    // Update Cart Quantity
    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId,$qty);
        return redirect()->route('product.cart');
    }
    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId,$qty);
        return redirect()->route('product.cart');
    }

    // Delete Cart Item
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success_message', 'Item has been removed!');
        return redirect()->route('product.cart');
    }
    public function destroyAll()
    {
        Cart::destroy();
        return redirect()->route('product.cart');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
