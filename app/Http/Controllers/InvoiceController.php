<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\CustomerTreatment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create(Request $request){
        //Convert Customer
        $customer = Customer::where('customer_id',$request->customer_id)->first();
        $convert = Appointment::where('appointment_id', $request->appoinment_id)->first();

        if($customer){
           
        }else{
        
        $customer = new Customer();
        $customer->customer_id = $request->customer_id;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        
        $customer->save();
        }
        
       // Appoinment Status Change
        $convert = Appointment::where('appointment_id', $request->appoinment_id)->first();

        if ($convert) {
            if($convert->source  != 'Front Office') {
                $convert->status = 'converted';
            }else{
                $convert->status = 'sucess';
            }
            
            $convert->save();
        }

        //Customer Treatment Table Record
        $customer = new CustomerTreatment();
        $customer->appoinment_id = $request->appoinment_id;
        $customer->customer_id = $request->customer_id;
        $customer->assistant = $request->assistant;
        $customer->doctor_id = $convert->doctor_id;
        $customer->treatment = $request->treatment;
        $customer->appointment_date_time = $convert->appointment_date_time;
        $customer->save();


        // Invoice and print
        $random_number = '#' . mt_rand(100000, 999999);
        $invoice = new Invoice();
        $invoice->invoice_id = $random_number;
        $invoice->appoinment_id = $request->appoinment_id;
        $invoice->total = $request->total;
        $invoice->payment_type = $request->paymentMethod;
        $invoice->pay_amount = $request->payamount;
        $invoice->balance = $request->balance;
        $invoice->treatment = $request->treatment;
        $invoice->issued_by = Auth::user()->name;
        $invoice->status = 'settled';
        $invoice->save();

        return view('print', ['invoice' => $invoice]);
    }


}
