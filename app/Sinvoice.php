<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Support\Organizer;
class Sinvoice extends Model
{

    use Organizer;

    protected $fillable = [
        'supplier_id', 'title', 'date', 'due_date',
        'discount', 'sub_total', 'total'
    ];

    protected $filter = [

        'id','supplier_id', 'title', 'date', 'due_date',
        'discount', 'sub_total', 'total', 'created_at',

        //filter relation in reference to customer

        'supplier.id', 'supplier.company','supplier.email',
         'supplier.name', 'supplier.phone',
         'supplier.address', 'supplier.created_at'
    ];

    public static function initialize(){

        return [
            'supplier_id' => 'select',
            'title' => 'invoice ',
            'date' => date('Y-m-d'),
            'due_date' => null,
            'discount' => 0,
            'items' => [
                SinvoiceItem::initialize()
            ]

        ]; 
    }
    public function items(){
        return $this->hasMany(SinvoiceItem::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
