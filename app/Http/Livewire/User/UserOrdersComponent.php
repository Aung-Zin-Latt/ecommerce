<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOrdersComponent extends Component
{
    public function render()
    {
        // Show Orders and Order Details for User
        $orders = Order::where('user_id', Auth::user()->id)->paginate(12);
        // dd($orders);
        return view('livewire.user.user-orders-component', ['orders'=>$orders])->layout('layouts.base');
    }
}
