<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderProductRequest;
use App\Http\Resources\ProviderProductResource;
use App\Models\ProviderProduct;

class ProviderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $perPage = request()->get('perPage');
        return ProviderProductResource::collection(ProviderProduct::where('provider_id', '=', auth()->user()->provider_id)->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ProviderProductRequest $request)
    {
        if($request->validated()){
            $data = $request->all();
            if(!empty($request->has('img'))){
                $getImage = $request->img;
                $imageName = time().'.'.$getImage->extension();
                $imagePath = public_path(). '/storage/images';
                $getImage->move($imagePath, $imageName);
                $full_name = "images/".$imageName;
                $data['icon_path'] = $full_name;
                unset($data['img']);
            }
            return new ProviderProductResource(ProviderProduct::create($data));
   
        }else
            return new ProviderProductResource(ProviderProduct::create($request->validate()));
        
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProviderProduct $providerProduct
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ProviderProduct $providerProduct)
    {
        return new ProviderProductResource($providerProduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProviderProduct $providerProduct
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProviderProductRequest $request, ProviderProduct $providerProduct)
    {
        $providerProduct->update($request->validated());
        return new ProviderProductResource($providerProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProviderProduct $providerProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderProduct $providerProduct)
    {
        $providerProduct->delete();
    }
}
