<?php

namespace App\Http\Controllers;

use RouterOS\Client;
use Illuminate\Http\Request;

class MikrotikApiController extends Controller
{
    public function connect(){
        $client = new Client([
            'host' => '103.110.78.226',
            'user' => 'api',
            'pass' => 'atsadmin'
        ]);
    }
}
