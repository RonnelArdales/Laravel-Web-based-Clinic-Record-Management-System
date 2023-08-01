<?php

namespace App\Services;

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;

class AuditTrailService {

    public function store($activity){

        AuditTrail::create([
                'user_id' => Auth::user()->id,
                'username' => Auth::user()->username,
                'activity' => $activity,
                'usertype' => Auth::user()->usertype,
        ]);

    }
}