<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Modeofpayment;
use App\Models\Transaction;
use App\Services\BillingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return (new BillingService())->getBillingForDatatable();
        }
        return view('admin_secretary.billing', [
            'discounts' =>Discount::all(),
            'mops' =>Modeofpayment::all(),
        ]);
    }

    public function edit($id){
        
        $billing = Transaction::where('transno', $id)->first();
    
        return response()->json(['data' => $billing]);
    
    }

    public function update($id ,Request $request){
        
        $validator = Validator::make($request->all(), [
                'mode_of_payment' => 'required'
            ],[
                'mode_of_payment.required'=>'Mode of payment is required',
            ]);

        if($validator->fails()) {
            return response()->json([
            'status' => 400,
            'errors' => $validator->errors()
            ]);
        }else{
            $input = $request->all();
            if($input['mode_of_payment'] == "Cash"){
                $validator = Validator::make($request->all(), [
                    'payment'=>'required|gte:total',
                ],[
                    'payment.required'=> 'Payment  is required',
                ]);

               
            }else{
                $validator = Validator::make($request->all(), [
                    'reference_no'=>'required',
                ],[
                    'reference_no.required'=> 'Reference no is required',
                ]);

            }

            if($validator->fails()) {
                return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
                ]);
            }else{

                (new BillingService())->update($id, $request->all());
            }

        }
    }

    public function destroy($id){
              
        (new BillingService())->delete($id);

        return response()->json($id);
    }

    public function view_billing($id){
        $infos = Transaction::with('user')->where('transno', $id)->first();

        $services = Transaction::where('transno', $id)->get();
      
        if(Auth::user()->usertype === "admin"){
            return view('admin.viewBilling', compact('services', 'infos'));
        }else{
            return view('secretary.viewBilling', compact('services', 'infos'));
        }
       
    }
}

