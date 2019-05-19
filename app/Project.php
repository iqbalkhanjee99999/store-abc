<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Session;

class Project extends Model
{
    public function addNewProject($data){
        $id = DB::table('projects')->insertGetId(
            ['project_name' => $data['projectName']]
        );

        foreach ($data['engineer_id'] as $k => $val) {
            DB::table('project_users')
                ->insert([
                    'project_id'        => $id,
                    'engineer_id'       => $data['engineer_id'][$k],
                    'storekeeper_id'    => $data['storekeeper_id'][$k],
                ]);
        }
    }

    public function deleteProject($id){
        $data = DB::table('project_items')
            ->where('project_id',$id)
            ->where('quantity','!=',0)
            ->get();

      if(count($data) > 0){
          return 0;
      }else{
          DB::table('projects')
              ->where('id',$id)
              ->delete();
          return 1;
      }
    }

    public function getMyProjects(){
        $q =DB::table('projects');
        $q->join('project_users','projects.id','=','project_users.project_id');
            $q->where('project_users.engineer_id',Auth::user()->id);
            $q->orWhere('project_users.storekeeper_id',Auth::user()->id);
        $q->select(
            'project_name',
            'projects.id as project_id'
        );
        $q->groupBy('projects.id');
        $data = $q->get();
        return $data;
    }

    public function getProjectDetails($id){
       $data=  DB::table('projects')
           ->where('projects.id',$id)
            ->first();
       return $data;
    }

    public function getAllProjects(){
        $data = DB::table('projects')
            ->get();
        return $data;
    }

    public function updateProject($data){
        DB::table('projects')
            ->where('id',$data['id'])
            ->update([
                'project_name' => $data['project_name']
            ]);
    }

    public function getProjectUsers($id){
        $data = DB::table('project_users')
            ->join('users as a','project_users.engineer_id','a.id')
            ->join('users as b','project_users.storekeeper_id','b.id')
            ->select('a.name as engineer_name','b.name as storekeeper_name','a.id as engineer_id','b.id as storekeeper_id')
            ->where('project_id',$id)
            ->get();
        return $data;
    }

    public function updateProjectUsers($data){
        DB::table('project_users')
            ->where('project_id',$data['project_id'])
            ->delete();

        foreach ($data['engineers'] as $k => $val) {
            DB::table('project_users')
                ->insert([
                    'project_id'        => $data['project_id'],
                    'engineer_id'       => $data['engineers'][$k],
                    'storekeeper_id'    => $data['storeKeepers'][$k],
                ]);
        }
    }

    public function ProjectAddRecivingMaterialsData($data){

        $id = DB::table('project_reciving_form')
            ->insertGetId([
                'reciving_from' => $data['reciving_from'],
                'project_id'    => $data['project_id'],
                'file'          => $data['file'],
                'date'          => date('Y-m-d')
            ]);

        foreach($data['categories'] as $k => $val){

            $q = DB::table('project_items')
                ->where('project_id', Session::get('project_id'))
                ->where('item_id', $data['items'][$k])
                ->first();

            if($q){
                DB::table('project_items')
                    ->where('id', $q->id)
                    ->increment('quantity' , $data['requested_qty'][$k]);
                DB::table('project_items')
                    ->where('id', $q->id)
                    ->increment('quantity_2' , $data['requested_qty'][$k]);
                DB::table('project_items')
                    ->where('id', $q->id)
                    ->update(['location' => $data['location'][$k],'updated_at' => $data['updated_at']]);
            }else{
                DB::table('project_items')
                    ->insert([
                        'project_id'    => Session::get('project_id'),
                        'category_id'   => $data['categories'][$k],
                        'item_id'       => $data['items'][$k],
                        'quantity'      => $data['requested_qty'][$k],
                        'quantity_2'    => $data['requested_qty'][$k],
                        'location'      => $data['location'][$k],
                        'created_at'    => $data['created_at'],
                        'updated_at'    => $data['updated_at'],
                    ]);
            }

            DB::table('projects_receiving_materials_2')
                ->insert([
                    'form_id'       => $id,
                    'project_id'    => Session::get('project_id'),
                    'category_id'   => $data['categories'][$k],
                    'item_id'       => $data['items'][$k],
                    'required_qty'  => $data['requested_qty'][$k],
                    'location'  => $data['location'][$k],
                ]);
        }
    }

