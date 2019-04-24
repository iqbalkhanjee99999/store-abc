{{--@php--}}
{{--echo "<pre>";--}}
{{--print_r($data);die();--}}
{{--@endphp--}}
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
                                        <h2>Requested Assets/Tools Reports</h2>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">--}}
                                {{--<div class="breadcomb-report">--}}
                                    {{--<button onclick="exportToExcel()" class="btn btn-success notika-btn-success"><i class="fa fa-download"></i> Export To Excel</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
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
                            <h2>Assets/Tools</h2>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>S NO</th>
                                    <th>Item</th>
                                    <th>Requested By</th>
                                    <th>Tool User</th>
                                    <th>Request Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                        <tr>
                                           <td>{{$val->requested_goods_id}}</td>
                                           <td>{{$val->description}}</td>
                                           <td>{{$val->name}}</td>
                                           <td>{{$val->tools_user}}</td>
                                           <td>{{$val->date}}</td>
                                           <td>
                                           @if($val->store_approval == 1)
                                               @if($val->is_taken == 1 && $val->tool_condition == 0)
                                                       <a onclick="returnTool({{$val->tool_item_id}},'{{$val->description}}',{{$val->requested_goods_id}})" class="btn btn-success notika-btn-success">Returned</a>
                                               @elseif($val->is_taken == 1 &&  $val->tool_condition == 1)
                                                       <a onclick="toolRepaired({{$val->tool_item_id}},{{$val->requested_goods_id}})" class="btn btn-warning notika-btn-warning">Repaired?</a>
                                                       <label class="text-warning"> Under Maintenance</label>
                                               @endif
                                           @endif
                                           </td>
                                        </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>S NO</th>
                                    <th>Item</th>
                                    <th>Requested By</th>
                                    <th>Tool User</th>
                                    <th>Request Date</th>
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
