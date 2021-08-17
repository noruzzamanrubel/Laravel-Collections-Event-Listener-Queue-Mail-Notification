<?php

namespace App\Jobs;

use App\Mail\StripepaymentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class StripeJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var mixed
     */

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Mail::to('taylor@example.com')->send( new StripepaymentMail() );
    }
}
