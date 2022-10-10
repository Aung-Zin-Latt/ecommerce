<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
class AdminDashboardComponent extends Component
{
    public $ordering;

    public $todaySales;
    public $todayExpense;
    public $todayRevenue;

    public $weeklySales;
    public $weeklyExpense;
    public $weeklyRevenue;

    public $monthlySales;
    public $monthlyExpense;
    public $monthlyRevenue;

    public $yearlySales;
    public $yearlyExpense;
    public $yearlyRevenue;

    public $totalExpense;
    public $totalSales;
    public $totalRevenue;

    public function mount()
    {
        $this->ordering = "default";
    }
    public function render()
    {
        // dd('GG');
        // $orderItem = OrderItem::where('order_id',2)->get();
        // $productIds = [];
        // foreach($orderItem as $item){
        //    array_push($productIds,$item->product_id);
        // }

        // $products = Product::whereIn('id',$productIds)->get();
        // dd($products);

        if ($this->ordering == "daily") {
            $orders = Order::whereDate('created_at', Carbon::today())->orderBy('id','DESC')->get();
            $totalProfit = 0 ;
            for($i = 0 ; $i < count($orders);$i++){
                    $orderItem = OrderItem::where('order_id',$orders[$i]->id)->get();
                    for($j = 0 ; $j < count($orderItem);$j++){
                            $product = Product::find($orderItem[$j]->product_id);
                            // dd($product);
                            $netProfit = ($orderItem[$j]->quantity * $product->sale_price) - ($orderItem[$j]->quantity * $product->buying_price);

                            $totalProfit +=$netProfit;
                    }
                    // dd($totalProfit);
            }
            $this->todayExpense = $totalProfit;
            $this->todaySales =  Order::whereDate('created_at', Carbon::today())->count();
            $this->todayRevenue =  Order::whereDate('created_at', Carbon::today())->sum('total');
            // dd($orders);
        } else if ($this->ordering == "weekly") {

            // $orders = Order::whereDate('created_at', Carbon::today())->get();
            // $orders = Order::whereBetween(
            //     'created_at',
            //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            // )
            //     ->get();
            // $this->weeklySales = Order::whereBetween(
            //     'created_at',
            //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            // )
            //     ->get()->count();
            // $this->weeklyRevenue = Order::whereBetween(
            //     'created_at',
            //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            // )
            //     ->get()->sum('total');
            $orders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('id','DESC')->get();

            // Calculate Net Profit
            $totalProfit = 0 ;
            for($i = 0 ; $i < count($orders);$i++){
                $orderItem = OrderItem::where('order_id',$orders[$i]->id)->get();
                for($j = 0 ; $j < count($orderItem);$j++){
                        $product = Product::find($orderItem[$j]->product_id);
                        // dd($product);
                        $netProfit = $orderItem[$j]->quantity * ($product->sale_price - $product->buying_price);
                        $totalProfit +=$netProfit;
                }
            }
            $this->weeklyExpense = $totalProfit;

            $this->weeklySales = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get()->count();

            $this->weeklyRevenue = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get()->sum('total');
        } else if ($this->ordering == "monthly") {
            $orders = Order::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();

            // Calculate Net Profit
            $totalProfit = 0 ;
            for($i = 0 ; $i < count($orders);$i++){
                $orderItem = OrderItem::where('order_id',$orders[$i]->id)->get();
                for($j = 0 ; $j < count($orderItem);$j++){
                        $product = Product::find($orderItem[$j]->product_id);
                        // dd($product);
                        $netProfit = $orderItem[$j]->quantity * ($product->sale_price - $product->buying_price);
                        $totalProfit +=$netProfit;
                }
            }
            $this->monthlyExpense = $totalProfit;

            $this->monthlySales = Order::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->get()->count();
            $this->monthlyRevenue = Order::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->get()->sum('total');
        } else if ($this->ordering == "yearly") {
            $orders =  Order::whereYear('created_at', Carbon::now()->year)->get();

            // Calculate Net Profit
            $totalProfit = 0 ;
            for($i = 0 ; $i < count($orders);$i++){
                $orderItem = OrderItem::where('order_id',$orders[$i]->id)->get();
                for($j = 0 ; $j < count($orderItem);$j++){
                        $product = Product::find($orderItem[$j]->product_id);
                        // dd($product);
                        $netProfit = $orderItem[$j]->quantity * ($product->sale_price - $product->buying_price);
                        $totalProfit +=$netProfit;
                }
            }
            $this->yearlyExpense = $totalProfit;

            $this->yearlySales = Order::whereYear('created_at', Carbon::now()->year)->count();
            $this->yearlyRevenue = Order::whereYear('created_at', Carbon::now()->year)->sum('total');
        } else {
            $orders = Order::orderBy('created_at', 'desc')->get()->take(15);

            // Calculate Net Profit
            $totalProfit = 0 ;
            for($i = 0 ; $i < count($orders);$i++){
                $orderItem = OrderItem::where('order_id',$orders[$i]->id)->get();
                for($j = 0 ; $j < count($orderItem);$j++){
                        $product = Product::find($orderItem[$j]->product_id);
                        // dd($product);
                        $netProfit = $orderItem[$j]->quantity * ($product->sale_price - $product->buying_price);
                        $totalProfit +=$netProfit;
                }
            }
            $this->totalExpense = $totalProfit;

            $this->totalSales = Order::where('status', 'delivered')->count();
            $this->totalRevenue = Order::where('status', 'delivered')->sum('total');
        }
        return view('livewire.admin.admin-dashboard-component', [
            'orders' => $orders,
            'totalSales' => $this->totalSales,
            'totalRevenue' => $this->totalRevenue,
            'todaySales' => $this->todaySales,
            'todayRevenue' => $this->todayRevenue,
            'weeklySales' => $this->weeklySales,
            'weeklyRevenue' => $this->weeklyRevenue,
            'monthlySales' => $this->monthlySales,
            'monthlyRevenue' => $this->monthlyRevenue,
            'yearlySales' => $this->yearlySales,
            'yearlyRevenue' => $this->yearlyRevenue,
        ])->layout('layouts.base');
    }
}
