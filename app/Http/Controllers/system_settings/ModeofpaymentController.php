<?php

namespace App\Http\Controllers\system_settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Modeofpayment;
use App\Services\system_settings\ModeofpaymentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ModeofpaymentController extends Controller
{

    public function index()
    {
        $mops = DB::table('modeofpayments')->orderBy('created_at', 'desc')->paginate(5);

        return view('system_settings.modeofpayment', compact('mops'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mop'=>'required',
            'image' => 'mimes:png,jpeg,jpg|max:3000',
        ],[
            'mop.required' => 'Name is required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);

        }else{

         $data = (new ModeofpaymentService())->store($request->only(['mop', 'image']), $request->file());

            return response()->json([
                'status' =>'success',
                'data' => $data,
            ]);
        }
    }
 
    public function edit($id)
    {
        $mop = Modeofpayment::where('id', $id)->first();
        return response()->json([
            'mop' => $mop,
        ]);
    }


    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mop'=>'required',
            'image' => 'mimes:png,jpeg,jpg|max:3000',
        ],[
            'mop.required' => 'Name is required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }else{

          $data = ( new ModeofpaymentService())->update($id, $request->only(['mop', 'image']), $request->file('image'));

            return response()->json([
                'status'=>200,
                'image' => $data,
            ]);
        }
    }

    public function destroy($id)
    {
        ( new ModeofpaymentService())->delete($id);

        return response()->json([
            'status'=> 200,
            'message'=> 'updated successfully',
        ]);
        
    }
}
