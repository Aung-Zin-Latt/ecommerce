<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    // Admin Show Subcategories With Category
    public function category()
    {
        $this->belongsTo(Category::class);
    }
}
