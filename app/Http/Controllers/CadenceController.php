<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadence;
use App\EmailCadence;
use App\SmsCadence;
use App\EmailTemplate;
use Sentinel;
use App\Lead;
use App\LeadMailCadence;
use Mail;

class CadenceController extends Controller
{
   public function addCadence(){
    return view('frontend.cadence.addCadence');
   }

   public function saveCadence(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3'
        ]);

        $maxed = md5(str_random(4));
        $cadence = new Cadence;
        $cadence->name = $request->name;
        $cadence->user_id = Sentinel::getUser()->id;
        $cadence->masked_id = $maxed;
        $cadence->save();

        return redirect(route('step', $maxed));
   }
   public function step($masked_id){
$cadence = Cadence::whereMasked_id($masked_id)->whereUser_id(Sentinel::getUser()->id)->first();
$leads = Lead::whereUser_id(Sentinel::getUser()->id)->get();
$emailCadence = EmailCadence::whereCadence_id($cadence->id)->get();
$smsCadence = SmsCadence::whereCadence_id($cadence->id)->get();
    return view('frontend.cadence.step')->with('emailCadence', $emailCadence)->with('smsCadence', $smsCadence)->with('cadence', $cadence)->with('leads', $leads);

   }

 public function saveAllCadence(Request $request, $id){
//dd($request->all());
    $cadence = Cadence::findorfail($id);

$emailCadence = EmailCadence::whereCadence_id($id)->get();
 

 foreach($emailCadence as $email){
     $temp = $email->temp;
 $template = $request->$temp;

 $email->email_template_id = $template;
 $email->date_string = date("Y-m-d H:i", strtotime($request->date[$email->id]));
 $email->save();
 

 foreach($request->leads as $key => $value){
   $leadmail = new LeadMailCadence;
   $leadmail->user_id = $key;
   $leadmail->cadence_id = $id;
$leadmail->email_cadence_id =  $email->id;
$leadmail->save();
 }
}

return redirect()->back();
 //dd($request->all());

//  $cadence = Cadence::findorfail($id);
//  //dd($cadence->masked_id);

 
// $emailCadence = EmailCadence::whereCadence_id($id)->get();
 

//  foreach($emailCadence as $email){
//      $temp = $email->temp;
// $template = $request->$temp;

// $emailTemplate = EmailTemplate::findorfail($template);
// //dd($emailTemplate->body);
//     $this->sub = str_replace('[name]', 'Hannah', $emailTemplate->subject);
//     $this->body = str_replace('[name]', 'Hannah', $emailTemplate->body); 

    // Mail::send([], [], function ($message) {
    //     $message->to('honyinye3@gmail.com')
    //       ->subject($this->sub)
    //       ->from('hannah.okwelum@salesruby.com')
    //       // here comes what you want
    //     //   ->setBody('Hi, welcome user!'); // assuming text/plain
    //       // or:
    //       ->setBody($this->body, 'text/html'); // for HTML rich messages
    //   });
 }

//  Mail::send(array(), array(), function ($message) use ($html) {
//     $message->to()
//       ->subject()
//       ->from()
//       ->setBody($html, 'text/html');
//   });

//$template = EmailTemplate::findorfail(1);

 

 //dd($sub);


// }

public function allcadence(){
    $cadences = Cadence::whereUser_id(Sentinel::getUser()->id)->get();
    return view('frontend.cadence.all-cadence')->with('cadences', $cadences);
}
}
