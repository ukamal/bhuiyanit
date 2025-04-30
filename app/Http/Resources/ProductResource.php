<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'text' => $this->die .' '.$this->item_description,
            'die' => $this->die,
            'item_description' => $this->item_description,
            'unit' => $this->unit,
            'product_type' => $this->product_type,
            'size' => $this->size,
            'thickness' => $this->thickness,
            'color' => $this->color,
            'silver_rate' => $this->silver_rate,
            'bronze_rate' => $this->bronze_rate,
            'ss_rate' => $this->ss_rate,
            'other_rate' => $this->other_rate,
        

        ];
    }
}
