<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\PatientDocs;
use App\Models\CustomerTreatment;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
class PatientDocsController extends Controller
{
    public function saveDocs(Request $request){
        
        $appoinment_id = $request->input('appoinment_id');
        $uploadFields = $request->file('upload');
        $dropdownFields = $request->input('dropdown');
        $appointmentDateTime = $request->appointmentDateTime;
    // Process the fields as needed

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
        $current_appoinment_data = Appointment::where('appointment_id','=',$appoinment_id)->first();
        $random_number = '#' . mt_rand(100000, 999999);
        // Create a new appointment instance
        $appointment = new Appointment();
        if(Auth::user()->role_id == 5){
            $appointment->agent_id = Auth::user()->id;
        }
        $treatment = Treatment::where('treatment_name',$current_appoinment_data->treatment)->first();   
        $appointment->appointment_id = $random_number.'-'.$treatment->treatment_code ;
        $appointment->customer_id = $random_number ;
        $appointment->customer_name = $current_appoinment_data->customer_name;
        $appointment->customer_phone = $current_appoinment_data->customer_phone;
        $appointment->customer_address = $current_appoinment_data->customer_address;
        $appointment->treatment = $current_appoinment_data->treatment;
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
    
}
