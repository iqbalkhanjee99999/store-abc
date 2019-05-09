<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll(){

        $category  = new Category();
        $data = $category->getAllCategories();

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2){

            return view('categories.showAll')->with('data',$data);
        }
        else{
            return redirect('/home');
        }
    }

    public function addNew($id = 0)
    {
        if (Auth::user()->user_type == 1001 || Auth::user()->user_type == 101){
            if ($id != 0) {
                $category = new Category();
                $data = $category->getCategoryDetails($id);

                return view('categories.addNew')->with('data', $data);
            } else {
                return view('categories.addNew');
            }
        }else{
            return redirect('/home');
        }
    }

    public function saveCategory(Request $request){

        $request->validate([
           'title'          => 'required|max:255',
        ]);

        $data['title']          = $request->title;
        $data['description']    = $request->description;

        $category = new Category();
        if(isset($request->item_id)){
            $data['item_id'] = $request->item_id;
            $category->updateCategory($data);
        }
        else{
            $category->addCategory($data);
        }
        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101) {
            return redirect('categories/showAll');
        }else{
            return redirect('/home');
        }
    }

    public function categoryItems($id){

        $category       = new Category();
        $categoryInfo   = $category->getCategoryData($id);
        $data           = $category->getCategoryItems($id);

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2) {
            return view('categories/categoryItems')->with('category',$categoryInfo)->with('data',$data);
        }else{
            return redirect('/home');
        }
    }

    public function newItem(Request $request){
        $category       = new Category();
        $categoryInfo   = $category->getCategoryData($request->id);

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101) {
            if(isset($request->item_id)){
                $data    = $category->getItemData($request->item_id);
                return view('categories.newItem')->with('category',$categoryInfo)->with('data',$data);
            }
            else{
                return view('categories.newItem')->with('category',$categoryInfo);
            }
        }else{
            return redirect('/home');
        }

    }

    public function addCategoryItem(Request $request){

        $request->validate([
            'description'   => 'required|max:255',
            'brand_name'    => 'required|max:255',
            'item_unit'     => 'required',
        ]);
        $data['description']    = $request->description;
        $data['model_no']       = $request->model_no;
        $data['brand_name']     = $request->brand_name;
        $data['zone_no']        = $request->zone_no;
        $data['column_no']      = $request->column_no;
        $data['shelf_no']       = $request->shelf_no;
        $data['carton_no']      = $request->carton_no;
        $data['category_id']    = $request->category_id;
        $data['item_unit']      = $request->item_unit;

        if ($request->hasFile('photo')) {
            $fileNameWithExtension  = $request->file('photo')->getClientOriginalName();
            $fileName               = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $fileExtension          = $request->file('photo')->getClientOriginalExtension();

            if ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png' || $fileExtension == 'pdf' ||$fileExtension == 'JPG' || $fileExtension == 'JPEG' || $fileExtension == 'PNG' || $fileExtension == 'PDF') {
                $fileNameToStore    = $fileName . '_' . time() . '.' . $fileExtension;

                $path   =   base_path() . '/attachments/items_images/';
                if(!is_dir ( $path))
                    $path   =   base_path() . '/attachments/items_images/';

                $request->file('photo')->move($path,$fileNameToStore);
                $data['photo'] = $fileNameToStore;
            } else {
                return redirect('categories/items/newItem/'.$data['category_id'])->with('error','Incorrect file formate');
            }
        } else {
            if(isset($request->photoUpdate)){
                $data['photo'] = $request->photoUpdate;
            }else{
                $data['photo'] = 'no_image.png';
            }
        }

        $category = new Category();
        if(isset($request->item_id)){
            $data['item_id'] = $request->item_id;
            $category->updateCategoryItem($data);
        }
        else{
            $category->addCategoryItem($data);
        }
        return redirect('/categories/categoryItems/'.$data['category_id']);
    }

    public function deleteCategory($id){

        $category = new Category();
        $check = $category->checkCategory($id);

        if($check > 0){
            return redirect()->back()->with('error',"Can't Delete Category. Items Inside!");
        }else{
            $category->deleteCategory($id);
            return redirect()->back()->with('success',"Category Deleted Successfully");
        }

    }

    public function deleteItem($id){

        $category = new Category();
        $check = $category->checkItem($id);

        if($check > 0){
            return redirect()->back()->with('error',"Can't Delete Item. Item In Reciving Goods");
        }else{
            $category->deleteItem($id);
            return redirect()->back()->with('success',"Item Deleted Successfully");
        }
    }

    public function deleteToolItem($id){

        $category = new Category();
        $check = $category->checkTool($id);

        if($check > 0){
            return redirect()->back()->with('error',"Can't Delete Tool.");
        }else{
            $category->deleteTool($id);
            return redirect()->back()->with('success',"Tool Deleted Successfully");
        }
    }

    public function tools(){

        $category = new Category();
        $data = $category->getToolsCategories();

        return view('categories.tools')->with('data',$data);
    }

    public function addNewTool($id = 0){

        if ($id != 0) {
            $category = new Category();
            $data = $category->getToolsCategoryDetails($id);

            return view('categories.addNew')->with('data', $data)->with('tool', 1);
        }
        return view('categories.addNew')->with('tool', 1);
    }

    public function saveToolCategory(Request $request){

        $request->validate([
            'title'    => 'required|max:255',
        ]);

        $data['title']          = $request->title;
        $data['description']    = $request->description;

        $category = new Category();
        if(isset($request->item_id)){
            $data['item_id'] = $request->item_id;
            $category->updateToolCategory($data);
        }
        else {
            $category->addToolsCategory($data);
        }

        return redirect('categories/tools');
    }

    public function toolsCategoryItems($id){

        $category = new Category();
        $categoryInfo = $category->getToolsCategoryData($id);
        $data = $category->toolsCategoryItems($id);

        return view('categories/toolsCategoryItems')->with('category',$categoryInfo)->with('data',$data);
    }

    public function addToolItem(Request $request){

        $category = new Category();
        $categoryInfo = $category->getToolsCategoryData($request->id);
        $items_count = $category->getCategoryItemsCount($request->id);

        if($items_count < 10){
            $items_count = '00'.($items_count+1);
        }elseif($items_count > 9 &&$items_count < 100){
            $items_count = '0'.($items_count+1);
        }
        $asset_no = strtoupper(substr($categoryInfo->title,0,2)).$items_count;

            if(isset($request->item_id)){
                $data    = $category->getToolsItemData($request->item_id);
                return view('categories.newItem')->with('category',$categoryInfo)->with('data',$data)->with('tool',1)->with('asset_no',$asset_no);
            }
            else{
                return view('categories.newItem')->with('category',$categoryInfo)->with('tool',1)->with('asset_no',$asset_no);
            }
    }

    public function addToolCategoryItem(Request $request){

        $request->validate([
            'description'   => 'required|max:255',
            'model_no'      => 'required|max:255',
            'brand_name'    => 'required|max:255',
            'zone_no'       => 'required',
            'column_no'     => 'required',
            'shelf_no'      => 'required',
            'carton_no'     => 'required',
        ]);
        $data['description']    = $request->description;
        $data['model_no']       = $request->model_no;
        $data['brand_name']     = $request->brand_name;
        $data['zone_no']        = $request->zone_no;
        $data['column_no']      = $request->column_no;
        $data['shelf_no']       = $request->shelf_no;
        $data['carton_no']      = $request->carton_no;
        $data['category_id']    = $request->category_id;

        if ($request->hasFile('photo')) {
            $fileNameWithExtension  = $request->file('photo')->getClientOriginalName();
            $fileName               = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $fileExtension          = $request->file('photo')->getClientOriginalExtension();

            if ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png' || $fileExtension == 'pdf' ||$fileExtension == 'JPG' || $fileExtension == 'JPEG' || $fileExtension == 'PNG' || $fileExtension == 'PDF') {
                $fileNameToStore    = $fileName . '_' . time() . '.' . $fileExtension;

                $path   =   base_path() . '/attachments/items_images/';
                if(!is_dir ( $path))
                    $path   =   base_path() . '/attachments/items_images/';

                $request->file('photo')->move($path,$fileNameToStore);
                $data['photo'] = $fileNameToStore;
            } else {
                return redirect('categories/items/newItem/'.$data['category_id'])->with('error','Incorrect file formate');
            }
        } else {
            if(isset($request->photoUpdate)){
                $data['photo'] = $request->photoUpdate;
            }else{
                $data['photo'] = 'no_image.png';
            }
        }

        $category = new Category();
        if(isset($request->item_id)){
            $data['item_id'] = $request->item_id;
            $category->updateToolCategoryItem($data);
        }
        else{
            $category->addToolCategoryItem($data);
        }
        return redirect('/categories/toolsCategoryItems/'.$data['category_id']);

    }

    public function deleteToolCategory($id){

        $category = new Category();
        $check = $category->checkToolCategory($id);

        if($check > 0){
            return redirect()->back()->with('error',"Can't Delete Category. Items Inside!");
        }else{
            $category->deleteToolCategory($id);
            return redirect()->back()->with('success',"Category Deleted Successfully");
        }

    }
}
