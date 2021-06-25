<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScreeningStoreRequest;
use App\Http\Requests\ScreeningUpdateRequest;
use App\Http\Resources\ScreeningResource;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Screening;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ScreeningResource::collection(Screening::paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScreeningStoreRequest $request
     * @return ScreeningResource
     */
    public function store(ScreeningStoreRequest $request)
    {
        $validated = $request->validated();
        $movie = Movie::findOrFail($validated['movie_id']);
        $room = Room::findOrFail($validated['room_id']);

        $screening = new Screening($validated);
        $screening->movie()->associate($movie);
        $screening->room()->associate($room);
        $screening->save();

        return ScreeningResource::make($screening);
    }

    /**
     * Display the specified resource.
     *
     * @param Screening $screening
     * @return ScreeningResource
     */
    public function show(Screening $screening)
    {
        return ScreeningResource::make($screening);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ScreeningUpdateRequest $request
     * @param \App\Models\Screening $screening
     * @return ScreeningResource
     */
    public function update(ScreeningUpdateRequest $request, Screening $screening)
    {
        $screening->update($request->validated());

        return ScreeningResource::make($screening);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Screening $screening
     * @return ScreeningResource
     */
    public function destroy(Screening $screening)
    {
        $screening->delete();

        return ScreeningResource::make($screening);
    }
}
