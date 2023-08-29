<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::all();
        // return $this->sendResponse($products->toArray(), 'Product Retrieved Successfully');
        return $this->sendResponse(ProductResource::collection($products), 'Product Retrieved Successfully');
    }
}
