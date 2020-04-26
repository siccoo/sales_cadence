<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Cadence;
use App\EmailCadence;

class EmailCadenceController extends Controller
{
  public function addStep($id){

   $cadence = Cadence::findorfail($id);
   if($cadence->step > 0){
    $cadence->step = $cadence->step - 1;
    $cadence->update();

    $email = new EmailCadence;
    $email->user_id = Sentinel::getUser()->id;
    $email->cadence_id = $id;
    $email->subname = str_random(4);
    $email->bodyname = str_random(4);
    $email->temp = str_random(4);
    $email->save();

    return redirect(route('step', $cadence->masked_id));
   }else{
       return back()->with('error', 'you have completed your step');
   }
   

  }
}
