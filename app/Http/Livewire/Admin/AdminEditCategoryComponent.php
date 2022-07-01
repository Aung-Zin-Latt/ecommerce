<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;

class AdminEditCategoryComponent extends Component
{
    // Admin Edit Category
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;

    // Admin Edit Subcategories
    public $scategory_id;
    public $scategory_slug;


    public function mount($category_slug, $scategory_slug=null)
    {
        // Admin Edit Subcategories
        if ($scategory_slug)
        {
            $this->scategory_slug = $scategory_slug;
            $scategory = Subcategory::where('slug', $scategory_slug)->first();
            $this->scategory_id = $scategory->id;
            $this->category_id = $scategory->category_id;
            $this->name = $scategory->name;
            $this->slug = $scategory->slug;
        }
        else
        {
            $this->category_slug = $category_slug;
            $category = Category::where('slug', $category_slug)->first();
            $this->category_id = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
        }
        // End Admin Edit Subcategories


    }
    public function autoGenerateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    // Form Validation for edit category
    public function updated($fields)    // hook method
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);
    }
    public function updateCategory()
    {
        // Form Validation
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',   // categories is a table
        ]);


        // Admin Edit Subcategories
        if ($this->scategory_id) {
            $scategory = Subcategory::find($this->scategory_id);
            $scategory->name = $this->name;
            $scategory->slug = $this->slug;
            $scategory->category_id = $this->category_id;
            $scategory->save();
        }
        else
        {
            $category = Category::find($this->category_id);
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
        }
        // End Admin Edit Subcategories

        session()->flash('message', 'Category has been updated successfully!');
        // return redirect()->route('admin.categories');
    }

    public function render()
    {
        // Admin Edit Subcategories
        $categories = Category::all();

        return view('livewire.admin.admin-edit-category-component', ['categories'=>$categories])->layout('layouts.base');
    }
}
