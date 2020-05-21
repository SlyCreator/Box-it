<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with('shipping')->paginate(10);
        return response()->json(['data' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->name    =   $request->name;
        $order->email   =   $request->email;
        $order->sent_from   =   $request->sent_from;
        $order->service_type_id =   $request->serviceType_id;
        $order->save();
        return response()->json(['message' => 'Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($orderId)
    {
       // $order = Order::findOrFail($orderId);
        $order = Order::all();
        return response()->json(['data'=>$order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @param $orderId
     * @return void
     */
    public function update(Request $request,$orderId)
    {
        $order = Order::findOrFail($orderId);
        DB::transaction(function ()use($order,$request,$orderId){
            $order->weight_in_kg = $request->weight_in_kg;
            $order->height_in_m  = $request->height_in_m;
            $order->length_in_m  = $request->length_in_m;
            $order->user_id    = $request->user()->id;
            $order->save();

            $shipping   =   new Shipping;
            $shipping->order_id = $order->id;
            $shipping->state    =   $request->state;
            $shipping->country  =   $request->country;
            $shipping->address  =   $request->address;
            $shipping->zipCode  =   $request->zipCode;
            $shipping->save();
        });

        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