    public function ProjectAddRecivingToolsData($data)
    {

        $id = DB::table('project_reciving_tools_form')
            ->insertGetId([
                'reciving_from' => $data['reciving_from'],
                'project_id' => $data['project_id'],
                'file' => $data['file'],
                'date' => date('Y-m-d')
            ]);

        foreach ($data['model'] as $k => $val) {

            DB::table('projects_receiving_tools')
                ->insert([
                    'form_id' => $id,
                    'project_id' => Session::get('project_id'),
                    'category_id' => $data['categories'][$k],
                    'requested_user_id' => Auth::user()->id,
                    'model' => $data['model'][$k],
                    'description' => $data['description'][$k],
                    'asset_no' => $data['asset_no'][$k],
                    'image' => $data['image'][$k],
                    'location' => $data['location'][$k],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at'],
                ]);

            $item_id = DB::table('tools_category_items')
                ->insertGetId([
                    'category_id'   => $data['categories'][$k],
                    'description'   => $data['description'][$k],
                    'model_no'      => $data['asset_no'][$k],
                    'brand_name'    => $data['model'][$k],
                    'photo'         =>  $data['image'][$k],
                    'is_taken'      =>  1,
                    'project_recived'  =>  1,
                ]);

            DB::table('project_tools')
                ->insert([
                    'project_id'            =>  Session('project_id'),
                    'category_id'           =>  $data['categories'][$k],
                    'location'              =>  $data['location'][$k],
                    'item_id'               =>  $item_id,
                    'quantity'              =>  1,
                    'is_idle'               =>  0,
                    'under_store_approval'  =>  0,
                    'created_at'            =>  $data['created_at'],
                    'updated_at'            =>   $data['updated_at'],
                ]);
        }
    }

    public function projectInventoryList($search,$project_id){
        $q = DB::table('project_items');
            $q->join('category_items','project_items.item_id','category_items.id');
            $q->join('categories','category_items.category_id','categories.id');
            if($search['category'] > 0){
                $q->where('categories.id',$search['category']);
            }
            if(trim($search['search']) != ''){
                $q->Where(function($query )use ($search){
                    $query->where('category_items.description', 'like', '%' . $search['search'] . '%');
                    $query->orWhere('category_items.model_no', 'like', '%' . $search['search'] . '%');
                    $query->orWhere('category_items.brand_name', 'like', '%' . $search['search'] . '%');
                    $query->orWhere('category_items.quantity', 'like', '%' . $search['search'] . '%');
                    $query->orWhere('categories.title', 'like', '%' . $search['search'] . '%');
                });
            }
            $q->select(DB::raw(
                'project_items.quantity_2 as total_qty'),
                'categories.id as category_id',
                'category_items.description as item_name',
                'category_items.brand_name',
                'categories.title as category_name',
                'category_items.model_no',
                'category_items.id as item_id',
                'project_items.id as project_item_id',
                'project_items.is_idle',
                'project_items.project_id',
                'project_items.location',
                'category_items.photo'
            );
            $q->where('project_items.project_id',$project_id);
            $q->where('project_items.under_store_approval','!=',1);
            $q->where('project_items.quantity','>',0);
            $data = $q->get();
        return $data;
    }

     public function projectToolsList(){
         $data = DB::table('project_tools')
             ->join('tools_category_items','project_tools.item_id','=','tools_category_items.id')
             ->join('tools_categories','project_tools.category_id','=','tools_categories.id')
             ->join('projects','project_tools.project_id','=','projects.id')
             ->where('project_tools.project_id',Session('project_id'))
             ->where('project_tools.under_store_approval','!=',1)
             ->where('project_tools.is_recevied',0)
             ->where('project_tools.store_return_approve',0)
             ->select(
                 'project_tools.id as project_tool_id',
                 'project_tools.*',
                 'tools_categories.*',
                 'tools_category_items.*',
                 'projects.project_name'
             )
             ->get();

//         echo "<pre>";
//         print_r(Session('project_id'));die();

         return $data;
    }

