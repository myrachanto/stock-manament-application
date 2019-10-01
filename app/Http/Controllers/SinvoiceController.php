<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sinvoice;
use App\SinvoiceItem;
use Validator;
use App\Supplier;
use App\Product;
class SinvoiceController extends Controller
{
     public function index(){

        return response()
            ->json([
                'model' => Sinvoice::with('supplier')->Organizer()
            ]);
    }
    public function create(){
        return response()
        ->json([
            'form' => Sinvoice::initialize(),
            'option' => [
                'suppliers' => Supplier::orderBy('name')->get(),
                'products' => Product::orderBy('name')->get()
            ]
        ]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'supplier_id' => 'required|exist:suppliers,id',
            'title' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|max:255',
            'items.*.qty' => 'required|integer|min:0',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);
        $data = $request->except('items');
        $data['sub_total'] = 0;
        $items = [];

        foreach($request->items as $item){
            $data['sub_total'] += $item['unit_price'] * $item['qty'];
            $items[] = new SinvoiceItem($item);
        }
        $data['total'] = $data['sub_total'] - $data['discount'];

        $sinvoice = Sinvoice::create($data);
        $sinvoice->items()
        ->saveMany($items);
 
        return response()
        ->json([
            'saved' => true
        ]);
         
    }

    public function show($id){
        $sinvoice = Sinvoice::with('supplier', 'items')->findOrFail($id);

        return response()
        ->json([
            'model' => $sinvoice
        ]);

    }

    public function edit($id){
        $sinvoice = Sinvoice::with('items')->findOrFail($id);
        return response()
                ->json([
                    'form' => $sinvoice,
                    'option' => Supplier::orderBy('name')->get()

                ]);
 
    }

    public function update(Request $request, $id){
           $this->validate($request, [
            'customer_id' => 'required|exist:customers,id',
            'title' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|max:255',
            'items.*.qty' => 'required|integer|min:0',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);
        $sinvoice = Sinvoice::findOrFail($id);

        $data = $request->except('items');
        $data['sub_total'] = 0;
        $items = [];
        $itemIds = [];

        foreach($request->items as $item){
            $data['sub_total'] += $item['unit_price'] * $item['qty'];
            if(isset($item['id'])){
                // update the item
                SinvoiceItem::whereId($item['id'])
                ->whereSinvoiceId($sinvoice->id)
                ->update($item);

            }else{
                
                $items[] = new SinvoiceItem($item);
            }
           
        }
        $data['total'] = $data['sub_total'] - $data['discount'];

        $invoice = update($data);
        //delete removed items
        if(count($itemid)){
            Sinvoice::whereSinvoiceId($invoice->id)
             ->whereNotIn('id', $itemIds)
             ->delete();
        }

        if(count($items)){
            
        $sinvoice->items()
        ->saveMany($items);
        }

        return response()
        ->json([
            'saved' => true
        ]);
    }
    public function destroy($id){
        $sinvoice = Sinvoice::findOrFail($id);
        SinvoiceItem::whereSinvoiceId($invoice->id)
         ->delete();

         $invoice->delete();

         response()
         ->json([
             'delete' => true
         ]);
    }
}
