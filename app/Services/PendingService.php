<?php

namespace App\Services;

use App\Mail\Approveaccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PendingService {

    public function getDataForDatatables()
    {
        $data = DB::table('users')->where('status', 'pending')->orderBy('created_at', 'desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($event) {
                $date = Carbon::parse($event->created_at);
                return $date->format('M j, Y H:i A');
            })
            ->addColumn('action', function ($row) {
                $btn = '<button class="verify btn btn-sm btn-primary" style="text-align:center" data-id="' . $row->id . '">Verify</button>';
                return $btn;
            })
            ->addColumn('fullname', function ($row) {
                return $row->fname . ' ' . $row->lname;
            })
            ->rawColumns(['action', 'fullname'])
            ->make(true);
    }

    public function update($data){

        $user = User::where('id', $data)->first();
        $user->status = "verified";
        $user->save();

        Mail::to($user->email)->send(new Approveaccount);

        (new AuditTrailService())->store('Verify');

        return $user;

    }
}