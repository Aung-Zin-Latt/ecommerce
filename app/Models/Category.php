<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Making Shop Page Products Dynamic
    protected $table = 'categories';

    // Admin Show Subcategories With Category
    public function subCategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');

        // if you don't put "return" keyword, it will get an error like this "App\Models\Category::subCategories must return a relationship instance, but "null" was returned. Was the "return" keyword used?"
    }
}
