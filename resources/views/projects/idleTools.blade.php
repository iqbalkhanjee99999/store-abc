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
                                            <p>Idle Assets/Tools</p>
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
                                <li><a href="{{asset('/projects/idleItems')}}"><h2>Idle Materials</h2></a></li>
                                <li class="active"><a href="{{asset('/projects/idleTools')}}"><h2>Idle Assets/Tools</h2></a></li>
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
                                    <th>Model</th>
                                    <th>Asset No</th>
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
                                        <td>{{$val->asset_no}}</td>
                                        @if(Auth::user()->user_type == 1)
                                            @if($val->project_id == Session::get('project_id'))
                                                <td> My Item </td>
                                            @else
                                                <td>
                                                    @if($val->under_store_approval == 0)
                                                        <button type="button" class="btn btn-success notika-btn-success"  onclick="requestIdleTool({{$val->row_id}},{{$val->project_id}})" >Request Tool</button>
                                                    @else
                                                        <label>Item Requested</label>
                                                    @endif
                                                </td>
                                            @endif
                                        @endif
                                    </tr>


                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Model</th>
                                    <th>Asset No</th>
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
