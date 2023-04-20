<?php

use Illuminate\Support\Collection;
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

Route::get('/', function () {
    $fruits = new Collection([
        ['name' => 'Apple', 'color' => 'Red', 'price' => 0.5],
        ['name' => 'Banana', 'color' => 'Yellow', 'price' => 0.3],
        ['name' => 'Orange', 'color' => 'Orange', 'price' => 0.4],
        ['name' => 'Grapes', 'color' => 'Purple', 'price' => 0.8],
    ]);

    print_r($fruits);
});
