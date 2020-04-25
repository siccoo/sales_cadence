<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Jobs\SendMailJob;
use App\Lead;
use App\EmailTemplate;
use App\LeadMailCadence;
use App\Cadence;
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

        $emailCadence = EmailCadence::get();
        if($emailCadence !== null){
            
                 $template = EmailTemplate::findorfail($emailCadence->email_template_id);
                 
                 $emailCadence->where('date_string',  $now)->each(function($emailCadence) {
                    if($emailCadence->delivered == 'NO')
                    {
                        $leads = Lead::whereEmail_cadence($emailCadence->id)->get();
                       
                        foreach($leads as $lead) {
                            $leadname = $lead['lead']->first_name . ' ' .  $lead['lead']->last_name;
                            $template->subject = str_replace('[name]', $leadname, $emailTemplate->subject);
                            $template->body = str_replace('[name]', $leadname, $emailTemplate->subject);
                            dispatch(new SendMailJob($lead['lead'], $temblate->subject, $template->body));
                        }
                        $emailCadence->delivered = 'YES';
                        $emailCadence->save();   
                    }
                });
            }
        }
        
    }


