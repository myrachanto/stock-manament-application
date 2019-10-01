<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Support\Organizer;
class Product extends Model
{
    use Organizer; 

    protected $fillable = [
        'name', 'description','type', 'price1', 'price2', 'price3','cost','qty'
    ];
//whitelist of filter-able columns 
    protected $filter = [

        'id','name', 'description','type', 'price1', 'price2', 'price3','cost','qty'

    ];

    public static function initialize(){
        return[
            'name' => '', 'description' => '','type' => '', 
            'price1' => '', 'price2' => '', 'price3' => '','cost' => '','qty' => ''
      
        ];
    }
    public function invoices(){

        return $this->hasMany(Invoice::class);
    }
}
