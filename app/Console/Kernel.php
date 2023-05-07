<?php

namespace App\Console;

use App\Mail\Appointmentreminder;
use App\Mail\Bookappointment;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('appointment:reminder')->dailyAt('00:01')->dailyAt('18:00');

        // $schedule->call(function () {
        //     $appointments = Appointment::where('date', Carbon::tomorrow())->get();

        //     foreach ($appointments as $appointment) {
        //         $fullname = $appointment->fullname;
        //         $time = $appointment->time;
        //         Mail::to($appointment->email)->send(new Appointmentreminder($fullname, $time));
        //     }
            
        // })->daily('23:16');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
