<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\Screening;
use App\Models\User;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ReservationResource::collection(Reservation::paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReservationStoreRequest $request
     * @return ReservationResource
     */
    public function store(ReservationStoreRequest $request)
    {
        $validated = $request->validated();
        $user = User::findOrFail($validated['user_id']);
        $screening = Screening::findOrFail($validated['screening_id']);

        $reservation = new Reservation($validated);
        $reservation->user()->associate($user);
        $reservation->screening()->associate($screening);
        $reservation->fill([
            'total_price' => $screening->price * $reservation->seats,
            'is_paid' => false
        ]);
        $reservation->save();

        return ReservationResource::make($reservation);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \App\Http\Resources\ReservationResource
     */
    public function show($uuid)
    {
        $reservation = Reservation::findOrFail($uuid);
        return ReservationResource::make($reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ReservationUpdateRequest $request
     * @param \App\Models\Reservation $reservation
     * @return \App\Http\Resources\ReservationResource
     */
    public function update(ReservationUpdateRequest $request, $uuid)
    {
        $validated = $request->validated();
        $reservation = Reservation::findOrFail($uuid);
        $reservation->update($validated);

        return ReservationResource::make($reservation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ReservationResource
     */
    public function destroy($uuid)
    {
        $reservation = Reservation::findOrFail($uuid);
        $reservation->delete();

        return ReservationResource::make($reservation);
    }
}

