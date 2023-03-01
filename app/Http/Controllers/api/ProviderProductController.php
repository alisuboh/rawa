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
        $all = request()->get('all');
        if($all){
            return ProviderProductResource::collection(ProviderProduct::where('provider_id', '=', auth()->user()->provider_id)->paginate($perPage));

        }else{
            return ProviderProductResource::collection(ProviderProduct::where('provider_id', '=', auth()->user()->provider_id)->where("is_active",1)->paginate($perPage));

        }
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
                $imageName = time().'.'.$getImage->getClientOriginalExtension();
                $imagePath = public_path(). '/storage/images';
                // var_dump($getImage->getClientOriginalExtension());die;
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
    public function show($id)
    {
        $providerProduct = ProviderProduct::findOrFail($id); 
        return new ProviderProductResource($providerProduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ProviderProductRequest $request
     * @param \App\Models\ProviderProduct $providerProduct
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProviderProductRequest $request, $id)
    {
        $request->request->remove('_method');
        $providerProduct = ProviderProduct::findOrFail($id);
        $providerProduct->update($request->validated());

        return new ProviderProductResource($providerProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProviderProduct $providerProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $providerProduct = ProviderProduct::findOrFail($id);
        $providerProduct->delete();
    }
}
