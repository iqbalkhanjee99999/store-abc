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
                                        <h2>Pending Requests</h2>
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
                            <h2>Items</h2>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Model No</th>
                                    <th>Brand Name</th>
                                    <th>Zone No</th>
                                    <th>Column No</th>
                                    <th>Shelf No</th>
                                    <th>Carton No</th>
                                    <th>Picture</th>
                                    <th>User Name</th>
                                    <th>Project Name</th>
                                    <th>Avalible Qty</th>
                                    <th>Requested Qty</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    @if($val->proc_approval == 1)
                                        @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                            <tr>
                                                <td>{{$k+1}}</td>
                                                <td>{{$val->description}}</td>
                                                <td>{{$val->model_no}}</td>
                                                <td>{{$val->brand_name}}</td>
                                                <td>{{$val->zone_no}}</td>
                                                <td>{{$val->column_no}}</td>
                                                <td>{{$val->shelf_no}}</td>
                                                <td>{{$val->carton_no}}</td>
                                                <td><a href="{{asset('attachments/items_images/'.$val->photo)}}"><i class="fa fa-image"></i></a></td>
                                                <td>{{$val->name}}</td>
                                                <td>{{$val->project_name}}</td>
                                                <td>{{$val->quantity + $val->requested_qty}}</td>
                                                <td>{{$val->requested_qty}}</td>
                                                    <td>
                                                        <a href="{{asset('requestedGoods/storeManagerApprove/'.$val->requested_goods_id)}}"  class="btn btn-success notika-btn-success">{{Auth::user()->user_type == 1001 ? 'Store ' : 'Approve'}}<i class="fa fa-check"></i></a>
                                                        <a href="{{asset('requestedGoods/storeManagerReject/'.$val->requested_goods_id)}}"  class="btn btn-danger notika-btn-danger col-md-12" style="margin-top: 5px;">{{Auth::user()->user_type == 1001 ? 'Store ' : 'Reject'}}<i class="fa fa-times"></i></a>
                                                    </td>
                                            </tr>
                                        @endif
                                    @elseif($val->proc_approval == 0)
                                        @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2)
                                            <tr>
                                                <td>{{$k+1}}</td>
                                                <td>{{$val->description}}</td>
                                                <td>{{$val->model_no}}</td>
                                                <td>{{$val->brand_name}}</td>
                                                <td>{{$val->zone_no}}</td>
                                                <td>{{$val->column_no}}</td>
                                                <td>{{$val->shelf_no}}</td>
                                                <td>{{$val->carton_no}}</td>
                                                <td><a href="{{asset('attachments/items_images/'.$val->photo)}}"><i class="fa fa-image"></i></a></td>
                                                <td>{{$val->name}}</td>
                                                <td>{{$val->project_name}}</td>
                                                <td>{{$val->quantity + $val->requested_qty}}</td>
                                                <td>{{$val->requested_qty}}</td>
                                                <td>
                                                    <a href="{{asset('requestedGoods/procurementApprove/'.$val->requested_goods_id)}}"  class="btn btn-success notika-btn-success col-md-12">{{Auth::user()->user_type == 1001 ? 'Proc ' : 'Approve'}}
                                                        @if(Auth::user()->user_type == 1001)
                                                            <i class="fa fa-check"></i></a>
                                                        @endif
                                                    <a href="{{asset('requestedGoods/procurementReject/'.$val->requested_goods_id)}}"  class="btn btn-danger notika-btn-danger col-md-12" style="margin-top: 5px;">{{Auth::user()->user_type == 1001 ? 'Proc ' : 'Reject'}}
                                                        @if(Auth::user()->user_type == 1001)
                                                            <i class="fa fa-times"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Model No</th>
                                    <th>Brand Name</th>
                                    <th>Zone No</th>
                                    <th>Column No</th>
                                    <th>Shelf No</th>
                                    <th>Carton No</th>
                                    <th>Picture</th>
                                    <th>User Name</th>
                                    <th>Project Name</th>
                                    <th>Avalible Qty</th>
                                    <th>Requested Qty</th>
                                    <th>Actions</th>
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
