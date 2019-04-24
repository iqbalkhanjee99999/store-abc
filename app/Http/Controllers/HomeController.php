<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notifications;
use App\Project;
use App\RecivingGoods;
use App\RequestedGoods;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category   = new Category();
        $categories = $category->getLastFiveCategories();
        $items      = $category->getLastSevenItems();
        $totalItems = $category->getAllItemsCount();

        $user = new User();
        $users = $user->getCountAllUsers();

        $reciving = new RecivingGoods();
        $totalReciving = $reciving->totalReciving();

        $requested = new RequestedGoods();
        $totalRequested = $requested->totalRequested();

        $notification = new Notifications();
        $notifications = $notification->getUsersNotifications();
        $notificationCount = $notification->countUnReadNotifications();

        $project = new Project();
        $projects = $project->getMyProjects();


        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 101 || Auth::user()->user_type == 2){
            return view('home')
                ->with('categories',$categories)
                ->with('items',$items)->with('users',$users)
                ->with('totalReciving',$totalReciving)
                ->with('notifications',$notifications)
                ->with('totalItems',$totalItems)
                ->with('totalRequested',$totalRequested);
        }
        elseif(Auth::user()->user_type == 1 || Auth::user()->user_type == 3){
            return view('projects/selectProject')->with('projects',$projects);
        }
    }
}
