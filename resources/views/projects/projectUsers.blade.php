{{--@php--}}
{{--echo '<pre>';--}}
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
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="breadcomb-ctn col-md-8">
                                        <h2>{{$projectData->project_name}} Users</h2>
                                        @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                            <p>Manage Users </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-md-6">--}}
                                {{--@if(session('success'))--}}
                                    {{--<div class="alert alert-success alert-dismissible">--}}
                                        {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
                                        {{--<strong>Success!</strong> {{session('success')}}--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                <div class="cmp-tb-hd cmp-int-hd">
                                    <div class="breadcomb-report">
                                        <a onclick="addRow()" data-placement="left" title="Add Coloumn" class="btn waves-effect"><i class="notika-icon notika-plus-symbol"></i></a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <form action="{{asset('/projects/upadateProjectUsers')}}" method="post" id="addProject">
                        <input type="hidden" name="project_id" value="{{$projectData->id}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-example-wrap mg-t-30">
                                    <div class="form-example-int form-horizental">

                                        <div class="form-group">
                                            <div class="row">
                                                <table class="table" id="projectsTable">
                                                    <tr>
                                                        <th>Engineers</th>
                                                        <th>Store Keepers</th>
                                                        @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                                            <th style="width: 100px;">Action</th>
                                                        @endif
                                                    </tr>
                                                    @if(count($data) > 0)
                                                    @foreach($data as $k => $val)
                                                        <tr class="rows">
                                                            <td>
                                                                <select class="form-control engineers" name="engineers[]"  disabled >
                                                                    <option value="">Select Engineer</option>
                                                                    @foreach($engineers as $k2 => $val2)
                                                                        <option value="{{$val2->id}}" {{$val->engineer_id == $val2->id ? 'selected' : ''}} >{{$val2->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control storeKeepers" name="storeKeepers[]" disabled>
                                                                    <option value="">Select StoreKeeper</option>
                                                                    @foreach($storeKeepers as $k2 => $val2)
                                                                        {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}
                                                                        <option value="{{$val2->id}}" {{$val->storekeeper_id == $val2->id ? 'selected' : ''}}>{{$val2->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                                                <td>
                                                                    <a onclick="enable_textareas(this)" title="Remove Coloumn" class="btn-warning notika-btn-warning btn waves-effect"><i id="btn_icon" class="notika-icon notika-edit"></i></a>
                                                                    <a onclick="remove_row(this)" title="Remove Coloumn" class="btn-danger notika-btn-danger btn waves-effect"><i class="notika-icon notika-trash"></i></a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    @else
                                                        <h5 id="no_users">No Users For This Project</h5>
                                                    @endif
                                                </table>
                                                <div class="form-example-int mg-t-15">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-5   col-xs-12">
                                                        </div>
                                                        @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <br>
                                                                <button  onclick="updateProjectUsers()" style="padding: 10px;margin: 30px;" class="btn btn-warning notika-btn-warning pull-right">Update Project Users</button>
                                                                <button  onclick="backToProjects()" style="padding: 10px 30px;margin-top: 30px" class="btn btn-primary notika-btn-primary pull-right">Cancel</button>
                                                            </div>
                                                        @else
                                                            <button  onclick="backToProjects()" style="padding: 10px 30px;margin-top: 30px;margin-right: 20px;" class="btn btn-primary notika-btn-primary pull-right">Back</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <tr id="main_row" style="display:none;" class="rows">
            <td>
                <select class="form-control engineers" name="engineers[]">
                    <option value="">Select Engineer</option>
                    @foreach($engineers as $k => $val)
                        {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}
                        <option value="{{$val->id}}" >{{$val->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control storeKeepers" name="storeKeepers[]">
                    <option value="">Select StoreKeeper</option>
                    @foreach($storeKeepers as $k => $val)
                        {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}
                        <option value="{{$val->id}}" >{{$val->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <a onclick="remove_row(this)" title="Remove Coloumn" class="btn-danger notika-btn-danger btn waves-effect col-md-12"><i class="notika-icon notika-trash"></i></a>
            </td>
    </table>
    <script src="{{asset('js/projects/main.js')}}"></script>
    @endsection

    </html>