<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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

    }

    public function send($lead, $message){
        $phone = $lead->phone;

        $post_data=array(
            'sub_account'=>'7979_slc',
            'sub_account_pass'=>'slc2020',
            'action'=>'send_sms',
            'sender_id'=>'SalesRuby',
            'recipients'=> $phone,
            'message'=>$message,
            'route' => 2
        );

        $api_url='http://cheapglobalsms.com/api_v1';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($response_code != 200)$response=curl_error($ch);
        curl_close($ch);

        if($response_code != 200)$msg="HTTP ERROR $response_code: $response";
        else
        {
            $json=@json_decode($response,true);

            if($json===null)$msg="INVALID RESPONSE: $response";
            elseif(!empty($json['error']))$msg=$json['error'];
            else
            {
//                $lead->update([$status => 1]);
                $msg="SMS sent to ".$json['total']." recipient(s).";
                $sms_batch_id=$json['batch_id'];
            }
        }
        echo $msg;
    }

}
