<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reports extends Model
{
    public function requestedItemsReports(){
        $data = DB::table('request_goods')
            ->join('projects','request_goods.project_id','projects.id')
            ->join('category_items','request_goods.item_id','=','category_items.id')
            ->join('categories','request_goods.category_id','=','categories.id')
            ->join('users','request_goods.user_id','=','users.id')
            ->select(
                'request_goods.id as requested_goods_id',
                'request_goods.*',
                'categories.*',
                'category_items.*',
                'users.name',
                'projects.*'
            )
            ->orderBy('request_goods.id','desc')
            ->get();
        return $data;
    }

    public function requestedToolsReports(){
        $data = DB::table('tools_request_goods')
            ->join('tools_category_items','tools_request_goods.item_id','=','tools_category_items.id')
            ->join('tools_categories','tools_request_goods.category_id','=','tools_categories.id')
            ->join('users','tools_request_goods.requested_user_id','=','users.id')
            ->select(
                'tools_request_goods.id as requested_goods_id',
                'tools_request_goods.*',
                'tools_categories.*',
                'tools_category_items.*',
                'tools_category_items.id as tool_item_id',
                'users.name'
            )
            ->where('returned',0)
            ->where('is_taken',1)
            ->where('tool_condition','!=',2)
            ->where('store_approval',1)
            ->orderBy('tools_request_goods.id','desc')
            ->get();

        return $data;
    }

    public function projectRecivingItemsReports($id){
       $data =  DB::table('project_reciving_form')
           ->join('projects_receiving_materials_2','projects_receiving_materials_2.form_id','=','project_reciving_form.id')
            ->join('category_items','projects_receiving_materials_2.item_id','=','category_items.id')
            ->join('categories','category_items.category_id','=','categories.id')
           ->where('projects_receiving_materials_2.form_id',$id)
           ->select(
               'project_reciving_form.*',
               'category_items.*',
               'categories.title',
               'projects_receiving_materials_2.required_qty as total_quantity',
               'projects_receiving_materials_2.location',
               'category_items.quantity_unit'
           )
            ->get();
       return $data;
    }

    public function showProjectToolsFormItems($id){
       $data =  DB::table('projects_receiving_tools')
           ->join('project_reciving_tools_form','projects_receiving_tools.form_id','=','project_reciving_tools_form.id')
            ->join('tools_categories','projects_receiving_tools.category_id','=','tools_categories.id')
           ->where('projects_receiving_tools.form_id',$id)
           ->select(
               'projects_receiving_tools.*',
               'tools_categories.title'
           )
            ->get();

       return $data;
    }

    public function projectReceivingToolsFrom(){
       $data =  DB::table('project_reciving_tools_form')
           ->where('project_id',Session('project_id'))
           ->get();
       return $data;
    }

    public function recivingItemsReports($id){
       $data =  DB::table('form_items')
           ->join('reciving_goods','form_items.form_id','=','reciving_goods.id')
            ->join('category_items','form_items.item_id','=','category_items.id')
            ->join('categories','category_items.category_id','=','categories.id')
           ->where('form_items.form_id',$id)
           ->select(
               'reciving_goods.*',
               'category_items.*',
               'categories.title',
               'form_items.quantity as total_quantity',
               'category_items.quantity_unit'
           )
            ->get();
       return $data;
    }

    public function getInventoryList($search){
        $q= DB::table('category_items');
            $q->join('categories','category_items.category_id','=','categories.id');
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
            $q->orderBy('categories.id');
            $q->select(
                'category_items.*',
                'category_items.id as category_id',
                'category_items.description as item_description',
                'categories.*',
                'category_items.quantity as total_avalible_quantity'
            );
            $data= $q->get();
        return $data;
    }

    public function getToolInventoryList($search){
        $q= DB::table('tools_category_items');
        $q->join('tools_categories','tools_category_items.category_id','=','tools_categories.id');
        if($search['category'] > 0){
            $q->where('tools_categories.id',$search['category']);
        }
        if(trim($search['search']) != ''){
            $q->Where(function($query )use ($search){
                $query->where('tools_category_items.description', 'like', '%' . $search['search'] . '%');
                $query->orWhere('tools_category_items.model_no', 'like', '%' . $search['search'] . '%');
                $query->orWhere('tools_category_items.brand_name', 'like', '%' . $search['search'] . '%');
                $query->orWhere('tools_categories.title', 'like', '%' . $search['search'] . '%');
                });
            }
            $q->orderBy('tools_categories.id');
            $q->select(
                'tools_category_items.*',
                'tools_category_items.id as category_id',
                'tools_category_items.description as item_description',
                'tools_categories.*'
            );
            $data= $q->get();
        return $data;
    }

    public function recivingItems(){
        $data = DB::table('reciving_goods')
            ->get();
        return $data;
    }

    public function projectReceivingItems($project_id){
        $data = DB::table('project_reciving_form')
            ->where('project_id',$project_id)
            ->get();
        return $data;
    }

    public function excelRecivingItemsReports(){
        $data = DB::table('reciving_goods')
            ->get();
        foreach($data as $k => $val){
            $data[$k]->items =  DB::table('form_items')
                ->join('reciving_goods','form_items.form_id','=','reciving_goods.id')
                ->join('category_items','form_items.item_id','=','category_items.id')
                ->join('categories','category_items.category_id','=','categories.id')
                ->where('form_items.form_id',$val->id)
                ->select(
                    'category_items.*',
                    'categories.title',
                    'form_items.quantity as total_quantity'
                )
                ->orderBy('reciving_goods.id','desc')
                ->get();
        }
        return $data;
    }
}
