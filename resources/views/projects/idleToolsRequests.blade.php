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
                                    <div class="breadcomb-ctn" style="margin-top: 10px;">
                                        <h2>{{Session::get('project_name')}}</h2>
                                        <p>Idle Items Requests</p>
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
                                <li><a href="{{asset('projects/idleItemsRequests')}}"><h2>Idle Items Requests</h2></a></li>
                                <li class="active"><a href="{{asset('projects/idleToolsRequests')}}"><h2>Idle Tools Requests</h2></a></li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Model</th>
                                    <th>Asset No</th>
                                    <th>Project</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$val->row_id}}</td>
                                        <td>{{$val->category_name}}</td>
                                        <td>{{$val->description}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td>{{$val->model_no}}</td>
                                        <td>{{$val->requested_project_name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success notika-btn-success" onclick="approveIdleToolsRequest({{$val->project_item_id}}, {{$val->row_id}})" >Accept</button> &nbsp
                                            <button type="button" class="btn btn-danger notika-btn-danger" onclick="rejectIdleToolRequest({{$val->row_id}})">Reject</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Model</th>
                                    <th>Brand Name</th>
                                    <th>Project</th>
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
