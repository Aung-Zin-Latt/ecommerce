<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class AdminOrderDetailsComponent extends Component
{
    // Admin Show Order Details
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::find($this->order_id);
        // dd($order);
        return view('livewire.admin.admin-order-details-component', ['order'=>$order])->layout('layouts.base');
    }
}
