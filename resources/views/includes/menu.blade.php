<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class=mobile-menu-nav">
                            @if(Auth::user()->user_type != 1)
                                <li><a  href="{{asset('/home')}}"><i class="fa fa-home"></i> Home</a>
                                </li>
                            @endif
                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2)
                                @if(Auth::user()->user_type == 2)
                                    <li><a href="{{asset('/categories/showAll')}}"><i class="notika-icon notika-edit"></i> Categories</a>
                                    </li>
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 )
                                    <li>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="notika-icon notika-form"></i> Categories
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu main-menu-dropdown">
                                            <li><a href="{{asset('/categories/showAll')}}">Material Categories</a></li>
                                            <li><a href="{{asset('categories/tools')}}">Tools/Assets Category</a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2)
                                    <li>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="notika-icon notika-form"></i> Users
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu main-menu-dropdown">
                                            <li><a href="{{asset('/users/engineers')}}">Engineers</a></li>
                                            <li><a href="{{asset('users/storeKeepers')}}">Store Keepers</a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                    <li><a data-toggle="" href="{{asset('/recivingGoods')}}" ><i class="notika-icon notika-mail"></i> Receiving Goods</a>
                                    </li>
                                    <li><a data-toggle="" href="{{asset('/returnedItems')}}" ><i class="notika-icon notika-mail"></i> Returned Goods</a>
                                    </li>
                                @endif
                            @endif
                            @if(Auth::user()->user_type != 2)
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type != 101)
                                    @if(Auth::user()->user_type != 3)
                                        <li><a href="{{asset('requestedGoods/addRequest')}}"><i class="notika-icon notika-windows"></i> Material Request</a></li>
                                        <li><a href="{{asset('requestedGoods/addToolsRequest')}}"><i class="notika-icon notika-windows"></i> Tools/Assets Request</a></li>
                                    @endif
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 1)
                                    <li><a  href="{{asset('requestedGoods/MyOrders')}}"><i class="notika-icon notika-windows"></i> My Orders</a></li>
                                    @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3)
                                        <li><a  href="{{asset('reports/inventoryList')}}"><i class="notika-icon notika-windows"></i> Inventory List</a></li>
                                    @endif
                                @endif
                            @endif
                            @if(Auth::user()->user_type != 1)
                                @if(Auth::user()->user_type == 2)
                                    <li><a href="{{asset('requestedGoods/PendingRequests')}}"><i class="notika-icon notika-windows"></i> Pending Request</a></li>
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 )
                                    <li>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="notika-icon notika-form"></i> Pending Request
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu main-menu-dropdown">
                                            <li><a href="{{asset('requestedGoods/PendingRequests')}}">Material Request</a></li>
                                            <li><a href="{{asset('requestedGoods/PendingToolsRequests')}}">Tools/Assets Request</a></li>
                                        </ul>
                                    </li>
                                @endif
                            @endif
                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2)
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="notika-icon notika-form"></i> Reports
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu main-menu-dropdown">
                                        <li><a href="{{asset('reports/requestedItemsReports')}}">Requested Materials</a></li>
                                        @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                            <li><a href="{{asset('reports/requestedToolsReports')}}">Requested Tools/Assets</a></li>
                                        @endif
                                        <li><a href="{{asset('reports/recivingItems')}}">Delivery Items</a></li>
                                        <li><a href="{{asset('reports/inventoryList')}}">Inventory List</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2)
                                <li>
                                    <a href="{{asset('projects/allProjects')}}"><i class="notika-icon notika-app"></i> Projects
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->


