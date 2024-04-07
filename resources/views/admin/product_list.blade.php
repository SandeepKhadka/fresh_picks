@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@section('scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $('.table').DataTable();
    </script>
@endsection
@section('title', 'Product List | Admin Dashboard | Fresh Picks')

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title" style="font-size: 24px; margin: auto;">Product List</div>
                        <a href="{{ route('product.create') }}" class="btn btn-success float-right"><i class="fa fa-plus">
                                Add Product
                            </i>
                        </a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Condition</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($product_list))
                                    @foreach ($product_list as $product_data)
                                        <tr>
                                            <td>
                                                {{ $product_data->name }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/product/Thumb-' . $product_data->image) }}"
                                                    alt="" class="img img-fluid" style="max-width: 4rem;">
                                            </td>
                                            <td>
                                                {{ ucfirst($product_data->conditions) }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $product_data->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($product_data->status) }}
                                                </span>
                                            </td>
                                            <td style="display: flex; gap: 10px">
                                                {{ Form::open(['url' => route('product.destroy', $product_data->id), 'class' => 'form form-container', 'files' => true, 'method' => 'delete']) }}
                                                @method('delete')
                                                <button class="btn btn-danger" style="border-radius: 50%"
                                                    onclick="return confirm('Do you want to delete this product');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                {{ Form::close() }}

                                                {!! Form::open(['url' => route('product.edit', $product_data->id), 'class' => 'form form-container', 'files' => true, 'method' => 'get']) !!}
                                                <button type="submit" class="btn btn-success" style="border-radius: 50%">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                {!! Form::close() !!}
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
