<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;

class AdminAddCategoryComponent extends Component
{
    // Admin Add New Category
    public $name;
    public $slug;
    // Admin Create Subcategories
    public $category_id;

    // for generating slug
    public function autoGenerateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    // Form Validation for add category
    public function updated($fields)    // hook method
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);
    }
    public function storeCategory()
    {
        // Form Validation for add category
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',  // categories is table name
        ]);

        // Admin Create Subcategories
        if ($this->category_id) {
            $scategory = new Subcategory();
            $scategory->name = $this->name;
            $scategory->slug = $this->slug;
            $scategory->category_id = $this->category_id;
            $scategory->save();
        }
        else
        {
            $category = new Category();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
        }

        session()->flash('message', 'Category has created successfully!');
        return redirect()->route('admin.categories');
    }


    public function render()
    {
        // Admin Create Subcategories
        $categories = Category::all();

        return view('livewire.admin.admin-add-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
