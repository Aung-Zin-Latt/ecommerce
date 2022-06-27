<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserOrderDetailsComponent extends Component
{
    // User Show Orders and Order Details
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    // User Order Cancellation
    public function cancelOrder()
    {
        $order = Order::find($this->order_id);
        $order->status = 'canceled';
        $order->canceled_date = DB::raw('CURRENT_DATE');
        $order->save();
        session()->flash('order_message', 'Order has been canceled!');
    }

    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $this->order_id)->first();
        // dd($order);
        return view('livewire.user.user-order-details-component', ['order'=>$order])->layout('layouts.base');
    }
}
