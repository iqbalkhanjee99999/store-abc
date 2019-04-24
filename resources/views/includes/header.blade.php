<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ABC Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.ico')}}">
    <!-- Google Fonts
		============================================ -->
    <link href="{{asset('https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900')}}" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/bootstrap.min.css')}}">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/font-awesome.min.css')}}">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/owl.transitions.css')}}">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/meanmenu/meanmenu.min.css')}}">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/animate.css')}}">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/normalize.css')}}">

    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <!-- jvectormap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/jvectormap/jquery-jvectormap-2.0.3.css')}}">
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/notika-custom-icon.css')}}">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/wave/waves.min.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/wave/button.css')}}">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/main.css')}}">

    <link rel="stylesheet" href="{{asset('temp_css/dialog/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/dialog/dialog.css')}}">

    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/summernote/summernote.css')}}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('temp_css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/notification/notification.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/bootstrap-select/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{asset('temp_css/dropzone/dropzone.css')}}">
    <!-- modernizr JS
		============================================ -->
    <script src="{{asset('temp_js/vendor/modernizr-2.8.3.min.js')}}"></script>
    {{--<script src="{{asset('jquery-3.3.1.min.js')}}"></script>--}}

</head>

<body>
<?php
    $noty   =   new \App\Notification\GetNotification();
    $myNoty   =   $noty->getNotificationsForUser();
?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Start Header Top Area -->
<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="{{asset('/home')}}"><img style="height: 33px;" src="{{asset('img/logo/logo.png')}}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav notika-top-nav">
                        @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 1001)
                            <li class="nav-item">
                                <a href="{{asset('requestedGoods/MyOrders')}}" aria-expanded="false" ><span><i class="fa fa-shopping-cart"></i></span></a>
                            </li>
                        @endif
                        <li class="nav-item nc-al"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="fa fa-bell"></i></span><div class="spinner4 spinner-4"></div></a>
                            <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
                                <div class="hd-mg-tt">
                                    <h2>Notification</h2>
                                </div>
                                <div class="hd-message-info headerNotifications">
                                    @foreach($myNoty['records'] as $k => $val)
                                    <a href="{{asset($val->link.'/'.$val->id)}}" class="{{$val->is_read == 0 ? 'unread': ''}}">
                                        <p class="pull-right" style="color:gray;padding:5px;font-size: 14px;font-style: italic">{{Carbon::parse($val->created_at)->diffForHumans()}}</p>
                                        <div class="hd-message-sn">
                                            <div class="hd-mg-ctn">
                                                <h3 style="margin-top:5px; ">{{$val->title}}</h3>
                                                <p>{{$val->description}}</p>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                                <div class="hd-mg-va">
                                    <a href="{{asset('/notifications/viewAll')}}">View All</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="fa fa-cog"></i></span>
                                @if($myNoty['count'] > 0)
                                    <div class="ntd-ctn"><span>{{$myNoty['count']}}</span></div>
                                @endif
                            </a>
                            <div role="menu" class="dropdown-menu message-dd animated zoomIn">
                                <div class="hd-mg-tt">
                                    <h2>Settings</h2>
                                    <hr>
                                </div>
                                <div class="hd-message-info" >
                                    <a href="#">
                                        <div class="hd-message-sn"style="padding-top:0px !important">
                                            <div class="hd-message-img">
                                            </div>
                                            <div class="hd-mg-ctn">
                                                <h3 style="font-size:16px;padding-left:10px">{{Auth::User()->name}}</h3>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{asset('/home')}}">
                                        <div class="hd-message-sn"style="padding-top:0px !important" id="changePassword">
                                            <div class="hd-mg-ctn" style="margin-top:8%;margin-left: 25%;">
                                                <h3 style="font-size:16px;">Change Project <i class="fa fa-arrow-right"></i> </h3>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{asset('users/changePassword')}}">
                                        <div class="hd-message-sn"style="padding-top:0px !important" id="changePassword">
                                            <div class="hd-mg-ctn" style="margin-top:8%;margin-left: 25%;">
                                                <h3 style="font-size:16px;"><i class="fa fa-edit"></i> Change Password</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="hd-mg-va" style="background: #b5d3e4c2;padding: 10px;">
                                    <a style="margin-top:0px;color:#e46a76" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();
                                                     localStorage.setItem('sub_store',0);">
                                        <i class="fa fa-power-off"></i> Logout
                                    </a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>