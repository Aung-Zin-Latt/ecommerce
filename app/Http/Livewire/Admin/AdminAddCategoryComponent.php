<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;

class AdminAddCategoryComponent extends Component
{
    // Admin Add New Category
    public $name;
    public $slug;

    // for generating slug
    public function autoGenerateSlug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function storeCategory()
    {
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('message', 'Category has created successfully!');
    }


    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}