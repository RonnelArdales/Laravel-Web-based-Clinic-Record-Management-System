<?php

namespace App\Console\Commands;

use App\Mail\Appointmentreminder;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AppointmentReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Running appointment reminder command...');
        $appointments = Appointment::where('date', Carbon::tomorrow())->get();

        foreach ($appointments as $appointment) {
            $fullname = $appointment->fullname;
            $time = $appointment->time;
            Mail::to($appointment->email)->send(new Appointmentreminder($fullname, $time));
        }
        return Command::SUCCESS;
    }
}
