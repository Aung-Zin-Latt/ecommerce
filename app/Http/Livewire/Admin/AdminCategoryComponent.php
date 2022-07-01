<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    // Admin Category Page
    use WithPagination;

    // Admin Delete Category
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('message', 'Category has been deleted successfully!');
    }

    // Admin Delete Subcategory
    public function deleteSubCategory($id)
    {
        $scategory = Subcategory::find($id);
        $scategory->delete();
        session()->flash('message', 'Subcategory has been deleted successfully!');
    }

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component', ['categories'=>$categories])->layout('layouts.base');
    }
}
