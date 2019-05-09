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
                                        <h2>Returned Items</h2>
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
                                    <th>Model</th>
                                    <th>Asset No</th>
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
                                        <td>{{$val->model_no}}</td>
                                        <td>{{$val->reason}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success notika-btn-success col-sm-12" data-toggle="modal" data-target="#myModal{{$val->id}}" >Add to store</button>
                                            <button type="button" class="btn btn-danger notika-btn-danger col-sm-12" onclick="rejectReturendTool({{$val->id}},{{$val->project_id}}, {{$val->item_id}})" style="margin-top: 3px;">Reject</button>
                                        </td>
                                    </tr>


                                    <div class="modal fade" id="myModal{{$val->id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h3 id="item_name">{{$val->item_name}}/{{$val->model_no}}</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <button class="btn btn-warning notika-btn-warning pull-right" title="enable item location" onclick="enable_item_location({{$val->id}})" style="margin-bottom: 5px;"><i class="fa fa-edit"></i></button>
                                                    <br>
                                                    <label for="zone_no">Zone No:</label>
                                                    <select class="form-control" name="zone_no" id="zone_no{{$val->id}}" {{$val->zone_no == '0' ? '' : 'disabled'}}>
                                                        @if($val->zone_no == 0)
                                                            <option value="">Select Zone No</option>
                                                        @endif
                                                        @foreach(range('A','Z') as $num)
                                                            <option {{$val->zone_no == $num ? 'selected' : ''}}>{{$num}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="column_no">Column No:</label>
                                                    <select class="form-control" name="column_no" id="column_no{{$val->id}}" {{$val->column_no == 0 ? '' : 'disabled'}}>
                                                        @if($val->column_no == 0)
                                                            <option value="">Select Column No</option>
                                                        @endif
                                                        @foreach(range(1,100) as $num)
                                                            <option {{$val->column_no == $num ? 'selected' : ''}}>{{$num}}</option>
                                                        @endforeach
                                                    </select>

                                                    <label for="shelf_no">Shelf No:</label>
                                                    <select class="form-control" name="shelf_no" id="shelf_no{{$val->id}}" {{$val->shelf_no == 0 ? '' : 'disabled'}}>
                                                        @if($val->shelf_no == 0)
                                                            <option value="">Select Shelf No</option>
                                                        @endif
                                                        @foreach(range(1,10) as $num)
                                                            <option {{$val->shelf_no == $num ? 'selected' : ''}}>{{$num}}</option>
                                                        @endforeach
                                                    </select>

                                                    <label for="carton_no">Carton No:</label>
                                                    <input type="text" class="form-control" name="carton_no" id="carton_no{{$val->id}}" value="{{$val->carton_no == '0'  ? '' : $val->carton_no }}"
                                                            {{$val->carton_no  == '0' ? '' : 'disabled'}} placeholder="{{$val->carton_no  == '0' ? 'Add Carton Number' : ''}}">

                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success notika-btn-success" onclick="returnedItemToStore({{$val->id}} ,{{$val->item_id}})">Received</button>
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
                                    <th>Engineer Name</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Model</th>
                                    <th>Asset No</th>
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
