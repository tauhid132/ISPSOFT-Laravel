<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SystemLog;
use App\Models\MonthlyBill;
use App\Models\ServiceArea;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RahulHaque\AdnSms\Facades\AdnSms;
use Maatwebsite\Excel\Concerns\ToArray;

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
        ->where('billing_year',date('Y'))->where('paid_monthly_bill', 0);
        if($area != 'all'){
            $users = $users->whereHas('user', function($query2) use ($area){
                $query2->where('service_area_id',$area);
            });
        }
        $users = $users->whereHas('user', function($query2) use ($area){
            $query2->where('mobile_no',null)->orWhere('mobile_no', '!=', '');
        });
        $users = $users->get();
        return response()->json([
            'html' => view('admin.sms.fetch-bill-reminder-users',[
                'users' => $users
                ])->render()
            ]);
    }
    public function checkSmsBalance()
    {
        $response = AdnSms::checkBalance();
        
        return $response['balance']['sms'];
    }
    public function sendReminderSms(Request $request){
        if($request->reminderType == "reminder"){
            foreach($request->id as $user_id){
                $user = User::where('id',$user_id)->first();
                $username = $user->username;
                $response = AdnSms::to($user->mobile_no)
                ->message("Dear user, Please pay your Internet Bill. bKash Payment: 01304779899. Reference:$username - ATS Technology ")
                ->send();
                SystemLog::create([
                    'module' => 'Accounts',
                    'action_by' => Auth::guard('admin')->user()->id,
                    'description' => "Reminder SMS-1 Sent to $username."
                ]);
            }
        }else if($request->reminderType == "warning"){
            foreach($request->id as $user_id){
                $user = User::where('id',$user_id)->first();
                $username = $user->username;
                $response = AdnSms::to($user->mobile_no)
                ->message("প্রিয় গ্রাহক, আজ বিল প্রদানের শেষ দিন। নিরবিচ্ছিন্ন ইন্টারনেট ব্যাবহারে আপনার ইন্টারনেট বিল পরিশোধ করুন। বিকাশ পেমেন্টঃ 01304779899. ধন্যবাদ - ATS Technology")
                ->send();
                SystemLog::create([
                    'module' => 'Accounts',
                    'action_by' => Auth::guard('admin')->user()->id,
                    'description' => "Reminder SMS-2 Sent to $username."
                ]);
            } 
        }
       
        return $request->reminderType;
    }

    public function viewSingleSmsSender(){
        return view('admin.sms.single-sms',[
            'templates' => SmsTemplate::all()
        ]);
    }
    public function sendSingleSms(Request $request){
        return AdnSms::to($request->mobile_no)
                ->message($request->sms_body)
                ->send();
    }
}
