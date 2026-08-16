<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        $photoUrl = $this->photo ? Storage::url($this->photo) : null;
        if ($photoUrl && app()->environment('local')) {
            $photoUrl = str_replace('/admin', '', $photoUrl);
        }

        return [
            'id' => $this->id,
            'organizer_name' => $this->user->name ?? 'Unknown',
            'name' => $this->name,
            'theme' => $this->theme,
            'description' => $this->description,
            'photo_url' => $photoUrl,
        ];
    }
}
