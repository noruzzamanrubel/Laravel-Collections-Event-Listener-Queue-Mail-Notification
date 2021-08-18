<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;

class JobController extends Controller {

/**
 *
 *
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
 */
    public function enqueue( Request $request ) {
        $details = ['email' => 'recipient@example.com'];
        SendEmail::dispatch( $details );
        echo "Process has Been Complete";
        
    }

}
