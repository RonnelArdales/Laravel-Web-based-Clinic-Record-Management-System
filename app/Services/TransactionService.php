<?php

namespace App\Services;

use App\Models\Addtocartservice;
use App\Models\Transaction;

class TransactionService {

    public function store($datas){
        $sum = Addtocartservice::sum('price');

        foreach ($datas as $data) {
            $billing = new Transaction();
            $billing->transno = $data['transno'];
            $billing->user_id = $data['user_id'];
            $billing->fullname = $data['fullname'];
            $billing->servicecode = $data['servicecode'];
            $billing->service = $data['service'];
            $billing->price = $data['price'];
            $billing->sub_total = $sum;
            $billing->total = $sum;
            $billing->status = 'Pending';
            $billing->save();
        }

        Addtocartservice::truncate();  

        (new AuditTrailService())->store('Create transaction');
    }

}