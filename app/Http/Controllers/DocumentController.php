<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\StoreDocumentRequest;
use App\Models\Consultationfile;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
   protected $documentService;
   
   public function __construct(DocumentService $documentService){
      $this->documentService = $documentService;
   }

   public function index(Request $request) {
      if ($request->ajax()) {
         return $this->documentService->getDocumentforDatatable();
      }
      return view('admin.document');
   }

   public function store(Request $request){

      $StoreDocumentRequest = new StoreDocumentRequest();

      $validator = Validator::make($request->all(), $StoreDocumentRequest->rules(), $StoreDocumentRequest->messages());

      if($validator->fails())
      {
         return response()->json([
             'status'=>400,
             'errors'=> $validator->messages(),
         ]);

      }else{
     
         $user = $this->documentService->store($request->all());

         return response()->json([
             'status' =>'success',
             'data' => $user,
         ]);
      }
   }

   public function edit($id){
      $document = Consultationfile::where('id', $id)->first();
      return response()->json([
          'document' => $document,
      ]);
   }

   public function update($id, Request $request){

      $validator = Validator::make($request->all(), [
         'doc_type' => 'required',
         'pdf' => 'mimes:pdf|max:3000',
      ],[
         'pdf.mimes'=>'the file must be a pdf',
         'doc_type.required'=>'File description is required',
      ]);

      if($validator->fails()){
         return response()->json([
               'status'=>400,
               'errors'=> $validator->messages(),
         ]);
      }else{
         $this->documentService->update($id, $request->all(), $request->file('pdf'));
      }
   }

   public function destroy($id){
      
      $this->documentService->destroy($id);

      return response()->json([
          'status'=>200,
          'message' => 'Deleted successfully',
      ]);
   }

   public function fetch_success_appointment(Request $request){

      if ($request->ajax()) {
         return $this->documentService->getSuccessAppointmentforDatatable();
      }
      
   }


}
