<?php

use App\Events\SomeOneCheckedProfile;
use App\Http\Controllers\JobController;
use App\Http\Controllers\StripeController;
use App\Jobs\ProcessPayment;
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use App\Notifications\ProfileCheckNotification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get( '/', function () {

    SendWelcomeEmail::dispatch();

    ProcessPayment::dispatch();

    return view( 'welcome' );
} );

Route::get( '/stripe', [StripeController::class, 'stripe'] );
Route::post( '/stripe', [StripeController::class, 'stripePost'] )->name( 'stripe.post' );

Route::get( '/test-email', [JobController::class, 'enqueue'] );

Route::get( '/profilecheck', function () {

    $user = User::inRandomOrder()->first();

    SomeOneCheckedProfile::dispatch( $user );

    echo $user->name . ' Your Profile Checked';
} );

Route::get( '/notify', function () {

    $user = User::inRandomOrder()->first();

    //$user->notify(new OrderShippingNotification);
    $user->notify( new ProfileCheckNotification );

    echo $user->name . ' Your Profile Checked';
} );

Route::get( '/users', function () {

    //$user = User::pluck( 'name' );
    //$user = User::where( 'name', 'Lea Treutel' )->value('email');
    // $user = User::where( 'name', 'Marcellus Fahey' )->value( 'email' );

    $user= User::find(1);

    dd( $user );

} );