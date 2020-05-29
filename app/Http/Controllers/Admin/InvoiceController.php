<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $orderId
     * @return \Illuminate\Http\Response
     */
    public function generateInvoice(Request $request)
    {
        $order  =   Order::findOrFail($request->order_id);

        Invoice::create([
            'ref_code' => "Sh".str_random(4).$request->user()->id.str_random(4).$order->id,
            'order_id' => $order->id,
            'amount'   => ($order->serviceType->amount_per_kg * $order->weight_in_kg)
        ]);
        return response()->json(['message'=>'success']);
    }

    public function fetchAll()
    {
       return Invoice::orderBy('id', 'DESC')->paginate(10);
    }

    public function markAsPaid($invoiceId)
    {
        Invoice::findOrFail($invoiceId)->update([
            'is_paid' => 1
        ]);
        return response()->json(['message' => 'success']);
    }

    public function destroy($invoiceid)
    {
        Invoice::findOrFail($invoiceid)->delete();
        return response()->json(['message' => 'success']);
    }
}
