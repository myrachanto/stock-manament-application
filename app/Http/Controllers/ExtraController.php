<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Extra;

class ExtraController extends Controller
{
    
    public function index(){

        return response()
            ->json([
                'model' => Extra::Organizer()
                
            ]);
    }

    public function store(Request $request)
    {
       $this->validate($request, [
            'classid' => 'required',
            'curriculumid'    => 'required',
            'team'  => 'required',
            'description' => 'required',
            'achievements' => 'required',
            'comments' => 'required'
        ]);
         $customer = Extra::create([
            'classid'        => request('classid'),
            'curriculumid'        => request('curriculumid'),
            'team'        => request('team'),
            'description'        => request('description'),
            'achievements'        => request('achievements'),
            'comments' => request('comments')
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
        'classid' => 'required',
        'curriculumid'    => 'required',
        'team'  => 'required',
        'description' => 'required',
        'achievements' => 'required',
        'comments' => 'required'
    ]);

    $customer->classid = request('classid');
    $customer->curriculumid = request('curriculumid');
    $customer->team = request('team');
    $customer->description = request('description');
    $customer->achievements = request('achievements');
    $customer->comments = request('comments');
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
