<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/signup', static function () {
  return view('signup');  
});

$routes->get('/login', static function () {
  return view('login');
});

$routes->get('/btn1', static function () {
  return view('btn1');
});

$routes->get('home', 'home::index');

$routes->get('/btn2', static function () {
  return view('btn2');
});