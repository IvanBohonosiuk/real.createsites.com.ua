<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Product $products)
    {
        $this->data['products'] = $products->getActive();

        return view('shop.index', $this->data);
    }

    public function show($id)
    {
        $this->data['product'] = Product::find($id);

        return view('shop.show', $this->data);
    }
}
