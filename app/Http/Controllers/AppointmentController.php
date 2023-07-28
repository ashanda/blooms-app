<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\CustomerTreatment;
use App\Models\Time;
use App\Models\Lead;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AppointmentController extends Controller
{
    public function show(Request $request)
    {
        $date = $request->date;

        $timesArr = DB::table('times')
                        ->join('appointments', function ($join) use ($date) {
                            $join->on('appointments.id', '=', 'times.appointment_id')
                                ->where('appointments.date', '=', $date)
                                ->where('appointments.user_id', '=', Auth::user()->id);
                        })
                        ->join('users', function ($join) {
                            $join->on('users.id', '=', 'times.patient_id');
                        })
                        ->orderBy('time')
                        ->get();

        return view('admin.appointment.view', ['timesArr' => $timesArr, 'date' => $date]);
    }

    public function view()
    {
        return view('admin.appointment.view');
    }


    public function add_appointment(Request $request){
       
       

        
        $random_number = '#' . mt_rand(100000, 999999);
        // Create a new appointment instance
        $appointment = new Appointment();
        if(Auth::user()->role_id == 5){
            $appointment->agent_id = Auth::user()->id;
        }
        $treatment = Treatment::where('treatment_name',$request->treatments)->first();   
        $appointment->appointment_id = $random_number.'-'.$treatment->treatment_code ;
        $appointment->customer_id = $random_number ;
        $appointment->customer_name = $request->name;
        $appointment->customer_phone = $request->phone;
        $appointment->customer_address = $request->address;
        $appointment->treatment = $request->treatments;
        $appointment->doctor_id = $request->doctors;
        $appointment->source = $request->source;
        $appointment->ads_name = $request->adsName;
        $appointment->appointment_date_time = $request->appointmentDateTime;
        $appointment->note = $request->note;
       
        // Save the appointment
        $appointment->save();

        if($request->leadID !== null){
            $lead = Lead::findOrFail($request->leadID);
            $lead->status = 'converted';
            $lead->save();
        }  
        // Redirect or perform additional actions as needed
        // For example:
        Alert::success('Success', 'Appointment created successfully.');  
        return redirect()->back();
    }



    public function all_appoinment(){
        $pageTitle = 'All Appoinments';
        if(Auth::user()->role_id == 5){
            $appointments = Appointment::where('agent_id', '=', Auth::user()->id);
        }else{
            $appointments = Appointment::all();
        }

        return view('admin.appointment.view', compact('appointments','pageTitle'));
    }

    public function ongoing_appoinment(){
        $pageTitle = 'Ongoing Appoinments';
        if(Auth::user()->role_id == 5){
            $appointments = Appointment::where('status', 'ongoing')
                                        ->where('agent_id', '=', Auth::user()->id)
                                        ->get();
        }else{
            $appointments = Appointment::where('status', 'ongoing')->get();
        }
        
        return view('admin.appointment.view', compact('appointments','pageTitle'));
    }

    public function missed_appoinment(){
        $pageTitle = 'Missed Appoinments';
        if(Auth::user()->role_id == 5){
            $appointments = Appointment::where('status', 'missed')
                                        ->where('agent_id', '=', Auth::user()->id)
                                        ->get();
        }else{
            $appointments = Appointment::where('status', 'missed')->get();
        }

        return view('admin.appointment.view', compact('appointments','pageTitle'));
    }


    public function converted_appoinment(){
        $pageTitle = 'Converted Appoinments';
        if(Auth::user()->role_id == 5){
            $appointments = Appointment::where('status', 'converted')
                                        ->where('agent_id', '=', Auth::user()->id)
                                        ->get();
        }else{
            $appointments = Appointment::where('status', 'converted')->get();
        }

        return view('admin.appointment.view', compact('appointments','pageTitle'));
    }

    public function assign_appoinment(){
        $pageTitle = 'Assign Appoinments';
        if(Auth::user()->role_id == 5){
            $appointments = Appointment::where('source', 'front_office')
                                        ->where('agent_id', '=', Auth::user()->id)
                                        ->get();
        }else{
            $appointments = Appointment::where('source', 'front_office')->get();
        }

        return view('admin.appointment.view', compact('appointments','pageTitle'));
    }

    public function recurring_appoinment(){
        $pageTitle = 'Recurring Appoinments';
        if(Auth::user()->role_id == 5){
            $appointments = Appointment::where('status', 'recurring')
                                        ->where('agent_id', '=', Auth::user()->id)
                                        ->get();
        }else{
            $appointments = Appointment::where('status', 'recurring')->get();
        }

        return view('admin.appointment.view', compact('appointments','pageTitle'));

    }

    public function edit($id)
    {
        $pageTitle = 'Edit Appoinment';
        $appointment = Appointment::findOrFail($id);

        // Pass the treatment to the view
        return view('admin.appointment.edit', compact('appointment','pageTitle'));

    }

    public function update(Request $request, $id){
        dd('mac');
        $appointment = Appointment::findOrFail($id);
        $appointment->treatment = $request->input('treatments');
        if($request->input('doctors') !== null){
            $appointment->doctor_id = $request->input('doctors');
        }
        
        $appointment->appointment_date_time = $request->input('appointmentDateTime');
        $appointment->note = $request->input('note');
        $appointment->status = 'ongoing';
        $appointment->save();

        Alert::success('Success', 'Appointment updated successfully.'); 
        return redirect()->route('home');
    }

    public function delete_appoinment(){
        
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $user = Appointment::where('customer_id', $query)
                    ->orWhere('customer_phone', $query)
                    ->where('status', '=', 'ongoing')
                    ->first();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found.',401]);
        }
    }


    public function new_appointment(){
        $pageTitle = 'Create Appoinment';
        return view('admin.appointment.create', compact('pageTitle'));
    }


    public function quick_appointment_pay(Request $request){

        $random_number = '#' . mt_rand(100000, 999999);
        // Create a new appointment instance
        $appointment = new Appointment();
        if (Auth::user()->role_id == 5) {
            $appointment->agent_id = Auth::user()->id;
        }
         
        $treatment = Treatment::where('treatment_name', $request->treatments)->first();
        $appoinment_id = $random_number . '-' . $treatment->treatment_code;
        $customer_id = $random_number;
        $appointment->appointment_id = $appoinment_id;
        $appointment->customer_id = $customer_id;
        $appointment->customer_name = $request->name;
        $appointment->customer_phone = $request->phone;
        $appointment->customer_address = $request->address;
        $appointment->treatment = $request->treatments;
        $appointment->doctor_id = $request->doctors;
        $appointment->source = $request->source;
        $appointment->ads_name = $request->adsName;
        $appointment->appointment_date_time = $request->appointmentDateTime;
        $appointment->status = 'sucess';
        $appointment->note = $request->note;

        // Save the appointment
        $appointment->save();


        //Customer Treatment Table Record
        $customer = new CustomerTreatment();
        $customer->appoinment_id = $appoinment_id;
        $customer->customer_id = $customer_id;
        $customer->assistant = $request->assistant;
        $customer->doctor_id = $request->doctors;
        $customer->appointment_date_time = $request->appointmentDateTime;
        $customer->treatment = $request->treatments;
        $customer->save();

        $customer = Customer::where('customer_id', $customer_id)->first();

        if ($customer) {
        } else {

            $customer = new Customer();
            $customer->customer_id = $customer_id;
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->save();
        }

        // Invoice and print
        $random_number = '#' . mt_rand(100000, 999999);
        $invoice = new Invoice();
        $invoice->invoice_id = $random_number;
        $invoice->appoinment_id = $appoinment_id;
        $invoice->total = $request->total1;
        $invoice->payment_type = $request->paymentMethod;
        $invoice->pay_amount = $request->payamount1;
        $invoice->balance = $request->balance1;
        $invoice->treatment = $request->treatments;
        $invoice->issued_by = Auth::user()->name;
        $invoice->status = 'settled';
        $invoice->save();

        return view('print', ['invoice' => $invoice]);

    }

}
