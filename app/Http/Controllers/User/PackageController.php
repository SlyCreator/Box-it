<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchAll()
    {
        return Package::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param $packageId
     * @return void
     */
    public function track($trackCode)
    {
        $order    =   Order::where('tracking_code',$trackCode)->first();
        $package    =   Package::where('order_id',$order->id)->get();
        return response()->json(['data' => $package]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AddLocation(Request $request)
    {
        $package = new Package();
        $package->order_id =$request->order_id ;

        if($request->arrival){
            $package->arrival = $request->arrival;
            $package->arrival_at    =   Carbon::now();
        }
        if($request->departure){
            $package->departure   =   $request->departure;
            $package->departure_at =     Carbon::now();
        }
        $package->save();
        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param $packageId
     * @return void
     */
    public function show($packageId)
    {
        $package    =   Package::findOrFail($packageId);
        return response()->json(['data'=>$package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function updateLocation(Request $request,$packageId)
    {
        $package = Package::findOrFail($packageId);
        if($request->arrival){
            $package->arrival = $request->arrival;
            $package->arrival_at    =   Carbon::now();
        }
        if($request->departure){
            $package->departure   =   $request->departure;
            $package->departure_at =     Carbon::now();
        }
        $package->save();
        return response()->json(['message' => 'succcess']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($packageId)
    {
        Package::findOrFail($packageId)->delete();
        return response()->json(['message' => 'success']);
    }
}
