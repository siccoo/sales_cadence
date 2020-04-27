<?php

namespace App\Console\Commands;

use App\LeadSmsCadence;
use App\SmsCadence;
use App\SmsTemplate;
use Carbon\Carbon;

class SMSLeads extends SMS
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:leads';

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
        $now = date('Y-m-d H:i', strtotime(Carbon::now()->addHour()));
        $smsCadence = SmsCadence::all();
        if($smsCadence !== null){
            $smsCadence->where('date_string', '<', $now)->each(function ($smsCadence){
                $template = SmsTemplate::findorfail($smsCadence->sms_template_id);
                if($smsCadence->delivered == 'NO')
                {
                    $leads = LeadSmsCadence::where('sms_cadence_id', $smsCadence->id)->get();

                    foreach($leads as $lead) {
                        $leadName = $lead['lead']->first_name . ' ' .  $lead['lead']->last_name;
                        $message = str_replace('[name]', $leadName, $template->message);
                        $this->send($lead, $message);
                    }
                    $smsCadence->update(['delivered' => 'YES']);
                }
            });
        }
    }
}
