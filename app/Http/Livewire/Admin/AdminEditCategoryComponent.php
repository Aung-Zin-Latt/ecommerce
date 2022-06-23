<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use App\Models\Category;
use Livewire\Component;

class AdminEditCategoryComponent extends Component
{
    // Admin Edit Category
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;
    public function mount($category_slug)
    {
        // dd($category_slug);
        $this->category_slug = $category_slug;
        $category = Category::where('slug', $category_slug)->first();
        $this->category_id = $category->id;
        // dd($this->category_id);
        $this->name = $category->name;
        $this->slug = $category->slug;
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

        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('message', 'Category has been updated successfully!');
        // return redirect()->route('admin.categories');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}
