<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class ReqeustController extends Controller
{

    public function details(Request $request)
    {
       $req = ModelsRequest::findOrFail($request->id);
       if($req && $req->status == 'active'){
            return view('livewire.requests.reqeust-details', ['request' => $req]);
       }
    }
}
