@extends('layouts.admin')

@section('title', 'Admin Dashboard | Fresh Picks')

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $newOrdersCount }}</h2>
                        <div class="m-b-5">NEW ORDERS</div>
                        <i class="ti-shopping-cart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">${{ $totalIncome }}</h2>
                        <div class="m-b-5">TOTAL INCOME</div>
                        <i class="fa fa-money widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Latest Orders</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th width="91px">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestOrders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('order.show', $order->id) }}">{{ $order->order_number }}</a>
                                        </td>
                                        <td>{{ \App\Models\User::where('id', $order->user_id)->value('name') }}</td>
                                        <td>Rs {{ $order->total_amount }}</td>
                                        <td>
                                            @if (@$order->condition == 'delivered')
                                                <span class="badge bg-success">{{ ucfirst($order->condition) }}
                                                </span>
                                            @elseif(@$order->condition == 'shipped')
                                                <span class="badge bg-primary">{{ ucfirst($order->condition) }}
                                                </span>
                                            @elseif(@$order->condition == 'out for delivery')
                                                <span class="badge bg-info">{{ ucfirst($order->condition) }}
                                                </span>
                                            @elseif(@$order->condition == 'processing')
                                                <span class="badge bg-yellow">{{ ucfirst($order->condition) }}
                                                </span>
                                            @elseif(@$order->condition == 'cancelled')
                                                <span class="badge bg-danger">{{ ucfirst($order->condition) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('m/d/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No orders available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
