<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Supplier;

class SupplierController extends Controller
{
    
    public function index(){

        return response()
            ->json([ 
                'model' => Supplier::Organizer()
            ]);
    }

    public function store(Request $request)
    {
       $this->validate($request, [
        'company' => 'required',
        'name'    => 'required|min:2|alpha_num',
        'email'  => 'required|email',
        'phone' => 'required',
        'address' => 'required|min:2|alpha_num'
        ]);
         $supplier = Supplier::create([
            'name'        => request('name'),
            'company'        => request('company'),
            'email'        => request('email'),
            'phone'        => request('phone'),
            'address' => request('address')
           // 'user_id'     => Auth::user()->id
        ]);
 
        return response()->json([
            'supplier'    => $supplier,
            'message' => 'supplier added succesifully'
        ], 200);
    }

public function update(Request $request, Supplier $supplier)
{
    $this->validate($request, [
        'company' => 'required',
        'name'    => 'required|min:2|alpha_num',
        'email'  => 'required|email',
        'phone' => 'required',
        'address' => 'required|min:2|alpha_num'
    ]);

    $supplier->name = request('name');
    $supplier->company = request('company');
    $supplier->email = request('email');
    $supplier->phone = request('phone');
    $supplier->address = request('address');
    $supplier->save();

    return response()->json([
        'message' => 'supplier Data updated successfully!'
    ], 200);
    }
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json([
            'message' => 'supplier data deleted successfully!'
        ], 200);
    }
 
}
