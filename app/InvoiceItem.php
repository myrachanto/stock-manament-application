<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Organizer;

class InvoiceItem extends Model
{
    Use Organizer;
    protected $fillable = [
           'description', 'qty', 'unit_price'
    ];
    
    public static function initialize(){

        return[
            'description' => '',
            'unit_price' => '',
            'qty' => ''

        ];
    }

}
