<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCat;
use Illuminate\Http\Request;

class ExpenseCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Expense Types';
        $campaigns = ExpenseCat::all();
        return view('admin.finance.expensescat.index', compact('campaigns', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Expense Type';
        return view('admin.finance.expensescat.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expenseType = new ExpenseCat;
        $expenseType->expence_type = $request->input('name');
        // Add any additional fields you need to save

        $expenseType->save();

        // Redirect to a success page or wherever you want to go
        
        return redirect()->route('expense_type.index')->with('success', 'Expense type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseCat  $expenseCat
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCat $expenseCat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseCat  $expenseCat
     * @return \Illuminate\Http\Response
     */
    public function edit($expenseCat)
    {
        
        $pageTitle = 'Edit Campaign';
        $expenseType = ExpenseCat::find($expenseCat);
        // You can also use "findOrFail" to automatically throw a 404 error if the expense type is not found
       
        // Render the edit form with the expense type data
        return view('admin.finance.expensescat.edit', compact('pageTitle','expenseType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseCat  $expenseCat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expenseType = ExpenseCat::find($id);
        $expenseType->expence_type = $request->input('name');
        // Update any additional fields you need

        $expenseType->save();

        // Redirect to a success page or wherever you want to go
        return redirect()->route('expense_type.index')->with('success', 'Expense type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseCat  $expenseCat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenseType = ExpenseCat::find($id);
        // You can also use "findOrFail" to automatically throw a 404 error if the expense type is not found

        // Delete the expense type
        $expenseType->delete();

        // Redirect to a success page or wherever you want to go
        return redirect()->route('expense_type.index')->with('success', 'Expense type deleted successfully');
    }
}
