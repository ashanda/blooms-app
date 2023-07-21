<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DaySummery;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use RealRashid\SweetAlert\Facades\Alert;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function view(Request $request){
        if($request->ajax())
    	{

            $event = Appointment::join('users', 'users.id', '=', 'appointments.doctor_id')
            ->select('appointments.*', 'users.*')
            ->get();
        
        return response()->json($event);
            
            
            
    	}
    
    
        $followUp = FollowUp::where('agent_id', Auth::user()->id)->get();
        return view('sale_agent.view',compact('followUp'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUp $followUp)
    {
        return view('sale_agent.view', 'followUp');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUp $followUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUp $followUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUp $followUp)
    {
        //
    }

    public function save_day_summary(Request $request){
        $whatsappChat = $request->input('whatsapp_chat');
        $whatsappCall = $request->input('whatsapp_call');
        $messengerChat = $request->input('messenger_chat');
        $directCall = $request->input('direct_call');
        $ads_id= $request->input('adsName');

        // Create a new instance of the DaySummary model
        $daySummary = new DaySummery();
        $daySummary->sale_agent_id = Auth::user()->id;
        $daySummary->whatsapp_chat = $whatsappChat;
        $daySummary->whatsapp_call = $whatsappCall;
        $daySummary->messenger_chat = $messengerChat;
        $daySummary->direct_call = $directCall;
        $daySummary->ads_id = $ads_id;
    
    // Save the DaySummary model
    $daySummary->save();
    Alert::success('Success', 'Today Summary Data Save successfully.');
    return redirect()->back()->with('success', 'Data saved successfully.');
    }
}
