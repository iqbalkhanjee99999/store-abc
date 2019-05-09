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
                                    <div class="breadcomb-ctn" style="margin-top:10px;">
                                        <h2>{{Session::get('project_name')}}</h2>
                                        <p>Inventory List</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="breadcomb-report">
                                    {{--<button onclick="exportProjectMaterialsToExcel()" class="btn btn-success notika-btn-success"><i class="fa fa-download"></i> Export To Excel</button>--}}
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
                                <li><a href="{{asset('reports/projectInventoryList/'.Session('project_id'))}}"><h2>Materials</h2></a></li>
                                <li  class="active"><a href="{{asset('reports/projectToolsList')}}"><h2>Assets/Tools</h2></a></li>
                            </ul>
                            <br>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Asset No</th>
                                    <th>Brand/Model</th>
                                    <th>Photo</th>
                                    <th>Store Location</th>
                                    <th>Status</th>
                                    @if(Auth::user()->user_type != 3)
                                        <th>Actions</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$val->title}}</td>
                                        <td>{{$val->description}}</td>
                                        <td>{{$val->model_no}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td><a  href="{{asset('attachments/items_images/'.$val->photo)}}"><i class="fa fa-image"></i></a></td>
                                        <td>{{$val->location}}</td>
                                        <td>{{$val->is_idle == 0 ?'Functional':'Idle Tool'}}</td>
                                        @if(Auth::user()->user_type !=3)
                                            <td>
                                                @if($val->is_idle == 0)
                                                <a  class="btn btn-success notika-btn-success col-sm-12"  data-toggle="modal" data-target="#myModal{{$val->project_tool_id}}">Return To Store</a> &nbsp
                                                <a  class="btn btn-danger notika-btn-danger col-sm-12" onclick="markToolAsIdle({{$val->project_tool_id}})">Idle Tool</a>
                                                @else
                                                <a  class="btn btn-warning notika-btn-warning col-sm-12" onclick="markToolAsFunctional({{$val->project_tool_id}})">Functional Tool</a>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>

                                    <div class="modal fade" id="myModal{{$val->project_tool_id}}" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 id="item_name">Return Item {{$val->description}}/{{$val->model_no}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="item_quantity">Enter Reason:</label>
                                                    <textarea id="reason{{$val->project_tool_id}}" name="reason"  rows="5" class="form-control" style="resize: none"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success notika-btn-success waves-effect" data-dismiss="modal"  onclick="returnProjectTool({{$val->project_tool_id}})">Submit</button>
                                                    <button type="button" class="btn btn- waves-effect" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Asset No</th>
                                    <th>Brand/Model</th>
                                    <th>Photo</th>
                                    <th>Store Location</th>
                                    <th>Status</th>
                                    @if(Auth::user()->user_type != 3)
                                        <th>Actions</th>
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
    <script src="{{asset('js/inventory/main.js')}}"></script>

@endsection
