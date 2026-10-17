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

$routes->get('welcome-sesion', 'Auth::welcomeSesion');

$routes->get('profile', 'Auth::profile');
$routes->get('profile/edit', 'Auth::editProfile');
$routes->post('profile/update', 'Auth::updateProfile');

$routes->get('verify-password', 'Auth::verifyPasswordForm');
$routes->post('verify-password', 'Auth::verifyPassword');

$routes->get('edit-password', 'Auth::editPasswordForm');
$routes->post('edit-password', 'Auth::updateLoggedInPassword');

$routes->get('profile/image', 'Auth::editProfileImage');
$routes->post('profile/image', 'Auth::updateProfileImage');
$routes->get('profile/image/delete', 'Auth::deleteProfileImageForm');
$routes->post('profile/image/delete', 'Auth::deleteProfileImage');

$routes->get('logout', 'Auth::logout');

$routes->get('users', 'Auth::users');
$routes->get('users/new', 'Auth::newUserForm');
$routes->post('users/new', 'Auth::createUser');
$routes->get('users/(:num)', 'Auth::showUser/$1');
$routes->get('users/(:num)/edit', 'Auth::editUser/$1');
$routes->post('users/(:num)/edit', 'Auth::updateUser/$1');
$routes->post('users/(:num)/delete', 'Auth::deleteUser/$1');

$routes->get('tasks', 'Auth::tasks');
$routes->get('tasks/new', 'Auth::newTaskForm');
$routes->post('tasks/new', 'Auth::createTask');
$routes->get('tasks/(:num)', 'Auth::showTask/$1');
$routes->get('tasks/(:num)/edit', 'Auth::editTask/$1');
$routes->post('tasks/(:num)/edit', 'Auth::updateTask/$1');
$routes->post('tasks/(:num)/delete', 'Auth::deleteTask/$1');