{{--<!-- Main Menu area start-->--}}
{{--<div class="main-menu-area mg-tb-40">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
                {{--<ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">--}}

                    {{--@if(Auth::user()->user_type != 1)--}}
                        {{--<li><a  href="{{asset('/home')}}"><i class="fa fa-home"></i> Home</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2)--}}
                        {{--@if(Auth::user()->user_type == 2)--}}
                        {{--<li><a href="{{asset('/categories/showAll')}}"><i class="notika-icon notika-edit"></i> Categories</a>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                        {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 )--}}
                            {{--<li>--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                    {{--<i class="notika-icon notika-form"></i> Categories--}}
                                    {{--<span class="caret"></span>--}}
                                {{--</a>--}}
                                {{--<ul class="dropdown-menu main-menu-dropdown">--}}
                                    {{--<li><a href="{{asset('/categories/showAll')}}">Material Categories</a></li>--}}
                                    {{--<li><a href="{{asset('categories/tools')}}">Tools/Assets Category</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--@endif--}}
                            {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2)--}}
                                {{--<li>--}}
                                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                        {{--<i class="notika-icon notika-form"></i> Users--}}
                                        {{--<span class="caret"></span>--}}
                                    {{--</a>--}}
                                    {{--<ul class="dropdown-menu main-menu-dropdown">--}}
                                        {{--<li><a href="{{asset('/users/engineers')}}">Engineers</a></li>--}}
                                        {{--<li><a href="{{asset('/users/storeKeepers')}}">Store Keepers</a></li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                        {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)--}}
                            {{--<li><a data-toggle="" href="{{asset('/recivingGoods')}}" ><i class="notika-icon notika-mail" ></i> Receiving Goods</a>--}}
                            {{--</li>--}}
                            {{--<li><a data-toggle="" href="{{asset('/returnedItems')}}" ><i class="notika-icon notika-mail"></i> Returned Goods</a>--}}
                            {{--</li>--}}
                        {{--@endif--}}
                    {{--@endif--}}
                    {{--@if(Auth::user()->user_type != 2)--}}
                        {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type != 101)--}}
                                {{--@if(Auth::user()->user_type != 3)--}}
                                    {{--<li><a href="{{asset('requestedGoods/addRequest')}}"><i class="notika-icon notika-windows"></i> Material Request</a></li>--}}
                                    {{--<li><a href="{{asset('requestedGoods/addToolsRequest')}}"><i class="notika-icon notika-windows"></i> Tools/Assets Request</a></li>--}}
                                {{--@endif--}}
                        {{--@endif--}}
                        {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 1 || Auth::user()->user_type == 3)--}}
                            {{--@if(Auth::user()->user_type != 3)--}}
                                {{--<li><a  href="{{asset('requestedGoods/MyOrders')}}"><i class="notika-icon notika-windows"></i> My Orders</a></li>--}}
                            {{--@endif--}}
                            {{--@if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3)--}}
                                {{--<li><a  href="{{asset('reports/inventoryList')}}"><i class="notika-icon notika-windows"></i> Inventory List</a></li>--}}
                            {{--@endif--}}
                        {{--@endif--}}
                    {{--@endif--}}
                    {{--@if(Auth::user()->user_type != 1)--}}
                            {{--@if(Auth::user()->user_type == 2)--}}
                                {{--<li><a href="{{asset('requestedGoods/PendingRequests')}}"><i class="notika-icon notika-windows"></i> Pending Request</a></li>--}}
                            {{--@endif--}}
                            {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 )--}}
                                {{--<li>--}}
                                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                        {{--<i class="notika-icon notika-form"></i> Pending Request--}}
                                        {{--<span class="caret"></span>--}}
                                    {{--</a>--}}
                                    {{--<ul class="dropdown-menu main-menu-dropdown">--}}
                                        {{--<li><a href="{{asset('requestedGoods/PendingRequests')}}">Material Request</a></li>--}}
                                        {{--<li><a href="{{asset('requestedGoods/PendingToolsRequests')}}">Tools/Assets Request</a></li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                    {{--@endif--}}
                    {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2)--}}
                        {{--<li>--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                {{--<i class="notika-icon notika-form"></i> Reports--}}
                                {{--<span class="caret"></span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu main-menu-dropdown">--}}
                                {{--<li><a href="{{asset('reports/requestedItemsReports')}}">Requested Materials</a></li>--}}
                                {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)--}}
                                    {{--<li><a href="{{asset('reports/requestedToolsReports')}}">Requested Tools/Assets</a></li>--}}
                                {{--@endif--}}
                                {{--<li><a href="{{asset('reports/recivingItems')}}">Receiving Items</a></li>--}}
                                {{--<li><a href="{{asset('reports/inventoryList')}}">Inventory List</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--@endif--}}

                    {{--@if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2)--}}
                        {{--<li>--}}
                            {{--<a href="{{asset('projects/allProjects')}}">--}}
                                {{--<i class="notika-icon notika-app"></i> Projects--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(Auth::user()->user_type == 1 || Auth::user()->user_type == 1001 || Auth::user()->user_type == 3)--}}
                        {{--<li>--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                {{--<i class="notika-icon notika-form"></i> Sub Store--}}
                                {{--<span class="caret"></span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu main-menu-dropdown">--}}
                                {{--@if(Auth::user()->user_type != 3)--}}
                                    {{--<li><a href="{{asset('projects/projectReceivingMaterials')}}">Receiving Materials</a></li>--}}
                                    {{--<li><a href="{{asset('projects/projectReceivingTools')}}">Receiving Tools/Assets</a></li>--}}
                                    {{--<li><a href="{{asset('projects/requestProjectMaterials')}}/{{Session::get('project_id')}}">Request Materials</a></li>--}}
                                    {{--<li><a href="{{asset('projects/engineerStoreOrders')}}">My Store Orders</a></li>--}}
                                    {{--<li><a href="{{asset('projects/idleItems')}}">Idle Items List</a></li>--}}
                                    {{--<li><a href="{{asset('projects/myIdleItemsRequest')}}">My Idle Items Requests</a></li>--}}

                                {{--@endif--}}
                                    {{--<li><a href="{{asset('reports/projectInventoryList')}}/{{Session::get('project_id')}}">Project Inventory List</a></li>--}}
                                {{--@if(Auth::user()->user_type == 3)--}}
                                        {{--<li><a href="{{asset('projects/pendingMaterialRequests')}}">Pending Material Request</a></li>--}}
                                        {{--<li><a href="{{asset('projects/idleItemsRequests')}}">Idle Items Requests</a></li>--}}
                                {{--@endif--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}


<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3)
                        <li  id="main_store"><a data-toggle="tab" href="#Home"><i class="fa fa-home"></i> Main Store</a></li>
                        <li id="sub_store"><a data-toggle="tab" href="#mailbox"><i class="notika-icon notika-house" onclick=""></i> Sub Store</a></li>
                    @endif
                </ul>
                <div class="tab-content custom-menu-content">
                    <div id="Home" class="tab-pane in notika-tab-menu-bg active animated flipInX">
                        <ul class="notika-main-menu-dropdown" id="main_store">
                            @if(Auth::user()->user_type !== 1)
                                @if(Auth::user()->user_type != 3)
                                    <li ><a  href="{{asset('/home')}}"><i class="fa fa-home"></i> Home</a>
                                    </li>
                                @endif
                            @endif
                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2)
                                @if(Auth::user()->user_type == 2)
                                    <li><a href="{{asset('/categories/showAll')}}"><i class="notika-icon notika-edit"></i> Categories</a>
                                    </li>
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="notika-icon notika-form"></i>
                                                Categories
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{asset('/categories/showAll')}}">Material Categories</a></li>
                                                <li><a href="{{asset('categories/tools')}}">Tools/Assets Category</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2)
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="notika-icon notika-form"></i>
                                                Users
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{asset('/users/engineers')}}" >Engineers</a></li>
                                                <li><a href="{{asset('/users/storeKeepers')}}">Store Keepers</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                    <li><a data-toggle="" href="{{asset('/recivingGoods')}}" ><i class="notika-icon notika-mail" ></i> Receiving Goods</a>
                                    </li>
                                    <li><a data-toggle="" href="{{asset('/returnedItems')}}" ><i class="notika-icon notika-mail"></i> Returned Goods</a>
                                    </li>

                                @endif
                            @endif
                            @if(Auth::user()->user_type != 2)
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type != 101)
                                    @if(Auth::user()->user_type != 3)
                                        <li><a href="{{asset('requestedGoods/addRequest')}}"><i class="notika-icon notika-windows"></i> Material Request</a></li>
                                        <li><a href="{{asset('requestedGoods/addToolsRequest')}}"><i class="notika-icon notika-windows"></i> Tools/Assets Request</a></li>
                                    @endif
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 1 || Auth::user()->user_type == 3)
                                    @if(Auth::user()->user_type != 3)
                                        <li><a  href="{{asset('requestedGoods/MyOrders')}}"><i class="notika-icon notika-windows"></i> My Orders</a></li>
                                    @endif
                                    @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3)
                                        <li><a  href="{{asset('reports/inventoryList')}}"><i class="notika-icon notika-windows"></i> Inventory List</a></li>
                                    @endif
                                @endif
                            @endif
                            @if(Auth::user()->user_type != 1)
                                @if(Auth::user()->user_type == 2)
                                    <li><a href="{{asset('requestedGoods/PendingRequests')}}"><i class="notika-icon notika-windows"></i> Pending Request</a></li>
                                @endif
                                @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 )
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="notika-icon notika-form"></i>
                                                Pending Request
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{asset('requestedGoods/PendingRequests')}}">Material Request</a></li>
                                                <li><a href="{{asset('requestedGoods/PendingToolsRequests')}}">Tools/Assets Request</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            @endif
                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2)
                                <li>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown">
                                            <i class="notika-icon notika-form"></i>
                                            Reports
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{asset('reports/requestedItemsReports')}}">Requested Materials</a></li>
                                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101)
                                                <li><a href="{{asset('reports/requestedToolsReports')}}">Requested Tools/Assets</a></li>
                                                <li><a href="{{asset('projects/idleItems')}}">Idle Items List</a></li>
                                                <li><a href="{{asset('reports/allProjectsInventory')}}">Projects Inventory</a></li>
                                            @endif
                                            <li><a href="{{asset('reports/recivingItems')}}">Receiving Items</a></li>
                                            <li><a href="{{asset('reports/inventoryList')}}">Inventory List</a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2)
                                <li>
                                    <a href="{{asset('projects/allProjects')}}">
                                        <i class="notika-icon notika-app"></i> Projects
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    @if(Auth::user()->user_type == 3 || Auth::user()->user_type == 1)
                        <div id="mailbox" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown" id="sub_store_ul">
                                @if(Auth::user()->user_type != 3)
                                    <li  class="active"><a href="{{asset('projects/requestProjectMaterials')}}/{{Session::get('project_id')}}">Issue Materials</a></li>
                                    <li><a href="{{asset('projects/projectReceivingMaterials')}}">Material Delivery</a></li>
                                    <li><a href="{{asset('projects/projectReceivingTools')}}">Tools/Assets Delivery</a></li>
                                    <li><a href="{{asset('projects/engineerStoreOrders')}}">Material Issue Reports</a></li>


                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="notika-icon notika-form"></i>
                                                Idle Items
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{asset('projects/idleItems')}}">List</a></li>
                                                <li><a href="{{asset('projects/myIdleItemsRequest')}}">Requested Items</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                    <li><a href="{{asset('reports/projectInventoryList')}}/{{Session::get('project_id')}}">Project Inventory List</a></li>
                                @if(Auth::user()->user_type == 3)
                                        <li><a href="{{asset('projects/pendingMaterialRequests')}}">Pending Issue Request</a></li>
                                        <li><a href="{{asset('projects/idleItemsRequests')}}">Idle Items Requests</a></li>
                                        <li><a href="{{asset('/storeReturnedItems')}}">Returned Items Request</a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ajaxProgress">
    <h3>Please wait</h3>
    <img src="{{asset('img/ajax-loader.gif')}}">
</div>