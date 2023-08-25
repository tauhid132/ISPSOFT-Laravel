<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MonthlyBill;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToArray;
use RahulHaque\AdnSms\Facades\AdnSms;

class SMSController extends Controller
{
    public function viewReminderSms(){
        return view('admin.sms.bill-reminder',[
            'service_areas' => ServiceArea::all(),
        ]);
    }
    public function fetchReminderSmsUsers(Request $request){
        $area = request('selectedArea','all');
        $users = MonthlyBill::where('billing_month',date('F'))
        ->where('billing_year',date('Y'));
        if($area != 'all'){
            $users = $users->whereHas('user', function($query2) use ($area){
                $query2->where('service_area_id',$area);
            });
        }
        $users = $users->get();
        return response()->json([
            'html' => view('admin.sms.fetch-bill-reminder-users',[
                'users' => $users
                ])->render()
            ]);
    }
    public function checkSmsBalance()
    {
        $res = AdnSms::checkBalance();
        $res = array($res);
        return response()->json($res);
    }
    public function sendReminderSms(Request $request){
        if($request->reminderType == "reminder"){
            foreach($request->id as $user_id){
                $user = User::where('id',$user_id)->first();
                $username = $user->username;
                $response = AdnSms::to($user->mobile_no)
                ->message("Dear user, Please pay your Internet Bill. bKash Payment: 01304779899. Reference:$username - ATS Technology ")
                ->send();
            }
        }else if($request->reminderType == "warning"){
            foreach($request->id as $user_id){
                $user = User::where('id',$user_id)->first();
                $username = $user->username;
                $response = AdnSms::to($user->mobile_no)
                ->message("Dear user, Today is last day of bill payment. Please pay your Internet Bill. bKash Payment: 01304779899. Reference:$username - ATS Technology ")
                ->send();
            } 
        }
       
        return $request->reminderType;
    }

}
