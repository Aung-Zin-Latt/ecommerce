<div class="content">
    <style>
        .content {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .icon-stat {
            display: block;
            overflow: hidden;
            position: relative;
            padding: 15px;
            margin-bottom: 1em;
            background-color: #fff;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .icon-stat-label {
            display: block;
            color: #999;
            font-size: 13px;
        }
        .icon-stat-value {
            display: block;
            font-size: 28px;
            font-weight: 600;
        }
        .icon-stat-visual {
            position: relative;
            top: 22px;
            display: inline-block;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            text-align: center;
            font-size: 16px;
            line-height: 30px;
        }
        .bg-primary {
            color: #fff;
            background: #d74b4b;
        }
        .bg-secondary {
            color: #fff;
            background: #6685a4;
        }
        .icon-stat-footer {
            padding: 10px 0 0;
            margin-top: 10px;
            color: #aaa;
            font-size: 12px;
            border-top: 1px solid #eee;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="wrap-shop-control">
                <h1 class="shop-title">All Orders</h1>
                <div class="wrap-right">
                    <div class="sort-item orderby">
                        <select
                            name="orderby"
                            class="use-chosen"
                            wire:model="ordering"
                        >
                            <option value="default" selected="selected">
                                All Orders
                            </option>
                            <option value="daily">Daily Orders</option>
                            <option value="weekly">Weekly Orders</option>
                            <option value="monthly">Monthly Orders</option>
                            <option value="yearly">Yearly Orders</option>
                        </select>
                    </div>
                </div>
            </div>
            <br />
            @if ($ordering == "daily")
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Today Revenue</span>
                            <span class="icon-stat-value"
                                >${{ $todayRevenue }}</span
                            >
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-dollar icon-stat-visual bg-primary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Today Sales</span>
                            <span class="icon-stat-value">{{
                                $todaySales
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Today Expense</span>
                            <span class="icon-stat-value">{{
                                $todayExpense
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            @elseif ($ordering == "weekly")
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Weekly Revenue</span>
                            <span class="icon-stat-value"
                                >${{ $weeklyRevenue }}</span
                            >
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-dollar icon-stat-visual bg-primary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Weekly Sales</span>
                            <span class="icon-stat-value">{{
                                $weeklySales
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Weekly Expense</span>
                            <span class="icon-stat-value">${{
                                $weeklyExpense
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            @elseif ($ordering == "monthly")
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Monthly Revenue</span>
                            <span class="icon-stat-value"
                                >${{ $monthlyRevenue }}</span
                            >
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-dollar icon-stat-visual bg-primary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Monthly Sales</span>
                            <span class="icon-stat-value">{{
                                $monthlySales
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Monthly Expense</span>
                            <span class="icon-stat-value">${{
                                $monthlyExpense
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            @elseif ($ordering == "yearly")
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Yearly Revenue</span>
                            <span class="icon-stat-value"
                                >${{ $yearlyRevenue }}</span
                            >
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-dollar icon-stat-visual bg-primary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Yearly Sales</span>
                            <span class="icon-stat-value">{{
                                $yearlySales
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Yearly Expense</span>
                            <span class="icon-stat-value">${{
                                $yearlyExpense
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>

            @else
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Revenue</span>
                            <span class="icon-stat-value"
                                >${{ $totalRevenue }}</span
                            >
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-dollar icon-stat-visual bg-primary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Sales</span>
                            <span class="icon-stat-value">{{
                                $totalSales
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>

            {{-- Calculate Net Profit --}}
            <div class="col-md-3 col-lg-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Expense</span>
                            <span class="icon-stat-value">{{
                                $totalExpense
                            }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i
                                class="fa fa-gift icon-stat-visual bg-secondary"
                            ></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            {{-- Calculate Net Profit --}}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Orders</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    <th>Substotal</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Zipcode</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>${{ $order->subtotal }}</td>
                                    <td>${{ $order->discount }}</td>
                                    <td>${{ $order->subtotal }}</td>
                                    <td>{{ $order->first_name }}</td>
                                    <td>{{ $order->last_name }}</td>
                                    <td>{{ $order->mobile }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->zipcode }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.orderdetails', ['order_id'=>$order->id]) }}"
                                            class="btn btn-info btn-sm"
                                            >Details</a
                                        >
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
