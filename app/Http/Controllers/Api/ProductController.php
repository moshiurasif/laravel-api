<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::all();
        // return $this->sendResponse($products->toArray(), 'Product Retrieved Successfully');
        return $this->sendResponse(ProductResource::collection($products), 'Product Retrieved Successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $product = Product::create($request->all());
        return $this->sendResponse(new ProductResource($product), 'Product Added Successfully');
    }
}
