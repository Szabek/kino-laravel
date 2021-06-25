<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Http\Resources\MovieResource;
use App\Models\Category;
use App\Models\Movie;
use App\services\PictureService;

class MovieController extends Controller
{

    public $pictureService;

    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return MovieResource::collection(Movie::paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MovieStoreRequest $request
     * @return MovieResource
     */
    public function store(MovieStoreRequest $request)
    {
        $validated = $request->validated();
        $category = Category::findOrFail($validated['category_id']);

        $pictureSource = request('picture')->store('uploads', 'public');
        $this->pictureService->resizePicture($pictureSource, 800, 1200);

        $movie = new Movie($validated);
        $movie->fill([
            'picture_source' => $pictureSource
        ]);
        $movie->category()->associate($category);

        $movie->save();

        return MovieResource::make($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Movie $movie
     * @return MovieResource
     */
    public function show(Movie $movie)
    {
        return MovieResource::make($movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\MovieUpdateRequest $request
     * @param \App\Models\Movie $movie
     * @return MovieResource
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        $validated = $request->validated();


        if ($request->picture) {
            $pictureSource = request('picture')->store('uploads', 'public');
            $this->pictureService->resizePicture($pictureSource, 800, 1200);
            $this->pictureService->removePicture($movie->picture_source);
            $movie->fill([
                'picture_source' => $pictureSource
            ]);
        }

        $movie->update($validated);
        return MovieResource::make($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Movie $movie
     * @return MovieResource
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return MovieResource::make($movie);
    }
}
