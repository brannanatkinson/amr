<?php

namespace App\Listeners;

use App\User;
use App\Mail\NewMentionMail;
use Auth;
use App\Events\NewMention;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewMentionListener
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
     * @param  NewMention  $event
     * @return void
     */
    public function handle(NewMention $event)
    {
        Mail::to( Auth::user()->email )->send(new NewMentionMail( $event->story ));
    }
}
