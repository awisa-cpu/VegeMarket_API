<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    //fetch categories
    public function categories()
    {


        $categories = Category::all();

        return response()->json([
            'Data' => $categories,
            'response' => response::HTTP_OK,
        ]);
    }

    //create a category
    public function create(Request $request)
    {

        //validate data
        $validData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        //create a new category instance
        $category = new Category([
            'name' => $validData['name'],
            'description' => $validData['description'],
        ]);

        //save to db
        $category->save();

        return response()->json($category, response::HTTP_CREATED);
    }
}
