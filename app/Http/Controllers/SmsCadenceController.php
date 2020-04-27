<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Cadence;
use App\SmsCadence;

class SmsCadenceController extends Controller
{
    public function addStep($id){

        $cadence = Cadence::findorfail($id);
        if($cadence->step > 0){
         $cadence->step = $cadence->step - 1;
         $cadence->update();
     
         $sms = new SmsCadence;
         $sms->user_id = Sentinel::getUser()->id;
         $sms->cadence_id = $id;
         $sms->temp = str_random(4);
         $sms->save();
     
         return redirect(route('step', $cadence->masked_id));
        }else{
            return back()->with('error', 'you have completed your step');
        }
        
     
       }
}
