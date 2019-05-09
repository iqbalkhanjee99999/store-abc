<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Notifications extends Model
{
    public function procSendNotification($noti){
        $notification_id = DB::table('notifications')
            ->insertGetId([
                'title'         => $noti['title'],
                'description'   => $noti['description'],
                'link'          => $noti['link'],
                'created_at'    => date('Y-m-d H:i:s')
            ]);

        DB::table('notification_users')
            ->insert([
                'notification_id'   => $notification_id,
                'user_id'           => 2,
                'is_read'           => 0,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
        DB::table('notification_users')
            ->insert([
                'notification_id'   => $notification_id,
                'user_id'           => 3,
                'is_read'           => 0,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
    }

    public function storeManagerSendNotification($noti){
        $notification_id = DB::table('notifications')
            ->insertGetId([
                'title'         => $noti['title'],
                'description'   => $noti['description'],
                'link'          => $noti['link'],
                'created_at'    => date('Y-m-d H:i:s')
            ]);

        DB::table('notification_users')
            ->insert([
                'notification_id'   => $notification_id,
                'user_id'           => 1,
                'is_read'           => 0,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
        DB::table('notification_users')
            ->insert([
                'notification_id'   => $notification_id,
                'user_id'           => 3,
                'is_read'           => 0,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
    }

    public function storeKeeperNotification($noti){
        $notification_id = DB::table('notifications')
            ->insertGetId([
                'title'         => $noti['title'],
                'description'   => $noti['description'],
                'link'          => $noti['link'],
                'created_at'    => date('Y-m-d H:i:s')
            ]);

        DB::table('notification_users')
            ->insert([
                'notification_id'   => $notification_id,
                'user_id'           => $noti['user_id'],
                'project_id'        => $noti['project_id'],
                'is_read'           => 0,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
    }

    public function engineerSendNotification($noti){

        $notification_id = DB::table('notifications')
            ->insertGetId([
                'title'         => $noti['title'],
                'description'   => $noti['description'],
                'link'          => $noti['link'],
                'created_at'    => date('Y-m-d H:i:s')
            ]);


        DB::table('notification_users')
            ->insert([
                'notification_id'   => $notification_id,
                'user_id'           => $noti['user_id'],
                'project_id'        => $noti['project_id'],
                'is_read'           => 0,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
    }

    public function getUsersNotifications(){

        $q = DB::table('notification_users');
            $q->join('notifications','notification_users.notification_id','=','notifications.id');
            $q->where('notification_users.user_id',Auth::user()->id);
            if(Auth::user()->user_type == 3 || Auth::user()->user_type == 1){
                $q->where('notification_users.project_id',Session::get('project_id'));
            }
            $q->orderBy('notifications.id','desc');
            $q->take(10);
            $data = $q->get();

            return $data;
    }

    public function countUnReadNotifications(){
        $q = DB::table('notification_users');
            $q->where('notification_users.user_id',Auth::user()->id);
             if(Auth::user()->user_type == 3 || Auth::user()->user_type == 1){
                 $q->where('notification_users.project_id',Session::get('project_id'));
             }
            $q->where('is_read',0);
            $q->select(DB::raw('COUNT(id) as unread_notifications'));
            $data = $q->first();

        return $data->unread_notifications;
    }

    public function changeStatusToRead($id){

        DB::table('notification_users')
            ->where('notification_users.notification_id',$id)
            ->update([
                'is_read' => 1
            ]);
    }

    public function getAllNotifications(){
        $data = DB::table('notifications')
            ->join('notification_users','notifications.id','=','notification_users.notification_id')
            ->orderBy('notifications.id','desc')
            ->get();
        return $data;
    }

    public function markAllAsRead(){
        DB::table('notification_users')
           ->where('user_id',Auth::user()->id)
            ->update(['is_read' => 1]);
    }
}
