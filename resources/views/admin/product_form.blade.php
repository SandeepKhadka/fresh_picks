@extends('layouts.admin')

@section('title', 'Product Add | Admin Dashboard | ecom300')


@section('form_style')
    <style>

    </style>
@endsection

@section('scripts')
    <script>
        if(window.$('#is_parent').is(':checked')){
            window.$('#parent_div').hide();
        }
        window.$('#is_parent').change(function (){
            window.$('#parent_div').slideToggle();
        })
    </script>
@endsection

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Product {{ isset($product_list) ? 'Update' : 'Add'}}</div>
                    </div>
                    <div class="ibox-body">
                        @if(isset($product_list))
                            {{ Form::open(['url' =>  route('pproduct.update', $product_list->id), 'class' => 'form form-container', 'files' => true ]) }}
                            @method('put')
                        @else
                            {{ Form::open(['url' =>  route('product.store'), 'class' => 'form form-container', 'files' => true ]) }}
                        @endif
                        <div class="form-group row mb-4">
                            {{ Form::label('title', 'Title:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::text('title', @$product_list->title, ['class' => 'form-control form-control-sm', 'id' => 'title', 'required' => true, 'placeholder' => 'Enter pproduct title ']) }}
                                @error('title')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('summary', 'Summary:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('summary', @$product_list->summary, ['class' => 'form-control form-control-sm', 'id' => 'summary', 'placeholder' => 'Enter pproduct summary ', 'rows' => '5', 'style' => 'resize : none']) }}
                                @error('summary')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('is_parent', 'Is parent:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::checkbox('is_parent', 1, (@$product_list->is_parent) ?? true, ['id' => 'is_parent']) }} Yes
                                @error('is_parent')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4" id="parent_div">
                            {{ Form::label('parent_id', 'Parent Product:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('parent_id', $parent_id, @$product_list->parent_id, ['class' => 'form-control form-control-sm', 'id' => 'parent_id' , 'placeholder' => '--Select any one--']) }}
                                @error('parent_id')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('status', 'Status:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('status', ['active' => 'Published', 'inactive' => 'Unpublished'], @$product_list->status, ['class' => 'form-control form-control-sm', 'id' => 'status' , 'required' => true]) }}
                                @error('status')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {{ Form::label('image', 'Image:', ['class'=> 'col-sm-3']) }}
                            <div class="col-sm-5">
                                {{ Form::file('image', ['id' => 'status' , 'required' => (isset($product_list) ?false : true) , 'accept' =>'image/*']) }}
                                @error('error')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <img src={{ asset('uploads/product/Thumb-'.@$product_list->image) }} alt=""
                                     class="img img-fluid img-responsive" style="max-width: 10rem">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
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
