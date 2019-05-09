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
                                    </div>
                                </div>
                            </div>
                            @if(session('success'))
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                                        <div class="alert alert-success">
                                            <ul>
                                                <li><i class="fa fa-check"></i> {{session('success')}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <form action="{{asset('/requestedGoods/addToolsRequestedGoods')}}" method="post" id="addToolsRequest">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-example-wrap mg-t-30">
                                    <div class="form-example-int form-horizental">
                                        <div class="cmp-tb-hd cmp-int-hd">
                                            <h2>Tools/Assets Request</h2>
                                            <div class="breadcomb-report">
                                                <a onclick="addRow()" data-placement="left" title="Add Coloumn" class="btn waves-effect"><i class="notika-icon notika-plus-symbol"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <table class="table" id="recivingGoodsTable">
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Item</th>
                                                        <th>Tools/Asset User</th>
                                                        <th>Location</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control categories" name="categories[]" id="categories"  onchange="getToolsCategoryItems(this)" >
                                                                <option value="">Select Category</option>
                                                                @foreach($categories as $k => $val)
                                                                    <option value="{{$val->id}}" {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}>{{$val->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control items" name="items[]" onchange="enableTextBoxes(this)" disabled>
                                                                <option value="0">Select Item</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control tools_user" name="tools_user[]" required placeholder="user name" disabled>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control location"  name="location[]" required placeholder="Location" disabled>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                                    </div>
                                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                        <br>
                                                        <button  onclick="validateToolsRequest()" style="padding: 10px;;margin-right: 10px;" class="btn btn-success notika-btn-success pull-right">Add Request</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table>


                            <tr id="main_row" style="display:none;">
                                <td>
                                    <select class="form-control categories" name="categories[]" id="categories"  onchange="getToolsCategoryItems(this)" >
                                        <option value="">Select Category</option>
                                        @foreach($categories as $k => $val)
                                            <option value="{{$val->id}}" {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}>{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control items" name="items[]" onchange="enableTextBoxes(this)" disabled>
                                        <option value="0">Select Item</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control tools_user" name="tools_user[]" required placeholder="user name" disabled>
                                </td>
                                <td>
                                    <input type="text" class="form-control location"  name="location[]" required placeholder="Location" disabled>
                                </td>
                                <td>
                                    <a onclick="remove_row(this)" title="Remove Coloumn" class="btn-danger notika-btn-danger btn waves-effect"><i class="notika-icon notika-trash"></i></a>
                                </td>

                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div> <script src="{{asset('js/requestedGoods/main.js')}}"></script>

@endsection
