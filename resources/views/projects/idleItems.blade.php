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
                                        @if(Auth::user()->user_type == 1001)
                                            <h2>Idle Items List</h2>
                                        @else
                                            <h2>{{Session::get('project_name')}}</h2>
                                            <p>Idle Items</p>
                                        @endif
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
                                <li class="active"><a href="{{asset('/projects/idleItems')}}"><h2>Idle Materials</h2></a></li>
                                <li><a href="{{asset('/projects/idleTools')}}"><h2>Idle Assets/Tools</h2></a></li>
                            </ul>
                            <br>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Brand Name</th>
                                    <th>Quantity</th>
                                    @if(Auth::user()->user_type == 1)
                                        <th>Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$val->row_id}}</td>
                                        <td>{{$val->project_name}}</td>
                                        <td>{{$val->category_name}}</td>
                                        <td>{{$val->description}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td >{{$val->total_qty}}</td>
                                        @if(Auth::user()->user_type == 1)
                                            @if($val->project_id == Session::get('project_id'))
                                                <td> My Item </td>
                                            @else
                                                <td>
                                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#myModal{{$val->row_id}}" >Request Items</button>
                                                </td>
                                            @endif
                                        @endif
                                    </tr>

                                    <div class="modal fade" id="myModal{{$val->row_id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 id="item_name">{{$val->description}}/{{$val->brand_name}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="item_quantity">Enter Quantity:</label>
                                                    <input type="number" class="form-control" name="item_quantity" id="quantity{{$val->row_id}}">
                                                    <input type="hidden"  id="avalible_quantity{{$val->row_id}}" value="{{$val->total_qty}}">
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" onclick="requestIdleItem({{$val->row_id}},{{$val->project_id}})">Request</button>
                                                    <button type="button" class="btn btn- waves-effect" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Brand Name</th>
                                    <th>Quantity</th>
                                    @if(Auth::user()->user_type == 1)
                                        <th>Action</th>
                                    @endif
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
