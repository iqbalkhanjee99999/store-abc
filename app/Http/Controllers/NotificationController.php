<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewAll(){
        $noty = new Notifications();
        $data = $noty->getAllNotifications();

        return view('notifications.viewAll')->with('data',$data );
    }

    public function markAllAsRead(){
        $noty = new Notifications();
        $noty->markAllAsRead();

        return redirect()->back();
    }
}
