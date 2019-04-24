<?php
namespace App\Notification;


use App\Notifications;

Class GetNotification extends Notifications {
    public function getNotificationsForUser(){

        $noty               =   new \App\Notifications();
        $data['records']    =   $noty->getUsersNotifications();

        $notification   = new Notifications();
        $data['count']  = $notification->countUnReadNotifications();

        return $data;
    }
}
?>