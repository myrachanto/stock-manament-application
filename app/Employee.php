<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Support\Organizer;
class Employee extends Model
{
    use Organizer; 

    protected $fillable = [
        'username', 'email', 'name', 'phone', 'address'
    ];
//whitelist of filter-able columns 
    protected $filter = [

        'id', 'username', 'email', 'name', 'phone',
         'address', 'created_at'

    ];

    public static function initialize(){
        return[

        'username' => '', 'email' => '', 'name' => '', 'phone' => '', 'address' => ''
        ];
    }
}
