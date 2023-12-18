<?php

use App\Http\Controllers\ProductController;
use App\Jobs\FetchPrice;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index']);
Route::get('products/add', [ProductController::class, 'create']);
Route::post('products', [ProductController::class, 'store']);
Route::get('products/{product}', [ProductController::class, 'show']);

Route::get('set-product', function () {
    $product = Product::query()->updateOrCreate([
        'name' => 'Amazon Fire TV Stick Lite with all-new Alexa Voice Remote Lite (no TV controls), HD streaming device Now with App controls',
        'url' => 'https://www.daraz.com.np/products/amazon-fire-tv-stick-lite-with-all-new-alexa-voice-remote-lite-no-tv-controls-hd-streaming-device-now-with-app-controls-i118155682-s1032388485.html?spm=a2a0e.searchlist.sku.26.13ad1dddRUJ8vh&search=1'
    ]);

    return FetchPrice::dispatchSync($product);
});
