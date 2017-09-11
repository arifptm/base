<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

use Illuminate\Auth\Events\Registered;
use App\Jobs\SendUserVerificationEmail;

use Flash;
use Bouncer;
use App\UserProfile;
use App\Order;
use App\Product;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-users',['except'=>[]]);
    }

    public function assignRole(){
        return view('admin.user.assign_role');
    }

    public function storeRole(){
        
        //Bouncer::allow($user)->to('manage', User::class);
        return redirect('/manage/users');
    }


    public function index(){
        $users = User::whereIsNot('super')->orderBy('id', 'desc')->paginate(20);
        return view('admin.user.index',['users'=>$users]);
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(Request $request){
        $input = $request->all();
        $input['password'] = bcrypt(str_random(8));
        $input['verification_token'] = base64_encode($request->email);
        event(new Registered($user = User::create($input)));
        
        dispatch(new SendUserVerificationEmail($user));


        //User::save($input);


        UserProfile::create(['image'=> 'default.jpg', 'user_id' => $user->id]);
        Bouncer::assign('user')->to($user);

        Flash::success('User baru berhasil ditambahkan');
        return redirect('manage/users');
    }

    public function show($id){      
        $user = User::findOrFail($id);
        $product = Product::whereUserId($user->id);
        $order = Order::whereUserId($user->id);
        return view('admin.user.show', ['user'=>$user, 'product'=>$product, 'order'=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',['user'=>$user]);
    }


    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $input = $request->all();
        $user -> update($input);
        
        if ($request->hasFile('image')) {
            $profile = new UserProfile;
            $profile['image'] = $this->upload($request);
            
            $user->userProfile->update(['image'=>$profile['image']]);
        }        

        Flash::success('Data berhasil di-update...');
        return redirect('/manage/users');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $product = Product::whereUserId($user->id);
        $order = Order::whereUserId($user->id);

        if ($product->count() OR $order->count()){
            Flash::success("$user->name tidak bisa dihapus karena sudah mempunyai usulan/permintaan");            
            return redirect()->back();
        }
        $user->delete();
        Flash::success("$user->name telah dihapus");
        return redirect()->back();
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
                $request->file('image')->move("assets/profiles/", $name);
                return $name;

            } catch (Illuminate\Filesystem\FileNotFoundException $e) {

            }
        }
    }
}
