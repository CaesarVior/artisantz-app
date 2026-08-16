<?php

namespace App\Http\Controllers;

use App\Helpers\EventHelper;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\EventModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    public function __construct(private EventHelper $eventHelper) {}

    public function publicIndex(): View
    {
        $events = EventResource::collection(
            $this->eventHelper->getUpcomingActiveEvents()
        );

        return view('event', compact('events'));
    }

    public function index(): View
    {
        $events = EventResource::collection(
            $this->eventHelper->getAllPaginated()
        );

        return view('admin.pages.events.index', [
            'events' => $events,
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.events.create');
    }

    public function store(EventRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photos')) {
            $validatedData['photo'] = $this->eventHelper->uploadPhotos(
                $request->file('photos'),
                $validatedData['name']
            );

            unset($validatedData['photos']);
        }

        $userId = Auth::id() ?? 1;
        $this->eventHelper->createEvent($validatedData, $userId);

        return redirect()->route('admin-events')->with('success', 'Event berhasil dibuat.');
    }

    public function show(EventModel $event): View
    {
        $formattedEvent = (new EventResource($event))->resolve();

        return view('admin.pages.events.index', compact('formattedEvent'));
    }

    public function edit(int $id): View
    {
        $event = $this->eventHelper->getEventById($id);

        return view('admin.pages.events.update', compact('event'));
    }

    public function update(EventRequest $request, int $id): RedirectResponse
    {
        $event = $this->eventHelper->getEventById($id);
        $validatedData = $request->validated();

        if ($request->hasFile('photos')) {
            $validatedData['photo'] = $this->eventHelper->uploadPhotos(
                $request->file('photos'),
                $validatedData['name'] ?? $event->name
            );

            unset($validatedData['photos']);
        }

        $this->eventHelper->updateEvent($event, $validatedData);

        return redirect()->route('admin-events')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $event = $this->eventHelper->getEventById($id);

        if (! empty($event->photo)) {
            $photos = is_string($event->photo) ? json_decode($event->photo, true) : $event->photo;

            if (is_array($photos)) {
                $this->eventHelper->deletePhotos($photos);
            }
        }

        // Hapus record di database
        $this->eventHelper->deleteEvent($id);

        return redirect()->route('admin-events')->with('success', 'Event berhasil dihapus!');
    }
}
