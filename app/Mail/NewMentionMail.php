<?php

namespace App\Mail;

use App\User;
use App\Story;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMentionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var user
     */
    public $story;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->story);
        return $this->from('brannan@amyacommunications.com')->subject('New Mention Added')->view('emails.newmention')
            ->with(['story' => $this->story]);
        ;
    }
}
