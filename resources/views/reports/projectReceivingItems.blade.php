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
                                    <div class="breadcomb-ctn" style="margin-top:10px;">
                                        <h2>{{Session('project_name')}}</h2>
                                        <p>Project Material Delivery </p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                       {{session('error')}}
                                    </div>
                                @endif

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
                            <h2>List</h2>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Receiving From</th>
                                    <th>Attachment</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td onclick="showProjectFormItems({{$val->id}})" class="main_td">{{$val->id}}</td>
                                        <td onclick="showProjectFormItems({{$val->id}})" class="main_td">{{$val->date}}</td>
                                        <td onclick="showProjectFormItems({{$val->id}})" class="main_td">{{$val->reciving_from}}</td>
                                        <td class="main_td"><a class="btn btn-success notika-btn-success btn-sm" href= "{{asset('reports/downloadFile/'.$val->id)}}">Download Attachment</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Receiving From</th>
                                    <th>Attachment</th>
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
    <script src="{{asset('js/recivingGoods/main.js')}}"></script>
@endsection
