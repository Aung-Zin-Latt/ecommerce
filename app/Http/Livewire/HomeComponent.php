<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\Product;
use App\Models\HomeSlider;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        // Make Home Page Slider Dynamic
        $sliders = HomeSlider::where('status', 1)->get();

        // Admin Show Latest Products On Homepage
        $lproducts = Product::orderBy('created_at', 'DESC')->get()->take(8);

        // Admin Show Product Categories On Homepage
        $category = HomeCategory::find(1);
        $cats = explode(',', $category->sel_categories);
        $categories = Category::whereIn('id', $cats)->get();
        $no_of_products = $category->no_of_products;

        // Admin Making On Sale Carousel Dynamic
        $sproducts = Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        // dd($sproducts);

        // Admin Making On Sale Timer Working
        $sale = Sale::find(1);

        return view('livewire.home-component', ['sliders'=>$sliders, 'lproducts'=>$lproducts, 'categories'=>$categories, 'no_of_products'=>$no_of_products, 'sproducts'=>$sproducts, 'sale'=>$sale])->layout('layouts.base');
    }
}
