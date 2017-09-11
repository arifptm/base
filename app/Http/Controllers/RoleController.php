<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Auth;
use Flash;
use Bouncer;

class RoleController extends Controller
{
     public function __construct()
     {

    //     $this->middleware('can:manage,App\Role');
     }

    public function createUserRole(){
        $users = User::whereIsNot('super')->pluck('name','id');
        $roles = Role::where('name','!=', 'super')->orderBy('name')->pluck('name','id');
        return view('admin.role.assign_role',['users'=>$users, 'roles'=>$roles]);
    }

    public function storeUserRole(Request $request){
        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);
        Bouncer::assign($role)->to($user);
        Flash::success('User Role assigned successfully.');
        return redirect('/manage/users');
    }
    public function deleteUserRole(Request $request){
        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);
        Bouncer::retract($role)->from($user);
        Flash::success('User Role eetracted successfully.');
        return redirect('/manage/users');
    }




    public function index(){
        $roles = Role::all();
        dd($roles->abilities());
        return view('admin.role.index', ['roles'=>$roles]);
    }

    public function create()
    {
        return view('admin.role.create');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        Role::create($input);
        Flash::success('Role created successfully.');
        return redirect('/manage/roles');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', ['role'=>$role]);
    }


    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $input = $request->all();
        $role->update($input);
        Flash::success('Role updated successfully.');
        return redirect('/manage/roles');
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        Flash::success('Role deleted successfully.');
        return redirect('/manage/roles');        
    }
}
