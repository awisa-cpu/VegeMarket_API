<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    //retrive products
    public function products()
    {
        $products = Product::all();
        return response()->json($products, response::HTTP_OK);

    }


    //readproduct 
    public function product($productId)
    {
        //get the data
        $product = Product::find($productId);

        //check if found
        if (!$product) {
            return response()->json(
                [
                    'message' => "product with id: $productId not found",
                    'response' => $product
                ]
            );
        }

        return response()->json($product, response::HTTP_OK);

    }
    //create product
    function createProduct(Request $request)
    {

        //validate the entries
        $validData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'weight' => 'required',
            'category_id' => 'required'

        ]);

        $product = new Product(
            [
                'name' => $validData['name'],
                'description' => $validData['description'],
                'price' => $validData['price'],
                'image' => $validData['image'],
                'weight' => $validData['weight'],
                'category_id' => $validData['category_id']
            ]
        );

        $product->save();

        return response()->json($product, Response::HTTP_CREATED);
    }




    //updateProduct
    public function update($id, Request $request)
    {
        //fetch the data
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Data not found',
                'data' => $product,
            ]);
        }

        //validate the data
        $validData = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'image' => 'required',
                'weight'=>'required',
            ]
        );

        $updatedProduct = new Product($validData);
        $product->update($validData);

        return response()->json($updatedProduct, response::HTTP_OK);

    }



    //deleteProduct
    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(
                [
                    'message' => 'Data not found',
                    'Data' => $product
                ]
            );
        }

        $product->delete();
        return response()->json(['Message' => 'Product deleted']);
    }







}
