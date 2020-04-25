<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Imports\LeadsImport;
use App\Lead;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    /**
     * LeadController constructor.
     */
    function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $user = auth()->user();
//        $leads = $user->leads()->latest()->paginate(5);
        $leads = Lead::latest()->paginate(5);
        return view('frontend.leads.index', compact('leads'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
//      $users = auth()->user();
        $user = 1;
        return view('frontend.leads.create', compact(['user']));

    }


    /**
     * @param LeadRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LeadRequest $request)
    {
        $input = $request->validated();
        Lead::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'company_name' => $input['company_name'],
            'designation' => $input['designation'],
            'user_id' => $input['user_id']
        ]);

        return redirect()->route('leads.index')
            ->with('success', 'Lead created successfully.');

    }


    /**
     * @param Lead $lead
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function show(Lead $lead)
    {
//        i removed chats variable in the compact

        return view('leads.show', compact('lead'));
    }


    /**
     * @param Lead $lead
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Lead $lead)
    {
        return view('frontend.leads.edit', compact('lead'));
    }


    /**
     * @param Lead $lead
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Lead $lead, Request $request)
    {
        $input = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:leads,email,'. $lead->id .',id',
            'phone' => 'required|max:20',
            'company_name' => 'required',
            'designation' => 'required',
        ]);

        $lead->update($input);

        return redirect()->route('leads.index')
            ->with('success', 'Lead updated successfully');
    }


    /**
     * @param Lead $lead
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')
            ->with('success', 'Lead deleted successfully');
    }

    public function upload(){
        return view('frontend.leads.upload');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadPost(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlx,xlsx,csv,ods|max:2048'
        ]);

        $fileName = time(). '.' .$request->file->extension();
        $request->file->move(public_path('uploads'), $fileName);

        Excel::import(new LeadsImport, 'uploads/'.$fileName);

        return redirect()->route('leads.index')
            ->with('success', 'Leads uploaded successfully');
    }


}
