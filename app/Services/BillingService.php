<?php

namespace App\Services;

use App\Models\Transaction;
use DataTables;
use Illuminate\Support\Facades\Auth;

class BillingService {

    public function getBillingForDatatable(){
        $data = Transaction::getBilling();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->status == "Pending"){
                        if(Auth::user()->usertype == "admin"){
                            $btn = '<button type="button" data-id="' . $row->transno . '" class="payment btn  btn-success btn-sm">Pay now</button>';
                            $btn = $btn.'<a href="/admin/billing/viewBilling/ ' . $row->transno . ' " class="btn btn-primary btn-sm" style="margin-left:5px"    >View</a>';
                            $btn = $btn.'<button  style="margin-left:5px" class="delete btn btn-sm btn-danger" data-id="' . $row->transno . '">Delete</button>';
                            $size = '<div style="width: 200px">' . $btn . '</div>';                
                            return $size;
                        }else{
                            $btn = '<button type="button" data-id="' . $row->transno . '" class="payment btn  btn-success btn-sm">Pay now</button>';
                            $btn = $btn.'<a href="/secretary/billing/viewBilling/ ' . $row->transno . ' " class="btn btn-primary btn-sm" style="margin-left:5px"    >View</a>';
                            $btn = $btn.'<button  style="margin-left:5px" class="delete btn btn-sm btn-danger" data-id="' . $row->transno . '">Delete</button>';
                            $size = '<div style="width: 200px">' . $btn . '</div>';                
                            return $size;
                        }
                        
                       
                    }else{
                        if(Auth::user()->usertype == "admin"){
                            $btn = ' <a href="/admin/billing/viewBilling/' . $row->transno . '" class="btn btn-primary btn-sm">View</a>';
                            $btn = $btn.'<button  style="margin-left:5px" class="delete btn btn-sm btn-danger" data-id="' . $row->transno . '">Delete</button>';
                            $size = '<div style="width: 200px">' . $btn . '</div>';                
                            return $size;
                        }else{
                            $btn = ' <a href="/secretary/billing/viewBilling/' . $row->transno . '" class="btn btn-primary btn-sm">View</a>';
                            $btn = $btn.'<button  style="margin-left:5px" class="delete btn btn-sm btn-danger" data-id="' . $row->transno . '">Delete</button>';
                            $size = '<div style="width: 200px">' . $btn . '</div>';                
                            return $size;
                        }
                    }

                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function update($id, $data){
        Transaction::where('transno', $id)->update([
            'discount' => $data['discountname'],
            'discount_price' => $data['discountprice'],
            'total' => $data['total'],
            'mode_of_payment' => $data['mode_of_payment'],
            'reference_no' => $data['reference_no'],
            'payment' => floor($data['payment']),  
            'change' => floatval(str_replace(',', '', $data['change'])),
            'status' => "Paid",             
                    ]);

        (new AuditTrailService())->store('Update transaction');
    }

    public function delete($id){
        $transaction = Transaction::where('transno', $id)->delete();

        (new AuditTrailService())->store('Delete transaction');

    }


}