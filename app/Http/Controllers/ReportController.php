<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
class ReportController extends Controller
{
    public function index(){
        $pageTitle = 'Income Report';
        $invoices = Invoice::where('status','settled')->get();
        return view('admin.finance.incomes.index',compact('invoices','pageTitle'));
    }
}
