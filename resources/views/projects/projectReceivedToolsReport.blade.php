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
                                        <p>Received Tools/Assets</p>
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
                                <li  class="active"><a href="{{asset('projects/projectReceivedToolsReport')}}"><h2>Main Store</h2></a></li>
                                <li><a href="{{asset('projects/RecivedToolsFromSubStore')}}"><h2>Sub Store</h2></a></li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Engineer Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Model</th>
                                    <th>Asset No</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->title}}</td>
                                        <td>{{$val->description}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td>{{$val->model_no}}</td>
                                        <td>{{$val->date}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Engineer Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Model</th>
                                    <th>Asset No</th>
                                    <th>Date</th>
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
