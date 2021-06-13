<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Http\Resources\MovieResource;
use App\Models\Category;
use App\Models\Movie;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return MovieResource::collection(Movie::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return MovieResource
     */
    public function store(MovieStoreRequest $request)
    {
        $validated = $request->validated();

        $pictureSource = request('picture')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$pictureSource}"))->fit(800, 1200);
        $image->save();

        $movie = Movie::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'description' => $validated['description'],
            'trailer' => $validated['trailer'],
            'release_date' => $validated['release_date'],
            'picture_source' => $pictureSource
        ]);
        $category = Category::find($validated['category_id']);
        $movie->category->associate($category);

        $movie->save();

        return MovieResource::make($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return MovieResource
     */
    public function show(Movie $movie)
    {
        return MovieResource::make($movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return MovieResource
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        $validated = $request->validated();
        $movie->update($validated);                             //TODO: image handling

        return MovieResource::make($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return MovieResource
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return MovieResource::make($movie);
    }
}
