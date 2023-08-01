<?php

namespace App\Http\Controllers;

use App\Models\Guestpage;
use App\Services\system_settings\GuestpageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GuestpageController extends Controller
{
    public function index(){
            $content = Guestpage::all();
            return view('system_settings.guestpage', ['guestpages' => $content]);
    }

    public function edit(Guestpage $guestpage){
        return view('system_settings.edit_guestpage', ['guestpages' => $guestpage]);
    }

    public function update(Guestpage $guestpage, Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'bail|mimes:img,jpg,png|max:3000'
        ],[
            'image.mimes'=>'the file must be a image',
        ])->stopOnFirstFailure(true);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }else{

            $data = (new GuestpageService())->update($guestpage, $request->all(), $request->image);

            if(Auth::user()->usertype === "admin"){
                return redirect()->route('admin.guestpage.index')->with('success', 'updated Successfully');
            }else{
                return redirect()->route('secretary.guestpage.index')->with('success', 'updated Successfully');
            }
        }
    }
}
