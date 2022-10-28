<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewUserNotification;
use App\Notifications\UserOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Queue\InteractsWithQueue;
use Notification;
class SendNewUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::where('role_as',  1)->get();
        Notification::send($admins, new NewUserNotification($event->user));
    }
}
