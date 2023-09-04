<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SmsSendCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_sms_reminder';

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
        $appointmentDateTime = $currentDateTime->addDays(2);
        $formattedDate = $appointmentDateTime->format('Y-m-d');


        

        $get_two_day_remainings = DB::table('appointments')->where('status','ongoing')->whereDate('appointment_date_time','=',$formattedDate)->get();
		foreach($get_two_day_remainings as $get_two_day_remaining){
            
            $formattedDateTime = Carbon::parse($get_two_day_remaining->appointment_date_time)->format('jS F, g:ia (l)');
            $message = ''.$get_two_day_remaining->prefix.'.'.$get_two_day_remaining->customer_name.', reminder on your medical appointment in two days at Bloom Skin Clinic '.$formattedDateTime.'' ;
            sendSMS($get_two_day_remaining->customer_phone,$message);
			//dd($message);
        }

        
    }
}
