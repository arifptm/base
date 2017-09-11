<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Flash; 
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Order;


class ProductController extends Controller
{
    
    public function __construct(){
        $this->middleware('can:manage-products', ['except'=>['userIndex','userEdit','userUpdate','userCreate', 'userStore','userDestroy','userShow','data']]);
    }

    public function index(){
        $products = Product::orderBy('id','desc')->paginate(20);
        return view('admin.product.index', ['products' => $products]);
    }

    public function indexAdmin(){
            $order = Order::whereUserId(Auth::id())->whereStatus('NewOrder')->first();     
            return view('user.index', ['order_inprogress'=> $order] );
    }

    public function create(){
        return view('admin.product.create');
    }

    public function store(Request $request){
        $input = $request->except('_token');

        if ($request->hasFile('image')) {
            $input['image'] = $this->upload($request);
        }

        Product::create($input);
        Flash::success('Product updated successfully.');
        return redirect('/manage/products');
    }

    public function show($slug){
        $product = Product::whereSlug($slug)->first();
        return view('admin.product.show', ['product'=>$product]);
    }

    public function edit(Product $product){
        return view('admin.product.edit', ['product'=>$product]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $input['image'] = $this->upload($request);
        }

        $product = Product::findOrFail($id);
        $product->update($input);

        Flash::success('Product updated successfully.');
        return redirect('/manage/products');
    }

    public function destroy(Product $product){
        $product->delete();
        Flash::success('Product deleted successfully.');
        return redirect('/manage/products');
    }





    /* PUBLIC
     * User Method
     */

    public function userIndex(){
        $products = Product::where('user_id','=', Auth::id())->paginate(20);
        $suggestions = Product::where('user_id','!=', Auth::id())->orderBy('id','desc')->limit(10)->get();
        return view('user.product.index', ['products' => $products, 'suggestions'=>$suggestions]);
    }

    public function userCreate(){
        return view('user.product.create'); 
    }

    public function userStore(Request $request){
        $input = $request->except('_token');
        $input['user_id'] = Auth::user()->id;

        if ($request->hasFile('image')) {
            $input['image'] = $this->upload($request);
        }
        
        Product::create($input);
        Flash::success('Usulan telah berhasil dikirimkan.');
        return redirect('/products');        
    }

    public function userShow($slug){
        $product = Product::whereSlug($slug)->first();
        return view('user.product.show',['product'=>$product]);
    }

    public function userEdit($id){
        $product = Product::findOrFail($id);
        
        if($product->user_id != Auth::user()->id){
            Flash::warning('Tidak bisa melakukan pembaruan, karena barang tersebut bukan usulan anda!');
            return back();
        }

        if($product->verified == 1){
            Flash::warning('Tidak bisa melakukan pembaruan barang yang sudah diproses admin!');
            return back();
        }

        return view('user.product.edit', ['product'=>$product]);        
    }

    public function userUpdate(Request $request, $id){
        $input = $request->all();
        if ($request->hasFile('image')) {
            $input['image'] = $this->upload($request);
        }

        $product = Product::findOrFail($id);
        $product->update($input);

        Flash::success('Usulan telah berhasil diperbarui.');
        return redirect('/products');      
    }

    public function userDestroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        Flash::success('Usulan telah berhasil dihapus.');
        return redirect('/products');
    }









    /* PUBLIC
     *
     * Misc Method
     *
     */ 
    public function upload(Request $request){    
        if($request->file('image')->isValid()) {
            try {
                $file = $request->file('image');
                $name = time() . '.' . $file->guessClientExtension();
                $request->file('image')->move("assets/products/", $name);
                return $name;

            } catch (Illuminate\Filesystem\FileNotFoundException $e) {

            }
        }
    }

    public function data(){
        if (Auth::user()->isAn('user')){
            $product= Product::select(['id', 'slug', 'stock', 'name', 'body', 'image', 'register_date', 'verified'])->where('verified','!=',9);
        } else {
            $product= Product::select(['id', 'slug', 'stock', 'name', 'body', 'image', 'register_date', 'verified']);
        }

            $dt = Datatables::of($product)
                ->addColumn('title_a', function ($product) {
                    return '<a href="/products/'.$product->slug.'">'.$product->name.'</a>';                    
                })
                ->addColumn('action', function ($product) {
                    if ($product->verified == 1 )
                    return '<button             
                        data-dataid = "'.$product->id.'"
                        data-datatitle = "'.$product->name.'"
                        data-dataimage= "<img class=\'img-responsive\' src=/assets/products/'. $product->image .' >"
                        data-toggle="modal" 
                        data-target="#myModal"  
                        class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus"></i> Permintaan</button>';
                    if ($product->verified == 0 )
                    return '<button class="btn btn-xs disabled">Pending</button>';
                    if ($product->verified == 9 )
                    return '<button class="btn btn-xs disabled">Ditolak</button>';
                })

                ->addColumn('thumb', function ($product) {
                    if($product->image <> null)
                    return '<a href="/products/'.$product->id.'"><img src="/images/s/'.$product->image.'" /></a>';
                    if($product->image == null)
                    return '<a href="/products/'.$product->id.'"><img height="60" src="/assets/products/noimage.png" /></a>';
                })
                ->addColumn('edit', function ($product){
                    return '<a class="btn btn-xs btn-primary" href="/manage/products/'.$product->id.'/edit">Edit</a>';
                })
                ->addColumn('body_limit', function($product){
                    return str_limit($product->body);
                })

                ->rawColumns(['title_a','thumb','action','d_stock','edit','body_limit']);
                return $dt->make(true); 
            
        
    }
}
