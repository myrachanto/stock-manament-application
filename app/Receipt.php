<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Organizer;
class Receipt extends Model
{
    use Organizer; 

    protected $fillable =  [

        'supplier_id', 'title', 'date', 'due_date',
        'discount', 'sub_total', 'total','amountPaid', 'balance', 'paymentStatus'

    ];
	
//whitelist of filter-able columns 
    protected $filter = [

        'id', 'supplier_id', 'title', 'date', 'due_date',
        'discount', 'sub_total', 'total','amountPaid', 'balance', 'paymentStatus'

    ];
	  
    
    public function suppliers(){

        return $this->hasMany(Supplier::class);
    }
}

