<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'appointment_id' => $this->appointment_id,
            'appointment_address' => $this->appointment_address,
            'origin_addresses' => $this->origin_addresses,
            'post_code' => $this->post_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'appointment_date' => $this->appointment_date,
            'appointment_date' => $this->appointment_date,
            'distance' => $this->distance,
            'duration' => ($this->duration / 60) ,
            'estimated_time_out_of_office' => $this->estimated_time_out_of_office,
            'available_time_at_the_office' => $this->available_time_at_the_office
        ];
    }
}