    public function allProjectsInventory($project_id = 0){
        $q = DB::table('project_items');
            $q->join('projects','project_items.project_id','projects.id');
            $q->join('category_items','project_items.item_id','category_items.id');
            $q->join('categories','category_items.category_id','categories.id');
            if($project_id > 0){
                $q->where('project_items.project_id',$project_id);
            }
            $q->select(DB::raw(
                'project_items.quantity_2 as total_qty'),
                'projects.project_name',
                'categories.id as category_id',
                'category_items.description as item_name',
                'category_items.brand_name',
                'categories.title as category_name',
                'category_items.model_no',
                'category_items.id as item_id',
                'project_items.id as project_item_id',
                'project_items.is_idle',
                'project_items.project_id',
                'project_items.location',
                'category_items.photo'
            );
            $q->orderBy('project_name');
            $data = $q->get();
        return $data;
    }

    public function getItemData($item_id,$project_id){
        $data = DB::table('project_items')
            ->join('category_items','project_items.item_id','=','category_items.id')
            ->where('project_items.item_id',$item_id)
            ->where('project_items.project_id',$project_id)
            ->select('project_items.quantity as total_qty',
                'project_items.item_id',
                'category_items.description',
                'category_items.brand_name',
                'category_items.quantity_unit',
                'category_items.model_no'
                )
            ->first();
        return $data;
    }

    public function getPendingMaterialRequests($id){
        $data = DB::table('project_request_materials')
            ->join('projects','project_request_materials.project_id','projects.id')
            ->leftJoin('project_items', function($join){
                $join->on('project_items.project_id', '=', 'project_request_materials.project_id');
                $join->on('project_items.item_id', '=', 'project_request_materials.item_id');
            })
            ->join('category_items','project_request_materials.item_id','=','category_items.id')
            ->join('categories','project_request_materials.category_id','=','categories.id')
            ->join('users','project_request_materials.user_id','=','users.id')
            ->where('project_request_materials.store_approval',0)
            ->where('project_request_materials.project_id',$id)
            ->select(
                'project_request_materials.id as requested_goods_id',
                'project_request_materials.requested_qty as requested_qty',
                'project_request_materials.*',
                'categories.*',
                'category_items.*',
                'users.name',
                'project_items.quantity_2',
                'projects.project_name'
            )
            ->get();
        return $data;
    }

    /**
     * @param $id
     * @param $project_id
     * @return mixed
     */
    public function approveProjectMaterialStoreKeeper($id, $project_id){

        $current_date_time = Carbon::now()->toDateTimeString();

        DB::table('project_request_materials')
            ->where('id',$id)
            ->update([
                'store_approval' => 1
            ]);

        $data = DB::table('project_request_materials')
            ->leftJoin('project_items', function($join){
                $join->on('project_items.project_id', '=', 'project_request_materials.project_id');
                $join->on('project_items.item_id', '=', 'project_request_materials.item_id');
            })
            ->where('project_request_materials.id',$id)
            ->first();

        $project_id = $data->project_id;
        $item_id    = $data->item_id;
        $quantity   = $data->requested_qty;

        DB::table('project_items')
            ->where('project_id',$project_id)
            ->where('item_id',$item_id)
            ->decrement('quantity_2',$quantity);

        DB::table('project_items')
            ->where('project_id',$project_id)
            ->where('item_id',$item_id)
            ->update(['updated_at'=> $current_date_time]);

        return $project_id;
    }

