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
                                    <button onclick="exportProjectMaterialsToExcel()" class="btn btn-success notika-btn-success"><i class="fa fa-download"></i> Export To Excel</button>
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
                                    <li class="active"><a href="{{asset('reports/inventoryList')}}"><h2>Materials</h2></a></li>
                                    {{--<li><a href="{{asset('reports/toolsInventoryList')}}"><h2>Assets/Tools</h2></a></li>--}}
                                </ul>
                            <br>
                        </div>
                        <div class="table-responsive">
                            <div class="col-md-1"></div>
                            <form   method="GET" action="{{asset('reports/projectInventoryList/')}}/{{Session::get('project_id')}}">
                                {{csrf_field()}}
                                <div class="col-md-4 ">
                                    <select class="form-control categories" name="category" id="category" onchange="getCategoryItems(this)" >
                                        <option value="">Select Category</option>
                                        @foreach($categories as $k => $val)
                                            <option value="{{$val->id}}" {{ request()->category == $val->id ? 'selected':''}}>{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" class="form-control" placeholder="search.." name="search" id="search" value="{{request()->search}}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="col-md-12 btn btn-success notika-btn-success">Search</button>
                                </div>
                            </form>
                            <div class="col-md-1" style="height: 70px;"></div>
                            <div class="col-md-6 ">

                            </div>

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Brand</th>
                                    <th>Model No</th>
                                    <th>Quantity</th>
                                    <th>Photo</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $k => $val)
                                            <tr>
                                                <td>{{$val->category_name}}</td>
                                                <td>{{$val->item_name}}</td>
                                                <td>{{$val->brand_name}}</td>
                                                <td>{{$val->model_no}}</td>
                                                <td style="color:indianred;font-weight: bold;">{{$val->total_qty}}</td>
                                                <td><a  href="{{asset('attachments/items_images/'.$val->photo)}}"><i class="fa fa-image"></i></a></td>
                                                <td>
                                                    @if($val->is_idle == 0)
                                                        <a  class="btn btn-success notika-btn-success" onclick="returnItem({{$val->project_item_id}})">Return To Store</a> &nbsp
                                                        <a  class="btn btn-danger notika-btn-danger" onclick="markAsIdle({{$val->project_item_id}})">Idle Item</a>
                                                    @else
                                                        <a  class="btn btn-warning notika-btn-warning" onclick="markAsFunctional({{$val->project_item_id}})">Functional Item</a>
                                                    @endif
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Brand Name</th>
                                    <th>Model No</th>
                                    <th>Quantity</th>
                                    <th>Photo</th>
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
    <script src="{{asset('js/inventory/main.js')}}"></script>

@endsection
