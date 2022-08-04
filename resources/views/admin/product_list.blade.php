@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    @section('scripts')
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script>
            $('.table').DataTable();
        </script>
    @endsection
    @section('title', 'Product List | Admin Dashboard | ecom300')

    @section('main-content')
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Product List</div>
                            <a href="{{ route('product.create') }}" class="btn btn-success float-right"><i
                                    class="fa fa-plus">
                                    Add Product
                                </i>
                            </a>
                        </div>
                        <div class="ibox-body">
                            <table class="table table-hover">
                                <thead class="table-secondary">
                                <tr>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Thumbnail</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($product_list))
                                    @foreach($product_list as $product_data)
                                        <tr>
                                            <td>
                                                <a href="{{route('product.edit',$product_data->id)}}"
                                                   class="btn btn-link" title="Edit product">
                                                    {{ $product_data->title }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ $product_data->link }}" target="_product"
                                                   style="color: black">
                                                    {{ $product_data->link }}
                                                </a>
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/product/Thumb-'.$product_data->image) }}"
                                                     alt=""
                                                     class="img img-fluid" style="max-width: 4rem;">
                                            </td>
                                            <td>
                                            <span
                                                class="badge badge-{{$product_data->status == 'active' ? 'success' : 'danger'}}">
                                                {{ ucfirst($product_data->status) }}
                                            </span>
                                            </td>
                                            <td>
                                                {{ Form::open(['url' =>  route('product.destroy', $product_data->id), 'class' => 'form form-container', 'files' => true, 'method' => 'delete' ]) }}
                                                @method('delete')
                                                <button class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Do you want to delete this product');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                {{ Form::close() }}
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
