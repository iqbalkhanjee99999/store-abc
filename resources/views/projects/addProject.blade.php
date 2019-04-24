
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
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </div>
                                    <div class="breadcomb-ctn col-md-8">
                                        <h2>Add Project</h2>
                                        <p>New Project</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Success!</strong> {{session('success')}}
                                    </div>
                                @endif
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <form action="{{asset('/projects/saveProject')}}" method="post" id="addProject">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-example-wrap mg-t-30">
                                    <div class="form-example-int form-horizental">
                                        <div class="cmp-tb-hd cmp-int-hd">
                                            
                                            <div class="col-md-2">
                                                <h4 for="projectName">Project Name</h4>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="project_name" id="projectName" class="form-control" style="font-weight: bold;" value="{{old('project_name')}}">
                                            </div>
                                            <br>
                                            <div class="breadcomb-report">
                                                <a onclick="addRow()" data-placement="left" title="Add Coloumn" class="btn waves-effect"><i class="notika-icon notika-plus-symbol"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <table class="table" id="projectsTable">
                                                    <tr>
                                                        <th>Engineers</th>
                                                        <th>Store Keepers</th>
                                                        <th style="width: 100px;">Action</th>
                                                    </tr>
                                                    <tr class="rows">
                                                        <td>
                                                            <select class="form-control engineers" name="engineers[]" >
                                                                <option value="">Select Engineer</option>
                                                                @foreach($engineers as $k => $val)
                                                                    {{--{{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}--}}
                                                                    <option value="{{$val->id}}" >{{$val->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control storeKeepers" name="storeKeepers[]">
                                                                <option value="">Select StoreKeeper</option>
                                                                @foreach($storeKeepers as $k => $val)
                                                                    {{--{{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}--}}
                                                                    <option value="{{$val->id}}" >{{$val->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                                <div class="form-example-int mg-t-15">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-5   col-xs-12">
                                                        </div>
                                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                            <br>
                                                            <button  onclick="validateProject()" style="padding: 10px;margin: 30px;" class="btn btn-success notika-btn-success pull-right">Add Project</button>
                                                        </div>
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
                        {{--{{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}--}}
                        <option value="{{$val->id}}" >{{$val->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control storeKeepers" name="storeKeepers[]">
                    <option value="">Select StoreKeeper</option>
                    @foreach($storeKeepers as $k => $val)
                        {{--{{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}--}}
                        <option value="{{$val->id}}" >{{$val->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <a onclick="remove_row(this)" title="Remove Coloumn" class="btn-danger notika-btn-danger btn waves-effect"><i class="notika-icon notika-trash"></i></a>
            </td>
    </table>
    <script src="{{asset('js/projects/main.js')}}"></script>
    @endsection

    </html>