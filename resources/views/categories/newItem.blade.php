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
                                    <h2>{{$category->title}}</h2>
                                    <p>{{isset($data) ? 'Edit Item' : 'Add Items To Category' }}</p>
                                </div>
                                @if(session('error'))
                                <div class="alert alert-danger col-md-6 col-md-offset-4">
                                    {{session('error')}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>{{isset($data) ? 'Edit Item' : 'Add Item' }}</h2>
                            </div>
                            @if(isset($tool))
                                <form action="{{asset('categories/addToolCategoryItem')}}" method="post" enctype="multipart/form-data">
                            @else
                                <form action="{{asset('categories/addCategoryItem')}}" method="post" enctype="multipart/form-data">
                            @endif
                                {{csrf_field()}}
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm ">Description</label>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <div class="nk-int-st">
                                                    <input type="text" name="description" class="form-control input-sm" value="{{isset($data->description)? $data->description : '' }}" placeholder="Item Description" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(!isset($tool))
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="hrzn-fm ">Material Unit</label>
                                                </div>
                                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                    <div class="bootstrap-select fm-cmp-mg">
                                                        <select class="selectpicker" data-live-search="true" name="item_unit" required }}>
                                                            <option value="">Select Item Unit</option>
                                                            <option value="M" {{isset($data->quantity_unit) && $data->quantity_unit == "M" ? 'selected' : ''}}>Meter</option>
                                                            <option value="No's" {{isset($data->quantity_unit) && $data->quantity_unit == "No's" ? 'selected' : ''}}>No's</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            @if(isset($tool))
                                                <label class="hrzn-fm ">Asset No</label>
                                            @else
                                                <label class="hrzn-fm ">Model No</label>
                                            @endif
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <div class="nk-int-st">
                                                    <input type="text" name="model_no" class="form-control input-sm" placeholder="Model Number" value="{{isset($data->model_no) ? $data->model_no : ''}}"  {{isset($tool)? 'required' : ''}}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            @if(isset($tool))
                                                    <label class="hrzn-fm ">Brand/Model</label>
                                            @else
                                                <label class="hrzn-fm ">Brand Name</label>
                                            @endif
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <div class="nk-int-st">
                                                    <input type="text" name="brand_name" class="form-control input-sm" placeholder="Brand Name" required value="{{isset($data->brand_name) ? $data->brand_name : ''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm ">Photo</label>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <div class="nk-int-st">
                                                    <input type="hidden" name="photoUpdate" value="{{isset($data->photo) ? $data->photo : ''}}">
                                                    <input type="file" name="photo" class="form-control input-sm" {{isset($data->photo) ? '': 'required'}} style="border-top: none; border-right: none;border-left: none">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm ">Zone No</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="bootstrap-select fm-cmp-mg">
                                                        <select class="selectpicker" data-live-search="true" name="zone_no" {{isset($tool) ? 'required' : ''}}>
                                                            <option value="{{isset($tool) ? '': 0}}">Select Zone No</option>
                                                            @foreach (range('A', 'Z') as $char)
                                                                <option value="{{$char}}" {{isset($data->zone_no) && $data->zone_no == $char ? 'selected' : ''}}>{{$char}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                                    <label class="hrzn-fm ">Column No</label>
                                                </div>
                                                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                                <div class="bootstrap-select fm-cmp-mg">
                                                    <select class="selectpicker" data-live-search="true" name="column_no" {{isset($tool) ? 'required' : ''}}>
                                                        <option value="{{isset($tool) ? '': 0}}">Select Column No</option>
                                                        @foreach (range(1, 100) as $val)
                                                            <option value="{{$val}}" {{isset($data->column_no) && $data->column_no == $val ? 'selected' : ''}}>{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm ">Shelf No</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="bootstrap-select fm-cmp-mg">
                                                        <select class="selectpicker" data-live-search="true" name="shelf_no" {{isset($tool) ? 'required' : ''}}>
                                                            <option value="{{isset($tool) ? '': 0}}">Select Shelf No</option>
                                                            @foreach (range(1, 10) as $val)
                                                                <option value="{{$val}}" {{isset($data->shelf_no) && $data->shelf_no == $val ? 'selected' : ''}}>{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                                    <label class="hrzn-fm ">Carton No</label>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="nk-int-st">
                                                        <input name="carton_no" type="text" name="carton_no" class="form-control input-sm" placeholder="Carton Number" value="{{isset($data->carton_no) ? $data->carton_no : ''}}" {{isset($tool) ? 'required' : ''}}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="category_id" value="{{$category->id}}">
                                @if(isset($data))
                                    <input type="hidden" name="item_id" value="{{$data->id}}">
                                @endif
                                <br>
                                <div class="form-example-int mg-t-15">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <button type="submit" class="btn btn-{{isset($data) ? 'warning' : 'success'}} notika-btn-{{isset($data) ? 'warning' : 'success'}} col-md-2 pull-right" style="padding:10px;">{{isset($data) ? 'Update' : 'Add'}}</button>
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
