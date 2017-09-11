<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bouncer;

use App\User;
use App\Product;
use App\Order;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAn('admin','super') ){
            $u = new User;
            $admins = $u->whereIs('super')->get();
            $users = $u->whereIs('user')->get();

            $p = new Product;            
            $pendings = Product::whereVerified(0)->get();
            $verifieds = Product::whereVerified(1)->get();

            $o = new Order;
            $orders_new = $o->whereStatus('NewOrder')->get();
            $orders_completed = $o->whereStatus('Completed')->get();

            return view('admin.index')->with([        
                'all_products' => $p->orderBy('id','desc')->limit(10)->get(),
                'products_pending' => $pendings,
                'products_verified' => $verifieds,
            
                'all_users' => $u->orderBy('id','desc')->whereIsNot('super')->limit(10)->get(),
                'users' => $users,
                'admins' => $admins,
            
                'all_orders' => $o->orderBy('id','desc')->limit(5)->get(),
                'orders_new' => $orders_new,
                'orders_completed' => $orders_completed
            ]);


        } else if (Auth::user()->isAn('user')){
            $order = Order::whereUserId(Auth::id())->whereStatus('NewOrder')->first();   
            return view('user.index', ['order_inprogress'=> $order] );
        }
    }
}
