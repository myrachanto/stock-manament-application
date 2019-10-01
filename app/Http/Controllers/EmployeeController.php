<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Employee;

class EmployeeController extends Controller
{
    
    public function index(){

        return response()
            ->json([ 
                'model' => Employee::Organizer()
            ]);
    }

    public function store(Request $request)
    {
       $this->validate($request, [
        'username' => 'required|min:2|alpha_num',
        'name'    => 'required|min:2|alpha_num',
        'email'  => 'required|email',
        'phone' => 'required',
        'address' => 'required|min:2|alpha_num'
        ]);
         $employee = Employee::create([
            'name'        => request('name'),
            'username'        => request('username'),
            'email'        => request('email'),
            'phone'        => request('phone'),
            'address' => request('address')
           // 'user_id'     => Auth::user()->id
        ]);
 
        return response()->json([
            'employee'    => $employee,
            'message' => 'employee added succesifully'
        ], 200);
    }

public function update(Request $request, Employee $customer)
{
    $this->validate($request, [
        'username' => 'required|min:2|alpha_num',
        'name'    => 'required|min:2|alpha_num',
        'email'  => 'required|email',
        'phone' => 'required',
        'address' => 'required|min:2|alpha_num'
    ]);

    $employee->name = request('name');
    $employee->username = request('username');
    $employee->email = request('email');
    $employee->phone = request('phone');
    $employee->address = request('address');
    $employee->save();

    return response()->json([
        'message' => 'employee Data updated successfully!'
    ], 200);
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'message' => 'employee data deleted successfully!'
        ], 200);
    }
 
}
