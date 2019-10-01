<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Support\Organizer;
class Supplier extends Model
{
    use Organizer; 

    protected $fillable = [
        'company', 'email', 'name', 'phone', 'address'
    ];
//whitelist of filter-able columns 
    protected $filter = [

        'id', 'company', 'email', 'name', 'phone',
         'address', 'created_at'

    ];

    public static function initialize(){
        return[

        'company' => '', 'email' => '', 'name' => '', 'phone' => '', 'address' => ''
        ];
    }
    public function sinvoices(){

        return $this->hasMany(Sinvoice::class);
    }
}