    public function rejectProjectMaterialStoreKeeper($id){
        DB::table('project_request_materials')
            ->where('id',$id)
            ->update([
                'store_approval' => 2
            ]);

        $data = DB::table('project_request_materials')
            ->leftJoin('project_items', function($join){
                $join->on('project_items.project_id', '=', 'project_request_materials.project_id');
                $join->on('project_items.item_id', '=', 'project_request_materials.item_id');
            })
            ->where('project_request_materials.id',$id)
            ->first();

        $project_id = $data->project_id;
        $item_id    = $data->item_id;
        $quantity   = $data->requested_qty;

        DB::table('project_items')
            ->where('project_id',$project_id)
            ->where('item_id',$item_id)
            ->increment('quantity',$quantity);

        return $project_id;
    }

    public function markItemAsRecievedFromStore($id){
        DB::table('project_request_materials')
            ->where('id',$id)
            ->update([
                'order_recieved' => 1
            ]);
    }

    public function markStoreItemAsFunctional($id){
        $current_date_time = Carbon::now()->toDateTimeString();
        DB::table('project_items')
            ->where('id',$id)
            ->update([
                'is_idle' => 0,
                'updated_at' => $current_date_time,
            ]);
    }

    public function markStoreToolAsFunctional($id){
        $current_date_time = Carbon::now()->toDateTimeString();
        DB::table('project_tools')
            ->where('id',$id)
            ->update([
                'is_idle' => 0,
                'updated_at' => $current_date_time,
            ]);
    }

    public function markStoreItemAsIdle($id){
        $current_date_time = Carbon::now()->toDateTimeString();
        $data = DB::table('project_items')
                ->where('id',$id)
                ->first();
        if($data->quantity != $data->quantity_2){
            return 'Item Has Pending Request From Engineer';
        }else{
            DB::table('project_items')
                ->where('id',$id)
                ->update([
                    'is_idle' => 1,
                    'updated_at' => $current_date_time,
                ]);
        }
    }

    public function markStoreToolAsIdle($id){
        $current_date_time = Carbon::now()->toDateTimeString();
            DB::table('project_tools')
                ->where('id',$id)
                ->update([
                    'is_idle' => 1,
                    'updated_at' => $current_date_time,
                ]);
    }

    public function returnItemToMainStore($id,$reason){
        $q = DB::table('project_items')
                ->where('id',$id)
                ->first();

        $item_id    = $q->item_id;
        $quantity   = $q->quantity;
        $project_id = $q->project_id;

        if($q->quantity != $q->quantity_2){
            return 'Item Has Pending Request From Engineer';
        }else{
            DB::table('returned_items')
                ->insert([
                    'item_id' => $item_id,
                    'quantity' => $quantity,
                    'project_id' => $project_id,
                    'engineer_id' => Auth::user()->id,
                    'engineer_name' => Auth::user()->name,
                    'reason' =>$reason,
                ]);

            DB::table('project_items')
                ->where('id',$id)
                ->update(['under_store_approval' => 1]);

            return $project_id;
        }
    }


    public function returnToolToMainStore($id,$reason){


        $q = DB::table('project_tools')
                ->where('id',$id)
                ->first();

        $item_id    = $q->item_id;
        $project_id = $q->project_id;

        DB::table('returned_tools')
            ->insert([
                'item_id' => $item_id,
                'project_id' => $project_id,
                'engineer_id' => Auth::user()->id,
                'engineer_name' => Auth::user()->name,
                'reason' =>$reason,
            ]);

        DB::table('project_tools')
            ->where('id',$id)
            ->update(['store_return_approve' => 1]);

        return $project_id;
    }

    public function storeApproveReturnedItems($data){

        DB::table('returned_items')
            ->where('id',$data['row_id'])
            ->update([
                'store_approve' => 1,
                'date' => date('Y-m-d')
            ]);

        DB::table('project_items')
            ->where('project_id',$data['project_id'])
            ->where('item_id',$data['item_id'])
            ->update(['under_store_approval' => 2]);
    }

    public function storeApproveReturnedTools($data){

        DB::table('returned_tools')
            ->where('id',$data['row_id'])
            ->update([
                'store_approve' => 1,
                'date' => date('Y-m-d')
            ]);

        DB::table('project_tools')
            ->where('project_id',$data['project_id'])
            ->where('item_id',$data['item_id'])
            ->update(['under_store_approval' => 2]);
    }

