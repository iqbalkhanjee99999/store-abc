<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RequestedGoods extends Model
{
    public function addRequestedGoods($data){

        foreach($data['items'] as $k => $val){
            $category =  DB::table('category_items')
                ->where('id',$data['items'][$k])
                ->select('category_id','description')
                ->first();

            DB::table('request_goods')
                ->insert([
                    'category_id'   => $category->category_id,
                    'item_id'       => $data['items'][$k],
                    'user_id'       => Auth::user()->id,
                    'requested_qty' => $data['requested_qty'][$k],
                    'project_id'    => $data['project_id'],
                    'date'          => date('Y-m-d'),
                    'location'      => $data['location'][$k]
                ]);

            DB::table('category_items')
                ->where('id',$data['items'][$k])
                ->decrement('quantity',$data['requested_qty'][$k]);
        }
    }

    public function addRequestedProjectMaterials($data){
        $current_date_time = Carbon::now()->toDateTimeString();

        foreach($data['items'] as $k => $val){
            $category =  DB::table('category_items')
                ->where('id',$data['items'][$k])
                ->select('category_id','description')
                ->first();

            DB::table('project_request_materials')
                ->insert([
                    'category_id'   => $category->category_id,
                    'item_id'       => $data['items'][$k],
                    'user_id'       => Auth::user()->id,
                    'requested_qty' => $data['requested_qty'][$k],
                    'project_id'    => $data['project_id'],
                    'date'          => date('Y-m-d'),
                    'issued_to'     => $data['issued_to'][$k],
                ]);

            DB::table('project_items')
                ->where('project_id',$data['project_id'])
                ->where('item_id',$data['items'][$k])
                ->decrement('quantity',$data['requested_qty'][$k]);

        }

    }

    public function addToolsRequestedGoods($data){
        foreach($data['items'] as $k => $val){
            $category =  DB::table('tools_category_items')
                ->where('id',$data['items'][$k])
                ->select('category_id','description')
                ->first();

            DB::table('tools_request_goods')
                ->insert([
                    'category_id'       => $category->category_id,
                    'item_id'           => $data['items'][$k],
                    'requested_user_id' => Auth::user()->id,
                    'project_id'      => Session('project_id'),
                    'date'              => date('Y-m-d'),
                    'tools_user'        => $data['tools_user'][$k],
                    'location'        => $data['location'][$k],
                ]);
            DB::table('tools_category_items')
                ->where('id',$data['items'][$k])
                ->update([
                    'is_taken' => 2,
                ]);
        }

    }

    public function getPendingRequests(){
        $data = DB::table('request_goods')
            ->join('projects','request_goods.project_id','projects.id')
            ->join('category_items','request_goods.item_id','=','category_items.id')
            ->join('categories','request_goods.category_id','=','categories.id')
            ->join('users','request_goods.user_id','=','users.id')
            ->where('request_goods.proc_approval',0)
            ->orWhere('request_goods.store_approval',0)
            ->select(
                'request_goods.id as requested_goods_id',
                'request_goods.*',
                'categories.*',
                'category_items.*',
                'users.name',
                'projects.*'
            )
            ->get();
        return $data;
    }

    public function getPendingToolsRequests(){
        $data = DB::table('tools_request_goods')
            ->join('tools_category_items','tools_request_goods.item_id','=','tools_category_items.id')
            ->join('tools_categories','tools_request_goods.category_id','=','tools_categories.id')
            ->join('users','tools_request_goods.requested_user_id','=','users.id')
            ->join('projects','tools_request_goods.project_id','=','projects.id')
            ->where('tools_request_goods.store_approval',0)
            ->select(
                'tools_request_goods.id as requested_goods_id',
                'tools_request_goods.*',
                'tools_categories.*',
                'tools_category_items.*',
                'projects.project_name',
                'users.name'
            )
            ->get();
        return $data;
    }

    public function procurementApprove($id){
        DB::table('request_goods')
            ->where('id',$id)
            ->update([
                'proc_approval'   => 1,
            ]);
    }

    public function procurementReject($id){
        DB::table('request_goods')
            ->where('id',$id)
            ->update([
                'proc_approval'   => 2,
            ]);

        $data= DB::table('request_goods')
            ->where('id',$id)
            ->select(
                'project_id')
            ->first();
        return $data->project_id;
    }

    public function storeManagerApprove($id){
        DB::table('request_goods')
            ->where('id',$id)
            ->update([
                'store_approval'   => 1,
            ]);
        $data = DB::table('request_goods')
            ->select(
                'project_id'
            )
            ->where('id',$id)
            ->first();
        return $data->project_id;
    }

    public function storeToolsApprove($id){
        $data = DB::table('tools_request_goods')
            ->where('id',$id)
            ->select('item_id')
            ->first();
        $item = $data->item_id;

        DB::table('tools_request_goods')
            ->where('id',$id)
            ->update([
                'store_approval'   => 1,
            ]);

        DB::table('tools_category_items')
            ->where('id',$item)
            ->update([
                'is_taken'   => 1,
            ]);
    }

    public function storeToolReject($id){
        DB::table('tools_request_goods')
            ->where('id',$id)
            ->update([
                'store_approval'   => 2,
            ]);
        $data = DB::table('tools_request_goods')
            ->where('id',$id)
            ->select('item_id','project_id')
            ->first();
        $item = $data->item_id;
        $project_id = $data->project_id;

        DB::table('tools_category_items')
            ->where('id',$item)
            ->update([
                'is_taken'   => 0,
            ]);

        return $project_id;

    }

    public function storeManagerReject($id){
        DB::table('request_goods')
            ->where('id',$id)
            ->update([
                'store_approval'   => 2,
            ]);

       $data =  DB::table('request_goods')
            ->where('id',$id)
            ->select(
                'project_id'
            )->first();
        return $data->project_id;
    }

    public function myOrders(){
        $data = DB::table('request_goods')
            ->join('category_items','request_goods.item_id','=','category_items.id')
            ->join('categories','request_goods.category_id','=','categories.id')
            ->join('users','request_goods.user_id','=','users.id')
            ->where('user_id',Auth::user()->id)
            ->where('project_id',Session::get('project_id'))
            ->select(
                'request_goods.id as requested_goods_id',
                'request_goods.*',
                'request_goods.*',
                'categories.*',
                'category_items.*',
                'users.name'
            )
            ->get();

        return $data;
    }

    public function projectReceivedMaterials(){
        $data = DB::table('request_goods')
            ->join('category_items','request_goods.item_id','=','category_items.id')
            ->join('categories','request_goods.category_id','=','categories.id')
            ->join('users','request_goods.user_id','=','users.id')
            ->where('project_id',Session::get('project_id'))
            ->where('order_recieved',1)
            ->select(
                'request_goods.id as requested_goods_id',
                'request_goods.*',
                'categories.*',
                'category_items.*',
                'users.name'
            )
            ->get();

        return $data;
    }

    public function projectReceivedToolsReport(){
        $data = DB::table('tools_request_goods')
            ->join('tools_category_items','tools_request_goods.item_id','=','tools_category_items.id')
            ->join('tools_categories','tools_request_goods.category_id','=','tools_categories.id')
            ->join('users','tools_request_goods.requested_user_id','=','users.id')
            ->where('project_id',Session::get('project_id'))
            ->where('order_recieved',1)
            ->select(
                'tools_request_goods.id as tools_request_goods_id',
                'tools_request_goods.*',
                'tools_categories.*',
                'tools_category_items.*',
                'users.name'
            )
            ->get();

        return $data;
    }

    public function RecivedMaterialsFromSubStore(){
        $data = DB::table('project_idle_items_request')
            ->join('category_items','project_idle_items_request.item_id','=','category_items.id')
            ->join('categories','project_idle_items_request.category_id','=','categories.id')
            ->join('users','project_idle_items_request.requested_user_id','=','users.id')
            ->join('projects','project_idle_items_request.requested_project_id','=','projects.id')
            ->where('is_recevied',1)
            ->where('requested_project_id',Session('project_id'))
            ->select(
                'project_idle_items_request.id as idle_items_request_id',
                'project_idle_items_request.quantity as requested_qty',
                'project_idle_items_request.*',
                'categories.*',
                'category_items.*',
                'projects.project_name',
                'users.name'
            )
            ->get();

        return $data;
    }
    public function projectReturnedMaterials(){
        $data = DB::table('returned_items')
            ->join('projects','returned_items.project_id','projects.id')
            ->join('category_items','returned_items.item_id','category_items.id')
            ->join('categories','category_items.category_id','categories.id')
            ->select(
                'categories.title as category_name',
                'category_items.description as item_name',
                'category_items.brand_name',
                'category_items.model_no',
                'returned_items.quantity',
                'returned_items.date',
                'returned_items.engineer_name',
                'returned_items.reason',
                'returned_items.item_id',
                'returned_items.project_id',
                'projects.project_name',
                'returned_items.id'
            )
            ->where('project_id',Session('project_id'))
            ->where('store_approve',1)
            ->get();

//        echo "<pre>";
//        print_r($data);die();
        return $data;

    }

    public function myStoreOrders(){
        $data = DB::table('project_request_materials')
            ->join('category_items','project_request_materials.item_id','=','category_items.id')
            ->join('categories','project_request_materials.category_id','=','categories.id')
            ->join('users','project_request_materials.user_id','=','users.id')
            ->where('user_id',Auth::user()->id)
            ->where('project_id',Session::get('project_id'))
            ->select(
                'project_request_materials.id as requested_goods_id',
                'project_request_materials.*',
                'categories.*',
                'category_items.*',
                'users.name'
            )
            ->get();
        return $data;
    }

    public function materialsIssuedToEngineers(){
        $data = DB::table('project_request_materials')
            ->join('category_items','project_request_materials.item_id','=','category_items.id')
            ->join('categories','project_request_materials.category_id','=','categories.id')
            ->join('users','project_request_materials.user_id','=','users.id')
            ->where('project_id',Session::get('project_id'))
            ->where('store_approval',1)
            ->select(
                'project_request_materials.id as requested_goods_id',
                'project_request_materials.*',
                'categories.*',
                'category_items.*',
                'users.name'
            )
            ->get();
        return $data;
    }

    public function materialsIssuedToSubStores(){
        $data = DB::table('project_idle_items_request')
            ->join('category_items','project_idle_items_request.item_id','=','category_items.id')
            ->join('categories','project_idle_items_request.category_id','=','categories.id')
            ->join('users','project_idle_items_request.requested_user_id','=','users.id')
            ->join('projects','project_idle_items_request.requested_project_id','=','projects.id')
            ->where('storekeeper_approve',1)
            ->where('project_id',Session('project_id'))
            ->select(
                'project_idle_items_request.id as idle_items_request_id',
                'project_idle_items_request.quantity as requested_qty',
                'project_idle_items_request.*',
                'categories.*',
                'category_items.*',
                'projects.project_name',
                'users.name'
            )
            ->get();
        return $data;
    }

    public function myToolsOrders(){
        $data = DB::table('tools_request_goods')
            ->join('tools_category_items','tools_request_goods.item_id','=','tools_category_items.id')
            ->join('tools_categories','tools_request_goods.category_id','=','tools_categories.id')
            ->join('users','tools_request_goods.requested_user_id','=','users.id')
            ->where('tools_request_goods.project_id',Session('project_id'))
            ->select(
                'tools_request_goods.id as requested_goods_id',
                'tools_request_goods.*',
                'tools_categories.*',
                'tools_category_items.*',
                'users.name'
            )
            ->get();
        return $data;
    }

    public function totalRequested(){
        $data = DB::table('request_goods')
            ->where('store_approval',0)
            ->where('proc_approval','!=',2)
            ->sum('requested_qty');
        return $data;
    }

    public function getRequestedUserId($id){
        $data = DB::table('request_goods')
            ->where('id',$id)
            ->select('user_id')
            ->first();
        return $data->user_id;
    }

    public function getRequestedStoreUserId($id){
        $data = DB::table('project_request_materials')
            ->where('id',$id)
            ->select('user_id')
            ->first();
        return $data->user_id;
    }
    public function getStoreKeeper($id){
        $data = DB::table('project_users')
            ->where('project_id',$id)
            ->where('engineer_id',Auth::user()->id)
            ->select('storekeeper_id')
            ->first();
        return $data->storekeeper_id;
    }

    public function getStoreKeeperId($id){
        $data = DB::table('project_users')
            ->where('project_id',$id)
            ->select('storekeeper_id')
            ->first();
        return $data->storekeeper_id;
    }

    public function getToolsRequestedUserId($id){
        $data = DB::table('tools_request_goods')
            ->where('id',$id)
            ->select('requested_user_id','project_id')
            ->first();
        return $data;
    }

    public function updateQuantity($id){
        $data = DB::table('request_goods')
            ->where('id',$id)
            ->select('requested_qty','item_id')
            ->first();

        $quantity =  $data->requested_qty;
        $item_id =  $data->item_id;

        DB::table('category_items')
            ->where('id',$item_id)
            ->increment('quantity',$quantity);
    }

    public function marToolAsGood($id,$requested_goods_id){
        DB::table('tools_category_items')
            ->where('id',$id)
            ->update([
                'is_taken'        => 0,
                'tool_condition'  => 0,
            ]);

        DB::table('tools_request_goods')
            ->where('id',$requested_goods_id)
            ->update([
                'returned'   => 1,
            ]);
    }

    public function marToolAsNeedRepair($id){
        DB::table('tools_category_items')
            ->where('id',$id)
            ->update([
                'is_taken'       => 1,
                'tool_condition' => 1,
            ]);
    }

    public function marToolAsDemaged($id){
        DB::table('tools_category_items')
            ->where('id',$id)
            ->update([
                'is_taken'        => 1,
                'tool_condition'  => 2,
            ]);
    }

    public function markToolAsRecieved($id){
        DB::table('tools_request_goods')
            ->where('id',$id)
            ->update([
                'order_recieved' => 1,
            ]);

        $data = DB::table('tools_request_goods')
            ->where('id',$id)
            ->first();

        DB::table('project_tools')
            ->insert([
                'project_id'            =>  Session('project_id'),
                'category_id'           =>  $data->category_id,
                'location'              =>  $data->location,
                'item_id'               =>  $data->item_id,
                'quantity'              =>  1,
                'is_idle'               =>  0,
                'under_store_approval'  =>  0,
                'created_at'            =>   Carbon::now()->toDateTimeString(),
                'updated_at'            =>   Carbon::now()->toDateTimeString(),
            ]);

    }

    public function markMaterialAsRecieved($id){
        DB::table('request_goods')
        ->where('id',$id)
            ->update([
                'order_recieved'   => 1,
            ]);

        $q2 = DB::table('request_goods')
            ->where('id',$id)
            ->first();

        $current_date_time = Carbon::now()->toDateTimeString();

        $data['category_id']    = $q2->category_id;
        $data['form_id']        = 0;
        $data['item_id']        = $q2->item_id;
        $data['requested_qty']  = $q2->requested_qty;
        $data['location']       = $q2->location;

        $q = DB::table('project_items')
            ->where('project_id', Session::get('project_id'))
            ->where('item_id', $data['item_id'])
            ->first();

        if($q){
            $row_id = $q->id;
            DB::table('project_items')
                ->where('id', $row_id)
                ->increment('quantity' , $data['requested_qty']);
            DB::table('project_items')
                ->where('id',$row_id)
                ->increment('quantity_2' , $data['requested_qty']);
            DB::table('project_items')
                ->where('id',$row_id)
                ->update(['location' => $data['location'],'updated_at' => $current_date_time]);
        }else{
            DB::table('project_items')
                ->insert([
                    'project_id'    => Session::get('project_id'),
                    'category_id'   => $data['category_id'],
                    'item_id'       => $data['item_id'],
                    'quantity'      => $data['requested_qty'],
                    'quantity_2'    => $data['requested_qty'],
                    'location'      => $data['location'],
                    'created_at'    =>$current_date_time,
                    'updated_at'    =>$current_date_time,
                ]);
        }

        DB::table('projects_receiving_materials_2')
            ->insert([
                'form_id'       => 0,
                'project_id'    => Session::get('project_id'),
                'category_id'   => $data['category_id'],
                'item_id'       => $data['item_id'],
                'required_qty'  => $data['requested_qty'],
            ]);
    }

    public function rejectMaterialOrder($id){

        DB::table('request_goods')
            ->where('id',$id)
            ->update([
                'order_recieved'   => 2,
            ]);

        $data = DB::table('request_goods')
            ->join('projects','request_goods.project_id','=','projects.id')
            ->select(
                'project_name'
            )
            ->where('request_goods.id',$id)
            ->first();
        return $data->project_name;
    }

    public function getAllReturnedGoods(){
        $data = DB::table('returned_items')
            ->join('projects','returned_items.project_id','projects.id')
            ->join('category_items','returned_items.item_id','category_items.id')
            ->join('categories','category_items.category_id','categories.id')
            ->select(
                'categories.title as category_name',
                'category_items.description as item_name',
                'category_items.zone_no',
                'category_items.carton_no',
                'category_items.column_no',
                'category_items.shelf_no',
                'category_items.brand_name',
                'returned_items.quantity',
                'returned_items.engineer_name',
                'returned_items.reason',
                'returned_items.item_id',
                'returned_items.project_id',
                'projects.project_name',
                'returned_items.id'
            )
            ->where('returned_items.is_returned',0)
            ->where('returned_items.store_approve',1)
            ->get();
        return $data;
    }


    public function getAllReturnedTools(){
        $data = DB::table('returned_tools')
            ->join('projects','returned_tools.project_id','projects.id')
            ->join('tools_category_items','returned_tools.item_id','tools_category_items.id')
            ->join('tools_categories','tools_category_items.category_id','tools_categories.id')
            ->select(
                'tools_categories.title as category_name',
                'tools_category_items.description as item_name',
                'tools_category_items.zone_no',
                'tools_category_items.carton_no',
                'tools_category_items.column_no',
                'tools_category_items.shelf_no',
                'tools_category_items.brand_name',
                'tools_category_items.model_no',
                'returned_tools.engineer_name',
                'returned_tools.reason',
                'returned_tools.item_id',
                'returned_tools.project_id',
                'projects.project_name',
                'returned_tools.id'
            )
            ->where('returned_tools.is_returned',0)
            ->where('returned_tools.store_approve',1)
            ->get();

        return $data;
    }

    public function getStoreReturnedItems(){
        $data = DB::table('returned_items')
            ->join('projects','returned_items.project_id','projects.id')
            ->join('category_items','returned_items.item_id','category_items.id')
            ->join('categories','category_items.category_id','categories.id')
            ->select(
                'categories.title as category_name',
                'category_items.description as item_name',
                'category_items.brand_name',
                'returned_items.quantity',
                'returned_items.reason',
                'returned_items.project_id',
                'returned_items.engineer_name',
                'returned_items.item_id',
                'projects.project_name',
                'returned_items.id'
            )
            ->where('returned_items.is_returned',0)
            ->where('returned_items.store_approve',0)
            ->get();
        return $data;
    }

    public function storeReturnedTools(){
        $data = DB::table('returned_tools')
            ->join('projects','returned_tools.project_id','projects.id')
            ->join('tools_category_items','returned_tools.item_id','=','tools_category_items.id')
            ->join('tools_categories','tools_category_items.category_id','=','tools_categories.id')
            ->select(
                'tools_categories.title as category_name',
                'tools_category_items.description as item_name',
                'tools_category_items.brand_name',
                'tools_category_items.model_no',
                'returned_tools.reason',
                'returned_tools.project_id',
                'returned_tools.engineer_name',
                'returned_tools.item_id',
                'projects.project_name',
                'returned_tools.id'
            )
            ->where('returned_tools.is_returned',0)
            ->where('returned_tools.store_approve',0)
            ->get();

        return $data;
    }

    public function returnedToStore($data){
        DB::table('returned_items')
            ->where('id',$data['id'])
            ->update([
                'is_returned' => 1
            ]);

            DB::table('category_items')
                ->where('id',$data['item_id'])
                ->increment('quantity',$data['quantity']);

        DB::table('category_items')
            ->where('id',$data['item_id'])
            ->update([
                    'column_no'         => $data['column_no'],
                    'zone_no'           => $data['zone_no'],
                    'shelf_no'          => $data['shelf_no'],
                    'carton_no'         => $data['carton_no'],
                ]);
    }

    public function returnedItemToStore($data){
        DB::table('returned_tools')
            ->where('id',$data['id'])
            ->update([
                'is_returned' => 1
            ]);
        DB::table('tools_category_items')
            ->where('id',$data['item_id'])
            ->update([
                    'column_no'         => $data['column_no'],
                    'zone_no'           => $data['zone_no'],
                    'shelf_no'          => $data['shelf_no'],
                    'carton_no'         => $data['carton_no'],
                    'is_taken'          => 0,
                    'project_recived'   => 0,
                ]);
    }
}
