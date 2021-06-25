<?php


namespace App\services;


use App\Models\Category;

class CategoryDeleteService
{
    public function deleteCategory(Category $category)
    {
        return ($category->movies()->exists()) ? false : $category->delete();
    }

    public function passStatus(bool $isDeleted)
    {
        if ($isDeleted) {
            return response()->json([
                'status' => 1,
                'message' => 'success'
            ]);
        }
        return response()->json([
            'status' => 0,
            'message' => 'fail'
        ]);
    }

}