    public function storeRejectReturnedItems($data){

        DB::table('returned_items')
            ->where('id',$data['row_id'])
            ->update([
                'store_approve' => 2,
            ]);

        DB::table('project_items')
            ->where('project_id',$data['project_id'])
            ->where('item_id',$data['item_id'])
            ->update(['under_store_approval' => 0]);

        $data = DB::table('returned_items')
            ->select('project_id','engineer_id')
            ->where('id',$data['row_id'])->first();
        return $data;
    }

    public function storeRejectReturnedTool($data){

        DB::table('returned_tools')
            ->where('id',$data['row_id'])
            ->update([
                'store_approve' => 2,
            ]);

        DB::table('project_tools')
            ->where('project_id',$data['project_id'])
            ->where('item_id',$data['item_id'])
            ->update(['store_return_approve' => 0]);

        $data = DB::table('returned_tools')
            ->select('project_id','engineer_id')
            ->where('id',$data['row_id'])->first();
        return $data;
    }
    public function storeManagerRejectReturnedItems($data){
        DB::table('returned_items')
            ->where('id',$data['row_id'])
            ->update([
                'store_approve' => 3,//store manager reject
            ]);

        DB::table('project_items')
            ->where('project_id',$data['project_id'])
            ->where('item_id',$data['item_id'])
            ->update([
                'under_store_approval' => 0,
            ]);

        $data = DB::table('returned_items')
            ->select('project_id','engineer_id')
            ->where('id',$data['row_id'])->first();
        return $data;
    }

    public function storeManagerRejectReturnedTools($data){
        DB::table('returned_tools')
            ->where('id',$data['row_id'])
            ->update([
                'store_approve' => 3,//store manager reject
            ]);

        DB::table('project_tools')
            ->where('project_id',$data['project_id'])
            ->where('item_id',$data['item_id'])
            ->update([
                'under_store_approval' => 0,
                'store_return_approve' => 0,
            ]);

        $data = DB::table('returned_tools')
            ->select('project_id','engineer_id')
            ->where('id',$data['row_id'])->first();
        return $data;
    }

    public function getIdleItems(){

        $data = DB::table('project_items')
            ->join('category_items','project_items.item_id','=','category_items.id')
            ->join('categories','project_items.category_id','=','categories.id')
            ->join('projects','project_items.project_id','=','projects.id')
            ->select('project_items.quantity as total_qty',
                'project_items.item_id',
                'category_items.description','category_items.brand_name',
                'category_items.model_no',
                'categories.title as category_name',
                'projects.project_name',
                'projects.id as project_id',
                'project_items.id as row_id'
            )
            ->where('is_idle',1)
            ->where('project_items.quantity','>',0)
            ->get();

        return $data;

    }

    public function idleTools(){

        $data = DB::table('project_tools')
            ->join('tools_category_items','project_tools.item_id','=','tools_category_items.id')
            ->join('tools_categories','project_tools.category_id','=','tools_categories.id')
            ->join('projects','project_tools.project_id','=','projects.id')
            ->select(
                'project_tools.item_id',
                'tools_category_items.description',
                'tools_category_items.brand_name',
                'tools_category_items.model_no as asset_no',
                'tools_categories.title as category_name',
                'projects.project_name',
                'projects.id as project_id',
                'project_tools.id as row_id',
                'project_tools.under_store_approval'
            )
            ->where('is_idle',1)
            ->get();

        return $data;

    }

    public function requestIdleItems($data){

        $q = DB::table('project_items')
            ->where('id',$data['id'])
            ->first();

        $item_id        = $q->item_id;
        $category_id    = $q->category_id;
        $project_id     = $q->project_id;
        $quantity       = $data['quantity'];

        $q2 = DB::table('project_users')
            ->select('storekeeper_id')
            ->where('project_id',$project_id)
            ->first();

        $storekeeper_id = $q2->storekeeper_id;

        DB::table('project_idle_items_request')
            ->insert([
                'project_item_id' => $data['id'],
                'project_id' => $project_id,
                'requested_project_id' => Session::get('project_id'),
                'requested_user_id' => Auth::user()->id,
                'category_id' => $category_id,
                'item_id' => $item_id,
                'quantity' => $quantity,
                'storekeeper_id' => $storekeeper_id,
            ]);
    }

