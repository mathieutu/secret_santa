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
$router->get('/', 'HomeController')->name('home');
$router->get('register', 'RegistrationController@redirectToProvider')->name('register');
$router->get('confirmation', 'RegistrationController@handleProviderCallback');
$router->redirect('continue', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')->name('continue');
