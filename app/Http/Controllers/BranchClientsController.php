<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\BranchClients;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Exports\BranchClientsExport;
use Maatwebsite\Excel\Facades\Excel;
class BranchClientsController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->hasRole('Admin')){
            $data['branchClients'] = BranchClients::with('branch')->orderBy('id', 'DESC')->get();
           return view('branch.clients.index')->with($data);
       }elseif(Auth::user()->hasRole('Branch-Admin')){
            
            $user = User::with('branch')->find(Auth::user()->id);
            $data['branchClients'] = BranchClients::with('branch')->where('branches_id', $user->branch->id)->orderBy('id', 'DESC')->get();
           return view('branch.clients.index')->with($data);
       }
    }

   
    public function create()
    {
        if(Auth::user()->hasRole('Admin') ){
             $data['branches'] = Branch::all();
        }
        if(Auth::user()->hasRole('Branch-Admin') ){
            $data['user'] = User::with('branch')->find(Auth::user()->id);
            //$data['branches'] = BranchClients::with('branch')->where('branches_id', $user->branch->id)->first();
        }
         
        return view('branch.clients.create')->with($data);
    }

    
    public function store(Request $request)
    {
        //return $request;
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone1' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'city' => 'required',
            'pinCode' => 'required',
            'branch_id' => 'required',
            'address' => 'required',
        ],[
          //  'name.required' => 'Name is must.',
          //  'name.min' => 'Name must have 5 char.',
        ]);
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }
        if(Auth::user()->hasRole('Branch-Admin') ){

            $userBranch = $user = User::with('branch')->find(Auth::user()->id);
             $branchId  = $userBranch->branch->id;

        }else{
            $branchId = $request->branch_id;
        }
        $branchClients = BranchClients::create([
            'branches_id' => $branchId,
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'pincode' => $request->pinCode,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'address' => $request->address,
        ]);
       
        return redirect('clients')->with('success', 'Client added successfully!');
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        if(Auth::user()->hasRole('Admin') ){
            $data['branches'] = Branch::all();
        }
        if(Auth::user()->hasRole('Branch-Admin') ){
            $user = User::with('branch')->find(Auth::user()->id);
            $data['branches'] = BranchClients::with('branch')->where('branches_id', $user->branch->id)->first();
        }
        $data['userData'] = BranchClients::find($id);
        return view('branch.clients.edit')->with($data);
    }

    
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone1' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'city' => 'required',
            'pinCode' => 'required',
            'branch_id' => 'required',
            'address' => 'required',
        ],[
          //  'name.required' => 'Name is must.',
          //  'name.min' => 'Name must have 5 char.',
        ]);
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }
        $branchClient = BranchClients::find($id);
        $branchClient->name = $request->name;
        $branchClient->email = $request->email;
        $branchClient->city = $request->city;
        $branchClient->pincode = $request->pinCode;
        $branchClient->phone1 = $request->phone1;
        $branchClient->phone2 = $request->phone2;
        $branchClient->address = $request->address;
        $branchClient->save();
        return redirect('clients')->with('success', 'Record updated successfully!');
    }

   
    public function destroy($id)
    {
        //return $id;
        $BranchClients = BranchClients::find( $id );
        $res = $BranchClients->delete();
        if($res){
            return redirect('clients')->with('success','Record Deleted Successfully!');
        }
    }

    public function SearchBranchUser(Request $request){
        //return $request->searchUser;
        $user = User::with('branch')->find(Auth::user()->id);
       return $data['branches'] = BranchClients::with('branch')->where(['branches_id'=>$user->branch->id, 'name' => $request->searchUser,'status' => 1])->first();
        
       //return BranchClients::where('name', $request->searchUser)->first();
    }

    public function branchClientDisableSettings($id){
        //return $id;
        $BranchClients = BranchClients::find($id);
        if($BranchClients->status === 1){
            $BranchClients->status = 0;
        }else{
            $BranchClients->status = 1;
        };
        $BranchClients->save();
       
        return redirect('clients')->with('success','Stutus updated successfully!');
    }

    public function branchClientExcelDownlad(){
       // return 'branchClientExcelDownlad';
        $branch = Branch::where('users_id',Auth::user()->id)->first();
        return Excel::download(new BranchClientsExport, 'Branch-Clients-'.$branch->name.'.xlsx');
    }
}
