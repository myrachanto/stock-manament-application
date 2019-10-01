<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Organizer;

class Sinvoiceitem extends Model
{
    Use Organizer;
    protected $fillable = [
           'name','description', 'qty', 'unit_price', 'vat','discount'
    ];
    
    public static function initialize(){

        return[
            'name' => '',
            'description' => '',
            'unit_price' => '',
            'discount' => '',
            'vat' => '',
            'qty' => ''

        ];
    }

}
