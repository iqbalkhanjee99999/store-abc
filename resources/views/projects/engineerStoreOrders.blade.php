{{--@php--}}
{{--echo "<pre>";--}}
{{--print_r($data);die();--}}
{{--@endphp--}}
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
                                        <h2>{{Session::get('project_name')}}</h2>
                                        <p>Store Orders</p>
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
                                <li class="active"><a href="{{asset('requestedGoods/MyOrders')}}"><h2>Materials</h2></a></li>
                                {{--<li><a href="{{asset('requestedGoods/MyToolsOrders')}}"><h2>Assets/Tools</h2></a></li>--}}
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
                                    <th>Requested Qty</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td>{{$val->description}}</td>
                                            <td>{{$val->model_no}}</td>
                                            <td>{{$val->brand_name}}</td>
                                            <td>{{$val->requested_qty}}</td>
                                                <td>
                                                    @if($val->store_approval == 0 && $val->order_recieved == 0)
                                                        <label class="text-primary">Waiting For Store Keeper Approval</label>
                                                    @elseif($val->store_approval == 1 && $val->order_recieved == 0)
                                                        <label class="text-success">Order Apporved</label> &nbsp &nbsp
                                                        <button class="btn btn-success notika-btn-success" onclick="itemReciveFromStore({{$val->requested_goods_id}})">Received</button>

                                                    @elseif($val->store_approval == 1 && $val->order_recieved == 1 )
                                                        <label>Order Received</label>
                                                    @elseif($val->store_approval == 2 )
                                                            <label class="text-danger">Order Rejected By Store Keeper</label>
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
                                    <th>Requested Qty</th>
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
