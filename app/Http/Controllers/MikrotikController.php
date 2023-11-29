<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use RouterOS\Query;
use App\Models\User;
use RouterOS\Client;
use App\Models\Mikrotik;
use App\Models\MonthlyBill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ExpireUnpaidUsers;
use Illuminate\Support\Facades\Auth;
use RahulHaque\AdnSms\Facades\AdnSms;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\BadCredentialsException;

class MikrotikController extends Controller
{
    public function viewMikrotiks(){
        return view('admin.mikrotik.mikotiks');
    }
    public function getMikrotiks(Request $request){
        $data = Mikrotik::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $btn = '<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_mikrotik m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete_mikrotik m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            try{
                $config = new Client([
                    'host' => $row->host,
                    'user' => $row->username,
                    'pass' => $row->password
                ]);
                return $btn = '<span class="badge bg-success"> Online</span>';
            }catch(BadCredentialsException $exp){
                return $btn = '<span class="badge bg-danger"> Offine</span>';
            }catch(ConnectException $exp){
                return $btn = '<span class="badge bg-danger"> Offine</span>';
            }
            return 1;
        })
        ->rawColumns(['action' => 'action', 'status' => 'status'])
        ->make(true);
    }
    public function addEditMikrotik(Request $request){
        if(empty($request->id)){
            Mikrotik::create([
                'name' => $request->name,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
            ]);
        }else{
            $mikrotik = Mikrotik::find($request->id);
            $mikrotik->update([
                'name' => $request->name,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
            ]);
        }
    }
    public function fetchMikrotik(Request $request){
        return response()->json(Mikrotik::find($request->id));
    }
    public function deleteMikrotik(Request $request){
        Mikrotik::find($request->id)->delete();
    }
    
    public function connect(){
        $mikrotiks = Mikrotik::all();
        foreach($mikrotiks as $mikrotik){
            try{
                $client = new Client([
                    'host' => $mikrotik->host,
                    'user' => $mikrotik->username,
                    'pass' => $mikrotik->password
                ]);
            }catch(BadCredentialsException $exp){
                dd('WrongPassword');
            }catch(ConnectException $exp){
                dd('Connection Error');
            }
            $query = (new Query('/ppp/secret/print'));
            
            $api_users[$mikrotik->name] = $client->query($query)->read();
        }
        
        
        dd($api_users['Home Server'][546]);
        
    }
    
    public function viewApiUsers(){
        return view('admin.mikrotik.api-users');
    }
    
    public function getApiUsers(Request $request){
        $data = User::with('server')->where('api_status', 1)->get();
        $mikrotiks = Mikrotik::all();
        foreach($mikrotiks as $mikrotik){
            try{
                $client = new Client([
                    'host' => $mikrotik->host,
                    'user' => $mikrotik->username,
                    'pass' => $mikrotik->password
                ]);
            }catch(BadCredentialsException $exp){
                dd('WrongPassword');
            }catch(ConnectException $exp){
                dd('Connection Error');
            }
            $query = (new Query('/ppp/active/print'));
            
            $api_users[$mikrotik->name] = $client->query($query)->read();
        }
        
        
        
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('account_status', function($row){
            if($row->status == 1){
                $btn = '<span class="badge bg-success"> Active</span>';
            }else if($row->status == 0){
                $btn = '<span class="badge bg-danger"> Inactive</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-warning">Expired</span>';
            }
            return $btn;
        })
        ->addColumn('action', function($row){
            
            $btn = '<a><button id="'.$row->id.'" class="btn btn-sm btn-warning block_user m-1"><i class="fa fa-ban"></i> Block</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-success unblock_user m-1"><i class="fa fa-check"></i> Unblock</button></a>';
            return $btn;
        })
        ->addColumn('validity', function($row){
            $expiry_date = Carbon::parse($row->expiry_date);
            $now = Carbon::now();
            
            $diff = $now->diffInDays($expiry_date);
            if($now->lt($expiry_date)){
                return '<i class="fa fa-edit me-1 text-success change_expiry_date" id="'.$row->id.'"></i>Expired '.$diff.' days back';
            }else{
                return '<i class="fa fa-edit me-1 text-success change_expiry_date" id="'.$row->id.'"></i>Expires in '.$diff.' days';
            }
            
        })
        ->addColumn('status', function($row) use ($api_users){
            foreach($api_users[$row->server->name] as $api_user){
                if($api_user['name'] == $row->username){
                    return '<span class="badge bg-success"> Online</span>';
                    break;
                }
            }
            return '<span class="badge bg-danger"> Offline</span>';
        })
        ->addColumn('uptime', function($row) use ($api_users){
            foreach($api_users[$row->server->name] as $api_user){
                if($api_user['name'] == $row->username){
                    return $api_user['uptime'];
                    break;
                }
            }
            return '0';
        })
        ->rawColumns(['action' => 'action', 'status' => 'status', 'account_status' => 'account_status','uptime' => 'uptime','validity' => 'validity'])
        ->make(true);
    }
    
    public function blockUser(Request $request){
        $user = User::find($request->id);
        $mikrotik = Mikrotik::find($user->api_server);
        $client = new Client([
            'host' => $mikrotik->host,
            'user' => $mikrotik->username,
            'pass' => $mikrotik->password
        ]);
        $query = (new Query('/ppp/secret/print'));
        $ppp_secrets = $client->query($query)->read();
        for($i=0; $i<sizeof($ppp_secrets); $i++){
            if($ppp_secrets[$i]['name'] == Str::lower($user->username)){
                $query = (new Query('/ppp/secret/set'));
                $query->equal('comment','Disabled By API');
                $query->equal('disabled','yes');
                $query->equal('.id', $i);
                $client->query($query)->read();
                break;
            }
        }
        $user->update([
            'status' => 2
        ]);
        if($user->mobile_no != null){
            $response = AdnSms::to($user->mobile_no)
            ->message("প্রিয় গ্রাহক, আপনার বিল বকেয়া থাকার কারনে ইন্টারনেট সংযোগ বিচ্ছিন হয়ে গিয়েছে। পুনরায় সংযোগ চালু করতে বিল পরিশোধ করুন।")
            ->send();
        }
        
    }
    public function unblockUser(Request $request){
        $user = User::find($request->id);
        $mikrotik = Mikrotik::find($user->api_server);
        $client = new Client([
            'host' => $mikrotik->host,
            'user' => $mikrotik->username,
            'pass' => $mikrotik->password
        ]);
        $query = (new Query('/ppp/secret/print'));
        $ppp_secrets = $client->query($query)->read();
        for($i=0; $i<sizeof($ppp_secrets); $i++){
            if($ppp_secrets[$i]['name'] == Str::lower($user->username)){
                $query = (new Query('/ppp/secret/set'));
                $query->equal('comment','');
                $query->equal('disabled','no');
                $query->equal('.id', $i);
                $client->query($query)->read();
                break;
            }
        }
        $user->update([
            'status' => 1
        ]);
    }
    
    public function autoExpireUsers(){
        // $today = Carbon::today()->toDateString();
        // //Get Unpaid and API Enabled Users
        // $year = request('year',date('Y'));
        // $month = request('month',date('F'));
        // $unpaid_invoices = MonthlyBill::with('user')->whereHas('user', function($query2) use($today){
            //     $query2->where('api_status',1)->where('expiry_date','<=', $today);
            // })->where('billing_year', $year)
            // ->where('billing_month',$month)->where('paid_monthly_bill', 0)->get();
            
            // dd($unpaid_invoices);
            // //Get Mikrotik Info
            // $mikrotiks = Mikrotik::all();
            // foreach($mikrotiks as $mikrotik){
                //     try{
                    //         $client = new Client([
                        //             'host' => $mikrotik->host,
                        //             'user' => $mikrotik->username,
                        //             'pass' => $mikrotik->password
                        //         ]);
                        //         $clients[$mikrotik->name] = $client;
                        //     }catch(BadCredentialsException $exp){
                            //         dd('WrongPassword');
                            //     }catch(ConnectException $exp){
                                //         dd('Connection Error');
                                //     }
                                //     $query = (new Query('/ppp/secret/print'));
                                
                                //     $api_users[$mikrotik->name] = $client->query($query)->read();
                                
                                //     $query2 = (new Query('/ppp/active/print'));
                                //     $active_connections[$mikrotik->name] = $client->query($query2)->read();
                                // }
                                
                                // //Disable User
                                // foreach($unpaid_invoices as $unpaid){
                                    //     for($i=0; $i<sizeof($api_users[$unpaid->user->server->name]); $i++){
                                        //         if($api_users[$unpaid->user->server->name][$i]['name'] == Str::lower($unpaid->user->username)){
                                            //             $query = (new Query('/ppp/secret/set'));
                                            //             $query->equal('comment','Disabled By API');
                                            //             $query->equal('disabled','yes');
                                            //             $query->equal('.id', $i);
                                            //             $client = $clients[$unpaid->user->server->name];
                                            //             $client->query($query)->read();
                                            //             break;
                                            //         }
                                            //     }
                                            //     //Remove From Active Connections
                                            //     for($i=0; $i<sizeof($active_connections[$unpaid->user->server->name]); $i++){
                                                //         if($active_connections[$unpaid->user->server->name][$i]['name'] == Str::lower($unpaid->user->username)){
                                                    //             $query = (new Query('/ppp/active/remove'));
                                                    //             $query->equal('.id', $i);
                                                    //             $client = $clients[$unpaid->user->server->name];
                                                    //             $client->query($query)->read();
                                                    //             break;
                                                    //         }
                                                    //     }
                                                    //     //Profile Expire
                                                    //     $unpaid->user->update([
                                                        //         'status' => 2
                                                        //     ]);
                                                        //     //Send Notification
                                                        //     $response = AdnSms::to('01304779899')
                                                        //         ->message("Dear user, Please pay your Internet Bill. bKash Payment: 01304779899.ATS Technology ")
                                                        //         ->queue();
                                                        // }
                                                        
                                                        // dd($today);
                                                        dispatch(new ExpireUnpaidUsers);
                                                    }
                                                    
                                                    
                                                }
                                                