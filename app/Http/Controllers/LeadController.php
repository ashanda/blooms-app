<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'All Lead';
        if (Auth::user()->role_id == 5) {
            $leads = Lead::where('agent_id', '=', Auth::user()->id)
                ->where('status', 'not_converted')
                ->get();
        } else {
            $leads = Lead::where('status', 'not_converted')->get();
        }

        return view('admin.lead.index', compact('leads', 'pageTitle'));
    }


    public function converted_leads()
    {
        $pageTitle = 'All Converted Lead';
        if (Auth::user()->role_id == 5) {
            $leads = Lead::where('agent_id', '=', Auth::user()->id)
                ->where('status', 'converted')
                ->get();
        } else {
            $leads = Lead::where('status', 'converted')->get();
        }

        return view('admin.lead.index', compact('leads', 'pageTitle'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'New Lead';
        return view('admin.lead.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lead = new Lead();
        if (Auth::user()->role_id == 5) {
            $lead->agent_id = Auth::user()->id;
        }
        $lead->customer_name = $request->name;
        $lead->customer_phone = $request->phone;
        $lead->customer_address = $request->address;
        $lead->treatment = $request->treatments;
        $lead->doctor_id = $request->doctors;
        $lead->source = $request->source;
        $lead->ads_name = $request->adsName;
        $lead->note = $request->note;

        // Save the lead
        $lead->save();



        Alert::success('Success', 'Lead created successfully.');
        return redirect()->route('lead.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Lead';
        $lead = Lead::findOrFail($id);

        // Pass the treatment to the view
        return view('admin.lead.edit', compact('lead', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lead = lead::findOrFail($id);
        $lead->customer_name = $request->input('customer_name');
        $lead->customer_phone = $request->input('phone');
        $lead->customer_address = $request->input('address');
        $lead->treatment = $request->input('treatments');
        if ($request->input('doctors') !== null) {
            $lead->doctor_id = $request->input('doctors');
        }
        $lead->note = $request->input('note');

        $lead->save();

        Alert::success('Success', 'Appointment updated successfully.');
        return redirect()->route('lead.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);

        $lead->delete();
        Alert::warning('Delete', 'Campaign deleted successfully.');
        return redirect()->route('lead.index');
    }
}
