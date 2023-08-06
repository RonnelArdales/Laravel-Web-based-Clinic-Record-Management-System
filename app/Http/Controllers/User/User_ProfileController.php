<?php

namespace App\Http\Controllers\User;
use App\http\Controllers\Controller;
use App\Http\Requests\Patient\UpdateInfoPatientRequest;
use App\Models\BusinessHour;
use App\Models\Consultationfile;
use App\Models\Dayoff_date;
use App\Models\User;
use App\Services\system_settings\ProfileService;
use App\Services\User\User_ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class User_ProfileController extends Controller
{
    protected $User_ProfileService;

    public function __construct(User_ProfileService $User_ProfileService){
        $this->User_ProfileService = $User_ProfileService;
    }

    public function index(){
        $days = BusinessHour::getBusinessHour();
        $walkins = BusinessHour::select('day')->where('off', '1')->where('appointment_method', 'walkin')->groupBy('day')->get();
        $dates = Dayoff_date::getDayoff_date();
        $day = BusinessHour::select('day', 'off')->distinct()->get();

        $documents = Consultationfile::where('user_id', Auth::user()->id)->get();
        $appointments = DB::table('appointments')->where('user_id',  Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);

        $day_array = [];
        $date_array = [];
        
        foreach($dates as $date){
            $date_array[] = $date->date;
        }
        foreach($days as $day){
            $day_array[] = date('w', strtotime($day->day));
        }

        $walkin_array = [];
        foreach ($walkins as $walkin){
            $walkin_array[] = date('w', strtotime($walkin->day));
        } 

       
        return view('patient.profile.index', compact('documents', 'appointments'))->with('day_array', $day_array)->with('walkin_array', $walkin_array)->with('date_array', $date_array);
    }

    public function edit(User $user){
        return view('patient.profile.editprofile');
    }

    public function update(UpdateInfoPatientRequest $request, $id){

        if($request->input('old_password') || $request->input('password') || $request->input('password_confirmation')){
            if(!password_verify($request->input('old_password'), Auth::user()->password)){
                return redirect()->back()->with('error', 'The password did not match with the current password.');
            }else{
                $validated = $request->validate([
                    "password" => 'required|confirmed|min:8',
                ], [
                    'password.required' => 'Password is required',
                    'password.confirmed' => 'Password did not match',
                ] );
            }
        }
        

        $this->User_ProfileService->update($request->validated(), $id);

        return redirect()->route('profile.index')->with('success', 'Updated successfully');
    }

    public function image_profile_update($id, Request $request){
        $validated = $request->validate([
            "profilepic" => 'required|mimes:png,jpg,jpeg',
 
        ],[
            "profilepic" =>'The picture must be a file of type: png, jpg, jpeg.'
        ]);

        (new ProfileService())->update_profilepic($request->only('profilepic'));

        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function view_document($id){

        $document = Consultationfile::where('id', $id)->first();

        return response()->json(['document' => $document]);

    }
}
