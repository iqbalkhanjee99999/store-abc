<?php

namespace App\Http\Controllers;

use App\Category;
use App\RecivingGoods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecivingGoodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function recivingGoods(){

        $category = new Category();
        $categories = $category->getAllCategories();

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101){
            return view('goods.recivingGoods')->with('categories',$categories);
        }
        else{
            return redirect('/home');
        }
    }

    public function getCategoryItems(Request $request,$id){
        $category = new Category();
        $data = $category->getCategoryItems($id);
        die(json_encode($data));
    }

    public function getRecivingCategoryItems(Request $request,$id){

        $avalible_items = $request->avalible_items;

        $category = new Category();
        $data = $category->getRecivingCategoryItems($id,$avalible_items);
        die(json_encode($data));
    }

    public function getRequestedCategoryItems(Request $request,$id){

        $avalible_items = $request->avalible_items;
        $category = new Category();
        $data = $category->getRequestedCategoryItems($id,$avalible_items);

        die(json_encode($data));
    }

    public function getToolsCategoryItems($id,Request $request){

        $avalible_items = $request->avalible_items;
        $category = new Category();
        $data = $category->toolsSearchCategoryItems($id,$avalible_items);

        die(json_encode($data));
    }

    public function getItemDetails(Request $request){

        $item_id = $request->item_id;

        $category   = new Category();
        $categories = $category->getAllCategories();
        $data       = $category->getItemData($item_id);

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101){
            return view('goods.recivingGoods')->with('categories',$categories)->with('data',$data);
        }
        else
        {
            return redirect('/home');
        }
    }
    public function getItembyCat(Request $request){

        $item_id    = $request->id;
        $category   = new Category();
        $data       = $category->getItemData($item_id);
        die(json_encode($data));
    }

    public function addRecivingGoodsData(Request $request){

        $data['categories']         = $request->categories;
        $data['items']              = $request->items;
        $data['zone']               = $request->zone;
        $data['quantity']           = $request->quantity;
        $data['column']             = $request->column;
        $data['carton']             = $request->carton;
        $data['shelf']              = $request->shelf;
        $data2['reciving_from']     = $request->reciving_from;
        $data2['project_name']      = $request->project_name;
        $data2['date']              = date('Y-m-d');

        $goods      = new RecivingGoods();
        $form_id    = $goods->addRecivingGoods($data2);
        $data['form_id'] = $form_id;
        $goods->updateItemData($data);

        return redirect()->back();
    }
}
