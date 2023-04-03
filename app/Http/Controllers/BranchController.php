<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Hash;
class BranchController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->hasRole('Admin')){
             $data['branches'] = Branch::with('user')->orderBy('id', 'DESC')->get();
            return view('branch.index')->with($data);
        }elseif(Auth::user()->hasRole('Branch-Admin')){
             $data['branches'] = Branch::with('user')->where('users_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
            return view('branch.index')->with($data);
        }
        
    }

    
    public function create()
    {
        $language = array("laravel", "php", "java", "odo");

        //echo current($language) . "<br>";
        //echo next($language) . "<br>";
       // echo prev($language);

        $branchNames = array('A', 'B', 'C', 'D', 'E', 'F', 'G','H','I','J','K','L','M','N','O','P', 'Q', 'R','S', 'T');
        $data['item'] = Branch::all();
        $lastBranch = Branch::latest()->first();
        $lastBranchName = $lastBranch->branch_name ?? '';
        foreach (array_values($branchNames) as $i => $value) {
           // echo "$i: $value\n";
            if($lastBranchName == $value ){
                ++$i;
                $data['branchName'] = $branchNames[$i];
                break;
            }
            else{
                $data['branchName'] = $lastBranch->branch_name ?? 'A';
            }
          }
       // $data['lastSerialNo'] = $lastBranch->invoicing_serial ?? 0;
       // ++$data['lastSerialNo'];
        return view('branch.create')->with($data);
    }

    
    public function store(Request $request)
    {
        $validate = $request->validate([
            'invoice_serial' => 'required',
            'email' => '|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ], [
           // 'branch_name.required' => 'Branch Name field is required',
            'invoice_serial.required' => 'Invoice Serial field is required.',
            'password.required' => 'Password field is required.',
            'email.required' => 'Email field is required.',
           // 'user_uid.email' => 'User ID field must be email address.'
        ]);
        // if($validate->fails()){
        //     return back()->withErrors($validate->errors())->withInput();
        // }
        $user = User::create([
            'name' => $request->userName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            //'user_uid' => $request->branch_name.'-'.str_ireplace (' ', '', $request->userName).'-'.random_int(1000, 9999)
            //'user_uid' => $request->user_uid,
        ]);
        $data = array( 
            'branch_name' => $request->branch_name,
            'invoicing_serial' => $request->invoice_serial,
            'users_id' => $user->id,
           // 'password' => $request->password,
        );
        
        $branch = Branch::create($data);
        
        $roleAssigned = $user->assignRole('Branch-Admin');
        if($branch && $user && $roleAssigned){
            return redirect('branch');
        }else{
            return 0;
        }
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
       $branch = Branch::with('user')->find($id);
       return view('branch.edit', compact('branch') );
    }

    
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            //'branch_name' => 'required',
            'branch_user_name' => 'required',
            'email' => '|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'branch_user_phone' => 'required',
        ], [
           // 'branch_name.required' => 'Branch Name field is required',
            'branch_user_name.required' => 'User name field is required.',
            'password.required' => 'Password field is required.',
            'email.required' => 'Email field is required and should be unique!',
            'branch_user_phone.required' => 'Phone Number is required'
        ]);
        $user = User::find($id);
        $user->name = $request->branch_user_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->filled('password')) {
            
            $user->password =  Hash::make($request->password);
    
         } 
        
        $user->save();
        return redirect('branch');
    }

    
    public function destroy($id)
    {
       
        $branch = Branch::find( $id );
        $res = $branch->delete();
        if($res){
            return redirect('branch');
        }
    }

    public function branchDisableSettings($id){
        $branch = Branch::find($id);
        if($branch->status === 1){
            $branch->status = 0;
        }else{
            $branch->status = 1;
        };
        $branch->save();
        $user = User::find($branch->users_id);
        if($user->status === 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        };
        $user->save();
        $user->status = 0;
       
        return redirect('branch');
    }
}
