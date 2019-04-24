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
                            <h2>Idle Items Requests</h2>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Brand Name</th>
                                    <th>Requested Quantity</th>
                                    <th>Project</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$val->row_id}}</td>
                                        <td>{{$val->category_name}}</td>
                                        <td>{{$val->description}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td >{{$val->total_qty}}</td>
                                        <td>{{$val->requested_project_name}}</td>
                                        <td>
                                            @if($val->storekeeper_approve == 0 && $val->is_recevied == 0)
                                                <label class="text-info">Waiting For Store Keeper Approval</label>
                                            @elseif($val->storekeeper_approve == 1 && $val->is_recevied == 0)
                                                <label class="text-success">Request Approved</label>
                                                <button class="btn btn-success notika-btn-success" onclick="idleItemsRecevied({{$val->item_id}},{{$val->total_qty}} , {{$val->row_id}})">Received</button>
                                            @elseif($val->storekeeper_approve == 1 && $val->is_recevied == 1)
                                                <label>Items Recevied</label>
                                            @elseif($val->storekeeper_approve == 2)
                                                <label class="text-danger">Request Rejected</label>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Brand Name</th>
                                    <th>Requested Quantity</th>
                                    <th>Project</th>
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
