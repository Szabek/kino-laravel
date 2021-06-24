<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return RoomResource::collection(Room::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoomStoreRequest $request
     * @return RoomResource
     */
    public function store(RoomStoreRequest $request)
    {
        $room = Room::create($request->validated());

        return RoomResource::make($room);
    }

    /**
     * Display the specified resource.
     *
     * @param Room $room
     * @return RoomResource
     */
    public function show(Room $room)
    {
        return RoomResource::make($room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoomUpdateRequest $request
     * @param Room $room
     * @return RoomResource
     */
    public function update(RoomUpdateRequest $request, Room $room)
    {
        $room->update($request->validated());

        return RoomResource::make($room);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Room $room
     * @return RoomResource
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return RoomResource::make($room);
    }
}
