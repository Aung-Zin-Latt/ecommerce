<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    // Product Sorting and Products Per Page
    public $sorting;
    public $pagesize;
    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart!');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    public function render()
    {
        // Product Sorting and Products Per Page
        if ($this->sorting == 'date') {
            $products = Product::ordeBy('created_at', 'DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price')
        {
            $products = Product::ordeBy('regular_price', 'ASC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-desc')
        {
            $products = Product::ordeBy('regular_price', 'DESC')->paginate($this->pagesize);
        }
        else
        {
            $products = Product::paginate($this->pagesize);
        }

        $products = Product::paginate(12);
        return view('livewire.shop-component', ['products' => $products])->layout('layouts.base');
    }
}
