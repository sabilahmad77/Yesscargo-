<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipmentWeightCharges;

class AdminSettingsController extends Controller
{
    public function index(){
        //$latestPosts = Post::latest()->take(5)->get();
         $weightPrice =  ShipmentWeightCharges::latest()->take(2)->get();
        //return $weightPrice[0]->price;
        return view('admin_settings.index', compact('weightPrice') );
    }

    public function shipmentWeightPrice(Request $request){
     
        ShipmentWeightCharges::create(['price' => $request->price]);
        return redirect('admin-settings');
    }

    public function currentShipmentRate(Request $request){
        //return $request->weight;
        $weightPrice =  ShipmentWeightCharges::latest()->first();
        return $weightPrice->price * $request->weight;
    }
}
