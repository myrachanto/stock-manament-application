<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Invoice;
use App\Sinvoice;
use App\Payment;
use App\Receipt;
use App\Supplier;
use App\Transaction;
use App\Employee;
use DB;
class DashboardController extends Controller
{
    public function index(){

        $cards = [
            [
            'title' => 'New Cunstomer Invoices',
            'type'  => 'value',
            'value' => Invoice::count()
            ],
            [
            'title' => 'New Supplier invoice',
            'type'  => 'value',
            'value' => Sinvoice::count()
            ],
            
            [
            'title' => 'All customers ',
            'type'  => 'value',
            'value' => Customer::count()
            ], 
            [
            'title' => 'All suppliers',
            'type'  => 'value',
            'value' => Supplier::count()
            ],
            [
            'title' => 'New Payments',
            'type'  => 'value',
            'value' => Payment::count()
            ],
            
            [
            'title' => 'New Receipts ',
            'type'  => 'value',
            'value' => Receipt::count()
            ],
            [
                'title' => 'All transactions',
                'type'  => 'value',
                'value' => Transaction::count()
                ],
                [
                'title' => 'All Payments',
                'type'  => 'value',
                'value' => Payment::count()
                ],
                
                [
                'title' => 'All Employees ',
                'type'  => 'value',
                'value' => Employee::count()
                ]
           /*
           [
            'title' => 'Opportunities lost',
            'type'  => 'chart',
            'color' => #6be6c1,
            'value' => $this->getChart(Opportunity::get()->where('status', 'lost'), 'created_at')
                ],
            
            [
                'title' => 'Opportunities Won',
                'type'  => 'chart',
                'color' => #96dee8,
                'value' => $this->getChart(Opportunity::get()->where('status', 'won'),  'created_at')
                    ],
                [
                    'title' => 'Cleared Payments',
                    'type'  => 'chart',
                    'color' => #96dee8,
                    'value' => $this->getChart(Payment::get()->where('status', 'cleared'),  'payment_date')
                ]                        
    
 */
        ];
        return response()
            ->json(['cards' => $cards]);
        
    }/*
    public function getChart($model, $column){
        $valueFormat = DB::raw("DATE_FORMAT(".$column.", '%d') as value");
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        $dates = [];
        while($run->item($end)){
            $dates = array_add($dates, $run->copy()->format('d'), 0);
            $run->addDay(1);
        }
        $res = $model->groupBy($column)
            ->select(DB::raw('count(*) as total'), $valueFormat)
            ->pluck->addDay();

        $all = $res->toArray() + $dates;

        ksort($all);

        return collect(array_values($all))->map(function($item){
            return ['value' => $item];
        });

    }*/
}
