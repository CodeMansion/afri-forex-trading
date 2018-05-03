<?php

namespace App\Mail;

use App\User;
use App\MailSetting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmRegistration extends Mailable
{
    use Queueable, SerializesModels;

    protected $member;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['setting'] = MailSetting::find(1);
        $data['member'] = $this->member;

        return $this->view("emails.confirm_registration")->with($data)
            ->replyTo($data['setting']['reply_to'])
            ->subject("New Member Account Activation");
    }
}
