<?php

namespace App\Observers;

use App\Models\Provider;
use App\Models\SysAdmin;
use App\Models\AdminRoleUsers;
use Illuminate\Support\Str;


class AdminObserver
{
    /**
     * Handle the Provider "created" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function created(Provider $provider)
    {
        $admin = new SysAdmin();
        $admin->username = $provider->name;
        $admin->email = $provider->email;
        $admin->password = $provider->password;
        $admin->active = $provider->status;
        $admin->name = $provider->commercial_name??$provider->name;
        $admin->phone_number = $provider->contact_mobile??$provider->contact_phone;
        $admin->provider_id = $provider->id;
        $admin->api_token = Str::random(60);
        $admin->save();
        $roles = new AdminRoleUsers(['user_id'=>$admin->id, 'role_id'=>2]);
        $admin->roles()->save($roles);
        
    }

    /**
     * Handle the Provider "updated" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function updated(Provider $provider)
    {
        $admin = SysAdmin::where('provider_id','=',$provider->id)->first();
        if($admin){
            $admin->username = $provider->name;
            $admin->email = $provider->email;
            $admin->password = $provider->password;
            $admin->active = $provider->status;
            $admin->name = $provider->commercial_name??$provider->name;
            $admin->phone_number = $provider->contact_mobile??$provider->contact_phone;
            $admin->update();
        }
        
    }

    /**
     * Handle the Provider "deleted" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function deleted(Provider $provider)
    {
        $admin = SysAdmin::where('provider_id','=',$provider->id);
        if($admin)
            $admin->delete();
    }
}
