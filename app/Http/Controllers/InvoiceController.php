<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller {
    public function get_all_invoice() {
        $invoices = Invoice::with( 'customer' )->orderBy( 'id', "DESC" )->get();

        return response()->json( [
            'invoices' => $invoices,
        ], 200 );
    }

    public function search_invoice( Request $request ) {
        $search_term = $request->get( 's' );
        if ( $search_term != null ) {
            $invoices = Invoice::with( 'customer' )
                ->where( 'id', 'LIKE', "%$search_term" )
                ->orderBy( 'id', "DESC" )
                ->get();

            return response()->json( [
                'invoices' => $invoices,
            ], 200 );
        }

        return $this->get_all_invoice();
    }

    public function create_invoice( Request $request ) {
        $counter = Counter::where( 'key', 'invoice' )->first();
        $random = Counter::where( 'key', 'invoice' )->first();

        $invoice = Invoice::orderBy( 'id', 'DESC' )->first();

        if ( $invoice ) {
            $invoice = $invoice->id + 1;
            $counters = $counter->value + $invoice;
        } else {
            $counters = $counter->value;

        }

        $formData = [
            'number' => $counter->prefix . $counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date( 'Y-m-d' ),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'terms_and_conditions' => "Default",
            'items' => [
                [
                    'product_id' => null,
                    'product' => null,
                    'unit_price' => 0,
                    'quantity' => 1,
                ],
            ],
        ];

        return response()->json( $formData );

    }

}