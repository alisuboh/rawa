<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebPermissionRequest;
use App\Http\Resources\WebPermissionResource;
use App\Models\WebPermission;

class WebPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $role_ids =auth()->user()->roles()->pluck('id');
        $permissions = [];
        $final_per=[];
        foreach($role_ids as $role_id){
            $permissions = array_merge($permissions,WebPermission::where('role_id', 'like',  '%'.$role_id.'%')->pluck('name')->toArray()) ;


        }
        $final_per =array_unique($permissions, SORT_REGULAR);

        return ['data' => $final_per];
        // return WebPermissionResource::collection(WebPermission::paginate());
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function get()
    {
        return WebPermissionResource::collection(WebPermission::paginate());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(WebPermissionRequest $request)
    {
        return new WebPermissionResource(WebPermission::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\WebPermission $webPermission
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(WebPermission $webPermission)
    {
        return new WebPermissionResource($webPermission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\WebPermission $webPermission
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(WebPermissionRequest $request, WebPermission $webPermission)
    {
        $webPermission->update($request->validated());
        return new WebPermissionResource($webPermission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\WebPermission $webPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebPermission $webPermission)
    {
        $webPermission->delete();
    }
}
