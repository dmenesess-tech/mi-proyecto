<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

$routes->get('btn1', 'Auth::registroForm');
$routes->get('signup', 'Auth::registroForm');
$routes->post('signup', 'Auth::registrar');

$routes->get('btn2', 'Auth::loginForm');
$routes->get('login', 'Auth::loginForm');
$routes->post('login', 'Auth::login');
$routes->get('forgot-password', 'Auth::forgotPasswordForm');
$routes->post('forgot-password', 'Auth::sendResetLink');

$routes->get('reset-password/(:segment)', 'Auth::resetPasswordForm/$1');
$routes->post('reset-password/(:segment)', 'Auth::updatePassword/$1');

$routes->get('welcome-sesion', function() {
    return view('welcome-sesion');
});

$routes->get('profile', 'Auth::profile');
$routes->get('profile/edit', 'Auth::editProfile');
$routes->post('profile/update', 'Auth::updateProfile');
$routes->get('logout', 'Auth::logout');

