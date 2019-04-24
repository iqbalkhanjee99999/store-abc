@extends('layouts.app')
@include('includes.header')
@include('includes.menu')
@section('content')
    {{--@php--}}
    {{--echo "<pre>";--}}
    {{--print_r($data);die();--}}
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
                                    <div class="breadcomb-ctn" style="margin-top: 10px;">
                                        <h2>Requested Items Reports</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="breadcomb-report">
                                    <button onclick="exportToExcel()" class="btn btn-success notika-btn-success"><i class="fa fa-download"></i> Export To Excel</button>
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
                            <h2>Items</h2>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>User Name</th>
                                    <th>Project Name</th>
                                    <th>Model No</th>
                                    <th>Brand Name</th>
                                    <th>Requested Qty</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                        <tr>
                                            <td>{{$val->requested_goods_id}}</td>
                                            <td>{{$val->description}}</td>
                                            <td>{{$val->name}}</td>
                                            <td>{{$val->project_name}}</td>
                                            <td>{{$val->model_no}}</td>
                                            <td>{{$val->brand_name}}</td>
                                            <td>{{$val->requested_qty}}</td>
                                            <td><a  href="{{asset('attachments/items_images/'.$val->photo)}}"><i class="fa fa-image"></i></a></td>
                                            <td>{{$val->date}}</td>
                                                <td>
                                                    @if($val->proc_approval == 0 && $val->order_recieved == 0)
                                                        <label class="text-primary">Waiting For Procurement Approval</label>
                                                    @elseif($val->proc_approval == 1 && $val->store_approval== 0 && $val->order_recieved == 0)
                                                        <label class="text-warning">Waiting For Store Manager Approval</label>
                                                    @elseif($val->proc_approval == 2 || $val->store_approval== 2)
                                                        @if($val->store_approval == 2 )
                                                            <label class="text-danger">Order Rejected Store Manager</label>
                                                        @endif
                                                        @if($val->proc_approval == 2 )
                                                            <label class="text-danger">Order Rejected Procurement</label>
                                                        @endif
                                                    @elseif($val->proc_approval == 1 && $val->store_approval== 1 && $val->order_recieved == 0)
                                                        <label class="text-success">Order Approved</label>
                                                    @elseif($val->proc_approval == 1 && $val->store_approval== 1 && $val->order_recieved == 1)
                                                        <label>Recived By Site</label>
                                                    @endif
                                                </td>
                                        </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Project Name</th>
                                    <th>Description</th>
                                    <th>Model No</th>
                                    <th>Brand Name</th>
                                    <th>Requested Qty</th>
                                    <th>Image</th>
                                    <th>Date</th>
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
    <script src="{{asset('js/reports/main.js')}}"></script>
    <script src="{{asset('js/requestedGoods/main.js')}}"></script>
@endsection
