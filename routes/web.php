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





/* Categories */
Route::prefix('categories')->as('categories.')->group(function () {
    Route::get('/index', function(){
        $categories = Http::get(config('app.backend_url').'/api/categories/')->json();
        return view('admin.categories.index', ['categories'=>$categories['categories']]);
    })->name('index');

    Route::get('/create', function(){
        return view('admin.categories.create');
    })->name('create');

    Route::get('/edit/{id}', function($id){
        $category = Http::get(config('app.backend_url').'/api/categories/'.$id)->json();
        return view('admin.categories.edit', ['category'=>$category['category']]);
    })->name('edit');

    Route::get('/show/{id}', function($id){
        $category = Http::get(config('app.backend_url').'/api/categories/'.$id)->json();
        return view('admin.categories.show', ['category'=>$category['category']]);
    })->name('show');
});


/* Price Types */
Route::prefix('price-types')->as('priceTypes.')->group(function () {
    Route::get('/index', function(){
        $priceTypes = Http::get(config('app.backend_url').'/api/price-types/')->json();
        return view('admin.price-types.index', ['priceTypes'=>$priceTypes['priceTypes']]);
    })->name('index');

    Route::get('/create', function(){
        return view('admin.price-types.create');
    })->name('create');

    Route::get('/edit/{id}', function($id){
        $priceType = Http::get(config('app.backend_url').'/api/price-types/'.$id)->json();
        return view('admin.price-types.edit', ['priceType'=>$priceType['priceType']]);
    })->name('edit');

    Route::get('/show/{id}', function($id){
        $priceType = Http::get(config('app.backend_url').'/api/price-types/'.$id)->json();
        return view('admin.price-types.show', ['priceType'=>$priceType['priceType']]);
    })->name('show');
});