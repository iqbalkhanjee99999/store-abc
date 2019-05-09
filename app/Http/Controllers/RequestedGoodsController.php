<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notifications;
use App\RequestedGoods;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Project;
use Illuminate\Support\Facades\Session;

class RequestedGoodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function addRequest(){
        $category   = new Category();
        $categories = $category->getAllCategories();

        if(Auth::user()->user_type == 1001 ||Auth::user()->user_type == 101 || Auth::user()->user_type == 1 || Auth::user()->user_type == 3){
            return view('requestedGoods.addRequest')->with('categories',$categories);
        }
        else{
            return redirect('/home');
        }
    }

    public function addToolsRequest(){
        $category   = new Category();
        $categories = $category->getAllToolsCategories();

        if(Auth::user()->user_type == 1001 ||Auth::user()->user_type == 101 || Auth::user()->user_type == 1 || Auth::user()->user_type == 3){
            return view('requestedGoods.toolsRequest')->with('categories',$categories);
        }
        else{
            return redirect('/home');
        }
    }

    public function getItemDetails($id){

        $category   = new Category();
        $data       = $category->getItemData($id);

        die(json_encode($data));
    }

    public function addRequestedGoods(Request $request){

        $data['requested_qty']      = $request->requested_qty;
        $data['project_id']         = Session::get('project_id');
        $data['items']              = $request->items;
        $data['location']           = $request->location;


        $requestedGoods = new RequestedGoods();
        $requestedGoods->addRequestedGoods($data);

        $noti['title']          = 'Goods Requested';
        $noti['description']    = 'Engineer Requested Goods. Please Take Required Action';
        $noti['link']           = 'requestedGoods/PendingRequests';


        $notification = new Notifications();
        $notification->procSendNotification($noti);

        return redirect()->back()->with('success','Request Added. Please Wait For Approval');
    }

    public function PendingRequests($id = 0){
        $goods  = new RequestedGoods();
        $data   = $goods->getPendingRequests();

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }
        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2){
            return view('requestedGoods.pendingRequests')->with('data',$data);
        }
        else{
            return redirect('/home');
        }
    }

    public function PendingToolsRequests($id = 0){

        $goods  = new RequestedGoods();
        $data   = $goods->getPendingToolsRequests();

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }
        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2){
            return view('requestedGoods.toolsPendingRequests')->with('data',$data);
        }
        else{
            return redirect('/home');
        }
    }

    public function procurementApprove($id){

        $goods = new RequestedGoods();
        $goods->procurementApprove($id);

        $noti['title']          = 'Request Approved';
        $noti['description']    = 'Procurement Accepted Goods Request. Please Take Required Action';
        $noti['link']           = 'requestedGoods/PendingRequests';

        $notification = new Notifications();
        $notification->storeManagerSendNotification($noti);

        return redirect()->back();
    }

    public function procurementReject($id){
        $goods      = new RequestedGoods();
        $user_id    = $goods->getRequestedUserId($id);
        $project_id = $goods->procurementReject($id);
        $goods->updateQuantity($id);

        $noti['title']          = 'Request Rejected';
        $noti['description']    = 'Rejected By Procurement Manager';
        $noti['link']           = 'requestedGoods/MyOrders';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $project_id;

        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

        return redirect()->back();
    }

    public function storeManagerReject($id){
        $goods      = new RequestedGoods();
        $project_id = $goods->storeManagerReject($id);
        $user_id    = $goods->getRequestedUserId($id);
        $goods->updateQuantity($id);

        $noti['title']          = 'Request Rejected';
        $noti['description']    = 'Rejected By Store Manager';
        $noti['link']           = 'requestedGoods/MyOrders';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $project_id;


        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

        return redirect()->back();
    }

    public function storeManagerApprove($id){
        $goods      = new RequestedGoods();
        $project_id = $goods->storeManagerApprove($id);

        $user       = new RequestedGoods();
        $user_id    = $user->getRequestedUserId($id);

        $noti['title']          = 'Request Approved';
        $noti['description']    = 'Your Request is Approved';
        $noti['link']           = 'requestedGoods/MyOrders';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $project_id;

        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

        return redirect()->back();
    }

    public function MyOrders($id = 0){
        $goods  = new RequestedGoods();
        $data   = $goods->myOrders();

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }

        return view('requestedGoods.myOrders')->with('data',$data)->with('materials',1);
    }

    public function MyToolsOrders($id = 0){
        $goods  = new RequestedGoods();
        $data   = $goods->myToolsOrders();

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }

        return view('requestedGoods.myToolsOrders')->with('data',$data)->with('tools',1);
    }

    public function addToolsRequestedGoods(Request $request){

        $data['location']      = $request->location;
        $data['tools_user']      = $request->tools_user;
        $data['items']           = $request->items;

        $requestedGoods = new RequestedGoods();
        $requestedGoods->addToolsRequestedGoods($data);

        $noti['title']          = 'Tools/Assets Requested';
        $noti['description']    = 'Engineer Requested Goods. Please Take Required Action';
        $noti['link']           = 'requestedGoods/PendingToolsRequests';


        $notification = new Notifications();
        $notification->storeManagerSendNotification($noti);

        return redirect()->back()->with('success','Request Added. Please Wait For Approval');
        return 'tools requested Goods Added';
    }

    public function storeToolsApprove($id){

        $goods = new RequestedGoods();
        $goods->storeToolsApprove($id);

        $user    = new RequestedGoods();
        $data    = $user->getToolsRequestedUserId($id);
        $user_id = $data->requested_user_id;
        $project_id = $data->project_id;

        $noti['title']          = 'Tools/Assets Request Approved';
        $noti['description']    = 'Your Request For Tools/Assets Approved';
        $noti['link']           = 'requestedGoods/MyToolsOrders';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $project_id;

        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

        return redirect()->back();
    }

    public function storeToolsReject($id){

        $goods      = new RequestedGoods();
        $data    = $goods->getToolsRequestedUserId($id);
        $goods->storeToolReject($id);
        $user_id = $data->requested_user_id;
        $project_id = $data->project_id;

        $noti['title']          = 'Tools/Assets Request Rejected';
        $noti['description']    = 'Rejected By Store Manager';
        $noti['link']           = 'requestedGoods/MyToolsOrders';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $project_id;


        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

        return redirect()->back();
    }

    public function markToolAsGood($id,$requested_goods_id){
        $item = new RequestedGoods();
        $item->marToolAsGood($id,$requested_goods_id);
    }

    public function markToolAsNeedRepair($id){
        $item = new RequestedGoods();
        $item->marToolAsNeedRepair($id);
    }

    public function markToolAsDemaged($id){
        $item = new RequestedGoods();
        $item->marToolAsDemaged($id);
    }

    public function markToolAsRecieved($id){
        $item = new RequestedGoods();
        $item->markToolAsRecieved($id);
    }

    public function markMaterialAsRecieved($id){

        $item = new RequestedGoods();
        $item->markMaterialAsRecieved($id);
    }

    public function rejectMaterialOrder($id){

        $item = new RequestedGoods();
        $project_name = $item->rejectMaterialOrder($id);

        $goods = new RequestedGoods();
        $goods->updateQuantity($id);

        $noti['title']          = 'Materials Rejected';
        $noti['description']    = 'Project : '.$project_name.'. Engineer rejected materials';
        $noti['link']           = 'requestedGoods/PendingRequests';
        $noti['user_id']        = 1;


        $notification = new Notifications();
        $notification->storeManagerSendNotification($noti);
    }

    public function selectedProject(Request $request){

        $id = $request->project_id;

        $category   = new Category();
        $categories = $category->getAllCategories();

        $project    = new Project();
        $data       = $project->getProjectDetails($id);

        $request->session()->put('project_name', $data->project_name);
        $request->session()->put('project_id', $data->id);
        return view('projects.requestProjectMaterials')->with('categories',$categories);
    }

    public function returnedItems($id = 0){

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }
        $goods  = new RequestedGoods();
        $data   = $goods->getAllReturnedGoods();

        return view('projects.returnedItems')->with('data',$data);
    }

    public function returnedTools($id = 0){

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }
        $goods  = new RequestedGoods();
        $data   = $goods->getAllReturnedTools();

        return view('projects.returnedTools')->with('data',$data);
    }
    public function getStoreReturnedItems($id = 0){

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }
        $goods  = new RequestedGoods();
        $data   = $goods->getStoreReturnedItems();

        return view('projects.getStoreReturnedItems')->with('data',$data);
    }

    public function storeReturnedTools($id = 0){

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }
        $goods  = new RequestedGoods();
        $data   = $goods->storeReturnedTools();

        return view('projects.getStoreReturnedTools')->with('data',$data);
    }

    public function returnedToStore(Request $request){

        $data['id']         = $request->id;
        $data['item_id']    = $request->item_id;
        $data['quantity']   = $request->quantity;
        $data['shelf_no']   = $request->shelf_no;
        $data['column_no']  = $request->column_no;
        $data['zone_no']    = $request->zone_no;
        $data['carton_no']  = $request->carton_no;

        $goods  = new RequestedGoods();
        $goods->returnedToStore($data);
    }

    public function returnedItemToStore(Request $request){

        $data['id']         = $request->id;
        $data['item_id']    = $request->item_id;
        $data['shelf_no']   = $request->shelf_no;
        $data['column_no']  = $request->column_no;
        $data['zone_no']    = $request->zone_no;
        $data['carton_no']  = $request->carton_no;

        $goods  = new RequestedGoods();
        $goods->returnedItemToStore($data);
    }

}
