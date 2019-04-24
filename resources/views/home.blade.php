@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.menu')
<!-- Start Status area -->
@section('content')
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{$users}}</span></h2>
                        <p>Total Users</p>
                    </div>
                    <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{$totalReciving}}</span></h2>
                        <p>Total Reciving</p>
                    </div>
                    <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{$totalRequested}}</span></h2>
                        <p>Total Requested</p>
                    </div>
                    <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{$totalItems}}</span></h2>
                        <p>Total Items</p>
                    </div>
                    <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>
<div class="notika-email-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
                    <div class="rc-it-ltd">
                        <div class="recent-items-ctn">
                            <div class="recent-items-title">
                                <h2>Recent Categories</h2>
                            </div>
                        </div>
                        <div class="recent-items-inn">
                            <table class="table table-inner table-vmiddle">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th style="width: 60px">Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $k => $val)
                                    <tr>
                                        <td class="f-500 c-cyan">{{$val->id}}</td>
                                        <td>{{$val->title}}</td>
                                        <td class="f-500 c-cyan">{{$val->description}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div id="recent-items-chart" class="flot-chart-items flot-chart vt-ct-it tb-rc-it-res"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
                    <div class="rc-it-ltd">
                        <div class="recent-items-ctn">
                            <div class="recent-items-title">
                                <h2>Recent Items</h2>
                            </div>
                        </div>
                        <div class="recent-items-inn">
                            <table class="table table-inner table-vmiddle">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th style="width: 60px">Brand</th>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($items as $k => $val)
                                    <tr>
                                        <td class="f-500 c-cyan">{{$val->id}}</td>
                                        <td>{{$val->description}}</td>
                                        <td class="f-500 c-cyan">{{$val->brand_name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" >
                <div class="recent-post-wrapper notika-shadow sm-res-mg-t-30 tb-res-ds-n dk-res-ds">
                    <div class="recent-post-ctn">
                        <div class="recent-post-title">
                            <h2>Recent Notifications</h2>
                        </div>
                    </div>
                    <div class="recent-post-items" id="homeNotifications">
                        @foreach($notifications as $k => $val)
                            <div class="recent-post-signle">
                                <a href="{{asset($val->link.'/'.$val->id)}}" class="{{$val->is_read == 0? 'unread': ''}}">
                                    <div class="recent-post-flex rct-pt-mg">
                                        <div class="recent-post-img">
                                        </div>
                                        <div class="recent-post-it-ctn">
                                            <h2>{{$val->title}}</h2>
                                            <p>{{$val->description}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        <div class="recent-post-signle">
                            <a href="#">
                                <div class="recent-post-flex rc-ps-vw">
                                    <div class="recent-post-line rct-pt-mg">
                                        <a href="{{asset('/notifications/viewAll')}}">View All</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

