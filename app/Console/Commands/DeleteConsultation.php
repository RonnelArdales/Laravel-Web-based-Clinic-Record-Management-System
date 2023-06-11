<?php

namespace App\Console\Commands;

use App\Models\Consultation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteConsultation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:consultation';

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

        $tenYears = Carbon::now()->subYears(10);

        $latestConsultations = DB::table('consultations')
        ->select('user_id', DB::raw('MAX(created_at) as latest_created_at'))
        ->groupBy('user_id')
        ->having('latest_created_at', '<=', $tenYears)
        ->get();
    
        foreach ($latestConsultations as $user) {
            Consultation::where('user_id', $user->user_id)
              ->delete();

              User::where('id', $user->user_id)->delete();
              
        }
      

        return Command::SUCCESS;
    }
}
