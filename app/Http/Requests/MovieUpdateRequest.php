<?php

namespace App\Http\Requests;

class MovieUpdateRequest extends MovieStoreRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required',
            'description' => 'required',
            'trailer' => 'required',
            'release_date' => 'required',
            'picture' => 'image'
        ];
    }
}

