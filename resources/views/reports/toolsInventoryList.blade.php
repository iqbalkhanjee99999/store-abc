@extends('layouts.app')
@include('includes.header')
@include('includes.menu')
@section('content')
    {{--@php--}}
    {{--echo "<pre>";--}}
    {{--print_r($item);die();--}}
    {{--@endphp--}}
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
                                        <p>Inventory List</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="breadcomb-report">
                                    <button onclick="exportToolsToExcel()" class="btn btn-success notika-btn-success"><i class="fa fa-download"></i> Export To Excel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                                <ul class="nav nav-tabs">
                                    <li><a href="{{asset('reports/inventoryList')}}"><h2>Materials</h2></a></li>
                                    <li class="active"><a href="{{asset('reports/toolsInventoryList')}}"><h2>Assets/Tools</h2></a></li>
                                </ul>
                            <br>
                        </div>
                        <div class="table-responsive">
                            <div class="col-md-1"></div>
                            <form   method="GET" action="{{asset('reports/toolsInventoryList')}}">
                                {{csrf_field()}}
                                <div class="col-md-4 ">
                                    <select class="form-control categories" name="category" id="category" onchange="getCategoryItems(this)" >
                                        <option value="">Select Category</option>
                                        @foreach($categories as $k => $val)
                                            <option value="{{$val->id}}" {{ request()->category == $val->id ? 'selected':''}}>{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" class="form-control" placeholder="search.." name="search" id="search" value="{{request()->search}}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="col-md-12 btn btn-success notika-btn-success">Search</button>
                                </div>
                            </form>
                            <div class="col-md-1" style="height: 70px;"></div>
                            <div class="col-md-6 ">

                            </div>

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Asset No</th>
                                    <th>Brand/Model</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $k2 = 0;
                                @endphp
                                    @foreach($data as $k => $val)
                                            <tr>
                                                <td>{{$val->title}}</td>
                                                <td>{{$val->item_description}}</td>
                                                <td>{{$val->brand_name}}</td>
                                                <td>{{$val->model_no}}</td>
                                                <td><a  href="{{asset('attachments/items_images/'.$val->photo)}}"><i class="fa fa-image"></i></a></td>
                                                <td>
                                                    @if($val->is_taken ==0 && $val->tool_condition == 0)
                                                        @php
                                                            $k2++;
                                                        @endphp
                                                        <label class="text-success">Avalible</label>
                                                    @elseif($val->is_taken ==2 && $val->tool_condition == 0)
                                                        <label class="text-info">Waiting Approval</label>
                                                    @elseif($val->is_taken == 1 && $val->tool_condition == 0)
                                                        <label>Recevied By Site</label>
                                                    @elseif($val->is_taken == 1 &&  $val->tool_condition == 1)
                                                        <label class="text-warning"> Under Maintenance</label>
                                                    @elseif($val->is_taken == 1 &&  $val->tool_condition == 2)
                                                        <label class="text-danger"> damaged</label>
                                                    @endif
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Asset No</th>
                                    <th>Brand/Model</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="pull-right"><label style="font-size: 18px;margin-right: 20px;">Total Avalible Quantity: <span class="text-danger">{{$k2 }}</span></label></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/inventory/main.js')}}"></script>

@endsection
