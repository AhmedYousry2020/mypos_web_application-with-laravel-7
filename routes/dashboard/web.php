<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

           Route::prefix('dashboard')->middleware('auth')->name('dashboard.')->group(function (){
           Route::get('/', 'DashboardController@index')->name('index');
           Route::resource('categories','CategoryController')->except(['show']);
           Route::resource('products','ProductController')->except(['show']);
           Route::resource('users','UserController')->except(['show']);
           Route::resource('clients','ClientController')->except(['show']);
           Route::resource('clients.orders','Client\OrderController')->except(['show']);
         
           Route::resource('orders','OrderController')->except(['show']);
           Route::get('/orders/{order}/products','OrderController@products')->name('orders.products');


           

    });

});
