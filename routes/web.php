<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TreatmentController;  
use App\Http\Controllers\PatientDocsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;
use app\Http\Controllers\LeadController;
use app\Http\Controllers\ExpenseCatController;
use app\Http\Controllers\ExpensesController;


Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::post('/add_appointment', [AppointmentController::class, 'add_appointment'])->name('add_appointment');
Route::get('/followups', [FollowUpController::class, 'view'])->name('followups.view');
Route::post('/followups', [FollowUpController::class, 'show'])->name('followups.show');


Route::get('/dashboard', function () {
    $pageTitle = Auth::user()->role->name.' '.'Dashboard';
    return view('dashboard', compact('pageTitle'));
});

//Patient CRUD
Route::group(['middleware' => ['auth', 'patient']], function () {

    Route::get('/index', [App\Http\Controllers\PatientController::class, 'index'])->name('patient.index');
    Route::put('/index/delete', [App\Http\Controllers\PatientController::class, 'delete'])->name('patient.delete');
    Route::post('/book/show', [App\Http\Controllers\PatientController::class, 'show'])->name('patient.show');
    Route::post('/book/doctors', [App\Http\Controllers\PatientController::class, 'viewDoctors'])->name('patient.viewDoctors');
    Route::get('/book', [App\Http\Controllers\PatientController::class, 'book'])->name('patient.book');
    Route::put('/book', [App\Http\Controllers\PatientController::class, 'update'])->name('patient.update');

});




//Doctor CRUD
Route::group(['middleware' => ['auth', 'doctor']], function () {
    //Create availability
    Route::post('/availability', [App\Http\Controllers\AvailabilityController::class, 'store'])->name('availability.store');
    Route::get('/availability/create', [App\Http\Controllers\AvailabilityController::class, 'create'])->name('availability.create');

    //View and delete availability
    Route::get('/availability', [App\Http\Controllers\AvailabilityController::class, 'index'])->name('availability.index');
    Route::post('/availability/{user_id}/show', [App\Http\Controllers\AvailabilityController::class, 'show'])->name('availability.show');
    Route::post('/availability/delete', [App\Http\Controllers\AvailabilityController::class, 'destroy'])->name('availability.delete');

    //view booked appointments
    Route::post('/appointment', [App\Http\Controllers\AppointmentController::class, 'show'])->name('appointment.show');
    Route::get('/appointment', [App\Http\Controllers\AppointmentController::class, 'view'])->name('appointment.view');

    Route::get('/patient_data', [PatientDocsController::class, 'all'])->name('patient.all');
    Route::get('/patient_data/{id}', [PatientDocsController::class, 'docs'])->name('patient.data');


});

//Sale Agent CRUD
Route::group(['middleware' => ['auth', 'sales_agent']], function () {


    //view booked appointments
   
   
    Route::post('/followups/action', [FollowUpController::class, 'action']);
    
    Route::post('/save_day_summary',[FollowUpController::class, 'save_day_summary'])->name('save_day_summary');
    
});

//admin CRUD
Route::resource('/staff', App\Http\Controllers\StaffController::class)->middleware('admin:view');
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::resource('/treatment', App\Http\Controllers\TreatmentController::class);
    Route::resource('/campaigns', App\Http\Controllers\CampaignController::class);
    Route::resource('/expense_type', App\Http\Controllers\ExpenseCatController::class);
    Route::resource('/expense', App\Http\Controllers\ExpenseController::class);
  
});

// Role Acess
Route::group(['middleware' => ['auth']], function () {
 
Route::get('/all_appointments', [AppointmentController::class, 'all_appoinment'])->name('all_appoinment');
Route::get('/ongoing_appointments', [AppointmentController::class, 'ongoing_appoinment'])->name('ongoing_appoinment');
Route::get('/missed_appointments', [AppointmentController::class, 'missed_appoinment'])->name('missed_appoinment');
Route::get('/converted_appointments', [AppointmentController::class, 'converted_appoinment'])->name('converted_appoinment');
Route::get('/assign_appointments', [AppointmentController::class, 'assign_appoinment'])->name('assign_appoinment');
Route::get('/recurring_appointments', [AppointmentController::class, 'recurring_appoinment'])->name('recurring_appoinment');

Route::get('/appointments/search', [AppointmentController::class, 'search'])->name('appointments.search');


Route::get('/gettreatment/feed_data', [TreatmentController::class, 'getFeedData'])->name('treatment.feed');
Route::post('/treatment/patient_docs', [PatientDocsController::class, 'saveDocs'])->name('treatment.patient_docs');

Route::post('/invoice', [InvoiceController::class, 'create'])->name('invoice.create');
Route::get('/appointments/{appointment}/edit', [AppointmentController::class,'edit'])->name('appointments.edit');
Route::put('/appointments/{appointment}', [AppointmentController::class,'update'])->name('appointments.update');
Route::get('/new_appointment', [App\Http\Controllers\AppointmentController::class, 'new_appointment'])->name('appointment.new_appointment');

Route::resource('lead', App\Http\Controllers\LeadController::class);
Route::get('/converted-leads', [App\Http\Controllers\LeadController::class, 'converted_leads'])->name('lead.converted_leads');

Route::get('/getdoctors', [HomeController::class, 'getDoctors']);
Route::get('/getrelatedimage', [HomeController::class, 'getRelatedImage']);


});