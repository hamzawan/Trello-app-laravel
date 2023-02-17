<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "image" => $this->image,
            "expire_time" => $this->expire_time,
            "issue_type" => $this->issue_type,
            "status" => $this->status,
            "assignee" => $this->assignee,
            "assignor" => $this->assignor,
        ];
    }
}