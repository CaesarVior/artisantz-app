<?php

namespace App\Http\Controllers;

use App\Helpers\EventHelper;
use App\Http\Resources\EventResource;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    protected $eventHelper;

    public function __construct(EventHelper $eventHelper)
    {
        $this->eventHelper = $eventHelper;
    }

    public function index()
    {
        // 1. Wrap hasil dari helper menggunakan EventResource::collection
        $events = EventResource::collection(
            $this->eventHelper->getUpcomingActiveEvents()
        );

        // 2. Ambil event pertama dari collection
        $event = $events->first();

        $bannerImg = asset('img/event-banner.webp'); // Default fallback

        if ($event) {
            // Karena $event berupa JsonResource/Arrayable, aman akses via property $event->name
            $slug = Str::slug($event->name);
            $folderPath = public_path("event/{$slug}");

            // 3. Cek folder fisik & ambil foto urutan pertama (_01_)
            if (file_exists($folderPath) && is_dir($folderPath)) {
                $files = array_diff(scandir($folderPath), ['.', '..']);

                if (! empty($files)) {
                    sort($files); // Mengurutkan file dari _01_
                    $firstPhoto = reset($files);
                    $bannerImg = asset("event/{$slug}/{$firstPhoto}");
                }
            }
        }

        return view('home', compact('event', 'bannerImg'));
    }
}
