<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'All Staff';
        $staff = User::where('role_id', '!=', '1')
            ->get();
        return view('admin.staff.index', ['staff' => $staff])->with('pageTitle', $pageTitle);
    }

    public function create()
    {
        $pageTitle = 'Create Staff';
        $roles = Role::where('name', '!=', 'patient')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.staff.create', ['roles' => $roles])->with('pageTitle', $pageTitle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => Rule::requiredIf($request->role_id == '2'),
            'phone_number' => ['required', 'numeric', 'min:8'],
            'role_id' => 'required',
            'nic' => ['required', 'string', 'max:20'],
            'salary' => ['required', 'numeric', 'min:0'],
            'joining_date' => ['required', 'date', 'before_or_equal:' . Carbon::now()->format('Y-m-d')],
        ]);

        $image = $this->imgHandle($request);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), //FIXME: gen random temp password to change on email request
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'role_id' => $request->role_id,
            'nic' => $request->nic,
            'salary' => $request->salary,
            'joining_date' => $request->joining_date,
        ]);

        Alert::success('Success', 'Member registered successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'Show Staff';
        $staff = User::find($id);
        return view('admin.staff.delete', ['staff' => $staff])->with('pageTitle', $pageTitle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Staff';
        $staff = User::find($id);
        $roles = Role::where('name', '!=', 'patient')
            ->get();

        return view('admin.staff.edit', ['staff' => $staff, 'roles' => $roles])->with('pageTitle', $pageTitle);
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
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        'gender' => Rule::requiredIf($request->role_id == '2'),
        'phone_number' => ['required', 'numeric', 'min:8'],
        'role_id' => 'required',
        'nic' => ['required', 'string', 'max:20'],
        'salary' => ['required', 'numeric', 'min:0'],
        'joining_date' => ['required', 'date', 'before_or_equal:' . Carbon::now()->format('Y-m-d')],
    ]);

    $staff = User::find($id);

    $staff->update([
        'name' => $request->name,
        'email' => $request->email,
        'gender' => $request->gender,
        'phone_number' => $request->phone_number,
        'role_id' => $request->role_id,
        'nic' => $request->nic,
        'salary' => $request->salary,
        'joining_date' => $request->joining_date,
    ]);

    Alert::success('Success', 'Member updated successfully!');
    return redirect()->route('staff.index');
}

    private function imgHandle(Request $request)
    {
        $img = $request->file('image');

        if ($img == null)
            return;

        $image = Hash::make($img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
        $image = str_replace('/', '', $image);
        $img->move((public_path('images')), $image);

        return $image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id)
            abort(401);

        $staff = User::find($id);
        $staff->delete();
        Alert::success('Success', 'Member deleted successfully!');
        return redirect()->route('staff.index');
    }
}
