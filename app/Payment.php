<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Organizer;
class Payment extends Model
{
    use Organizer; 

    protected $fillable =  [

        'customer_id', 'title', 'date', 'due_date',
        'discount', 'sub_total', 'total','amountPaid', 'balance', 'paymentStatus'

    ];
	
//whitelist of filter-able columns 
    protected $filter = [

        'id', 'customer_id', 'title', 'date', 'due_date',
        'discount', 'sub_total', 'total','amountPaid', 'balance', 'paymentStatus'

    ];
	  
    
    public function customers(){

        return $this->hasMany(Customer::class);
    }
}
