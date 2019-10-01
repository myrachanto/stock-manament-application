<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Customer;

class CustomerController extends Controller
{
    
    public function index(){

        return response()
            ->json([ 
                'model' => Customer::Organizer()
            ]);
    }

    public function store(Request $request)
    {
       $this->validate($request, [
        'company' => 'required|min:2|alpha_num',
        'name'    => 'required|min:2|alpha_num',
        'email'  => 'required|email',
        'phone' => 'required|num',
        'address' => 'required|min:2|alpha_num'
        ]);
         $customer = Customer::create([
            'name'        => request('name'),
            'company'        => request('company'),
            'email'        => request('email'),
            'phone'        => request('phone'),
            'address' => request('address')
           // 'user_id'     => Auth::user()->id
        ]);
 
        return response()->json([
            'customer'    => $customer,
            'message' => 'Customer added succesifully'
        ], 200);
    }

public function update(Request $request, Customer $customer)
{
    $this->validate($request, [
        'company' => 'required|min:2|alpha_num',
        'name'    => 'required|min:2|alpha_num',
        'email'  => 'required|email',
        'phone' => 'required|num',
        'address' => 'required|min:2|alpha_num'
    ]);

    $customer->name = request('name');
    $customer->company = request('company');
    $customer->email = request('email');
    $customer->phone = request('phone');
    $customer->address = request('address');
    $customer->save();

    return response()->json([
        'message' => 'Customer Data updated successfully!'
    ], 200);
    }
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json([
            'message' => 'Customer data deleted successfully!'
        ], 200);
    }
 
}
