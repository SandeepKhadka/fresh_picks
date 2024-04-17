@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@section('scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $('.table').DataTable();
    </script>
@endsection
@section('title', 'Order List | Admin Dashboard | Fresh Picks')

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title" style="font-size: 24px; margin: auto;">Order List</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width: 10px">S.N.</th>
                                    <th>Order Number</th>
                                    <th>User</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Total</th>
                                    <th style="width: 90px">Condition</th>
                                    <th style="width: 120px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($order_list))
                                    @foreach ($order_list as $orders => $order)
                                        <tr>
                                            <td>{{ $orders + 1 }}</td>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ \App\Models\User::where('id', $order->user_id)->value('name') }}
                                            </td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                @if (@$order->payment_status == 'paid')
                                                    <span class="badge bg-success">{{ ucfirst($order->payment_status) }}
                                                    </span>
                                                @elseif(@$order->payment_status == 'unpaid')
                                                    <span class="badge bg-danger">{{ ucfirst($order->payment_status) }}
                                                    </span>
                                                @elseif(@$order->payment_status == 'redeem')
                                                    <span class="badge bg-warning">{{ ucfirst($order->payment_status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>Rs {{ number_format($order->total_amount, 2) }}</td>
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
                                            <td>
                                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary">
                                                    {{-- <i class="fa fa-eye"> --}}
                                                        View Order
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
