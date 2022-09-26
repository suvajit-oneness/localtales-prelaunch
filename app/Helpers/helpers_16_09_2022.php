<?php

use App\Models\Notification;

function sendNotification($sender, $receiver, $type, $route, $title, $body='')
{
    $noti = new Notification();
    $noti->sender = $sender;
    $noti->receiver = $receiver;
    $noti->type = $type;
    $noti->route = $route;
    $noti->title = $title;
    $noti->description = $body;
    $noti->read_flag = 0;
    $noti->save();
}