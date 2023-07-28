<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\ExpenseCat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Expense ';
        $campaigns = Expenses::all();
        return view('admin.finance.expense.index', compact('campaigns', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Expense';
        $expenseTypes = ExpenseCat::all();
        return view('admin.finance.expense.create', compact('pageTitle', 'expenseTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expenseType = new Expenses;
        $expenseType->expenses_type = $request->input('expense_type');
        $expenseType->amount = $request->input('amount');
        $expenseType->date = $request->input('date');
        // Add any additional fields you need to save

        $expenseType->save();

        Alert::success('Success', 'Expense Add successfully');
        // Redirect to a success page or wherever you want to go
        return redirect()->route('expense.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Expense';
        $expenseType = Expenses::find($id);
        $expenseTypes = ExpenseCat::all();
        // You can also use "findOrFail" to automatically throw a 404 error if the expense type is not found

        // Render the edit form with the expense type data
        return view('admin.finance.expense.edit', compact('expenseType', 'expenseTypes', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expenseType = Expenses::find($id);
        $expenseType->expenses_type = $request->input('expense_type');
        $expenseType->amount = $request->input('amount');
        $expenseType->date = $request->input('date');
        // Update any additional fields you need

        $expenseType->save();

        Alert::success('Success', 'Expense updated successfully');
        // Redirect to a success page or wherever you want to go
        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenseType = Expenses::find($id);
        // You can also use "findOrFail" to automatically throw a 404 error if the expense type is not found

        // Delete the expense type
        $expenseType->delete();

        Alert::warning('Delete', 'Expense deleted successfully');
        // Redirect to a success page or wherever you want to go
        return redirect()->route('expense.index');
    }
}
