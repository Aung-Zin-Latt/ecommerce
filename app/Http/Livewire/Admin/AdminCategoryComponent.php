<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    // Admin Category Page
    use WithPagination;

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component', ['categories'=>$categories])->layout('layouts.base');
    }
}
