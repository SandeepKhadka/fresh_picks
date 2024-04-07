@extends('layouts.admin')

@section('title', 'Banner Add | Admin Dashboard | Fresh Picks')

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

@section('main-content')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="ibox">
                    <div class="ibox-title">Banner {{ isset($banner_data) ? 'Update' : 'Add'}}</div>
                    <div class="ibox-body">
                        @if(isset($banner_data))
                            {!! Form::open(['url' =>  route('banner.update', $banner_data->id), 'class' => 'form form-container', 'files' => true ]) !!}
                            @method('put')
                        @else
                            {!! Form::open(['url' =>  route('banner.store'), 'class' => 'form form-container', 'files' => true ]) !!}
                        @endif
                        <div class="form-group mb-4">
                            <label class="form-label" for="title">Title:</label>
                            {!! Form::text('title', @$banner_data->title, ['class' => 'form-control', 'id' => 'title', 'required' => true, 'placeholder' => 'Enter banner title ']) !!}
                            @error('title')
                                <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label" for="status">Status:</label>
                            {!! Form::select('status', ['active' => 'Published', 'inactive' => 'Unpublished'], @$banner_data->status, ['class' => 'form-control', 'id' => 'status', 'required' => true]) !!}
                            @error('status')
                                <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label" for="image">Image:</label>
                            {!! Form::file('image', ['id' => 'image', 'required' => !isset($banner_data), 'accept' =>'image/*']) !!}
                            @error('image')
                                <span class="alert-danger">{{ $message }}</span>
                            @enderror
                            @if(isset($banner_data))
                                <img src="{{ asset('uploads/banner/Thumb-'.@$banner_data->image) }}" alt="Banner Image" class="img-preview">
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <button type="reset" class="btn btn-danger"><i class="fa fa-trash"></i> Reset</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
