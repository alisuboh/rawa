<?php

namespace App\Observers;

use App\Models\AdminRoleUsers;
use App\Models\ProvidersEmployee;
use App\Models\SysAdmin;
use Illuminate\Support\Str;

class EmployeeObserver
{
    /**
     * Handle the ProvidersEmployee "created" event.
     *
     * @param  \App\Models\ProvidersEmployee  $providersEmployee
     * @return void
     */
    public function created(ProvidersEmployee $providersEmployee)
    {

        if($providersEmployee->type == 1){
            $admin = new SysAdmin();
            $admin->username = $providersEmployee->full_name;
            $admin->email = 'email@email.com';
            $admin->password = $providersEmployee->password;
            $admin->active = $providersEmployee->status;
            $admin->name = $providersEmployee->full_name;
            $admin->phone_number = $providersEmployee->phone_number;
            $admin->driver_id = $providersEmployee->id;
            $admin->provider_id = $providersEmployee->provider_id;
            $admin->api_token = Str::random(60);
            $admin->save();
            $roles = new AdminRoleUsers(['user_id'=>$admin->id, 'role_id'=>3]);
            $admin->roles()->save($roles);
        }

        if(auth()->user()->provider_id){
            $providersEmployee->seq = $providersEmployee->getLastSeq();
             
        }
        
    }

    /**
     * Handle the ProvidersEmployee "updated" event.
     *
     * @param  \App\Models\ProvidersEmployee  $providersEmployee
     * @return void
     */
    public function updated(ProvidersEmployee $providersEmployee)
    {
        if($providersEmployee->type == 1){
            $admin = SysAdmin::where('driver_id','=',$providersEmployee->id)->first();
            if($admin){
                $admin->username = $providersEmployee->full_name;
                $admin->password = $providersEmployee->password;
                $admin->active = $providersEmployee->status;
                $admin->name = $providersEmployee->full_name;
                $admin->phone_number = $providersEmployee->phone_number;
                $admin->update();
            }
        }
    }

    /**
     * Handle the ProvidersEmployee "deleted" event.
     *
     * @param  \App\Models\ProvidersEmployee  $providersEmployee
     * @return void
     */
    public function deleted(ProvidersEmployee $providersEmployee)
    {
        //
    }

    /**
     * Handle the ProvidersEmployee "restored" event.
     *
     * @param  \App\Models\ProvidersEmployee  $providersEmployee
     * @return void
     */
    public function restored(ProvidersEmployee $providersEmployee)
    {
        //
    }

    /**
     * Handle the ProvidersEmployee "force deleted" event.
     *
     * @param  \App\Models\ProvidersEmployee  $providersEmployee
     * @return void
     */
    public function forceDeleted(ProvidersEmployee $providersEmployee)
    {
        //
    }
}
