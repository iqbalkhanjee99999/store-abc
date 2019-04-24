<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecivingGoods extends Model
{
    public function addRecivingGoods($data){
        $data = DB::table('reciving_goods')
            ->insertGetId([
                'date' => $data['date'],
                'reciving_from' => $data['reciving_from'],
                'project_name' => $data['project_name'],
            ]);
        return $data;
    }

    public function updateItemData($data){
        foreach ($data['items'] as $k => $val){
            DB::table('category_items')
                ->where('id',$data['items'][$k])
                ->increment('quantity',$data['quantity'][$k],
                    [
                        'column_no'         => $data['column'][$k],
                        'zone_no'           => $data['zone'][$k],
                        'shelf_no'          => $data['shelf'][$k],
                        'carton_no'         => $data['carton'][$k],
                        'total_quantity'    => $data['quantity'][$k],
                    ]);

            DB::table('form_items')
                ->insert([
                    'item_id'           => $data['items'][$k],
                    'quantity'          => $data['quantity'][$k],
                    'form_id'           => $data['form_id'],
                ]);
        }
    }

    public function totalReciving(){
        $data = DB::table('category_items')
            ->sum('quantity');
        return $data;
    }
}
