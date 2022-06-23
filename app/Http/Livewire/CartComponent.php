<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    // Update Cart Quantity
    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        // dd($qty);
        Cart::instance('cart')->update($rowId,$qty);
        // return redirect()->route('product.cart');

        // autorefresh wishlist count
        $this->emitTo('cart-count-component', 'refreshComponent');  // refreshComponent argument is from CartCountCompoent.php file
        
    }
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        // return redirect()->route('product.cart');

        // autorefresh wishlist count
        $this->emitTo('cart-count-component', 'refreshComponent');  // refreshComponent argument is from CartCountCompoent.php file
    }

    // Delete Cart Item
    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);

        // autorefresh wishlist count
        $this->emitTo('cart-count-component', 'refreshComponent');  // refreshComponent argument is from CartCountCompoent.php file

        session()->flash('success_message', 'Item has been removed!');
        // return redirect()->route('product.cart');
        
    }
    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        
        // autorefresh wishlist count
        $this->emitTo('cart-count-component', 'refreshComponent');  // refreshComponent argument is from CartCountCompoent.php file
        
        return redirect()->route('product.cart');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
