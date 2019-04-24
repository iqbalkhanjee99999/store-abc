@extends('layouts.app')
@include('includes.header')
@include('includes.menu')
@section('content')
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-form"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    @if(isset($tool))
                                        <h2>Assets/Tools</h2>
                                        <p>Add New Assets/Tools Category</p>
                                    @else
                                        <h2>Categories</h2>
                                        <p>{{isset($data)? 'Edit Category' : 'Add New Categories'}}</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>{{isset($data)? 'Edit Category' : 'Add Category'}}</h2>
                            </div>
                            @if(isset($tool))
                                <form action="{{asset('categories/saveToolCategory')}}" method="post">
                            @else
                                <form action="{{asset('categories/saveCategory')}}" method="post">
                            @endif
                                {{csrf_field()}}
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm ">Title</label>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <div class="nk-int-st">
                                                    <input type="text" name="title" class="form-control input-sm" placeholder="Category title" required value="{{isset($data->title)?  $data->title: ''}}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="hrzn-fm ">Description</label>
                                                </div>
                                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                    <div class="nk-int-st">
                                                        <textarea name="description" class="form-control auto-size" rows="2" placeholder="Category Description" >{{isset($data->description)?  $data->description : ''}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-example-int mg-t-15">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            </div>
                                            @if(isset($data))
                                                <input type="hidden" name="item_id" value="{{$data->id}}">
                                            @endif
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <button type="submit" class="btn btn-{{isset($data)?  'warning': 'success'}} notika-btn-{{isset($data)?  'warning': 'success'}} col-md-2 pull-right" style="padding:10px;">{{isset($data)?  'Update': 'Add'}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
