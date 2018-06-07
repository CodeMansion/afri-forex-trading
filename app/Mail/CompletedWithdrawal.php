<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\MailSetting;

class CompletedWithdrawal extends Mailable
{
    use Queueable, SerializesModels;
    protected $withdrawal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['setting'] = MailSetting::find(1);

        return $this->view("emails.completed_withdrawal")->with($this->withdrawal)
            ->replyTo($data['setting']['reply_to'])
            ->subject("Completed Withdrawal Request");
    }
}
