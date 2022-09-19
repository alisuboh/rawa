<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SysAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Encore\Admin\Controllers\AuthController as BaseAuthController;


class AuthController extends BaseAuthController
{

    public function login(Request $request)
    {
        $request['phone_number'] = $request->get($this->username());
        if (!$this->guard()->attempt($request->only('username', 'password')))
        {
            if(!$this->guard()->attempt($request->only(['phone_number', 'password'])))
                return response()
                    ->json(['message' => 'These credentials do not match our records'], 401);
        }

        $admin = SysAdmin::where('username', $request['username'])->orWhere('phone_number', $request['phone_number'])->firstOrFail();

        $token = $admin->createToken('auth_token')->plainTextToken;
        $data = array_merge($admin->toArray(),['role'=>$admin->roles[0]->slug,'access_token' => $token, 'token_type' => 'Bearer']);

        return response()
            ->json(['data'=>$data ]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
    public function validateToken(Request $request)
    {
        if (! $request->user() || ! $request->user()->currentAccessToken()) {
            return false;
        }
        return true;


    }

    public function ChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        SysAdmin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   


    }

}
