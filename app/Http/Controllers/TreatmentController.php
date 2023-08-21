<?php

namespace App\Http\Controllers;

use App\Models\CustomerTreatment;
use App\Models\Treatment;
use App\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'All Treatment';
        $treatments = Treatment::all();
        return view('admin.treatment.index',compact('pageTitle','treatments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $pageTitle = 'Create Treatment';
       $doctors = User::where('role_id', '=', 3)->get();
       return view('admin.treatment.create',compact('pageTitle','doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // Validate the form data


    $treatment = new Treatment();
    $treatment->treatment_code = $request->treatment_code;
    $treatment->treatment_name = $request->treatment_name;
    $treatment->doctor_id = $request->doctor_id;
    $treatment->treatment_time = $request->treatment_time;
    $treatment->face_value = $request->face_value;
    $treatment->actual_value = $request->actual_value;
    $treatment->hospital_charge = $request->hospital_charge;
    $treatment->agent_fee = $request->agent_fee;
    $treatment->other_expense = $request->other_expense;
    $treatment->note = $request->note;
    $treatment->save();

    Alert::success('Success', 'Treatment created successfully');
    return redirect()->route('treatment.index');
}
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Treatment';
        $treatment = Treatment::findOrFail($id);

        // Pass the treatment to the view
        return view('admin.treatment.edit', compact('treatment','pageTitle'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    
        $treatment = Treatment::findOrFail($id);
        $treatment->treatment_code = $request->treatment_code;
        $treatment->treatment_name = $request->treatment_name;
       // $treatment->doctor_id = $request->doctor_id;
        $treatment->treatment_time = $request->treatment_time;
        $treatment->face_value = $request->face_value;
        $treatment->actual_value = $request->actual_value;
        $treatment->hospital_charge = $request->hospital_charge;
        $treatment->agent_fee = $request->agent_fee;
        $treatment->other_expense = $request->other_expense;
        $treatment->note = $request->note;
        $treatment->save();
        Alert::success('Success', 'Treatment updated successfully');
        return redirect()->route('treatment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the treatment by ID
            $treatment = Treatment::findOrFail($id);

            // Delete the treatment
            $treatment->delete();
            Alert::success('Success', 'Treatment deleted successfully');
            // Redirect or perform any other necessary actions
            return redirect()->back();
    }


    public function getFeedData(Request $request){
        date_default_timezone_set('Asia/Colombo');
        $inputQuery = $request->input('query');
        $currentDateTime = Carbon::now();

        $getFeedData = CustomerTreatment::where('status', 'waiting')
        ->join('customers', 'customers.customer_id', '=', 'customer_treatments.customer_id')
        ->where('customer_treatments.appointment_date_time', '>=', $currentDateTime)
        ->where(function ($query) use ($inputQuery) {
            $query->where('appoinment_id', $inputQuery)
                ->orWhere('phone', $inputQuery)
                ->orWhere('name', $inputQuery)
                ->orWhere('customers.customer_id', $inputQuery);
        })
        ->first(['customer_treatments.*', 'customers.*']);
    
        
        if ($getFeedData) {
            return response()->json($getFeedData);
        } else {
            return response()->json(['message' => 'User not found.',401]);
        }

    }
}
