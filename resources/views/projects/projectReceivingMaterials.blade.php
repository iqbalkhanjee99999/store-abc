
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
                                <div class="breadcomb-ctn" style="margin-top:10px;">
                                    <h2>{{Session::get('project_name')}}</h2>
                                </div>
                            </div>
                        </div>
                        @if(session('success'))
                            <div class="col-md-6 pull-right">
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> {{session('success')}}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <form action="{{asset('/projects/projectAddRecivingMaterialsData')}}" method="post" id="projectRecivingForm">
                    {{csrf_field()}}
                    <input type="hidden" name="project_id" value="{{Session::get('project_id')}}">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-example-wrap mg-t-30">
                                <div class="form-example-int form-horizental">
                                    <div class="cmp-tb-hd cmp-int-hd">
                                        <h2>Receiving Materials</h2>
                                        <div class="breadcomb-report">
                                            <a onclick="addRow()" data-placement="left" title="Add Coloumn" class="btn waves-effect"><i class="notika-icon notika-plus-symbol"></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <table class="table" id="recivingGoodsTable">
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Item</th>
                                                    <th>R-Quantity</th>
                                                    <th>Qty Unit</th>
                                                    <th>Location</th>
                                                    <th width="100">Actions</th>
                                                </tr>
                                                <tr class="rows">
                                                    <td id="row">
                                                        <select class="form-control categories" name="categories[]" id="categories"  onchange="getCategoryItems(this)" >
                                                            <option value="">Select Category</option>
                                                            @foreach($categories as $k => $val)
                                                                <option value="{{$val->id}}" {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}>{{$val->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control items" name="items[]" onchange="getItems(this)" disabled required>
                                                            <option value="0">Select Item</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control requested_qty" name="quantity[]" style="width: 120px"  placeholder="R-Quantity" disabled required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control quantity_unit" name="quantity_unit[]" style="width: 80px"  placeholder="Unit" disabled required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control location" id="location" name="location[]" placeholder="Location"  required>
                                                    </td>
                                                    <td></td>

                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-example-wrap mg-t-30">
                                <div class="form-example-int form-horizental">
                                    {{--<div class="cmp-tb-hd cmp-int-hd">--}}
                                        {{--<h2>Add Details</h2>--}}
                                    {{--</div>--}}
                                    <div class="form-group">
                                        {{csrf_field()}}
                                        <input type="hidden" name="project_id" value="{{Session::get('project_id')}}">
                                        <div class="form-example-int form-horizental">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="hrzn-fm "><strong>Receiving From</strong></label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                        <div class="nk-int-st">
                                                            <input type="text" id="reciving_from" name="reciving_from" class="form-control input-md" placeholder="Reciving Form" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-example-int mg-t-15">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                </div>
                                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                    <br>
                                                    <button  onclick="validateGoods()" class="btn btn-success notika-btn-success pull-right" style="padding: 10px 20px;margin-right: 40px;">Add Goods</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<table class="table">

    <tr id="main_row" style="display:none;" class="rows">
        <td>
            <select class="form-control categories" name="categories[]" onchange="getCategoryItems(this)" >
                <option value="">Select Category</option>
                @foreach($categories as $k => $val)
                    <option value="{{$val->id}}" {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}>{{$val->title}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select class="form-control items" name="items[]" onchange="getItems(this)" disabled required>
                <option value="0">Item</option>
            </select>
        </td>
        <td>
            <input type="number" class="form-control requested_qty" name="quantity[]" style="width: 120px"  placeholder="R-Quantity" disabled required>
        </td>
        <td>
            <input type="text" class="form-control quantity_unit" name="quantity_unit[]" style="width: 80px"  placeholder="Unit" disabled required>
        </td>
        <td>
            <input type="text" class="form-control location" id="location" name="location[]" placeholder="Location"  required>
        </td>
        <td>
            <a onclick="remove_row(this)" title="Remove Coloumn" class="btn-danger notika-btn-danger btn waves-effect"><i class="notika-icon notika-trash"></i></a>
        </td>

    </tr>
</table>
<script src="{{asset('js/projectRecivingGoods/main.js')}}"></script>
@endsection
