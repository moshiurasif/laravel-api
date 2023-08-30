<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;

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
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('Product Not Found');
        }

        return $this->sendResponse(new ProductResource($product), "Product Retrieved Successfully");
    }
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $product->update($request->all());
        return $this->sendResponse(new ProductResource($product), "Product Updated Successfully");
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse(new ProductResource($product), "Product Deleted Successfully");
    }
}
