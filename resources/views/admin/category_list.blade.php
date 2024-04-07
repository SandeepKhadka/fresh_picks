@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    @section('scripts')
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script>
            $('.table').DataTable();
        </script>
    @endsection
    @section('title', ' Category List | Admin Dashboard | Fresh Picks')

    @section('main-content')
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title" style="font-size: 24px; margin: auto;">Category List</div>
                            <a href="{{ route('category.create') }}" class="btn btn-success float-right"><i
                                    class="fa fa-plus">
                                    Add Category
                                </i>
                            </a>
                        </div>
                        <div class="ibox-body">
                            <table class="table table-hover">
                                <thead class="table-primary">
                                <tr>
                                    <th>Title</th>
                                    <th>Summary</th>
                                    <th>Image</th>
                                    <th>Is parent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($category_list))
                                    @foreach($category_list as $category_data)
                                        <tr>
                                            <td>
                                                {{ $category_data->title }}
                                            </td>
                                            <td>
                                                {{ $category_data->summary }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/category/Thumb-'.$category_data->image) }}"
                                                     alt=""
                                                     class="img img-fluid" style="max-width: 4rem;">
                                            </td>
                                           <td>
                                               {{ ($category_data->is_parent) ? 'Yes' : 'No' }}
                                           </td>
                                            <td>
                                            <span
                                                class="badge badge-{{$category_data->status == 'active' ? 'success' : 'danger'}}">
                                                {{ ucfirst($category_data->status) }}
                                            </span>
                                            </td>
                                            <td style="display: flex; gap: 10px">
                                                {!! Form::open(['url' => route('category.destroy', $category_data->id), 'class' => 'form form-container', 'files' => true, 'method' => 'delete']) !!}
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Do you want to delete this category');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                {!! Form::close() !!}
                                                
                                                {!! Form::open(['url' => route('category.edit', $category_data->id), 'class' => 'form form-container', 'files' => true, 'method' => 'get']) !!}
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
