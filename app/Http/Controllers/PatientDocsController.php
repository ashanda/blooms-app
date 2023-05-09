<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\PatientDocs;
use App\Models\CustomerTreatment;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class PatientDocsController extends Controller
{
    public function saveDocs(Request $request){
        
        $appoinment_id = $request->input('appoinment_id');
        $uploadFields = $request->file('upload');
        $dropdownFields = $request->input('dropdown');
        $appointmentDateTime = $request->appointmentDateTime;
    // Process the fields as needed
    $current_appoinment_data = Appointment::where('appointment_id','=',$appoinment_id)->first();
 
    // Example: Save the fields to the database
    foreach ($uploadFields as $index => $upload) {
        $dropdown = $dropdownFields[$index];

        // Save $upload to the public folder
        
        $file= $upload;
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file -> move(public_path('/patient_docs'), $filename);
        // Save the file path and dropdown value to the database
        $document = new PatientDocs();
        $document->appoinment_id = $appoinment_id ;
        $document->customer_id = $current_appoinment_data->customer_id ;
        $document->doctor_id = $current_appoinment_data->doctor_id ;
        $document->document = $filename;
        $document->document_type = $dropdown;
        $document->save();
    }

    $customer_treatments_status = CustomerTreatment::where('appoinment_id', $appoinment_id)->first();

    if ($customer_treatments_status) {
        $customer_treatments_status->status = 'done';
        $customer_treatments_status->save();
    }

    $appoinment_visibility = Appointment::where('appointment_id', $appoinment_id)->first();

    if ($appoinment_visibility) {
        $appoinment_visibility->visibility = 'closed';
        $appoinment_visibility->save();
    }

    //Create appoinment Assistant
    if($appointmentDateTime){
        
        $random_number = '#' . mt_rand(100000, 999999);
        // Create a new appointment instance
        $appointment = new Appointment();
        if(Auth::user()->role_id == 5){
            $appointment->agent_id = Auth::user()->id;
        }
        $treatment = Treatment::where('treatment_name',$current_appoinment_data->treatment)->first();   
        $appointment->appointment_id = $random_number.'-'.$treatment->treatment_code ;
        $appointment->customer_id = $current_appoinment_data->customer_id ;
        $appointment->customer_name = $current_appoinment_data->customer_name;
        $appointment->customer_phone = $current_appoinment_data->customer_phone;
        $appointment->customer_address = $current_appoinment_data->customer_address;
        $appointment->treatment = $current_appoinment_data->treatment;
        $appointment->doctor_id = $current_appoinment_data->doctor_id;
        $appointment->source = 'Front Office';
        $appointment->ads_name = $current_appoinment_data->ads_name;
        $appointment->appointment_date_time = $appointmentDateTime;
        $appointment->note = $request->note;
       
        // Save the appointment
        $appointment->save();
    }
    // Redirect or perform any other necessary actions
    Alert::success('Success', 'Patient Document Uploads successfully');
    return redirect()->route('home')->with('message', 'Member updated successfully!');

}

    public function all(Request $request){
        //get appinment id base it docs
        $doc_patients = DB::table('customers')
            ->join('patient_docs', 'customers.customer_id', '=', 'patient_docs.customer_id')
            ->select('customers.customer_id as customer_id', 'customers.name', 'customers.phone')
            ->where('patient_docs.doctor_id', Auth::user()->id)
            ->distinct('customers.customer_id')
            ->get();

        $pageTitle = 'Patient Documents';
        return view('admin.patient.index',compact('doc_patients','pageTitle'));
    }

    public function docs($id){
        //get appinment id base it docs
        $patients_docs = DB::table('patient_docs')
        ->Join('appointments', 'appointments.appointment_id', '=', 'patient_docs.appoinment_id')
        ->where('patient_docs.customer_id', $id)
        ->get();
    
        $pageTitle = 'Patient Documents';

        return view('admin.patient.show', compact('patients_docs','pageTitle'));
    }
    
}
