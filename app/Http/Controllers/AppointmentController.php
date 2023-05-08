<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\Time;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

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
        $appointment->source = $request->source;
        $appointment->ads_name = $request->ads_name;
        $appointment->appointment_date_time = $request->appointmentDateTime;
        $appointment->note = $request->note;
       
        // Save the appointment
        $appointment->save();

        // Redirect or perform additional actions as needed
        // For example:
        return redirect()->back()->with('success', 'Appointment created successfully.');
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

    public function edit($id)
    {
        $pageTitle = 'Edit Appoinment';
        $appointment = Appointment::findOrFail($id);

        // Pass the treatment to the view
        return view('admin.appointment.edit', compact('appointment','pageTitle'));

    }

    public function update(Request $request, $id){
        $appointment = Appointment::findOrFail($id);
        $appointment->treatment = $request->input('treatments');
        $appointment->appointment_date_time = $request->input('appointmentDateTime');
        $appointment->status = 'ongoing';
        $appointment->save();

        return redirect()->route('home')->with('success', 'Appointment updated successfully.');
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

}
