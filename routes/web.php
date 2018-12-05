<?php

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

/** @var \Illuminate\Routing\Router $router */

use App\Http\Controllers\HandleProviderCallback;
use App\Http\Controllers\LogOut;
use App\Http\Controllers\RedirectToProvider;
use App\Http\Controllers\ShowHome;

$router->get('/', ShowHome::class)->name('home');
$router->get('register', RedirectToProvider::class)->name('register');
$router->get('login', RedirectToProvider::class)->name('login');
$router->get('confirmation', HandleProviderCallback::class);
$router->get('logout', LogOut::class)->name('logout');
