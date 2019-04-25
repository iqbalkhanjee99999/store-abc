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
                        <li class="nav-item dropdown">
                            <a style="margin-top:0px;color:white" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('layouts.login')

@section('content')
    <div class="login-content">
        <!-- Login -->
        <div class="nk-block toggled" >
            <div class="nk-form">
                <form action="requestedGoods/selectedProject" method="get">
                    {{csrf_field()}}
                    <h4>Select Project</h4>
                    <select name="project_id" class="form-control" style="font-weight: bold;" required>
                        <option value="">Select Project</option>{{$projects}}
                        @foreach($projects as $k => $val)
                            <option value="{{$val->project_id}}">{{$val->project_name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit" class="btn btn-login btn-success btn-block form-control" style="margin: 5px;right: 5px;">GO</button>
                </form>
            </div>
        </div>
    </div>
    <script src="projects/main.js"></script>
@endsection

