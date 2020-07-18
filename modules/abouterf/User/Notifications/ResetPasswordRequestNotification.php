<?php

namespace abouterf\User\Notifications;

use abouterf\User\Mail\ResetPasswordRequestMail;
use abouterf\User\Services\VerifyCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ResetPasswordRequestNotification extends Notification
{
    use Queueable;


    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code,120);
        return (new ResetPasswordRequestMail($code))->to($notifiable->email);
    }


    public
    function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

