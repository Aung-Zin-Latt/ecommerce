<?php

namespace App\Http\Livewire\Admin;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    // Admin Add New Product
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $buying_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    // Add Product Gallery
    public $images;
    // Add Subcategory On Edit and Add Product Page
    public $scategory_id;
    // Add Attribute Option on Add New Product Page
    public $attr;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values;


    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    }

    // For Adding Product attributes
    public function add()
    {
        if (!in_array($this->attr, $this->attribute_arr))
        {
            array_push($this->inputs, $this->attr);
            array_push($this->attribute_arr, $this->attr);

        }
    }

    // For Adding Product attributes
    public function remove($attr)
    {
        unset($this->inputs[$attr]);
    }

    public function autoGenerateSlug()
    {
        $this->slug = Str::slug($this->name, '-');    // '-' means "separator"
    }

    // Form Validation for add Product
    public function updated($fields)    // hook method
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required|unique:products',  // products is a table name
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'buying_price' => 'required|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png',
            'category_id' => 'required',
        ]);
    }
    public function storeProduct()
    {
        // Form Validation for add Product
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',  // products is a table name
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'buying_price' => 'required|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png',
            'category_id' => 'required',
        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->buying_price = $this->buying_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        $imageName = Carbon::now()->timestamp. '.' . $this->image->extension(); // go config/filesystems.php => 'local'
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;
        // dd($product->image);

        // Add Product Gallery
        if ($this->images)
        {
            $imagesname = '';
            foreach ($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp. $key. '.' . $image->extension();
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

        // Add Attribute Option on Add New Product Page
        if ($this->attribute_values)
        {
            foreach ($this->attribute_values as $key => $attribute_value)
            {
                $attrvalues = explode(',', $attribute_value);
                foreach ($attrvalues as $attrvalue) {
                    $attr_value = new AttributeValue();
                    $attr_value->product_attribute_id = $key;
                    $attr_value->value = $attrvalue;
                    $attr_value->product_id = $product->id;
                    $attr_value->save();
                }
            }
        }

        session()->flash('message', 'Product has been created successfully!');
        // return redirect()->route('admin.products');
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

        // Add Attribute Option on Add New Product Page
        $pattributes = ProductAttribute::all();

        return view('livewire.admin.admin-add-product-component', ['categories'=>$categories, 'scategories'=>$scategories, 'pattributes'=>$pattributes])->layout('layouts.base');
    }
}
