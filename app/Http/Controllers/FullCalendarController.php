<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Appointment;
use Illuminate\Http\Request;

use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Appointment::all();
            return response()->json($data);
    	}
    	return view('full-calender');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Appointment::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Appointment::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Appointment::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
}
