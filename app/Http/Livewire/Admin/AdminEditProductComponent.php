<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WtihFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;
    // Admin Edit Product
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $newimage;
    public $product_id;

    // For editing new image gallery
    public $images;
    public $newimages;

    // Add Subcategory On Edit and Add Product Page
    public $scategory_id;

    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;

        $this->images = explode(",", $product->images);  // $this->newimages should not write like $this->image if u write, htmlspecialchars() error will occur

        $this->category_id = $product->category_id;

        // Add Subcategory On Edit and Add Product Page
        $this->scategory_id = $product->subcategory_id;

        $this->product_id = $product->id;
    }
    public function autoGenerateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    // Form Validation for edit Product
    public function updated($fields)    // hook method
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            // 'newimage' => 'required|mimes:jpeg,png',
            'category_id' => 'required',
        ]);
        if($this->newimage)
        {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:jpeg,png'
            ]);
        }
    }
    public function updateProduct()
    {
        // Form Validation for edit Product
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            // 'newimage' => 'required|mimes:jpeg,png',
            'category_id' => 'required',
        ]);
        if($this->newimage)
        {
            $this->validate([
                'newimage' => 'required|mimes:jpeg,png'
            ]);
        }

        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->quantity = $this->quantity;
        if ($this->newimage)
        {
            // For editing new image gallery
            unlink('assets/images/products'.'/'.$product->image);

            $imageName = Carbon::now()->timestamp. '.' . $this->newimage->extension();     // go config/filesystems.php => 'local'
            $this->newimage->storeAs('products', $imageName);
            $product->image = $imageName;
            // dd($product->image);
        }

        if($this->newimages)
        {
            if($product->images)
            {
                $images = explode(",", $product->images);
                foreach($images as $image)
                {
                    if($image)
                    {
                        unlink('assets/images/products'.'/'.$image);
                    }
                }
            }

            // add new product img gallery after delete above part
            $imagesname = '';
            foreach ($this->newimages as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('products', $imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            $product->images = $imagesname;
        }


        $product->category_id = $this->category_id;

        // Add Subcategory On Edit and Add Product Page
        if ($this->scategory_id)
        {
            $product->subcategory_id = $this->scategory_id;
        }

        $product->save();
        session()->flash('message', 'Product has been updated successfully!');
        return redirect()->route('admin.products');
    }

    // Add Subcategory On Edit and Add Product Page
    public function changeSubcategory()
    {
        $this->scategory_id = 0;
    }

    public function render()
    {
        $categories = Category::all();

        // Add Subcategory On Edit and Add Product Page
        $scategories = Subcategory::where('category_id', $this->category_id)->get();
        return view('livewire.admin.admin-edit-product-component', ['categories'=>$categories, 'scategories'=>$scategories])->layout('layouts.base');
    }
}
