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
                                        <p>Add/Show All Projects</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="breadcomb-report">
                                    @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                        <a href="{{asset('/projects/addProject')}}"data-placement="left" title="Add New Category" class="btn"><i class="notika-icon notika-plus-symbol"></i></a>
                                    @endif
                                </div>
                            </div>

                            @if(session('error'))
                               <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                                       <div class="alert alert-danger alert-dismissible" role="alert">
                                           <strong>Error!</strong> {{Session::get('error')}}
                                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                   </div>
                               </div>
                            @endif
                            @if(session('success'))
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <strong>Success!</strong> {{Session::get('success')}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
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
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-hover" style="width: 100%">
                            <thead >
                            <tr>
                                <th>#</th>
                                <th colspan="6">Project Name</th>
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                    <th>Actions</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $k => $val)
                                <tr>
                                    <td onclick="showProjectUsers({{$val->id}})" class="main_td">{{$val->id}}</td>
                                    <td onclick="showProjectUsers({{$val->id}})" class="main_td" colspan="4">{{$val->project_name}}</td>
                                    <td></td>
                                    <td></td>
                                    @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                        <td>
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <a href="{{asset('projects/editProject/'.$val->id)}}" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg waves-effect"><i class="notika-icon notika-menu"></i></a>
                                                <a href="{{asset('projects/deleteProject/'.$val->id)}}" class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg"><i class="notika-icon notika-trash"></i></a>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                </a>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th colspan="5"></th>

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
<script src="{{asset('js/projects/main.js')}}"></script>
@endsection
