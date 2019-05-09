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
                                        <p>Returned Materials</p>
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
                        {{--<div class="basic-tb-hd">--}}
                            {{--<ul class="nav nav-tabs">--}}
                                {{--<li  class="active"><a href="{{asset('projects/projectReceivedMaterials')}}"><h2>Main Store</h2></a></li>--}}
                                {{--<li><a href="{{asset('projects/RecivedMaterialsFromSubStore')}}"><h2>Sub Stores</h2></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Engineer Name</th>
                                    <th>Description</th>
                                    <th>Model No</th>
                                    <th>Brand Name</th>
                                    <th>Quantity</th>
                                    <th>Return Reason</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$val->engineer_name}}</td>
                                        <td>{{$val->item_name}}</td>
                                        <td>{{$val->model_no}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td>{{$val->quantity}}</td>
                                        <td>{{$val->reason}}</td>
                                        <td>{{$val->date}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Engineer Name</th>
                                    <th>Description</th>
                                    <th>Model No</th>
                                    <th>Brand Name</th>
                                    <th>Quantity</th>
                                    <th>Return Reason</th>
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
