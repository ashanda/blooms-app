<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Treatment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Doctor' || Auth::user()->role->name == 'Sales Agent' || Auth::user()->role->name == 'Assistant' || Auth::user()->role->name == 'Front Officer'){
        $pageTitle = 'Dashboard';  
          
        return redirect()->to('/dashboard');
         }
        return redirect()->to('/');
    }

    public function getDoctors(Request $request)
    {
        $selectedTreatments = $request->input('treatments');
        $get_treatments = Treatment::whereIn('treatment_name', $selectedTreatments)->get();
        $doctors = [];

        foreach ($get_treatments as $get_treatment) {
            $doctor = User::where('id', $get_treatment->doctor_id)->first();
            if ($doctor) {
                $doctors[] = $doctor;
            }
        }

        return response()->json(['doctors' => $doctors]);
    }

    public function getRelatedImage(Request $request)
    {
        $get_image = Campaign::select('image')
                                ->where('id', $request->selectedValue)
                                ->first();
        return response()->json($get_image);

        
    }
}