    public function requestIdleTools($data){

        DB::table('project_tools')
            ->where('id',$data['id'])
            ->update(['under_store_approval' => 1]);

        $q = DB::table('project_tools')
            ->where('id',$data['id'])
            ->first();

        $item_id        = $q->item_id;
        $category_id    = $q->category_id;
        $project_id     = $q->project_id;

        $q2 = DB::table('project_users')
            ->select('storekeeper_id')
            ->where('project_id',$project_id)
            ->first();

        $storekeeper_id = $q2->storekeeper_id;

        DB::table('project_idle_tools_request')
            ->insert([
                'project_item_id' => $data['id'],
                'project_id' => $project_id,
                'requested_project_id' => Session::get('project_id'),
                'requested_user_id' => Auth::user()->id,
                'category_id' => $category_id,
                'item_id' => $item_id,
                'storekeeper_id' => $storekeeper_id,
                'date' => date('Y-m-d'),
            ]);
    }

    public function idleItemsRequests(){
        $data = DB::table('project_idle_items_request')
            ->join('category_items','project_idle_items_request.item_id','=','category_items.id')
            ->join('categories','project_idle_items_request.category_id','=','categories.id')
            ->join('projects as a','project_idle_items_request.project_id','=','a.id')
            ->join('projects as b','project_idle_items_request.requested_project_id','=','b.id')
             ->leftJoin('project_items', function($join){
                 $join->on('project_items.project_id', '=', 'project_idle_items_request.project_id');
                 $join->on('project_items.item_id', '=', 'project_idle_items_request.item_id');
             })
            ->select('project_idle_items_request.quantity as total_qty',
                'category_items.description','category_items.brand_name',
                'category_items.model_no',
                'categories.title as category_name',
                'b.project_name as requested_project_name',
                'project_idle_items_request.id as row_id',
                'project_idle_items_request.project_item_id',
                'project_items.location'
            )
            ->where('storekeeper_id',Auth::user()->id)
            ->where('project_idle_items_request.project_id',Session::get('project_id'))
            ->where('storekeeper_approve',0)
            ->get();

        return $data;
    }

    public function idleToolsRequests(){
        $data = DB::table('project_idle_tools_request')
            ->join('tools_category_items','project_idle_tools_request.item_id','=','tools_category_items.id')
            ->join('tools_categories','project_idle_tools_request.category_id','=','tools_categories.id')
            ->join('projects as a','project_idle_tools_request.project_id','=','a.id')
            ->join('projects as b','project_idle_tools_request.requested_project_id','=','b.id')
             ->leftJoin('project_items', function($join){
                 $join->on('project_items.project_id', '=', 'project_idle_tools_request.project_id');
                 $join->on('project_items.item_id', '=', 'project_idle_tools_request.item_id');
             })
            ->select(
                'tools_category_items.description','tools_category_items.brand_name',
                'tools_category_items.model_no',
                'tools_categories.title as category_name',
                'b.project_name as requested_project_name',
                'project_idle_tools_request.id as row_id',
                'project_idle_tools_request.project_item_id',
                'project_items.location'
            )
            ->where('storekeeper_id',Auth::user()->id)
            ->where('project_idle_tools_request.project_id',Session::get('project_id'))
            ->where('storekeeper_approve',0)
            ->get();

        return $data;
    }

    public function approveIdleItemsRequest($data){
        DB::table('project_idle_items_request')
            ->where('id',$data['row_id'])
            ->update([
                'storekeeper_approve' => 1,
                'date' => date('Y-m-d')
            ]);

        DB::table('project_items')
            ->where('id',$data['id'])
            ->decrement('quantity',$data['quantity']);

        DB::table('project_items')
            ->where('id',$data['id'])
            ->decrement('quantity_2',$data['quantity']);

       $data =  DB::table('project_idle_items_request')
            ->where('id',$data['row_id'])
            ->select('requested_user_id','requested_project_id')
            ->first();
       return $data;
    }

