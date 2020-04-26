<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Jobs\SendMailJob;
use App\Lead;
use App\EmailTemplate;
use App\LeadMailCadence;
use App\Cadence;
use Mail;
use App\EmailCadence;


class MailLeads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:leads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = date("Y-m-d H:i", strtotime(Carbon::now()->addHour()));

        $emailCadences = EmailCadence::get();
        if($emailCadences !== null){
            
                 
                 
                 $emailCadences->where('date_string',  $now)->each(function($emailCadence) {
                    $template = EmailTemplate::findorfail($emailCadence->email_template_id);
                    if($emailCadence->delivered == 'NO')
                    {
                        $leads = LeadMailCadence::whereEmail_cadence_id($emailCadence->id)->get();
                       
                        foreach($leads as $lead) {
                            $leadname = $lead['lead']->first_name . ' ' .  $lead['lead']->last_name;
                            $subject = str_replace('[name]', $leadname, $template->subject);
                            $body = str_replace('[name]', $leadname, $template->body);
                            dispatch(new SendMailJob($lead['lead']->email, $subject, $body));
                        }
                        $emailCadence->delivered = 'YES';
                        $emailCadence->save();   
                    }
                });
            }
        }
        
    }


