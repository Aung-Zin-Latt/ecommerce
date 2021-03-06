<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    public function order()
    {
         return $this->belongsTo(Order::class);
    }

    // Admin Show Order Details
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Show Review & Rating on Product Details Page
    public function review()
    {
        return $this->hasOne(Review::class, 'order_item_id');
    }
}
