@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    @section('scripts')
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script>
            $('.table').DataTable();
        </script>
    @endsection
    @section('title', 'Banner List | Admin Dashboard | ecom300')

    @section('main-content')
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Banner List</div>
                            <a href="{{ route('banner.create') }}" class="btn btn-success float-right"><i
                                    class="fa fa-plus">
                                    Add Banner
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
                                @if(isset($banner_list))
                                    @foreach($banner_list as $banner_data)
                                        <tr>
                                            <td>
                                                <a href="{{route('banner.edit',$banner_data->id)}}"
                                                   class="btn btn-link" title="Edit banner">
                                                    {{ $banner_data->title }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ $banner_data->link }}" target="_banner"
                                                   style="color: black">
                                                    {{ $banner_data->link }}
                                                </a>
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/banner/Thumb-'.$banner_data->image) }}"
                                                     alt=""
                                                     class="img img-fluid" style="max-width: 4rem;">
                                            </td>
                                            <td>
                                            <span
                                                class="badge badge-{{$banner_data->status == 'active' ? 'success' : 'danger'}}">
                                                {{ ucfirst($banner_data->status) }}
                                            </span>
                                            </td>
                                            <td>
                                                {{ Form::open(['url' =>  route('banner.destroy', $banner_data->id), 'class' => 'form form-container', 'files' => true, 'method' => 'delete' ]) }}
                                                    @method('delete')
                                                    <button class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Do you want to delete this banner');">
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
