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

        return response()->json([
            'Data' => $category,
            'Response' => response::HTTP_CREATED
        ]);
    }

    //edit category
    public function update($id, Request $request)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                "Data" => $category,
                "Response" => response::HTTP_NOT_FOUND,
            ]);
        }

        $validData = $request->validate(
            [
                'name' => 'required',
                'description' => 'required'

            ]
        );

        $updatedCategory = new Category($validData);

        //update the instance
        $category->update($validData);

        return response()->json([
            'Data' => $updatedCategory,
            'Response' => response::HTTP_OK,
        ]);

    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(
                [
                    'Data' => $category,
                    "Response" => response::HTTP_NOT_FOUND,
                ]
            );
        }

        //delete the instance
        $category->delete();
        return response()->json(response::HTTP_OK);

    }
}
