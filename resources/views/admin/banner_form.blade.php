@extends('layouts.admin')

@section('title', 'Banner Add | Admin Dashboard | ecom300')


@section('form_style')
    <style>
        label {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Banner {{ isset($banner_data) ? 'Update' : 'Add'}}</div>
                    </div>
                    <div class="ibox-body">
                        @if(isset($banner_data))
                            {{ Form::open(['url' =>  route('banner.update', $banner_data->id), 'class' => 'form form-container', 'files' => true ]) }}
                            @method('put')
                        @else
                            {{ Form::open(['url' =>  route('banner.store'), 'class' => 'form form-container', 'files' => true ]) }}
                        @endif
                        <div class="form-group row">
                            {{ Form::label('title', 'Title:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::text('title', @$banner_data->title, ['class' => 'form-control form-control-sm', 'id' => 'title', 'required' => true, 'placeholder' => 'Enter banner title ']) }}
                                @error('title')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('link', 'Link:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::text('link', @$banner_data->link, ['class' => 'form-control form-control-sm', 'id' => 'link', 'required' => true, 'placeholder' => 'Enter banner link ']) }}
                                @error('link')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('status', ['active' => 'Published', 'inactive' => 'Unpublished'], @$banner_data->status, ['class' => 'form-control form-control-sm', 'id' => 'status' , 'required' => true]) }}
                                @error('status')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('image', 'Image:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-5">
                                {{ Form::file('image', ['id' => 'status' , 'required' => (isset($banner_data) ?false : true) , 'accept' =>'image/*']) }}
                                @error('error')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <img src={{ asset('uploads/banner/Thumb-'.@$banner_data->image) }} alt="" class="img img-fluid img-responsive" style="max-width: 10rem">
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('', '', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::button('<i class = "fa fa-trash"></i> Reset', ['class' => 'btn btn-sm btn-danger', 'id' => 'reset' , 'type' => 'reset']) }}
                                {{ Form::button('<i class = "fa fa-paper-plane"></i> Submit', ['class' => 'btn btn-sm btn-success', 'id' => 'submit' , 'type' => 'submit']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
