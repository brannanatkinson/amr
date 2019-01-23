<?php

namespace App\Mail;

use App\Story;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScheduleTest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $date = Carbon::now();
        $stories = Story::where( 'story_date', '>=', $date->sub('7 days')->calendar() );
        return $this->from('brannan@amyacommunications.com')
        ->subject('Schedule Test')
        ->view('emails.schedule')
        ->with('stories');
    }
}
