@extends('layouts.admin')

@section('title', 'Product Add | Admin Dashboard | Fresh Picks')

@section('form_style')
    <style>
        .page-content {
            padding: 10px;
        }

        .ibox {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .ibox-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            padding: 20px;
            border-bottom: 1px solid #eee;
            background-color: #f5f5f5;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .ibox-body {
            padding: 20px;
        }

        .form-label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
        }

        .form-control {
            width: calc(100% - 40px);
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #80bdff;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border: 1px solid #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border: 1px solid #bd2130;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border: 1px solid #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border: 1px solid #1e7e34;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .img-preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
@endsection
@section('scripts')
    <script>
        if (window.$('#is_parent').is(':checked')) {
            window.$('#parent_div').hide();
        }
        window.$('#is_parent').change(function() {
            window.$('#parent_div').slideToggle();
        })
    </script>
@endsection

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="ibox">
                    <div class="ibox-title">Product {{ isset($product_list) ? 'Update' : 'Add' }}</div>
                    <div class="ibox-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (isset($product_list))
                            {{ Form::open(['url' => route('product.update', $product_list->id), 'class' => 'form form-container', 'files' => true]) }}
                            @method('put')
                        @else
                            {{ Form::open(['url' => route('product.store'), 'class' => 'form form-container', 'files' => true]) }}
                        @endif
                        <div class="form-group row mb-4">
                            {{ Form::label('name', 'Name:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::text('name', @$product_list->name, ['class' => 'form-control form-control-sm', 'id' => 'name', 'required' => true, 'placeholder' => 'Enter product name ']) }}
                                @error('name')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('summary', 'Summary:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('summary', @$product_list->summary, ['class' => 'form-control form-control-sm', 'id' => 'summary', 'placeholder' => 'Enter product summary ', 'rows' => '5', 'style' => 'resize : none']) }}
                                @error('summary')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('description', 'Description:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('description', @$product_list->description, ['class' => 'form-control form-control-sm', 'id' => 'description', 'placeholder' => 'Enter product description ', 'rows' => '5', 'style' => 'resize : none']) }}
                                @error('description')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('cat_id', 'Category:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('cat_id', $categories->pluck('title', 'id'), @$product_list->cat_id, ['class' => 'form-control form-control-sm', 'id' => 'cat_id', 'required' => true, 'placeholder' => 'Select Category']) }}
                                @error('cat_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row mb-4">
                            {{ Form::label('sub_cat_id', 'Sub Category:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('sub_cat_id', $sub_categories->pluck('title', 'id'), @$product_list->sub_cat_id, ['class' => 'form-control form-control-sm', 'id' => 'sub_cat_id', 'placeholder' => 'Select Sub Category']) }}
                                @error('sub_cat_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group row mb-4">
                            {{ Form::label('quantity', 'Quantity:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::number('quantity', @$product_list->quantity, ['class' => 'form-control form-control-sm', 'id' => 'quantity', 'required' => true, 'placeholder' => 'Enter product quantity ']) }}
                                @error('quantity')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('price', 'Price:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::number('price', @$product_list->price, ['class' => 'form-control form-control-sm', 'id' => 'price', 'required' => true, 'placeholder' => 'Enter product price ']) }}
                                @error('price')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('discount', 'Discount:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::number('discount', @$product_list->discount, ['class' => 'form-control form-control-sm', 'id' => 'discount', 'placeholder' => 'Enter product discount ']) }}
                                @error('discount')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('conditions', 'Condition:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('conditions', ['exotic' => 'Exotic', 'new' => 'New', 'discount' => 'Discount'], @$product_list->conditions, ['class' => 'form-control form-control-sm', 'id' => 'conditions', 'required' => true, 'placeholder' => 'Select Condition ']) }}
                                @error('conditions')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('status', 'Status:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('status', ['active' => 'Published', 'inactive' => 'Unpublished'], @$product_list->status, ['class' => 'form-control form-control-sm', 'id' => 'status', 'required' => true]) }}
                                @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('image', 'Image:', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-5">
                                {{ Form::file('image', ['id' => 'status', 'required' => isset($product_list) ? false : true, 'accept' => 'image/*']) }}
                                @error('error')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <img src={{ asset('uploads/product/Thumb-' . @$product_list->image) }} alt=""
                                    class="img img-fluid img-responsive" style="max-width: 10rem">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('', '', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::button('<i class = "fa fa-trash"></i> Reset', ['class' => 'btn btn-sm btn-danger', 'id' => 'reset', 'type' => 'reset']) }}
                                {{ Form::button('<i class = "fa fa-paper-plane"></i> Submit', ['class' => 'btn btn-sm btn-success', 'id' => 'submit', 'type' => 'submit']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
