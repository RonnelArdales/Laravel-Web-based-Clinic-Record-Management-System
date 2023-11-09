<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\StoreAddToCartRequest;
use App\Models\Addtocartservice;
use App\Models\AuditTrail;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(){
        $addtocarts =  DB::table('addtocartservices')->orderBy('created_at', 'desc')->paginate(4, ['*'], 'addtocart');
        $service = Service::all();
        $sum = Addtocartservice::sum('price');
        $patients =  DB::table('users')->where('usertype', 'patient')->where('status', 'verified')->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
        return view('admin_secretary.transaction', [
                                        'services' => $service, 
                                        'addtocarts'=> $addtocarts, 
                                        'sum'=>$sum,
                                        'patients'=>$patients, 
                ]);
    }

    public function store_addtocart(Request $request){

        $StoreAddToCartRequest = new StoreAddToCartRequest();
        $validator = Validator::make($request->all(), $StoreAddToCartRequest->rules(), $StoreAddToCartRequest->messages() );

        if($validator->fails())
        {
            return response()->json([
                'status'=>401,
                'errors'=> $validator->messages(),
            ]);

        }else{
            $input = $request->all();
            $addtocartexist = Addtocartservice::where('servicecode', $input['servicecode'])->first();
        
            if($addtocartexist){
                return response()->json([
                    'status' => 400,
                    'message' => 'The service is already added',
                ]);
            }else{
                
                Addtocartservice::create($input);
        
                return response()->json([
                    'status' => 200,
                    'message' => 'Added successfully',
                   
                ]);
            }
        }
    }
    public function store_billing(Request $request){

        if (Addtocartservice::count() == 0) {
            return response()->json(['status' => '400']);
        }else{

            $addtocart = Addtocartservice::all();
            
            (new TransactionService())->store($addtocart);

    
            return response()->json([
               'status' => 200,
               'message' => 'Saved successfully',
            ]);

        }
    }

    public function destroy( $id){

        Addtocartservice::where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted successfully',
        ]);

    }

    public function get_id(){
        $appointment = Transaction::max('transno');
        $total =  $appointment + 1;
        return response()->json([
            'id' => $total ,
           ]);
    }
}