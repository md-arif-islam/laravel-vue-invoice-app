<?php

namespace App\Http\Controllers;

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

}