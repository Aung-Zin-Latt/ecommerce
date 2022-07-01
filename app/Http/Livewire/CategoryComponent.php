<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    // Product Sorting and Products Per Page
    public $sorting;
    public $pagesize;
    public $category_slug;

    // Show Products by Subcategory
    public $scategory_slug;
    public function mount($category_slug, $scategory_slug=null)
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->category_slug = $category_slug;

        $this->scategory_slug = $scategory_slug;
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
        // Show Products by Subcategory
        $category_id = null;
        $category_name = "";
        $filter = "";
        if ($this->scategory_slug) {
            $scategory = Subcategory::where('slug', $this->scategory_slug)->first();
            $category_id = $scategory->id;
            $category_name = $scategory->name;
            $filter = "sub";
        }
        else
        {
            $category = Category::where('slug', $this->category_slug)->first();
            $category_id = $category->id;
            $category_name = $category->name;
            $filter = "";
        }


        // Product Sorting and Products Per Page
        if ($this->sorting == 'date') {
            $products = Product::where($filter.'category_id', $category_id)->ordeBy('created_at', 'DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price')
        {
            $products = Product::where($filter.'category_id', $category_id)->ordeBy('regular_price', 'ASC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-desc')
        {
            $products = Product::where($filter.'category_id', $category_id)->ordeBy('regular_price', 'DESC')->paginate($this->pagesize);
        }
        else
        {
            $products = Product::where($filter.'category_id', $category_id)->paginate($this->pagesize);
        }

        // Products By Categories
        $categories = Category::all();

        return view('livewire.category-component', ['products' => $products, 'categories'=>$categories, 'category_name'=>$category_name])->layout('layouts.base');
    }
}
