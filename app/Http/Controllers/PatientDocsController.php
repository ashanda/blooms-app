<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\PatientDocs;
use App\Models\CustomerTreatment;
class PatientDocsController extends Controller
{
    public function saveDocs(Request $request){
        
        $appoinment_id = $request->input('appoinment_id');
        $uploadFields = $request->file('upload');
        $dropdownFields = $request->input('dropdown');

    // Process the fields as needed

    // Example: Save the fields to the database
    foreach ($uploadFields as $index => $upload) {
        $dropdown = $dropdownFields[$index];

        // Save $upload to the public folder
        $path = $upload->store('public/patient_docs');

        // Save the file path and dropdown value to the database
        $document = new PatientDocs();
        $document->appoinment_id = $appoinment_id ;
        $document->document = $path;
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
    // Redirect or perform any other necessary actions
    return redirect()->route('home')->with('message', 'Member updated successfully!');

}
    
}
