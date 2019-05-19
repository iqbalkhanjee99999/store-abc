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
                                        <h2>{{Session('project_name')}}</h2>
                                        <p>Returned Items Request</p>
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
                                <li class="active"><a href="{{asset('/storeReturnedItems')}}"><h2>Materials</h2></a></li>
                                <li><a href="{{asset('/storeReturnedTools')}}"><h2>Assets/Tools</h2></a></li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Engineer Name</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Brand Name</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$val->id}}</td>
                                        <td>{{$val->project_name}}</td>
                                        <td>{{$val->engineer_name}}</td>
                                        <td>{{$val->category_name}}</td>
                                        <td>{{$val->item_name}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td>{{$val->quantity}}</td>
                                        <td>{{$val->reason}}</td>
                                        <td>
                                            <button class="btn btn-success notika-btn-success" onclick="storeReturnApprove({{$val->id}}, {{$val->project_id}}, {{$val->item_id}})">Approve</button>
                                            <button class="btn btn-danger notika-btn-danger" onclick="storeReturnReject({{$val->id}}, {{$val->project_id}}, {{$val->item_id}})">Reject</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Engineer Name</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Brand Name</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                    <th>Action</th>
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