     public function approveIdleToolsRequest($data){
        DB::table('project_idle_tools_request')
            ->where('id',$data['row_id'])
            ->update([
                'storekeeper_approve' => 1,
                'date' => date('Y-m-d')
            ]);

         DB::table('project_tools')
             ->where('id',$data['id'])
             ->update(['is_recevied' => 1]);


         $data =  DB::table('project_idle_tools_request')
             ->where('id',$data['row_id'])
             ->select('requested_user_id','requested_project_id')
             ->first();
         return $data;

     }

    public function rejectIdleItemsRequest($row_id){
        DB::table('project_idle_items_request')
            ->where('id',$row_id)
            ->update([
                'storekeeper_approve' => 2
            ]);

       $data =  DB::table('project_idle_items_request')
            ->where('id',$row_id)
            ->select('requested_user_id','requested_project_id')
            ->first();
       return $data;
    }

    public function rejectIdleToolRequest($row_id){
        DB::table('project_idle_tools_request')
            ->where('id',$row_id)
            ->update([
                'storekeeper_approve' => 2
            ]);

       $data =  DB::table('project_idle_tools_request')
            ->where('id',$row_id)
            ->select('requested_user_id','requested_project_id','project_id','item_id')
            ->first();

        DB::table('project_tools')
            ->where('project_id',$data->project_id)
            ->where('item_id',$data->item_id)
            ->update([
                'under_store_approval' => 0
            ]);

       return $data;
    }

    public function myIdleItemsRequest(){

        $data = DB::table('project_idle_items_request')
            ->join('category_items','project_idle_items_request.item_id','=','category_items.id')
            ->join('categories','project_idle_items_request.category_id','=','categories.id')
            ->join('projects as a','project_idle_items_request.project_id','=','a.id')
            ->join('projects as b','project_idle_items_request.requested_project_id','=','b.id')
            ->select('project_idle_items_request.quantity as total_qty',
                'category_items.description','category_items.brand_name',
                'category_items.model_no',
                'categories.title as category_name',
                'b.project_name as requested_project_name',
                'project_idle_items_request.id as row_id',
                'project_idle_items_request.storekeeper_approve',
                'project_idle_items_request.item_id',
                'project_idle_items_request.is_recevied',
                'project_idle_items_request.project_item_id'
            )
            ->where('requested_user_id',Auth::user()->id)
            ->where('requested_project_id',Session::get('project_id'))
            ->get();

        return $data;
    }

    public function myIdleToolsRequest(){
        $data = DB::table('project_idle_tools_request')
            ->join('tools_category_items','project_idle_tools_request.item_id','=','tools_category_items.id')
            ->join('tools_categories','project_idle_tools_request.category_id','=','tools_categories.id')
            ->join('projects as a','project_idle_tools_request.project_id','=','a.id')
            ->join('projects as b','project_idle_tools_request.requested_project_id','=','b.id')
            ->select(
                'tools_category_items.description','tools_category_items.brand_name',
                'tools_category_items.model_no',
                'tools_categories.title as category_name',
                'b.project_name as requested_project_name',
                'project_idle_tools_request.id as row_id',
                'project_idle_tools_request.storekeeper_approve',
                'project_idle_tools_request.item_id',
                'project_idle_tools_request.is_recevied',
                'project_idle_tools_request.project_item_id'
            )
            ->where('requested_user_id',Auth::user()->id)
            ->where('requested_project_id',Session::get('project_id'))
            ->get();

        return $data;
    }

