<?php

namespace App\Admin\api;

use App\Http\Controllers\Controller;
use App\Models\ProvidersEmployee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\FlareClient\Api;




class DriverApiController extends Controller{
    public function drivers(Request $request){
        $q = $request->get("q");
        // dd($q);
        return ProvidersEmployee::where('full_name', 'like', "%$q%")->where('type','=',ProvidersEmployee::TYPE[1])->paginate(null, ['id', 'full_name as text']);
    }
}