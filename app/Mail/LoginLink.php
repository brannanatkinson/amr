<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var user
     */
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $loginlink)
    {
        $this->user = $user;
        $this->loginlink = $loginlink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('brannan@amyacommunications.com')->view('emails.loginlink')
            ->with(['loginlink' => $this->loginlink])
        ;
    }
}
