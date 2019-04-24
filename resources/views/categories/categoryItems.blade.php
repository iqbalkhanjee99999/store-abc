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
                                        <h2>{{$category->title}}</h2>
                                        @if(isset($item))
                                            <p>Edit Item </p>
                                        @else
                                            <p>Add/Show Items in This Category</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="breadcomb-report">
                                    @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                        <a href="{{asset('/categories/items/newItem/'.$category->id)}}" data-placement="left" title="Add Items to {{$category->title}}" class="btn"><i class="notika-icon notika-plus-symbol"></i> Add Item</a>
                                    @endif
                                </div>
                            </div>
                            @if(session('error'))
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li><i class="fa fa-times"></i> {{session('error')}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                                    <th>Photo</th>
                                    @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                        <th>Actions</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $val)
                                    <tr>
                                        <td>{{$val->id}}</td>
                                        <td>{{$val->description}}</td>
                                        <td>{{$val->model_no != '' ? $val->model_no : '-'}}</td>
                                        <td>{{$val->brand_name}}</td>
                                        <td>{{$val->zone_no == '0' ? '-' : $val->zone_no }}</td>
                                        <td>{{$val->column_no == 0 ? '-' : $val->column_no}}</td>
                                        <td>{{$val->shelf_no == 0 ? '-' : $val->shelf_no}}</td>
                                        <td>{{$val->carton_no == '' ? '-' : $val->carton_no}}</td>
                                        <td><a href="{{asset('attachments/items_images/'.$val->photo)}}"><i class="fa fa-image"></i></a></td>
                                        @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                            <td>
                                                <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                    <a href="{{'/categories/items/newItem/'.$category->id.'/'.$val->id}}" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg waves-effect"><i class="notika-icon notika-menu"></i></a>
                                                    <a href="{{'/categories/deleteItem/'.$val->id}}" class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg"><i class="notika-icon notika-trash"></i></a>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
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
                                    @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
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
    <script src="{{asset('js/categories/main.js')}}"></script>
@endsection
