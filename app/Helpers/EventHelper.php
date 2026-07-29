<?php

namespace App\Helpers;

use App\Models\EventModel;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EventHelper
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return EventModel::with('user')->latest()->paginate($perPage);
    }

    public function getEventById(int $id): EventModel
    {
        return EventModel::findOrFail($id);
    }

    public function createEvent(array $data, int $userId): EventModel
    {
        $data['user_id'] = $userId;

        return EventModel::create($data);
    }

    public function updateEvent(EventModel $event, array $data): bool
    {
        return $event->update($data);
    }

    public function deleteEvent(int $id): bool
    {
        $event = $this->getEventById($id);

        // Hapus foto terkait jika ada
        if ($event->photo) {
            $this->deletePhotos($event->photo);
        }

        return $event->delete();
    }

    public function uploadPhotos(array $files, string $title): array
    {
        if (empty($files)) {
            return [];
        }

        $paths = [];
        $slug = Str::slug($title);
        $timestamp = date('Ymd_His');

        $fileList = is_array($files) ? $files : [$files];
        $fileList = array_reverse($fileList);

        foreach ($fileList as $index => $file) {
            $extension = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = Str::slug($originalName);

            $sequence = sprintf('%02d', $index + 1);
            $filename = "{$timestamp}_{$sequence}_{$sanitizedName}.{$extension}";

            $file->move(public_path("event/{$slug}"), $filename);

            $paths[] = "event/{$slug}/{$filename}";
        }

        return $paths;
    }

    public function deletePhotos(?array $paths): void
    {
        if (is_array($paths)) {
            foreach ($paths as $path) {
                $fullPath = public_path($path);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
            }
        }
    }

    public function getUpcomingActiveEvents()
    {
        $now = Carbon::now();

        return EventModel::where('event_date', '>=', $now)
            ->where('event_date', '<=', $now->copy()->addDays(7))
            ->orderBy('event_date', 'asc')
            ->get();
    }
}
