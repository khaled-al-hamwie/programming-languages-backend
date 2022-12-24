<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use function PHPSTORM_META\map;

class ExpertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'expert_id' => (string)$this->expert_id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'rating' => $this->rating,
            'openning_time' => $this->openning_time,
            'experience' => array_map(function ($experience) {
                return [
                    'experience_id' => (string) $experience->experience_id,
                    'name' => $experience->name, 'details' => $experience->details
                ];
            }, json_decode($this->experiences))
        ];
    }
}
