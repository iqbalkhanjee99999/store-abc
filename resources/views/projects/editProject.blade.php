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
                                        <h2>Projects</h2>
                                        <p>Edit Project</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Edit Project</h2>
                            </div>
                                <form action="{{asset('projects/updateProject')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm ">Project Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <div class="nk-int-st">
                                                    <input type="text" name="project_name" class="form-control input-sm"  required value="{{$data->project_name}}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="form-example-int mg-t-15">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12"></div>
                                                <input type="hidden" name="project_id" value="{{$data->id}}">
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <button type="submit" class="btn btn-warning notika-btn-warning col-md-2 pull-right" style="padding:10px;">Update</button>
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
@endsection
