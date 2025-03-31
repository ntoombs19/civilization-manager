<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CivilizationData extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            // ... existing code ...
            
            // Add leader data
            'leader' => $this->whenLoaded('leader', function() {
                return [
                    'id' => $this->leader->id,
                    'name' => $this->leader->name,
                    // Other leader attributes you want to include
                ];
            }),
        ];
    }
} 