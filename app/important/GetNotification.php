<?php
namespace App\important;


Class GetNotification{
    public function getNotificationsForUser($user_type = 0){
        die('x');
        $noty   =   new \App\Notifications();
        $data   =   $noty->getUsersNotifications();

        return $data;
    }
}
?>