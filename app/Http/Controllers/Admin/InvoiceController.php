<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateInvoice(Request $request,$orderId)
    {
        $order  =   Order::findOrFail($orderId);
        Invoice::create([
            'ref_code' => "Sh".rand()
        ]);
    }
}
