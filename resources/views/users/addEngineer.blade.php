
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
                                        <h2>Engineers</h2>
                                        <p>{{isset($data)? 'Edit Engineer' : 'Add New Engineer'}}</p>
                                    </div>
                                </div>
                            </div>
                            @if(count($errors) > 0)
                            <div class=" col-lg-offset-2 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="breadcomb-wp">
                                   <div class="alert alert-danger">
                                       <ul>
                                       @foreach($errors->all() as $error)
                                           <li>{{$error}}</li>
                                       @endforeach
                                       </ul>
                                   </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-example-wrap mg-t-30">
                                <div class="cmp-tb-hd cmp-int-hd">
                                    <h2>{{isset($data)? 'Edit Engineer' : 'Add Engineer'}}</h2>
                                </div>
                                @if(isset($data))
                                    <div class="form-example-int mg-t-15">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                </div>
                                                <div class="col-lg-8 col-lg-offset-8 col-md-7 col-md-offset-8 col-sm-7 col-xs-12 ">
                                                    <button onclick="resetPassword({{$data->id}})" class="btn btn-danger notika-btn-danger col-md-2" style="margin-left: 40px; " >Reset Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <form action="{{asset('users/saveEngineer')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="hrzn-fm ">Eng. Name</label>
                                                </div>
                                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                    <div class="nk-int-st">
                                                        <input type="text" name="name" class="form-control input-md" placeholder="Enter Name" required value="{{isset($data->name)?  $data->name:  old('name') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="hrzn-fm ">Email</label>
                                                </div>
                                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                    <div class="nk-int-st">
                                                        <input type="text" name="email" class="form-control input-md" placeholder="Enter Email" required value="{{isset($data->email)?  $data->email: old('email') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="hrzn-fm ">phone No</label>
                                                </div>
                                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                    <div class="nk-int-st">
                                                        <input type="number" name="phone_no" class="form-control input-md" placeholder="000 00000" required value="{{isset($data->phone_no) ? $data->phone_no : old('phone_no')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="hrzn-fm ">Address</label>
                                                </div>
                                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                    <div class="nk-int-st">
                                                        <input type="text" name="address" class="form-control input-md" placeholder="Engineer Address" required value="{{isset($data->address) ? $data->address : old('address')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!isset($data))
                                        <div class="form-example-int form-horizental">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="hrzn-fm ">Password</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                        <div class="nk-int-st">
                                                            <input type="text"class="form-control input-md" value="User123!" style="font-weight: bold;" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($data))
                                        <input type="hidden" value="{{$data->id}}" name="user_id">
                                    @endif
                                    <br>
                                    <div class="form-example-int mg-t-15">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                </div>
                                                <div class="col-lg-8 col-lg-offset-8 col-md-7 col-md-offset-8 col-sm-7 col-xs-12 ">
                                                    <button type="submit" class="btn btn-{{isset($data) ? 'warning': 'success'}} notika-btn-{{isset($data) ? 'warning': 'success'}} col-md-2" style="margin-left: 40px; padding: 10px;" >{{isset($data) ? 'Update User': 'Add User'}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/users/main.js')}}"></script>
@endsection
