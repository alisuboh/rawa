<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
// dd($this->customer);
        return [
            'id' => $this->id,
            'name' => $this->full_name,
            'order_products' => $this->order_products,
            'customer' => CustomerResource::make($this->customer),
            'provider_id' => $this->provider_id,
            'phone_number' => $this->phone_number,
            'total_price' => $this->total_price,

            'note' => $this->note,
            'price' => $this->price,
            'order_delivery_date' => $this->order_delivery_date,
            // 'customer_address_id' => $this->customer_address_id,



            // 'secret' => $this->when($request->user()->isAdmin(), 'secret-value'),
            // 'secret' => $this->when($request->user()->isAdmin(), function () {
            //     return 'secret-value';
            // }),
            // 'name' => $this->whenNotNull($this->name),
            // $this->mergeWhen($request->user()->isAdmin(), [
            //     'first-secret' => 'value',
            //     'second-secret' => 'value',
            // ]),
            // 'posts' => PostResource::collection($this->whenLoaded('posts')),
            // 'expires_at' => $this->whenPivotLoaded('role_user', function () {
            //     return $this->pivot->expires_at;
            // }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