    public function idleItemsRecevied($data){
        DB::table('project_idle_items_request')
            ->where('id',$data['row_id'])
            ->update([
                'is_recevied' => 1
            ]);

        $project_id = DB::table('project_idle_items_request')
                ->select('requested_project_id')
                ->where('id',$data['row_id'])
                ->first();

        $q = DB::table('project_items')
            ->where('project_id', $project_id->requested_project_id)
            ->where('item_id', $data['item_id'])
            ->first();

        if($q){
            DB::table('project_items')
                ->where('id', $q->id)
                ->increment('quantity' , $data['quantity']);
            DB::table('project_items')
                ->where('id',$q->id)
                ->increment('quantity_2' , $data['quantity']);
        }else{
            $q2 = DB::table('category_items')
                    ->where('id',$data['item_id'])
                    ->select('category_id')
                    ->first();

            DB::table('project_items')
                ->insert([
                    'project_id'    => Session::get('project_id'),
                    'category_id'   => $q2->category_id,
                    'item_id'       => $data['item_id'],
                    'quantity'      => $data['quantity'],
                    'quantity_2'    => $data['quantity'],
                ]);
        }

    }

    public function idleToolsRecevied($data){

        DB::table('project_idle_tools_request')
            ->where('id',$data['row_id'])
            ->update([
                'is_recevied' => 1
            ]);

        $project_id = DB::table('project_idle_tools_request')
                ->select('project_id')
                ->where('id',$data['row_id'])
                ->first();

        DB::table('project_tools')
            ->where('project_id', $project_id->project_id)
            ->where('item_id', $data['item_id'])
            ->update([
                'project_id' => Session('project_id'),
                'store_return_approve' => 0,
                'under_store_approval' => 0,
                'is_recevied' => 0,
                'is_idle' => 0,
                ]);

    }

    public function getFileName($id){
        $data = DB::table('project_reciving_tools_form')
            ->select('file')
            ->where('id',$id)
            ->first();
        return $data->file;
    }

    public function notifiyUserForIdleITems(){

        $current_date_time = Carbon::now(); //current time
        $new_date = $current_date_time->subMonths(1); //current time with subtraction of one month

        $data = DB::table('project_items') // get all expired items
        ->join('category_items','project_items.item_id','=','category_items.id')
            ->join('projects','project_items.project_id','=','projects.id')
            ->select('project_id','item_id','category_items.description','project_items.id as project_item_id','project_name')
            ->where('project_items.is_idle',0)
            ->where('project_items.updated_at','<',$new_date)
            ->get();

        if(count($data) > 0){
            foreach ($data as $item){ //update expired items to Idle Items
                DB::table('project_items')
                    ->where('id',$item->project_item_id)
                    ->update(['is_idle' => 1]);

                $users_id = DB::table('project_users') // get engineers of the project of which item is expired
                    ->where('project_id',$item->project_id)
                    ->select('engineer_id')
                    ->get();


                if(count($users_id) > 0){
                    foreach($users_id as $user){
                        $notification_id2 = DB::table('notifications') //create notificaiton for Engineers
                            ->insertGetId([
                                'title'         => 'Item: '.$item->description.' Added To Idle List',
                                'description'   => 'Item had more than one month in store without use',
                                'link'          => 'reports/projectInventoryList/'.$item->project_id,
                                'created_at'    => date('Y-m-d H:i:s')
                            ]);

                        DB::table('notification_users') //send notification to engineers
                            ->insert([
                                'notification_id'   => $notification_id2,
                                'user_id'           => $user->engineer_id,
                                'project_id'        => $item->project_id,
                                'is_read'           => 0,
                                'created_at'        => date('Y-m-d H:i:s')
                            ]);
                    }
                }

                $notification_id = DB::table('notifications') //create notification for Admin
                    ->insertGetId([
                        'title'         => $item->project_name .'/'.$item->description.'item Added To Idle List',
                        'description'   => 'Item had more than one month in store without use',
                        'link'          => 'reports/allProjectsInventory',
                        'created_at'    => date('Y-m-d H:i:s')
                    ]);

                DB::table('notification_users') // send notification to admin
                    ->insert([
                        'notification_id'   => $notification_id,
                        'user_id'           => 3,
                        'is_read'           => 0,
                        'created_at'        => date('Y-m-d H:i:s')
                    ]);

            }
        }
    }

}
