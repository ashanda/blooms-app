<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Campaign';
        $campaigns = Campaign::all();
        return view('admin.campaigns.index', compact('campaigns', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Campaign';
        $agents = User::where('role_id', 5)->get();
        return view('admin.campaigns.create', compact('pageTitle', 'agents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campaign = new Campaign;
        $campaign->name = $request->input('name');
        $campaign->start_date = $request->input('start_date');
        $campaign->end_date = $request->input('end_date');
        $campaign->ad_id = uniqid(); // Generate a unique ad_id here, you can use any logic you prefer.

        // Save the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('/campaign_image'), $filename);
            $campaign->image = $filename;
        }

        $campaign->description = $request->input('description');
        $campaign->assigned_agent = $request->input('agent_id');
        $campaign->assign_budget = $request->input('assign_budget');
        $campaign->status = 1; // Assuming 1 represents the active status

        $campaign->save();

        // Assign an agent

        Alert::success('Success', 'Campaign created successfully.');
        return redirect()->route('campaigns.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Campaign';
        $campaign = Campaign::findOrFail($id);
        $agents = User::where('role_id', 5)->get();
        return view('admin.campaigns.edit', compact('pageTitle', 'campaign', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->name = $request->input('name');
        $campaign->start_date = $request->input('start_date');
        $campaign->end_date = $request->input('end_date');

        // Update the image if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('/campaign_image'), $filename);
            $campaign->image = $filename;
        }

        $campaign->description = $request->input('description');
        $campaign->assigned_agent = $request->input('agent_id');
        $campaign->assign_budget = $request->input('assign_budget');

        $campaign->save();

        Alert::success('Success', 'Campaign updated successfully.');
        return redirect()->route('campaigns.index');
    }


    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);

        // Delete the campaign image if it exists
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }

        // Remove the association with the agent


        $campaign->delete();
        Alert::warning('Delete', 'Campaign deleted successfully.');
        return redirect()->route('campaigns.index');
    }


    public function getRelatedImage(Request $request)
    {
        $campaignId = $request->input('campaignId');
        // Get the URL or image path based on the campaign ID
        $campaign = Campaign::find($campaignId);
        $imagePath = $campaign->$campaign;
        // Retrieve the image path or URL based on the campaign ID
        return $imagePath;
    }
}
