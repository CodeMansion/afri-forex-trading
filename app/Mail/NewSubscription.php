<?php

namespace App\Mail;

use App\User;
use App\MailSetting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewSubscription extends Mailable
{
    use Queueable, SerializesModels;

    protected $service;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['setting'] = MailSetting::find(1);
        $data['service'] = $this->service;
        $data['member'] = auth()->user()->full_name;

        return $this->view("emails.member_subscription")->with($data)
            ->replyTo($data['setting']['reply_to'])
            ->subject("First Time Subscription");
    }
}
