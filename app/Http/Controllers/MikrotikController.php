<?php

namespace App\Http\Controllers;

use RouterOS\Query;
use App\Models\User;
use RouterOS\Client;
use App\Models\Mikrotik;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        try{
            $client = new Client([
                'host' => '103.110.78.234',
                'user' => 'api',
                'pass' => 'atsadmin'
            ]);
        }catch(BadCredentialsException $exp){
            dd('WrongPassword');
        }catch(ConnectException $exp){
            dd('Connection Error');
        }
        $query =
    (new Query('/ppp/secret/print'));

$response = $client->query($query)->read();
        
        dd($response);
        
    }

    public function viewApiUsers(){
        return view('admin.mikrotik.api-users');
    }

    public function getApiUsers(Request $request){
        $data = User::with('api_server')->where('api_status', 1)->get();
        try{
            $client = new Client([
                'host' => '103.110.78.234',
                'user' => 'api',
                'pass' => 'atsadmin'
            ]);
        }catch(BadCredentialsException $exp){
            dd('WrongPassword');
        }catch(ConnectException $exp){
            dd('Connection Error');
        }
        $query = (new Query('/ppp/active/print'));
        $api_users['home_server'] = $client->query($query)->read();
        
        
    
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
            
            $btn = '<a><button id="'.$row->id.'" class="btn btn-sm btn-primary block_user m-1"><i class="fa fa-ban"></i> Block</button></a>';
            
            return $btn;
        })
        ->addColumn('status', function($row) use ($api_users){
            foreach($api_users['home_server'] as $api_user){
                if($api_user['name'] == $row->username){
                    return '<span class="badge bg-success"> Online</span>';
                    break;
                }
            }
            return '<span class="badge bg-danger"> Offline</span>';
        })
        ->addColumn('uptime', function($row) use ($api_users){
            foreach($api_users['home_server'] as $api_user){
                if($api_user['name'] == $row->username){
                    return $api_user['uptime'];
                    break;
                }
            }
            return '0';
        })
        ->rawColumns(['action' => 'action', 'status' => 'status', 'account_status' => 'account_status','uptime' => 'uptime'])
        ->make(true);
    }

    public function blockUser(Request $request){
        $user = User::find($request->id);
        $client = new Client([
            'host' => '103.110.78.234',
            'user' => 'api',
            'pass' => 'atsadmin'
        ]);
        $query = (new Query('/ppp/secret/print'));
        $ppp_secrets = $client->query($query)->read();
        for($i=0; $i<sizeof($ppp_secrets); $i++){
            if($ppp_secrets[$i]['name'] == Str::lower($user->username)){
                $query = (new Query('/ppp/secret/set'));
                $query->equal('comment','Disabled By API');
                $query->equal('disabled','yes');
                $query->equal('.id', $i);
                return $client->query($query)->read();
                break;
            }
        }
        
    }
}
