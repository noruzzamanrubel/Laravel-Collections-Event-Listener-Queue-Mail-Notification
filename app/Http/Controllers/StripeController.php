<?php

namespace App\Http\Controllers;

use App\Jobs\StripeJob;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller {

    public function stripe() {
        return view( 'stripe' );
    }

    /**
     * @param Request $request
     */
    public function stripePost( Request $request ) {

        Stripe\Stripe::setApiKey( env( 'STRIPE_SECRET' ) );
        Stripe\Charge::create( [
            "amount"      => 90 * 100,
            "currency"    => "usd",
            "source"      => $request->stripeToken,
            "description" => "This payment is testing purpose",
        ] );

        StripeJob::dispatch()
            ->delay( now()->addSeconds( 2 ) );

        Session::flash( 'success', 'Payment Successful !' );

        return back();
    }
}
