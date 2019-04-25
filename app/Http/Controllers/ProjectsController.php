<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\Project;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use App\RequestedGoods;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allProjects(){

        $project    = new Project();
        $data       = $project->getAllProjects();

        return view('projects/allProjects')
            ->with('data',$data);
    }

    public function addProject(){

        $user           = new User();
        $engineers      = $user->getAllEngineers();
        $storeKeepers   = $user->getAllStoreKeepers();

        return view('projects/addProject')
            ->with('engineers',$engineers)
            ->with('storeKeepers',$storeKeepers);
    }

    public function saveProject(Request $request){

        $request->validate([
            'project_name' => 'required|unique:projects|max:255',
        ]);

        $data['projectName']    = $request->project_name;
        $data['engineer_id']    = $request->engineers;
        $data['storekeeper_id'] = $request->storeKeepers;

        $project = new Project();
        $project->addNewProject($data);

        return redirect()->back()->with('success','Project Added!');
    }

    public function deleteProject($id){

        $project = new Project();
        $data = $project->deleteProject($id);

        if($data == 0){
            return redirect()->back()->with('error',"Can't Delete Project! Items In Project");
        }else{
            return redirect()->back()->with('success','Project Deleted Successfully!');
        }
    }

    public function editProject($id){

        $project    = new Project();
        $data       = $project->getProjectDetails($id);

        return view('projects/editProject')->with('data',$data);
    }

    public function updateProject(Request $request){
        $data['id']             = $request->project_id;
        $data['project_name']   = $request->project_name;

        $project = new Project();
        $project->updateProject($data);

        return redirect(asset('/projects/allProjects'));
    }

    public function projectUsers($id){

        $project = new Project();

        $data           = $project->getProjectUsers($id);
        $projectData    = $project->getProjectDetails($id);

        $user = new User();

        $engineers      = $user->getAllEngineers();
        $storeKeepers   = $user->getAllStoreKeepers();

        return view('projects/projectUsers')
            ->with('data',$data)
            ->with('projectData',$projectData)
            ->with('engineers',$engineers)
            ->with('storeKeepers',$storeKeepers);
    }

    public function upadateProjectUsers(Request $request){

        $data['project_id']     = $request->project_id;
        $data['engineers']      = $request->engineers;
        $data['storeKeepers']   = $request->storeKeepers;

        $project = new Project();
        $project->updateProjectUsers($data);

        return redirect(asset('projects/allProjects'));
    }

    public function projectReceivingMaterials(){

        $category = new Category();
        $categories = $category->getAllCategories();

        return view('projects/projectReceivingMaterials')->with('categories',$categories);
    }

    public function projectReceivingTools(){
        return view('projects/projectReceivingTools');
    }

    public function projectAddRecivingMaterialsData(Request $request){

        if ($request->hasFile('file')) {
            $fileNameWithExtension  = $request->file('file')->getClientOriginalName();
            $fileName               = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $fileExtension          = strtolower($request->file('file')->getClientOriginalExtension());

            if ($fileExtension == 'pdf' || $fileExtension == 'docx' || $fileExtension == 'xlsx' || $fileExtension == 'xls') {
                $fileNameToStore    = $fileName . '_' . time() . '.' . $fileExtension;

                $path   =   base_path() . '/attachments/files/';
                if(!is_dir ( $path))
                    $path   =   base_path() . '/attachments/files/';

                $request->file('file')->move($path,$fileNameToStore);
                $data['file'] = $fileNameToStore;
            } else {
                return redirect()->back()->with('error','incorrect file format');
            }
        }

        $current_date_time = Carbon::now()->toDateTimeString();

        $data['project_id']     = $request->project_id;
        $data['categories']     = $request->categories;
        $data['items']          = $request->items;
        $data['requested_qty']  = $request->quantity;
        $data['location']       = $request->location;
        $data['reciving_from']  = $request->reciving_from;
        $data['created_at']  = $current_date_time;
        $data['updated_at']  = $current_date_time;

        $project = new Project();
        $project->ProjectAddRecivingMaterialsData($data);

        return redirect(asset('projects/projectReceivingMaterials'))->with('success','Request Successull');
    }

    public function requestProjectMaterials($id){

        $category   = new Category();
        $categories = $category->getProjectCategories($id);

        return view('projects/requestProjectMaterials')->with('categories',$categories);
    }

    public function getRequestedCategoryItems(Request $request,$id){

        $avalible_items = $request->avalible_items;

        $category   = new Category();
        $data       = $category->getRequestedCategoryItems($id,$avalible_items);

        die(json_encode($data));
    }

    public function getRequestedProjectCategoryItems(Request $request,$id){

        $avalible_items = $request->avalible_items;
        $category       = new Category();
        $data           = $category->getRequestedProjectCategoryItems($id,$avalible_items);

        die(json_encode($data));
    }

    public function getItemDetails($id){

        $project_id = Session::get('project_id');
        $project    = new Project();
        $data       = $project->getItemData($id,$project_id);

        die(json_encode($data));
    }

    public function addProjectMaterialRequest(Request $request){

        $id                         = Session::get('project_id');
        $data['requested_qty']      = $request->requested_qty;
        $data['project_id']         = Session::get('project_id');
        $data['items']              = $request->items;
        $data['issued_to']          = $request->issued_to;
        $project_name = Session::get('project_name');

        $requestedGoods = new RequestedGoods();
        $user_id        = $requestedGoods->getStoreKeeper($id);

        $requestedGoods->addRequestedProjectMaterials($data);

        $noti['title']          = "Material Request: $project_name";
        $noti['description']    = 'Engineer Requested Materials. Please Take Required Action';
        $noti['link']           = 'projects/pendingMaterialRequests';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = Session::get('project_id');


        $notification = new Notifications();
        $notification->storeKeeperNotification($noti);

        return redirect()->back()->with('success','Request Added. Please Wait For Approval');
    }

    public function pendingMaterialRequests($id = 0){

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }
        $id = Session::get('project_id');

        $project    = new Project();
        $data       = $project->getPendingMaterialRequests($id);

        return view('projects/pendingMaterialRequests')->with('data',$data);
    }

    public function storeKeeperApprove($id){

        $project_id = Session::get('project_id');

        $project    = new Project();
        $project_id = $project->approveProjectMaterialStoreKeeper($id,$project_id);

        $goods      = new RequestedGoods();
        $user_id    = $goods->getRequestedStoreUserId($id);

        $noti['title']          = 'Request Approved';
        $noti['description']    = 'Project Store Material Request Approved';
        $noti['link']           = 'projects/engineerStoreOrders';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $project_id;

        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

        return redirect()->back();
    }

    public function storeKeeperReject($id){

        $project    = new Project();
        $project_id = $project->rejectProjectMaterialStoreKeeper($id);

        $goods      = new RequestedGoods();
        $user_id    = $goods->getRequestedStoreUserId($id);

        $noti['title']          = 'Request Rejected';
        $noti['description']    = 'Project Store Request Rejectd';
        $noti['link']           = 'projects/engineerStoreOrders';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $project_id;

        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

        return redirect()->back();
    }

    public function engineerStoreOrders($id = 0){

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }

        $goods  = new RequestedGoods();
        $data   = $goods->myStoreOrders();

        return view('projects.engineerStoreOrders')->with('data',$data);
    }

    public function markItemAsRecievedFromStore($id){

        $project = new Project();
        $project->markItemAsRecievedFromStore($id);
        die('xx');
    }

    public function markStoreItemAsIdle($id){

        $project    = new Project();
        $data       = $project->markStoreItemAsIdle($id);
        die($data);
    }
    public function markStoreItemAsFunctional($id){

        $project    = new Project();
        $data       = $project->markStoreItemAsFunctional($id);
        die($data);
    }
    public function returnItemToMainStore(Request $request){

        $id     = $request->id;
        $reason = $request->reason;
        $project    = new Project();
        $project_id       = $project->returnItemToMainStore($id,$reason);

        $requestedGoods = new RequestedGoods();
        $user_id        = $requestedGoods->getStoreKeeperId($project_id);

        $noti['title']          = 'Items Return Requested';
        $noti['description']    = 'Items Return Requested For '. Session::get('project_name');
        $noti['link']           = '/storeReturnedItems';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $project_id;

        $notification = new Notifications();
        $notification->storeKeeperNotification($noti);

    }

    public function idleItems(){
        $project    = new Project();
        $data       = $project->getIdleItems();

        return view('projects.idleItems')->with('data',$data);
    }

    public function requestIdleItems(Request $request){
        $data['id']         = $request->id;
        $data['quantity']   = $request->quantity;
        $id                 = $request->project_id;

        $project = new Project();
        $project->requestIdleItems($data);

        $requestedGoods = new RequestedGoods();
        $user_id        = $requestedGoods->getStoreKeeperId($id);

        $noti['title']          = 'Idle Items Requested';
        $noti['description']    = 'Items Requested For '. Session::get('project_name');
        $noti['link']           = 'projects/idleItemsRequests';
        $noti['user_id']        = $user_id;
        $noti['project_id']     = $id;

        $notification = new Notifications();
        $notification->storeKeeperNotification($noti);

    }

    public function idleItemsRequests($id = 0){

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }
        $project    = new Project();
        $data       =  $project->idleItemsRequests();

        return view('projects.idleItemsRequests')->with('data',$data);
    }

    public function approveRequestIdleItems(Request $request){
        $data['id']         = $request->id;
        $data['quantity']   = $request->quantity;
        $data['row_id']     = $request->row_id;

        $project    = new Project();
        $data2      = $project->approveIdleItemsRequest($data);

        $noti['title']          = 'Request Approved ';
        $noti['description']    = 'Idle Items Request Approved By Store Keeper';
        $noti['link']           = 'projects/myIdleItemsRequest';
        $noti['user_id']        = $data2->requested_user_id;
        $noti['project_id']     = $data2->requested_project_id;

        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

    }

    public function myIdleItemsRequest($id = 0){

        if($id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($id);
        }

        $project    = new Project();
        $data       = $project->myIdleItemsRequest();

        return view('projects.myIdleItemsRequests')->with('data',$data);
    }

    public function idleItemsRecevied(Request $request){
        $data['item_id']    = $request->item_id;
        $data['quantity']   = $request->quantity;
        $data['row_id']     = $request->row_id;

        $project = new Project();
        $project->idleItemsRecevied($data);
    }

    public function rejectIdleItemsRequest(Request $request){

        $row_id     = $request->row_id;

        $project    = new Project();
        $data       = $project->rejectIdleItemsRequest($row_id);

        $noti['title']          = 'Request Rejected ';
        $noti['description']    = 'Idle Items Request Rejected By Store Keeper';
        $noti['link']           = 'projects/myIdleItemsRequest';
        $noti['user_id']        = $data->requested_user_id;
        $noti['project_id']     = $data->requested_project_id;

        $notification = new Notifications();
        $notification->engineerSendNotification($noti);
    }

    public function storeApproveReturnedItems(Request $request){
        $data['row_id'] = $request->row_id;
        $data['project_id'] = $request->project_id;
        $data['item_id'] = $request->item_id;

        $project = new Project();
        $project->storeApproveReturnedItems($data);

        $noti['title']          = 'Items Returned';
        $noti['description']    = 'Items Returned To Store . Please Take Further Actions';
        $noti['link']           = '/returnedItems';

        $notification = new Notifications();
        $notification->storeManagerSendNotification($noti);

    }

    public function storeRejectReturnedItems(Request $request){
        $data['row_id'] = $request->row_id;
        $data['project_id'] = $request->project_id;
        $data['item_id'] = $request->item_id;

        $project = new Project();
        $project_data = $project->storeRejectReturnedItems($data);

        $noti['title']          = 'Request Rejected';
        $noti['description']    = 'Items Returned Request Rejected By StoreKeeper';
        $noti['link']           = '/reports/projectInventoryList/'.$project_data->project_id;
        $noti['user_id']        = $project_data->engineer_id;
        $noti['project_id']     = $project_data->project_id;

        $notification = new Notifications();
        $notification->engineerSendNotification($noti);

    }
}
