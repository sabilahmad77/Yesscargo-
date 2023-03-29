<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //return Inventory::with('branch','category')->get();
        if(Auth::user()->hasRole('Admin')){
            $data['invetories'] = Inventory::with('branch','category')->orderBy('id', 'DESC')->get();
            return view('accounts.inventory.index')->with($data);
       }elseif(Auth::user()->hasRole('Branch-Admin')){
            $branchId = Branch::where('users_id',Auth::user()->id)->first();
            $data['invetories'] = Inventory::with('branch','category')->where('branch_id',$branchId->id)->orderBy('id', 'DESC')->get();
            return view('accounts.inventory.index')->with($data);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Categories::all();
        return view('accounts.inventory.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->cat_id;
        $branches = Branch::where('users_id',Auth::user()->id)->first();
        $validate = $request->validate([
            'cat_id' => 'required',
            'paid_to' => 'required',
            'description' => 'required',
            'amount' => 'required',
        ], [
            'cat_id.required' => 'Category field is required.',
            'paid_to.required' => 'Reciever Name is required.',
            'description.required' => 'Description field is required.',
            'amount.required' => 'Amount field is required.'
        ]);
        $data = array( 
            'categories_id' => $request->cat_id,
            'branch_id' => $branches->id,
            'name' => $request->name,
            'amount' => $request->amount,
            'paid_to' => $request->paid_to,
            'paid_to_email' => @$request->paid_to_email,
            'paid_to_phone1' => $request->paid_to_phone1,
            'paid_to_phone2' => @$request->paid_to_phone2,
            'short_description' => @$request->short_description,
            'description' => $request->description,
        );
        
        $Inventory = Inventory::create($data);
        if($Inventory){
            return redirect('accounts/inventory');
        }else{
            return 'failed';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['Inventory'] = Inventory::find( $id );
        $data['categories'] = Categories::all();
        return view('accounts.inventory.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return 'update';
        // 'categories_id' => $request->cat_id,
        //     'name' => $request->name,
        //     'amount' => $request->amount,
        //     'paid_to' => $request->paid_to,
        //     'paid_to_email' => $request->paid_to_email,
        //     'paid_to_phone1' => $request->paid_to_phone1,
        //     'paid_to_phone2' => $request->paid_to_phone2,
        //     'short_description' => $request->short_description,
        //     'description' => $request->description,
        $validate = $request->validate([
            'cat_id' => 'required',
            'paid_to' => 'required',
            'description' => 'required',
            'amount' => 'required',
        ], [
            'cat_id.required' => 'Category field is required.',
            'paid_to.required' => 'Reciever Name is required.',
            'description.required' => 'Description field is required.',
            'amount.required' => 'Amount field is required.'
        ]);
        $Inventory = Inventory::find($id);
        $Inventory->categories_id =  $request->cat_id;
        $Inventory->name = $request->name;
        $Inventory->amount = $request->amount;
        $Inventory->paid_to = $request->paid_to;
        $Inventory->paid_to_email = @$request->paid_to_email;
        $Inventory->paid_to_phone1 = @$request->paid_to_phone1;
        $Inventory->paid_to_phone2 = @$request->paid_to_phone2;
        $Inventory->short_description = @$request->short_description;
        $Inventory->description = $request->description;
        $Inventory->save();
        return redirect('accounts/inventory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Inventory = Inventory::find( $id );
        $res = $Inventory->delete();
        if($res){
            return redirect('accounts/inventory');
        }
    }
}
