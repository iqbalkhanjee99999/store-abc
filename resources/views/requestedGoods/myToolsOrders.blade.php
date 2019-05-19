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
                                    <div class="breadcomb-ctn" style="margin-top: 10px;">
                                        <h2>My Orders</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="breadcomb-report">
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
                                <li><a href="{{asset('requestedGoods/MyOrders')}}"><h2>Materials</h2></a></li>
                                <li class="active"><a href="{{asset('requestedGoods/MyToolsOrders')}}"><h2>Assets/Tools</h2></a></li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Model No</th>
                                    <th>Brand Name</th>
                                    <th>Tools User</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$val->requested_goods_id}}</td>
                                        <td>{{$val->description}}</td>
                                        <td>{{$val->model_no}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td>{{$val->tools_user}}</td>
                                        <td>
                                            @if($val->store_approval == 0 && $val->order_recieved == 0)
                                                <label class="text-primary">Waiting For Store Manager Approval</label>
                                            @elseif($val->store_approval == 2 && $val->order_recieved == 0)
                                                <label class="text-danger">Order Rejected By Store Manager</label>
                                            @elseif($val->store_approval == 1 && $val->order_recieved == 0)
                                                <a onclick="orderRecieved({{$val->requested_goods_id}},'{{$val->description}}','{{$val->model_no}}','{{$val->brand_name}}')" class="btn btn-success notika-btn-success">Order Recived</a>
                                                <a onclick="toolOrderReject({{$val->requested_goods_id}},{{$val->tool_id}})" class="btn btn-danger notika-btn-danger">Reject Tool</a>
                                            @elseif($val->store_approval == 1 && $val->order_recieved == 1)
                                                <label>Order Recieved</label>
                                            @elseif($val->store_approval == 1 && $val->order_recieved == 2)
                                                <label style="color: palevioletred;">Tool Rejected</label>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Model No</th>
                                    <th>Brand Name</th>
                                    <th>Tools User</th>
                                    <th>Status</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/categories/main.js')}}"></script>
@endsection
