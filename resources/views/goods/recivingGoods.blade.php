
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
                                <div class="breadcomb-ctn">
                                    <h2>Receiving Goods</h2>
                                    <p>Select Receiving Goods</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{asset('/recivingGoods/addRecivingGoodsData')}}" method="post" id="recivingForm">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-example-wrap mg-t-30">
                                <div class="form-example-int form-horizental">
                                    <div class="cmp-tb-hd cmp-int-hd">
                                        <h2>Select Goods</h2>
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
                                                    <th>R-Quantity</th>
                                                    <th>Qty Unit</th>
                                                    <th>Zone No</th>
                                                    <th>Column No</th>
                                                    <th>Shelf No</th>
                                                    <th>Carton No</th>
                                                    <th width="150">Actions</th>
                                                </tr>
                                                <tr class="rows">
                                                    <td id="row">
                                                        <select class="form-control categories" name="categories[]" id="categories"  onchange="getCategoryItems(this)" >
                                                            <option value="">Select Category</option>
                                                            @foreach($categories as $k => $val)
                                                                <option value="{{$val->id}}" {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}>{{$val->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control items" name="items[]" onchange="getItems(this)" disabled required>
                                                            <option value="0">Select Item</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control requested_qty" name="quantity[]" style="width: 120px"  placeholder="R-Quantity" disabled required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control quantity_unit" name="quantity_unit[]" style="width: 80px"  placeholder="Unit" disabled required>
                                                    </td>
                                                    <td>
                                                        <select class="form-control zone" name="zone[]" style="width: 70px"  readonly required>
                                                            <option value="">-</option>
                                                            @foreach(range('A','Z') as $num)
                                                                <option>{{$num}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control column"  name="column[]" style="width: 70px" readonly required>
                                                            <option value="">-</option>
                                                            @foreach(range(1,100) as $num)
                                                                <option>{{$num}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control shelf" name="shelf[]" style="width: 70px" readonly required>
                                                            <option value="">-</option>
                                                            @foreach(range(1,10) as $num)
                                                                <option>{{$num}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input type="text" class="form-control carton" id="carton1" name="carton[]" placeholder="Carton No" readonly required>
                                                    </td>
                                                    <td>
                                                        <a onclick="enable(this)" title="Reallocate Item Address" class="btn-warning notika-btn-warning btn waves-effect"><i class="notika-icon notika-edit"></i></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">

                        <tr id="main_row" style="display:none;" class="rows">
                            <td>
                                <select class="form-control categories" name="categories[]" onchange="getCategoryItems(this)" >
                                    <option value="">Select Category</option>
                                    @foreach($categories as $k => $val)
                                        <option value="{{$val->id}}" {{isset($data->category_id) &&  $data->category_id == $val->id ? 'selected' : ''}}>{{$val->title}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control items" name="items[]" onchange="getItems(this)" disabled required>
                                    <option value="0">Item</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control requested_qty" name="quantity[]" style="width: 120px"  placeholder="R-Quantity" disabled required>
                            </td>
                            <td>
                                <input type="text" class="form-control quantity_unit" name="quantity_unit[]" style="width: 80px"  placeholder="Unit" disabled required>
                            </td>
                            <td>
                                <select class="form-control zone" name="zone[]" style="width: 70px"  readonly  required>
                                    <option value="">-</option>
                                    @foreach(range('A','Z') as $num)
                                        <option>{{$num}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control  shelf" name="shelf[]" style="width: 70px" readonly required>
                                    <option value="">-</option>
                                    @foreach(range(1,10) as $num)
                                        <option>{{$num}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control column"  name="column[]" style="width: 70px" readonly required>
                                    <option value="">-</option>
                                    @foreach(range(1,100) as $num)
                                        <option>{{$num}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control carton" name="carton[]" placeholder="Carton No" readonly>
                            </td>
                            <td>
                                <a onclick="enable(this)" title="Reallocate Item Address" class="btn-warning notika-btn-warning btn waves-effect"><i class="notika-icon notika-edit"></i></a>
                                <a onclick="remove_row(this)" title="Remove Coloumn" class="btn-danger notika-btn-danger btn waves-effect"><i class="notika-icon notika-trash"></i></a>
                            </td>

                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-example-wrap mg-t-30">
                                <div class="form-example-int form-horizental">
                                    <div class="cmp-tb-hd cmp-int-hd">
                                        <h2>Add Details</h2>
                                    </div>
                                    <div class="form-group">
                                        {{csrf_field()}}
                                        <div class="form-example-int form-horizental">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="hrzn-fm ">Receiving From</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                        <div class="nk-int-st">
                                                            <input type="text" id="reciving_from" name="reciving_from" class="form-control input-md" placeholder="Reciving Form" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-example-int form-horizental">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="hrzn-fm ">Project Name</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                        <div class="nk-int-st">
                                                            <input type="text" id="project_name" name="project_name" class="form-control input-md" placeholder="Project Name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-example-int mg-t-15">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    </div>
                                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                        <br>
                                                        <button  onclick="validateGoods()" class="btn btn-success notika-btn-success pull-right">Add Goods</button>
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
<script src="{{asset('js/recivingGoods/main.js')}}"></script>
@endsection
