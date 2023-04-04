<?php

namespace App\Http\Controllers;
    
use DB;
use Hash;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        return view('users.index',compact('data'));
    }
    

    public function create()
    {
         $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    

    public function store(Request $request)
    {
        //return $request;
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            //'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole('Admin');
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    public function show($id)
    {
        //return $id;
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        //return $request;
       
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.$id,
        ],[
            'email.required' => 'Email field is required!',
           
        ]);
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }
    
        $input = $request->all();
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->filled('password')) {
            $validate = Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed',
            ],[
                'password.required' => 'Password field is required!',
               
            ]);
            if($validate->fails()){
                return back()->withErrors($validate->errors())->withInput();
            }
            $user->password =  Hash::make($request->password);

        } 
        $user->save();
       // $user->update($input);
       // DB::table('model_has_roles')->where('model_id',$id)->delete();
    
       // $user->assignRole($request->input('roles'));
        if(Auth::user()->hasRole('Branch-Admin')){
            return redirect('users/account-settings/'.$id)->with('success','User updated successfully');
        }
        return redirect()->route('users.index')->with('success','User updated successfully');
                       
    }
    
    public function destroy($id)
    {

        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function userAccountSettings($id)
    {
        $user = User::find($id);
        return view('account-settings',compact('user'));
    }

    public function userDisableSettings($id){
        $user = User::find($id);
        if($user->status === 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        };
        $user->save();
        return redirect('users');
    }
    
}
