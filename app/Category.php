<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Category extends Model
{
    public function getAllCategories(){
        $data = DB::table('categories')
            ->select('id','title','description')
            ->orderBy('id','desc')
            ->get();
        return $data;
    }
    public function getAllToolsCategories(){
        $data = DB::table('tools_categories')
            ->select('id','title','description')
            ->orderBy('id','desc')
            ->get();
        return $data;
    }

    public function getProjectToolsCategories(){
        $data = DB::table('tools_request_goods')
            ->join('tools_categories','tools_request_goods.category_id','=','tools_categories.id')
            ->where('project_id',Session('project_id'))
            ->groupBy('tools_request_goods.category_id')
            ->select('tools_categories.title','tools_categories.id')
            ->get();
        return $data;
    }

    public function getProjectCategories($id){
        $data = DB::table('project_items')
            ->join('categories','project_items.category_id','=','categories.id')
            ->where('project_id',$id)
           ->groupBy('project_items.category_id')
            ->select('categories.title','categories.id')
            ->get();

        return $data;
    }

    public function getLastFiveCategories(){
        $data = DB::table('categories')
            ->select('id','title','description')
            ->orderBy('id','desc')
            ->limit(5)
            ->get();
        return $data;
    }

    public function addCategory($data){
        DB::table('categories')
            ->insert([
                'title' => $data['title'],
                'description' => $data['description']
            ]);
    }

    public function updateCategory($data){
        DB::table('categories')
            ->where('id',$data['item_id'])
            ->update([
                'title' => $data['title'],
                'description' => $data['description']
            ]);
    }

    public function updateToolCategory($data){
        DB::table('tools_categories')
            ->where('id',$data['item_id'])
            ->update([
                'title' => $data['title'],
                'description' => $data['description']
            ]);
    }

    public function getCategoryDetails($id){
        $data = DB::table('categories')
            ->where('id',$id)
            ->select('id','title','description')
            ->first();
        return $data;
    }

    public function getToolsCategoryDetails($id){
        $data = DB::table('tools_categories')
            ->where('id',$id)
            ->select('id','title','description')
            ->first();
        return $data;
    }

    public function getCategoryData($id){
        $data = DB::table('categories')
            ->select('id','title')
            ->where('id',$id)
            ->first();
        return $data;
    }

    public function getCategoryItemsCount($id){
        $data = DB::table('tools_category_items')
            ->select(DB::raw('count(id) as total'))
            ->where('category_id',$id)
            ->first();
        return $data->total;
    }

    public function getToolsCategoryData($id){
        $data = DB::table('tools_categories')
            ->select('id','title')
            ->where('id',$id)
            ->first();
        return $data;
    }

    public function getCategoryItems($id){
        $data = DB::table('category_items')
            ->where('category_id',$id)
            ->orderBy('id','desc')
            ->get();
        return $data;
    }

    public function getRecivingCategoryItems($id,$avalible_items){
        $data = DB::table('category_items')
            ->where('category_id',$id)
            ->whereNotIn('id', $avalible_items)
            ->orderBy('id','desc')
            ->get();
        return $data;
    }

    public function getRequestedCategoryItems($id,$avalible_items){
        $data = DB::table('category_items')
            ->where('category_id',$id)
            ->whereNotIn('id', $avalible_items)
            ->orderBy('id','desc')
            ->get();
        return $data;
    }
    public function getRequestedProjectCategoryItems($id,$avalible_items){
        $data = DB::table('project_items')
            ->join('category_items','project_items.item_id','=','category_items.id')
            ->where('project_items.category_id',$id)
            ->where('project_items.is_idle',0)
            ->where('project_items.project_id',Session('project_id'))
            ->whereNotIn('project_items.item_id', $avalible_items)
            ->select('project_items.item_id','category_items.description','category_items.brand_name')
            ->groupBy('project_items.item_id')
            ->orderBy('category_items.id','desc')
            ->get();

        return $data;
    }

    public function toolsCategoryItems($id){
        $data = DB::table('tools_category_items')
            ->where('category_id',$id)
            ->where('project_recived',0)
            ->orderBy('id','desc')
            ->get();
        return $data;
    }

    public function toolsSearchCategoryItems($id,$avalible_items){
        $data = DB::table('tools_category_items')
            ->where('category_id',$id)
            ->where('is_taken',0)
            ->where('tool_condition',0)
            ->whereNotIn('id', $avalible_items)
            ->orderBy('id','desc')
            ->get();
        return $data;
    }

    public function toolsSearchProjectCategoryItems($id,$avalible_items){
        $data = DB::table('tools_request_goods')
            ->join('tools_category_items','tools_request_goods.item_id','tools_category_items.id')
            ->where('tools_request_goods.project_id',Session('project_id'))
            ->where('tools_category_items.category_id',$id)
            ->where('tools_category_items.tool_condition',0)
            ->where('tools_request_goods.order_recieved',1)
            ->whereNotIn('tools_category_items.id', $avalible_items)
            ->orderBy('tools_category_items.id','desc')
            ->get();


        return $data;
    }

    public function getLastSevenItems(){
        $data = DB::table('category_items')
            ->orderBy('id','desc')
            ->limit(7)
            ->get();
        return $data;
    }

    public function addCategoryItem($data){
        DB::table('category_items')
            ->insert([
                'category_id'   => $data['category_id'],
                'description'   => $data['description'],
                'model_no'      => $data['model_no'],
                'brand_name'    => $data['brand_name'],
                'photo'         => $data['photo'],
                'zone_no'       => $data['zone_no'],
                'column_no'     => $data['column_no'],
                'shelf_no'      => $data['shelf_no'],
                'carton_no'     => $data['carton_no'],
                'quantity_unit'     => $data['item_unit'],
            ]);
    }

    public function addToolCategoryItem($data){

        DB::table('tools_category_items')
            ->insert([
                'category_id'   => $data['category_id'],
                'description'   => $data['description'],
                'model_no'      => $data['model_no'],
                'brand_name'    => $data['brand_name'],
                'photo'         => $data['photo'],
                'zone_no'       => $data['zone_no'],
                'column_no'     => $data['column_no'],
                'shelf_no'      => $data['shelf_no'],
                'carton_no'     => $data['carton_no'],
            ]);
    }

    public function updateCategoryItem($data){

        DB::table('category_items')
            ->where('id',$data['item_id'])
            ->update([
                'category_id'   => $data['category_id'],
                'description'   => $data['description'],
                'model_no'      => $data['model_no'],
                'brand_name'    => $data['brand_name'],
                'photo'         => $data['photo'],
                'zone_no'       => $data['zone_no'],
                'shelf_no'      => $data['shelf_no'],
                'carton_no'     => $data['carton_no'],
                'column_no'     => $data['column_no'],
                'quantity_unit' => $data['item_unit'],
            ]);
    }

    public function updateToolCategoryItem($data){
        DB::table('tools_category_items')
            ->where('id',$data['item_id'])
            ->update([
                'category_id'   => $data['category_id'],
                'description'   => $data['description'],
                'model_no'      => $data['model_no'],
                'brand_name'    => $data['brand_name'],
                'photo'         => $data['photo'],
                'zone_no'       => $data['zone_no'],
                'column_no'     => $data['column_no'],
                'shelf_no'      => $data['shelf_no'],
                'carton_no'     => $data['carton_no'],
            ]);
    }

    public function getItemCategory($id){
        $data =  DB::table('category_items')
            ->where('id',$id)
            ->select('category_id','description')
            ->first();
        return $data;
    }

    public function checkCategory($id){
        $data =  DB::table('category_items')
            ->where('category_id',$id)
            ->count();
        return $data;
    }

    public function checkToolCategory($id){
        $data =  DB::table('tools_category_items')
            ->where('category_id',$id)
            ->count();
        return $data;
    }

    public function checkItem($id){
        $data =  DB::table('form_items')
            ->where('item_id',$id)
            ->count();
        return $data;
    }

    public function checkTool($id){
        $data = DB::table('tools_category_items')
        ->join('tools_categories','tools_category_items.category_id','=','tools_categories.id')
        ->where('tools_category_items.id',$id)
        ->first();

        $is_taken = $data->is_taken;
        $condition = $data->tool_condition;

        $chek = 0;

        if($is_taken ==0 && $condition == 0)
            $chek = 0;
        elseif($is_taken ==2 && $condition == 0)
            $chek = 1;
        elseif($is_taken == 1 && $condition == 0)
            $chek = 1;
        elseif($is_taken == 1 &&  $condition == 1)
            $chek = 1;
        elseif($is_taken == 1 &&  $condition == 2)
            $chek = 0;

        return $chek;
    }

    public function deleteCategory($id){
        DB::table('categories')
            ->where('id',$id)
            ->delete();
    }

    public function deleteToolCategory($id){
        DB::table('tools_categories')
            ->where('id',$id)
            ->delete();
    }

    public function getItemData($item_id){
       $data =  DB::table('category_items')
            ->where('id',$item_id)
            ->first();
        return $data;
    }


    public function getToolsItemData($item_id){
        $data =  DB::table('tools_category_items')
            ->where('id',$item_id)
            ->first();
        return $data;
    }

    public function getAllItemsCount(){
        $data =  DB::table('category_items')->count();
        return $data;
    }

    public function deleteItem($id){

        DB::table('category_items')
            ->where('id',$id)
            ->delete();
    }

    public function deleteTool($id){

        DB::table('tools_category_items')
            ->where('id',$id)
            ->delete();
    }

    public function getToolsCategories(){
        $data =  DB::table('tools_categories')
            ->orderBy('id','desc')
            ->get();
        return $data;
    }

    public function addToolsCategory($data){
        DB::table('tools_categories')
            ->insert([
                'title' => $data['title'],
                'description' => $data['description']
            ]);
    }
}
