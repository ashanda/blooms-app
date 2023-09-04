<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SmsSendtodayCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_sms_today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDateTime = Carbon::now();
        $appointmentDateTime2 = $currentDateTime;
        $formattedDate2 = $appointmentDateTime2->format('Y-m-d');

        $get_day_remainings = DB::table('appointments')->where('status','ongoing')->whereDate('appointment_date_time','=',$formattedDate2)->get();
        foreach($get_day_remainings as $get_one_day_remaining){
            
            $formattedDateTime = Carbon::parse($get_one_day_remaining->appointment_date_time)->format('g:ia');
            $message = ''.$get_one_day_remaining->prefix.'.'.$get_one_day_remaining->customer_name.', Your medical appointment is TODAY at Bloom Skin Clinic '.$formattedDateTime.'' ;
            sendSMS($get_one_day_remaining->customer_phone,$message);
			//dd($message);
        }
    }
}
