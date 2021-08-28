<?php

use App\Events\SomeOneCheckedProfile;
use App\Http\Controllers\JobController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StudentController;
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
    return view( 'welcome' );
} );

Route::get( '/dashboard', function () {
    return view( 'dashboard' );
} )->middleware( ['auth', 'verified'] )->name( 'dashboard' );

require __DIR__ . '/auth.php';

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

    $user = User::pluck( 'name' );

    dd( $user );

} );

Route::get( '/collection', function () {
    $collection = collect( [1, 1, 2, 3, 3, 3, 4, 5, 5, 6, 7, 8, 9, 10] );
    // dd( $collection->all() );
    // dd( $collection->count() );
    // dd( $collection->countBy() );
    // dd( $collection->sum() );
    //  dd( $collection->sum() / $collection->count() );
    //  dd( $collection->avg());
    //  dd( $collection->chunk(4));
    //  dd( $collection->dump());
    //  dd( $collection->duplicates());
    //  dd( $collection->shuffle());
    //  dd( $collection->min());
    //  dd( $collection->max());
    //  dd( $collection->mode());
    //  dd( $collection->median());
    //  dd( $collection->first());
    dd( $collection->all() );

    //  dd( $collection->last());
    // $collection = collect([
    //     ['product' => 'Desk', 'price' => 200],
    //     ['product' => 'Chair', 'price' => 100],
    //     ['product' => 'Bookcase', 'price' => 150],
    //     ['product' => 'Door', 'price' => 100],
    // ]);

    // $filtered = $collection->where('price', 100);
    // return $filtered;

    // $collection = collect( [
    //     ['product' => 'Desk', 'price' => 200],
    //     ['product' => 'Chair', 'price' => 80],
    //     ['product' => 'Bookcase', 'price' => 150],
    //     ['product' => 'Pencil', 'price' => 30],
    //     ['product' => 'Door', 'price' => 100],
    // ] );

    // $filtered = $collection->whereBetween( 'price', [100, 200] );

    // $filtered->all();

    // $collection = collect([
    //     ['product' => 'Desk', 'price' => 200],
    //     ['product' => 'Chair', 'price' => 100],
    //     ['product' => 'Bookcase', 'price' => 150],
    //     ['product' => 'Door', 'price' => 100],
    // ]);

    // $filtered = $collection->whereIn('price', [100]);

    // $filtered->all();
    // return $filtered;
} );

Route::resource( 'students', StudentController::class );
