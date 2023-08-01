<?php

namespace App\Http\Controllers\system_settings;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Services\AuditTrailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{

    public function index(){
        $data = Discount::get();
        return view('system_settings.discount', ['discounts' => $data]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'discountname'=>'required',
            'percentage' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {

            Discount::create($request->only(['discountname', 'percentage']));

            (new AuditTrailService())->store('Create new discount');

            return response()->json([
                'status'=>200,
                'message' => 'discount added successfully',
            ]);
        }
    }

    public function edit($id){

        $discount = Discount::where('discountcode', $id )->get();
        if($discount){
            return response()->json([
                'status'=>200,
                'discount' => $discount,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message' => 'discount not found',
            ]);
        }
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'discountname'=>'required',
            'percentage' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {

            Discount::where('discountcode', $id)->update($request->only(['discountname', 'percentage']));

            (new AuditTrailService())->store('Update Discount');

            return response()->json([
                'status'=>200,
                'message' => 'discount updated successfully',
                
            ]);

        }
    }

    public function destroy($id){
        
        Discount::where('discountcode', $id)->delete();

        (new AuditTrailService())->store('Delete Discount');

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }
    
    public function get_discount($id){
        
        $discount = Discount::where('discountcode', $id)->first();

        return response()->json([
            "status" => '200',
            "discount" => $discount,
        ]);
 
    }
}
