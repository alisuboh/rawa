<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class MainResource extends JsonResource
{

    abstract public function combinedAttrs();

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (strpos($request->route()->getName(), 'index')) {
            return $this->indexAttrs();
        }
        return $this->showAttrs();
    }


    public function indexAttrs()
    {
        return $this->combinedAttrs();
    }

    public function showAttrs()
    {
        return $this->combinedAttrs();
    }
    /*
        public function withResponse($request, $response)
        {
            $response->header('X-Value', 'True');
        }*/
}
