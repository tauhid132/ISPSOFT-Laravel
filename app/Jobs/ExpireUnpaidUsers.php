<?php

namespace App\Jobs;

use Carbon\Carbon;
use RouterOS\Query;
use RouterOS\Client;
use App\Models\Mikrotik;
use App\Models\SystemLog;
use App\Models\MonthlyBill;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use RahulHaque\AdnSms\Facades\AdnSms;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use RouterOS\Exceptions\ConnectException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use RouterOS\Exceptions\BadCredentialsException;

class ExpireUnpaidUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $today = Carbon::today()->toDateString();
        //Get Unpaid and API Enabled Users
        $year = request('year',date('Y'));
        $month = request('month',date('F'));
        $unpaid_invoices = MonthlyBill::with('user')->whereHas('user', function($query2) use($today){
            $query2->where('api_status',1)->where('expiry_date','<=', $today);
        })->where('billing_year', $year)
        ->where('billing_month',$month)->where('paid_monthly_bill', 0)->get();
        
        //Get Mikrotik Info
        $mikrotiks = Mikrotik::all();
        foreach($mikrotiks as $mikrotik){
            try{
                $client = new Client([
                    'host' => $mikrotik->host,
                    'user' => $mikrotik->username,
                    'pass' => $mikrotik->password
                ]);
                $clients[$mikrotik->name] = $client;
            }catch(BadCredentialsException $exp){
                dd('WrongPassword');
            }catch(ConnectException $exp){
                dd('Connection Error');
            }
            $query = (new Query('/ppp/secret/print'));
            
            $api_users[$mikrotik->name] = $client->query($query)->read();
            
            $query2 = (new Query('/ppp/active/print'));
            $active_connections[$mikrotik->name] = $client->query($query2)->read();
        }
        
        //Disable User
        foreach($unpaid_invoices as $unpaid){
            for($i=0; $i<sizeof($api_users[$unpaid->user->server->name]); $i++){
                if($api_users[$unpaid->user->server->name][$i]['name'] == Str::lower($unpaid->user->username)){
                    $query = (new Query('/ppp/secret/set'));
                    $query->equal('comment','Disabled By API');
                    $query->equal('disabled','yes');
                    $query->equal('.id', $i);
                    $client = $clients[$unpaid->user->server->name];
                    $client->query($query)->read();
                    break;
                }
            }
            //Remove From Active Connections
            for($i=0; $i<sizeof($active_connections[$unpaid->user->server->name]); $i++){
                if($active_connections[$unpaid->user->server->name][$i]['name'] == Str::lower($unpaid->user->username)){
                    $query = (new Query('/ppp/active/remove'));
                    $query->equal('.id', $i);
                    $client = $clients[$unpaid->user->server->name];
                    $client->query($query)->read();
                    break;
                }
            }
            //Profile Expire
            $unpaid->user->update([
                'status' => 2
            ]);
            //Send Notification
            $mobile = $unpaid->user->mobile_no;
            if($mobile != null){
                $response = AdnSms::to($mobile)
                ->message("প্রিয় গ্রাহক, আপনার বিল বকেয়া থাকার কারনে ইন্টারনেট সংযোগ বিচ্ছিন হয়ে গিয়েছে। পুনরায় সংযোগ চালু করতে বিল পরিশোধ করুন।")
                ->send();
            }
           
            //Add to Log
            $username = $unpaid->user->username;
            SystemLog::create([
                'module' => 'Accounts',
                'action_by' => null,
                'description' => "User: $username is Expired!"
            ]);
        }
    }
}
