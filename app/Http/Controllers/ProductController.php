<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Product;

class ProductController extends Controller
{
    
    public function index(){

        return response()
            ->json([ 
                'model' => Product::Organizer()
            ]);
    }

    public function store(Request $request)
    {
       $this->validate($request, [
        'name'    => 'required|min:2',
        'description' => 'required|min:2',
        'type'    => 'required|min:2',
        'price1' => 'required',
        'price2' => 'required',
        'price3' => 'required',
        'cost' => 'required',
        'qty' => 'required'
        ]);
         $product = Product::create([
            'name'        => request('name'),
            'description'        => request('description'),
            'type'        => request('type'),
            'price1'        => request('price1'),
            'price2'        => request('price2'),
            'price3'        => request('price3'),
            'cost' => request('cost'),
            'qty' => request('qty')
           // 'user_id'     => Auth::user()->id
        ]);
 
        return response()->json([
            'product'    => $product,
            'message' => 'product added succesifully'
        ], 200);
    }

public function update(Request $request, Product $product)
{
    $this->validate($request, [
        'name'    => 'required|min:2',
        'description' => 'required|min:2',
        'type'    => 'required|min:2',
        'price1' => 'required',
        'price2' => 'required',
        'price3' => 'required',
        'cost' => 'required',
        'qty' => 'required'
    ]);

    $product->name = request('name');
    $product->description = request('description');
    $product->type = request('type');
    $product->price1 = request('price1');
    $product->price2 = request('price2');
    $product->price3 = request('price3');
    $product->cost = request('cost');
    $product->qty = request('qty');
    $product->save();

    return response()->json([
        'message' => 'product Data updated successfully!'
    ], 200);
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'product data deleted successfully!'
        ], 200);
    }
 
}
