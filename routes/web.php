<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){
    return view('admin.admin-home');
})->name('dashboard');


/* Products */
Route::prefix('products')->as('products.')->group(function () {
    Route::get('/index', function(){
        $products = Http::get(config('app.backend_url').'/api/products/')->json();
        return view('admin.products.index', ['products'=>$products['products']]);
    })->name('index');

    Route::get('/create', function(){
        $categories = Http::get(config('app.backend_url').'/api/categories/')->json();
        $priceTypes = Http::get(config('app.backend_url').'/api/price-types/')->json();
        return view('admin.products.create', ['categories'=>$categories['categories'], 'priceTypes'=>$priceTypes['priceTypes']]);
    })->name('create');

    Route::get('/edit/{id}', function($id){
        $categories = Http::get(config('app.backend_url').'/api/categories/')->json();
        $product = Http::get(config('app.backend_url').'/api/products/'.$id)->json();    
        $priceTypes = Http::get(config('app.backend_url').'/api/price-types/')->json();
        return view('admin.products.edit', ['categories'=>$categories['categories'], 'priceTypes'=>$priceTypes['priceTypes'], 'product'=>$product['product']]);
    })->name('edit');

    Route::get('/show/{id}', function($id){
        $product = Http::get(config('app.backend_url').'/api/products/'.$id)->json();

        return view('admin.products.show', ['product'=>$product['product']]);
    })->name('show');
});

