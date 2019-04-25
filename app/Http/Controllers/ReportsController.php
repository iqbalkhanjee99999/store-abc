<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\Reports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category;
use Excel;
use App\Project;
use Illuminate\Support\Facades\Session;
class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function requestedItemsReports(){

        $reports    = new Reports();
        $data       = $reports->requestedItemsReports();

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2){
            return view('reports.requestedItemsReports')->with('data',$data);
        }
        else{
            return redirect('/home');
        }
    }

    public function requestedToolsReports(){

        $reports    = new Reports();
        $data       = $reports->requestedToolsReports();

        return view('reports.requestedToolsReports')->with('data',$data);
    }

    public function recivingItems(){

        $reports    = new Reports();
        $data       = $reports->recivingItems();

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2){
            return view('reports.recivingItems')->with('data',$data);
        }
        else{
            return redirect('/home');
        }
    }

    public function recivingItemsReports($id){

        $reports = new Reports();
        $data = $reports->recivingItemsReports($id);

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2){
            return view('reports.recivingItemsReports')->with('data',$data);
        }
        else{
            return redirect('/home');
        }
    }

    public function inventoryList(Request $request){

        $search = array();
        $search['category']      = $request->category;
        $search['search']        = $request->search;

        $category   = new Category();
        $categories = $category->getAllCategories();

        $reports    = new Reports();
        $data       = $reports->getInventoryList($search);

        return view('reports.inventoryList')->with('data',$data)->with('categories',$categories);
    }

    public function exportToExcel(Request $request){

        $search = array();
        $search['category']    = $request->category;
        $search['search']      = $request->search;

        $reports = new Reports();
        $data    = $reports->getInventoryList($search);

        if(count($data) < 1){
            return 0;
        }
        $reports_array[] = array('ID','Category','Item','Brand','Model No','Quantity');

        foreach ($data as $count => $val){
            if($val->total_avalible_quantity == 0){
                $val->total_avalible_quantity = '0';
            }
            $reports_array[] = array(

                'ID'            => $val->category_id,
                'Category'      => $val->title,
                'Item'          => $val->item_description,
                'Brand'         => $val->brand_name,
                'Model No'      => $val->model_no,
                'Quantity'      => $val->total_avalible_quantity,
            );
        }
        $myFile =  Excel::create('Reports Data',function($excel) use ($reports_array){
            $excel->setTitle('Invoice Data');
            $excel->sheet('Invoice Data',function ($sheet) use ($reports_array){

                $sheet->fromArray($reports_array ,null,'A1',false,false);
                $sheet->cells("A1:F1", function($cells) {
                    $cells->setFontWeight('bold');
                });

            });
        });
        $myFile = $myFile->string('xlsx');
        $response =  array(
            'name' => "Material Inventory List (".date('Y-m-d').")",
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
        );
        return response()->json($response);
    }

    public function exportToExcelRequested(Request $request){


        $reports = new Reports();
        $data    = $reports->requestedItemsReports();

        if(count($data) < 1){
            return 0;
        }
        $reports_array[] = array('ID','Description','User Name','Project Name','Model No','Brand Name','Requested Quantity','Date','Status');

        foreach ($data as $count => $val){
            if($val->proc_approval == 0)
                $status = 'Waiting For Procurement Approval';
            else if($val->proc_approval == 1 && $val->store_approval== 0)
                $status = 'Waiting For Store Manager Approval';
            else if($val->proc_approval == 2 || $val->store_approval== 2)
                $status = 'Order Rejected';
            else if($val->proc_approval == 2 && $val->store_approval == 2 && $val->order_recieved == 0)
                $status = 'Order Approved';
            else
                $status = 'Recived By Site';

            $reports_array[] = array(

                'ID'                    => $val->requested_goods_id,
                'Description'           => $val->description,
                'User Name'             => $val->name,
                'Project Name'          => $val->project_name,
                'Model No'              => $val->model_no,
                'Brand Name'            => $val->brand_name,
                'Requested Quantity'    => $val->requested_qty,
                'Date'                  => $val->date,
                'Status'                => $status,
            );
        }
        $myFile =  Excel::create('Reports Data',function($excel) use ($reports_array){
            $excel->setTitle('Invoice Data');
            $excel->sheet('Invoice Data',function ($sheet) use ($reports_array){
                $sheet->fromArray($reports_array ,null,'A1',false,false);
                $sheet->cells("A1:I1", function($cells) {
                    $cells->setFontWeight('bold');
                });
            });
        });
        $myFile     = $myFile->string('xlsx');
        $response   =  array(
            'name' => "Requested Items List (".date('Y-m-d').")",
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
        );
        return response()->json($response);
    }

    public function exportToExcelRecieved(Request $request){
        $stack = array();

        $reports = new Reports();
        $data    = $reports->excelRecivingItemsReports();

        if(count($data) < 1){
            return 0;
        }
        $i = 1;
        $j = 1;
        foreach($data as $k => $val){
            $reports_array[] = array($val->id,$val->project_name,$val->reciving_from,$val->date);
            $reports_array[] = array('ID','Category','Item','Model No','Brand Name','Quantity');
            array_push($stack, $i);
            $i+=3;
            foreach ($data[$k]->items as $count => $val){
                $reports_array[] = array(
                    'ID'            => $val->id,
                    'Category'      => $val->title,
                    'Item'          => $val->description,
                    'Model No'      => $val->model_no,
                    'Brand Name'    => $val->brand_name,
                    'Quantity'      => $val->total_quantity,
                );
                $i++;
            }
            $reports_array[] = array('');
        }
        $myFile =  Excel::create('Reports Data',function($excel) use ($reports_array,$stack){
            $excel->setTitle('Invoice Data');
            $excel->sheet('Invoice Data',function ($sheet) use ($reports_array,$stack){

                $sheet->fromArray($reports_array ,null,'A1',false,false);
                $sheet->cells("A1:F1", function($cells) {
                    $cells->setFontWeight('bold');
                });
                foreach ($stack as $k => $val){
                    $sheet->cells("A".$val.":F".$val, function($cells) {
                        $cells->setFontWeight('bold');
                    });
                }

            });
        });
        $myFile = $myFile->string('xlsx');
        $response =  array(
            'name' => "Receving Items List (".date('Y-m-d').")",
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
        );
        return response()->json($response);
    }

    public function toolsInventoryList(Request $request){

        $search = array();
        $search['category']      = $request->category;
        $search['search']        = $request->search;

        $category = new Category();
        $categories = $category->getAllToolsCategories();

        $reports = new Reports();
        $data = $reports->getToolInventoryList($search);

        return view('reports.toolsInventoryList')->with('data',$data)->with('categories',$categories);
    }

    public function exportToolsToExcel(Request $request){

        $search = array();
        $search['category']    = $request->category;
        $search['search']      = $request->search;

        $reports = new Reports();
        $data        = $reports->getToolInventoryList($search);
        if(count($data) < 1){
            return 0;
        }
        $reports_array[] = array('ID','Category','Item','Brand','Model No','Status');

        foreach ($data as $count => $val){

            if($val->is_taken ==0 && $val->tool_condition == 0)
                $status = 'Avalible';
            elseif($val->is_taken ==2 && $val->tool_condition == 0)
                $status = 'Waiting Approval';
            elseif($val->is_taken == 1 && $val->tool_condition == 0)
                $status = 'Not Avalible';
            elseif($val->is_taken == 1 &&  $val->tool_condition == 1)
                $status = 'Under Maintainance';
            elseif($val->is_taken == 1 &&  $val->tool_condition == 2)
                $status = 'Dameged';

            $reports_array[] = array(

                'ID'            => $val->category_id,
                'Category'      => $val->title,
                'Item'          => $val->item_description,
                'Brand'         => $val->brand_name,
                'Model No'      => $val->model_no,
                'Status'        => $status,
            );
        }
        $myFile =  Excel::create('Reports Data',function($excel) use ($reports_array){
            $excel->setTitle('Invoice Data');
            $excel->sheet('Invoice Data',function ($sheet) use ($reports_array){

                $sheet->fromArray($reports_array ,null,'A1',false,false);
                $sheet->cells("A1:F1", function($cells) {
                    $cells->setFontWeight('bold');
                });

            });
        });
        $myFile = $myFile->string('xlsx');
        $response =  array(
            'name' => "Tools Inventory List (".date('Y-m-d').")",
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
        );
        return response()->json($response);
    }


    public function projectInventoryList(Request $request ,$noti_id = 0){

        if($noti_id > 0){
            $noti = new Notifications();
            $noti->changeStatusToRead($noti_id);
        }
        $search = array();
        $search['category']      = $request->category;
        $search['search']        = $request->search;
        $search['id']            = $request->id;
        $project_id              = Session::get('project_id');

        $category = new Category();
        $categories = $category->getProjectCategories($project_id);

        $project = new Project();
        $data = $project->projectInventoryList($search,$project_id);

        return view('reports/projectInventoryList')->with('data',$data)->with('categories',$categories);
    }

    public function allProjectsInventory(Request $request){

        $project_id = $request->project_id;

        $project = new Project();
        $projects = $project->getAllProjects();
        $data = $project->allProjectsInventory($project_id);

        return view('reports/allProjectsInventory')->with('data',$data)->with('projects',$projects);
    }

    public function exportProjectMaterialsToExcel(Request $request){

        $search = array();
        $search['category']    = $request->category;
        $search['search']      = $request->search;
        $search['id']          = Session::get('project_id');
        $project_id            = Session::get('project_id');

        $project = new Project();
        $data    = $project->projectInventoryList($search,$project_id);

        if(count($data) < 1){
            return 0;
        }
        $reports_array[] = array('ID','Category','Item','Brand','Model No','Quantity');

        foreach ($data as $count => $val){
            if($val->total_qty == 0){
                $val->total_qty = '0';
            }
            $reports_array[] = array(

                'ID'            => $val->category_id,
                'Category'      => $val->category_name,
                'Item'          => $val->item_name,
                'Brand'         => $val->brand_name,
                'Model No'      => $val->model_no,
                'Quantity'      => $val->total_qty,
            );
        }
        $myFile =  Excel::create('Reports Data',function($excel) use ($reports_array){
            $excel->setTitle('Invoice Data');
            $excel->sheet('Invoice Data',function ($sheet) use ($reports_array){

                $sheet->fromArray($reports_array ,null,'A1',false,false);
                $sheet->cells("A1:F1", function($cells) {
                    $cells->setFontWeight('bold');
                });

            });
        });
        $myFile = $myFile->string('xlsx');
        $response =  array(
            'name' => "Material Inventory List (".date('Y-m-d').")",
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
        );
        return response()->json($response);
    }


}
