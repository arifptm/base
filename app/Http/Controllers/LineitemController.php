<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Lineitem;
use Auth;

class LineitemController extends Controller
{
    public function index(){
        //
    }

    public function create(){
        $products = Product::all()->pluck('name','id')->toArray();
        return view('admin.lineitem.create', ['products' => $products ]);
    }

    public function store(Request $request){
        $input_order = [
            'user_id' => Auth::id(),
            'status' => 'NewOrder'
        ];
        
        $order = Order::firstOrCreate($input_order);
                
        $input_lineitem = [
            'quantity' => $request->quantity,
            'product_id' => $request->product_id,
            'order_id' => $order->id
        ];
        Lineitem::save($input_lineitem);
        return redirect ("/manage/orders/$order->id");
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }



    public function userStore(Request $request){
        $input_order = [
            'user_id' => Auth::user()->id,
            'status' => 'NewOrder'
        ];
        
        $order = Order::firstOrCreate($input_order);
        
        $lineitem = Lineitem::firstOrNew(['product_id' => $request->product_id, 'order_id' => $order->id ]);
        $lineitem['quantity'] +=  $request->quantity;
        $lineitem->save();
        return redirect ("/orders/$order->id");
    }

    public function userDestroy(Product $product){
        $product->delete();

        Flash::success('Product deleted successfully.');
        return redirect('/products');
    }
}
