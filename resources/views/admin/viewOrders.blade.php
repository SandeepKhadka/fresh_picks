@extends('layouts.admin')
@section('title', 'Munal Stores | Order View')
@section('main-content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order</a></li>
            <li class="breadcrumb-item active" aria-current="reply">View</li>
        </ol>
    </nav>
    <div class="content">
        <div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="m-0 text-left font-weight-bold" style="padding: 10px">Order
                        View</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="order_number">Order Number</label>
                                    <input type="text" id="order_number" name="order_number" disabled
                                        value="{{ @$order_data->order_number }}" class="form-control">
                                    @error('order_number')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="user_id">User</label>
                                    <input type="text" id="user_id" name="user_id" disabled
                                        value={{ \App\Models\User::where('id', $order_data->user_id)->value('name') }}
                                        class="form-control">
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="payment_method">Payment method</label>
                                    <input type="text" id="payment_method" name="payment_method" disabled
                                        value="{{ @$order_data->payment_method }}" class="form-control">
                                    @error('payment_method')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="payment_status">Payment status</label>
                                    <input type="text" id="payment_status" name="payment_status" disabled
                                        value="{{ @$order_data->payment_status }}" class="form-control">
                                    @error('payment_status')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="condition">Condition</label>
                                    <input type="text" id="condition" name="condition" disabled
                                        value="{{ @$order_data->condition }}" class="form-control">
                                    @error('condition')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="text" id="total_amount" name="total_amount" disabled
                                        value="{{ @$order_data->total_amount }}" class="form-control">
                                    @error('total_amount')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="delivery_address">Delivery Address</label>
                                    <input type="text" id="delivery_address" name="delivery_address" disabled
                                        value="{{ @$order_data->delivery_address }}" class="form-control">
                                    @error('delivery_address')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <a href="{{ route('order.index') }}" type="submit" class="btn btn-primary float-right"
                                style="margin-right: 10px" disabled value="Back">Back</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
