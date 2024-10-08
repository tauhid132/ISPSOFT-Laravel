<?php

namespace App\Http\Controllers;

use RouterOS\Query;
use RouterOS\Client;
use App\Models\Mikrotik;
use App\Models\Reseller;
use App\Models\SystemLog;
use Illuminate\Support\Str;
use App\Models\ResellerUser;
use Illuminate\Http\Request;
use App\Models\ResellerPackage;
use App\Models\ResellerUserPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\BadCredentialsException;

class ResellerController extends Controller
{
    public function viewLogin(){
        return view('selfcare.resellers.login');
    }
    public function login(Request $request){
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        $credintials = $request->only('username', 'password');
        if(Auth::guard('reseller')->attempt($credintials)){
            $request->session()->regenerate();
            return redirect()->route('viewResellerDashboard');
        }
        return redirect()->route('resellerLogin')->withErrors('Incorrect Username Or Password');
    }
    public function logout(Request $request){
        Auth::guard('reseller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('resellerLogin');
    }
    public function viewResellerDashboard(){
        return view('selfcare.resellers.dashboard');
    }


    public function viewResellers(){
        return view('admin.crm.reseller.resellers');
    }
    public function getResellers(Request $request){
        $data = Reseller::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('viewResellerUsers',$row->id).'" class="btn btn-primary btn-sm me-1"><i class="fa fa-users me-1"></i>Users</a>';
            $btn = $btn.'<a href="'.route('editReseller',$row->id).'" class="btn btn-info btn-sm me-1"><i class="fa fa-edit me-1"></i>Edit</a>';
            $btn = $btn.'<a class="btn btn-danger btn-sm me-1 delete_reseller"><i class="fa fa-trash me-1"></i>Delete</a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 1){
                $btn = '<span class="badge bg-success"> Active</span>';
            }else if($row->status == 0){
                $btn = '<span class="badge bg-danger"> Inactive</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-warning">Expired</span>';
            }
            return $btn;
        })
        ->rawColumns(['action' => 'action', 'status' => 'status'])
        ->make(true);
    }

    public function viewAddNewReseller(){
        return view('admin.crm.reseller.add-new-reseller');
    }
    public function addNewReseller(Request $request){
        $new_reseller = Reseller::create([
            'status' => $request->status,
            'name' => $request->name,
            'contact_person' => $request->contact_person,
            'username' => $request->username,
            'password' => "1234",
            'email_address' => $request->email_address,
            'mobile_no' => $request->mobile_no,
            'reseller_type' => $request->reseller_type,
            'address' => $request->address,
            'monthly_bill' => $request->monthly_bill,
            'current_due' => $request->current_due,
        ]);
        return redirect()->route('viewResellers')->with('success', 'Reseller Added Successfully!');
    }
    public function deleteReseller(Request $request){
        Reseller::find($request->id)->delete();
    }
    public function viewEditReseller($id){
        return view('admin.crm.reseller.edit-reseller',[
            'reseller' => Reseller::find($id)
        ]);
    }
    public function editReseller(Request $request, $id){
        $reseller = Reseller::find($id); 
        $reseller->update([
            'status' => $request->status,
            'name' => $request->name,
            'contact_person' => $request->contact_person,
            'username' => $request->username,
            'password' => "1234",
            'email_address' => $request->email_address,
            'mobile_no' => $request->mobile_no,
            'reseller_type' => $request->reseller_type,
            'address' => $request->address,
            'monthly_bill' => $request->monthly_bill,
            'current_due' => $request->current_due,
        ]);
        return redirect()->route('viewResellers')->with('success', 'Reseller Updated Successfully!');
    }
    public function viewReseller($id){
        return view('admin.crm.reseller.view-reseller',[
            'reseller' => Reseller::find($id)
        ]);
    }
    public function viewResellerUsers($reseller_id){
        return view('admin.crm.reseller.reseller-users', [
            'reseller' => Reseller::find($reseller_id),
            'reseller_packages' => ResellerUserPackage::all(),
            'mikrotiks' => Mikrotik::all()
        ]);
    }

    public function getResellerUsers(Request $request, $reseller_id){
        $data = ResellerUser::with('package')->where('reseller_id', $reseller_id)->get();
        
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
            $query2 = (new Query('/ppp/secret/print'));
            
            $api_users[$mikrotik->id] = $client->query($query)->read();
            $api_users_secrets[$mikrotik->id] = $client->query($query2)->read();
        }

        

        
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        
        ->addColumn('action', function($row){
            $btn = '<a class="btn btn-info btn-sm me-1 edit_reseller_user" id="'.$row->id.'"><i class="fa fa-edit me-1"></i>Edit</a>';
            $btn = $btn.'<a class="btn btn-danger btn-sm me-1 delete_reseller_user" id="'.$row->id.'"><i class="fa fa-trash me-1"></i>Delete</a>';
            if($row->status == 1){
                $btn = $btn.'<a class="btn btn-danger btn-sm me-1 block_reseller_user" id="'.$row->id.'"><i class="fa fa-ban me-1"></i>Block</a>';
            }else if($row->status == 2){
                $btn = $btn.'<a class="btn btn-success btn-sm me-1 unblock_reseller_user" id="'.$row->id.'"><i class="fa fa-check me-1"></i>Unblock</a>';
            }
            
            
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 1){
                $btn = '<span class="badge bg-success"> Active</span>';
            }else if($row->status == 0){
                $btn = '<span class="badge bg-danger"> Inactive</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-warning">Expired</span>';
            }
            return $btn;
        })
        ->addColumn('online_status', function($row) use ($api_users){
            foreach($api_users[$row->api_server] as $api_user){
                if($api_user['name'] == $row->username){
                    return '<span class="badge bg-success"> Online</span>';
                    break;
                }
            }
            return '<span class="badge bg-danger"> Offline</span>';
        })
        ->addColumn('uptime', function($row) use ($api_users){
            foreach($api_users[$row->api_server] as $api_user){
                if($api_user['name'] == $row->username){
                    return $api_user['uptime'];
                    break;
                }
            }
            return '0';
        })
        ->addColumn('mik_password', function($row) use ($api_users_secrets){
            foreach($api_users_secrets[$row->api_server] as $api_user){
                if($api_user['name'] == $row->username){
                    return $api_user['password'];
                    break;
                }
            }
            return '0';
        })
        
        ->rawColumns(['action' => 'action', 'status' => 'status', 'online_status' => 'online_status', 'uptime' => 'uptime', 'mik_password' => 'mik_password'])
        ->make(true);
    }


    public function addEditResellerUser(Request $request, $reseller_id){
        if(empty($request->id)){
            ResellerUser::create([
                'username' => $request->username,
                'password' => $request->password,
                'status' => $request->status,
                'api_status' => $request->api_status,
                'api_server' => $request->api_server,
                'reseller_user_package_id' => $request->reseller_user_package_id,
                'reseller_id' => $request->reseller_id,
            ]);
        }else{
            $user = ResellerUser::find($request->id);
            $user->update([
                'username' => $request->username,
                'password' => $request->password,
                'status' => $request->status,
                'api_status' => $request->api_status,
                'api_server' => $request->api_server,
                'reseller_user_package_id' => $request->reseller_user_package_id,
                'reseller_id' => $request->reseller_id,
            ]);
        }
    }

    public function fetchResellerUser(Request $request){
        $reseller_user = ResellerUser::with('package')->where('id', $request->id)->first();
        return response()->json($reseller_user);
    }
    public function deleteResellerUser(Request $request){
        ResellerUser::destroy($request->id);
        SystemLog::create([
            'module' => 'Accounts',
            'action_by' => Auth::guard('admin')->user()->id,
            'description' => "Reseller User: $request->id Deleted."
        ]);
    }


    public function blockResellerUser(Request $request){
        $user = ResellerUser::find($request->id);
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
        
        $query2 = (new Query('/ppp/active/print'));
        $active_connections = $client->query($query2)->read();
        for($i=0; $i<sizeof($active_connections); $i++){
            if($active_connections[$i]['name'] == Str::lower($user->username)){
                $query = (new Query('/ppp/active/remove'));
                $query->equal('.id', $i);
                $client->query($query)->read();
                break;
            }
        }
        $user->update([
            'status' => 2
        ]);
    }

    public function unblockResellerUser(Request $request){
        $user = ResellerUser::find($request->id);
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

    public function syncMikrotik(){
        $client = new Client([
            'host' => '103.110.79.1',
            'user' => 'api',
            'pass' => 'atsadmin'
        ]);

        $query = (new Query('/ppp/secret/print'));
        $ppp_secrets = $client->query($query)->read();
        // dd($ppp_secrets);
        for($i=0; $i<sizeof($ppp_secrets); $i++){
            if(str_contains($ppp_secrets[$i]['name'], 'ats')){
                if($ppp_secrets[$i]['disabled'] == 'true'){
                    $status = 0;
                }else{
                    $status = 1;
                }
                ResellerUser::create([
                    'username' => $ppp_secrets[$i]['name'],
                    'reseller_id' => 1,
                    'password' => $ppp_secrets[$i]['password'],
                    'api_status' => 1,
                    'api_server' => 3,
                    'status' => $status,
                    'reseller_user_package_id' => 1
                ]);
            }

            
        }
    }




    //Reseller Panel Controllers
    public function viewMyUsers(){
        return view('selfcare.resellers.my-users',[
            'reseller' => Reseller::find(Auth::guard('reseller')->user()->id)
        ]);
    }

    public function getMyUsers(Request $request, $reseller_id){
        $data = ResellerUser::with('package')->where('reseller_id', $reseller_id)->get();
        
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
            $query2 = (new Query('/ppp/secret/print'));
            
            $api_users[$mikrotik->id] = $client->query($query)->read();
            $api_users_secrets[$mikrotik->id] = $client->query($query2)->read();
        }

        

        
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        
        ->addColumn('action', function($row){
            $btn = '<a class="btn btn-info btn-sm me-1 change_password" id="'.$row->id.'"><i class="fa fa-lock me-1"></i>Change Password</a>';
          
            if($row->status == 1){
                $btn = $btn.'<a class="btn btn-danger btn-sm me-1 block_reseller_user" id="'.$row->id.'"><i class="fa fa-ban me-1"></i>Block</a>';
            }else if($row->status == 2){
                $btn = $btn.'<a class="btn btn-success btn-sm me-1 unblock_reseller_user" id="'.$row->id.'"><i class="fa fa-check me-1"></i>Unblock</a>';
            }
            
            
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 1){
                $btn = '<span class="badge bg-success"> Active</span>';
            }else if($row->status == 0){
                $btn = '<span class="badge bg-danger"> Inactive</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-warning">Expired</span>';
            }
            return $btn;
        })
        ->addColumn('online_status', function($row) use ($api_users){
            foreach($api_users[$row->api_server] as $api_user){
                if($api_user['name'] == $row->username){
                    return '<span class="badge bg-success"> Online</span>';
                    break;
                }
            }
            return '<span class="badge bg-danger"> Offline</span>';
        })
        ->addColumn('uptime', function($row) use ($api_users){
            foreach($api_users[$row->api_server] as $api_user){
                if($api_user['name'] == $row->username){
                    return $api_user['uptime'];
                    break;
                }
            }
            return '0';
        })
        ->addColumn('mik_password', function($row) use ($api_users_secrets){
            foreach($api_users_secrets[$row->api_server] as $api_user){
                if($api_user['name'] == $row->username){
                    return $api_user['password'];
                    break;
                }
            }
            return '0';
        })
        
        ->rawColumns(['action' => 'action', 'status' => 'status', 'online_status' => 'online_status', 'uptime' => 'uptime', 'mik_password' => 'mik_password'])
        ->make(true);
    }
    public function changeResellerUserPassword(Request $request){
        $user = ResellerUser::find($request->id);
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
                $query->equal('password',$request->password);
                $query->equal('.id', $i);
                $client->query($query)->read();
                break;
            }
        }
    }
}
