<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use Illuminate\Support\Facades\Auth;

class ShopComponent extends Component
{
    // Product Sorting and Products Per Page
    public $sorting;
    public $pagesize;

    // noUiSlider on shop page
    public $min_price;
    public $max_price;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;

        $this->min_price = 1;
        $this->max_price = 1000;
    }

    public function store($product_id, $product_name, $product_price)
    {
        // dd($product_price);
        // instance('cart') is for cart
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart!');
        return redirect()->route('product.cart');
    }

    // Add Product to WishList
    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        // autorefresh wishlist count
        $this->emitTo('wishlist-count-component', 'refreshComponent');  // refreshComponent argument is from WishlistCountCompoent.php file
    }

    // Remove Product from wishlist
    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if($witem->id == $product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component', 'refreshComponent');
                return;
            }
        }
    }

    use WithPagination;
    public function render()
    {
        // Product Sorting and Products Per Page
        if ($this->sorting == 'date') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price')
        {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-desc')
        {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }
        else
        {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->paginate($this->pagesize);
        }

        // Products By Categories
        $categories = Category::all();

        if(Auth::check())
        {
            // Shopping Cart Using Database
            Cart::instance('cart')->store(Auth::user()->email);
            // Wishlist Using Database
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.shop-component', ['products'=>$products, 'categories'=>$categories])->layout('layouts.base');
    }
}
