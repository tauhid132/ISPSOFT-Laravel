<?php

namespace App\Http\Controllers;

use App\Models\PaymentGatewayPayment;
use Illuminate\Http\Request;

class PaymentGatewayPaymentController extends Controller
{
    public function viewPaymentGatewayPayments(){
        return view('admin.accounts.payment-gateway-payments');
    }
    public function getPaymentGatewayPayments(){
        $data = PaymentGatewayPayment::with('invoice.user')->latest()->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        ->addColumn('action', function($row){
            $btn ='<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_package m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete_package m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
       
        
        ->rawColumns(['action' => 'action'])
        ->make(true);
    }
}
