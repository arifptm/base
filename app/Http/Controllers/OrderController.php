<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Flash;
use Auth;
use Excel;
use PDF;
use App\Lineitem;
use App\Product;

class OrderController extends Controller
{

    public function index(){
        $orders = Order::orderby('id','desc')->paginate(20);
        return view('admin.order.index', ['orders' => $orders]);
    }

    public function create(){
        
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        $order = Order::findOrFail($id);
        return view('admin.order.show',['order'=>$order]);
    }

    public function edit($id){
        $order = Order::findOrFail($id);
        return view('admin.order.edit', ['order'=>$order]);
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $input['status'] ='InProgress';
        $order = Order::findOrFail($id);
        $order->update($input);
        Flash::success('Permintaan telah dikirimkan. Silakan menunggu persetujuan.');
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function acceptOrder($id){
        $order = Order::findOrFail($id);
        $order->status = "Approved";

        foreach($order->lineitem as $item){
            $stock = Product::findOrFail($item->product->id)->stock;            
            $rest = $stock - $item->quantity;        
            if ($rest <= 0){
                Flash::warning('Stok tidak cukup');
                return redirect('/manage/orders');
            }
        }

        foreach($order->lineitem as $item){
            $product = Product::findOrFail($item->product->id);
            $rest = $product->stock - $item->quantity;        
            $product->update(['stock' => $rest]);
        }
        
        $order->update();
        
        Flash::success('Anda telah menyetujui permintaan...');
        return redirect('/manage/orders');
    }

    public function rejectOrder($id){
        $order = Order::findOrFail($id);
        $order->status = "Rejected";
        $order->update();

        Flash::success('Anda telah menolak permintaan...');
        return redirect('/manage/orders');
    }









    public function userIndex()
    {
        $order = new Order;        
        $all_orders = $order->orderBy('id','desc')->paginate(10);
        $user_orders = $order->whereUserId(Auth::user()->id)->orderBy('id','desc')->paginate(20);
        return view('user.order.index', ['user_orders' => $user_orders, 'all_orders'=>$all_orders]);
    }

    public function userShow($id)
    {
        $order = Order::findOrFail($id);
        return view('user.order.show', ['order'=>$order]);
    }

    public function userExportPdf($id){
        $order = Order::findOrFail($id);

        $k =0;
        foreach($order->lineitem as $key=>$item){
            $k++;
            $data[$key]['No'] = $k;            
            //$data[$key]['id'] = $item->product->id;
            $data[$key]['Nama Barang'] = $item->product->name;
            $data[$key]['Jumlah'] = $item->quantity;
        }

        $pdf = PDF::loadView('user.pdf.order', ['order' =>$order]);
        $pdf -> setOptions(['dpi' => 150, 'defaultFont' => 'helvetica']);
        
        return $pdf->download('Permintaan '.$order->user->name . '.pdf');
        
        
        // Excel::create('Permintaan '. $order->user->name, function($excel) use($order,$data){
        //     $excel->setTitle('Permintaan '. $order->user->name );
        //     $excel->sheet('PDF File', function($sheet) use ($data){
        //         $sheet->fromArray($data);
        //         $sheet->setStyle(array(
        //             'font' => array(
        //                 'name'      =>  'Arial',
        //                 'size'      =>  13,
        //             )
        //         ));
        //         $sheet->setAllBorders('thin');
        //         // $sheet->setWidth(array(
        //         //     'A'     =>  5,
        //         //     'B'     =>  10
        //         // ));
        //         $sheet->setAutoSize(true);
        //         $sheet->setfitToHeight(true);
        //     });
        // })->export('pdf');
    }


}
