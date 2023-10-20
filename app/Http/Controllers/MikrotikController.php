<?php

namespace App\Http\Controllers;

use RouterOS\Query;
use RouterOS\Client;
use App\Models\Mikrotik;
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

// Send query and read response from RouterOS
$response = $client->query($query)->read();
        
        dd($response);
        
    }
}
