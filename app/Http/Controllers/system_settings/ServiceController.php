<?php

namespace App\Http\Controllers\system_settings;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\AuditTrailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index(){
        $service = DB::table('services')->paginate(8);
        return view('system_settings.service', ['services' => $service]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'servicename'=>'required',
            'price' =>'required',
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
            $service = new Service;
            $service->services = $request->input('servicename');
            $service->price = $request->input('price');
            $service->save();

            (new AuditTrailService())->store("Create new service");

            return response()->json([
                'status'=>200,
                'message' => 'Added successfully',
            ]);
        }
    }

    public function edit($id){
        $service = Service::where('servicecode', $id )->get();
        if($service){
            return response()->json([
                'status'=>200,
                'service' => $service,
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
            'servicename'=>'required',
            'price' =>'required',
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
            $update = Service::where('servicecode', $id)->update([ "services" => $request->input('servicename'),
                                                                    "price" => $request->get('price'),
                                                                ]);

            (new AuditTrailService())->store("Update service");

            if($update){
                return response()->json([
                    'status'=>200,
                        'message' => 'service updated successfully',
                    
                ]);
            }else{
                return response()->json([
                    'status'=>400,
                        'message' => 'service updated unsuccessfully',
                    
                ]);
            }
        }
    }

    public function destroy($id){
        Service::where('servicecode', $id)->delete();

        (new AuditTrailService())->store("Delete service");

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }

    public function get_service($id){
        $service = Service::where('servicecode', $id)->first();
        return response()->json([
            'service' => $service,
        ]);
    }
}
