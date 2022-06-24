<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    // Create Product Details Page
    public $slug;
    // for increase & decrease price
    public $qty;

    public function mount($slug) 
    {
        $this->slug = $slug;
        // for increase & decrease price
        $this->qty = 1;
    }

    // Shopping Cart
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, $this->qty, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart!');
        return redirect()->route('product.cart');
    }
 
    public function increaseQuantity()
    {
        $this->qty++;
        // dd($this->qty);
    }
    public function decreaseQuantity()
    {
        if($this->qty > 1)
        {
            $this->qty--;
        }
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();

        // Admin Making On Sale Timer Working
        $sale = Sale::find(1);

        return view('livewire.details-component', ['product' => $product, 'popular_products' => $popular_products, 'related_products' => $related_products, 'sale'=>$sale])->layout('layouts.base');
    }
}
