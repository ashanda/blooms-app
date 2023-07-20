<?php
use App\Models\CustomerTreatment;
use App\Models\User;
use App\Models\Treatment;
use App\Models\Campaign;
use App\Models\DaySummery;
use App\Models\Lead;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

function sendSMS($phone,$message)
{
    $MSISDN = $phone;
	$SRC = 'Araliya CCT';
	$MESSAGE = ( urldecode($message));
	$AUTH = "716|dgD95hyXSbuxuoj5F4pG8QBdJ4wcoFzo064CAuhs ";  //Replace your Access Token
	
	$msgdata = array("recipient"=>$MSISDN, "sender_id"=>$SRC, "message"=>$MESSAGE);


			
			$curl = curl_init();
			
			//IF you are running in locally and if you don't have https/SSL. then uncomment bellow two lines
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://sms.send.lk/api/v3/sms/send",
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode($msgdata),
			  CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: Bearer $AUTH",
				"cache-control: no-cache",
				"content-type: application/x-www-form-urlencoded",
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}
}


function todayAppoinment($role,$id) {
	$todayAppoinment = 	CustomerTreatment::where($role,'=',$id)
										  ->whereDate('created_at', '=', Carbon::today()->format('Y-m-d'))
										  ->where('status', '=', 'waiting')
										  ->get();	
	return $todayAppoinment;									  
}

function allAssistant() {
	$allAssistants = User::where('role_id', '=', 6)->get();
	return $allAssistants;
}


function findSalesAgent($id) {
	$findSalesAgent = User::where('id', '=', $id)->first();
	return $findSalesAgent;
}


function campaingFind() {
	$findcampaigns = Campaign::where('assigned_agent','=',Auth::user()->id)->where('status','=',1)->get(); 
	return $findcampaigns;
}

function allTreatments() {
	$allTreatments = Treatment::all(); 
	return $allTreatments;
}

function todaysummary($id){
	$today = Carbon::now()->format('Y-m-d');
	if($id == 1){
		$todaysummaries = DaySummery::all( );
	}else{
		$todaysummaries = DaySummery::where('sale_agent_id', $id)
		->whereDate('created_at', $today)
		->get();
	}
	

	return $todaysummaries;

}

function isRouteActive($slug)
{
    return request()->is($slug);
}


function all_leads_count(){
	if(Auth::user()->role->name == 'Admin'){
		$all_leads = Lead::count();
	}else{
		$all_leads =Lead::where('agent_id', Auth::user()->id)->count();
	}
	return $all_leads;
}

function all_appoinments_count(){
	if(Auth::user()->role->name == 'Admin'){
		$all_appoinments = Appointment::count();
	}else{
		$all_appoinments =Appointment::where('agent_id', Auth::user()->id)->count();
	}
	return $all_appoinments;
}

function all_missed_appoinments_count(){
	if(Auth::user()->role->name == 'Admin'){
		$all_missed_appoinments = Appointment::where('status', 'missed')->count();
	}else{
		$all_missed_appoinments = Appointment::where('status', 'missed')
											  ->where('agent_id', Auth::user()->id)->count();
	}
	return $all_missed_appoinments;
}

function all_ongoing_appoinments_count(){
	if(Auth::user()->role->name == 'Admin'){
		$all_missed_appoinments = Appointment::where('status', 'missed')->count();
	}else{
		$all_missed_appoinments = Appointment::where('status', 'ongoing')
											  ->where('agent_id', Auth::user()->id)->count();
	}
	return $all_missed_appoinments;
}


function getCustomerCountByMonth()
{
	$currentYear = Carbon::now()->year;

	$customerCounts = Customer::selectRaw('COUNT(*) as count, YEAR(created_at) as year, MONTH(created_at) as month')
	->whereYear('created_at', $currentYear) // Filter by the current year
		->groupBy('year', 'month')
		->orderBy('year')
		->orderBy('month')
		->get();

	return $customerCounts;	
}

function getpayments()
    {
        $currentYear = Carbon::now()->year;

        $customerData = Invoice::selectRaw('SUM(pay_amount) as total_pay_amount, MONTH(created_at) as month')
            ->whereYear('created_at', $currentYear) // Filter by the current year
            ->where('status', 'settled') // Filter by settled status, adjust as needed
            ->groupBy('month')
            ->orderBy('month')
            ->get();

	return $customerData;		
}


function getappointment()
{
	$currentYear = Carbon::now()->year;

	$cappointment = Appointment::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
	->whereYear('created_at', $currentYear) // Filter by the current year
		->where('visibility', 'open') // Filter by settled status, adjust as needed
		->groupBy('month')
		->orderBy('month')
		->get();

	return $cappointment;
}

function staticsdata()
{
	$currentYear = Carbon::now()->year;
	$currentMonth = Carbon::now()->month;

	$customerCount = Customer::whereYear('created_at', $currentYear)
		->whereMonth('created_at', $currentMonth)
		->count();

	$invoiceSum = Invoice::whereYear('created_at', $currentYear)
		->whereMonth('created_at', $currentMonth)
		->where('status', 'settled')
		->sum('pay_amount');

	$appointmentCount = Appointment::whereYear('created_at', $currentYear)
		->whereMonth('created_at', $currentMonth)
		->where('visibility', 'open')
		->count();

	return [$customerCount, $invoiceSum, $appointmentCount];
}


function todayAppoinmentfront(){

	$todayAppoinment = 	Appointment::where('status', '=', 'ongoing')
		->whereDate('appointment_date_time', '=', Carbon::today()->format('Y-m-d'))
		->where('visibility', '=', 'open')
		->get();

	return 	$todayAppoinment;
}


function userdata($id){
	$user = User::where('id', $id)->first();
	return $user;
}