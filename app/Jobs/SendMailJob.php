<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     protected $lead, $sub, $body;
    public function __construct($lead, $sub, $body)
    {
        $this->lead = $user;
        $this->sub = $sub;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      return Mail::send([], [], function ($message) {
          $message->to($this->$lead->email)
          ->subject($this->sub)
          ->from('hannah.okwelum@salesruby.com')
         
          ->setBody($this->body, 'text/html'); // for HTML rich messages
      });
    }
}
