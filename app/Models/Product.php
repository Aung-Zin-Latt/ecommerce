<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Making Shop Page Products Dynamic
    protected $table = 'products';

    // Admin Product Page
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Show Review & Rating on Product Details Page
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    // Show Products by Subcategory
    public function subCategories()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    // Add Attribute Option on Edit Product Page
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'product_id');
    }
}
