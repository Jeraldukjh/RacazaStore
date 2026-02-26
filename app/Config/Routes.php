<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/staff/dashboard', 'Staff::dashboard');

$routes->get('/pos', 'Pos::index');
$routes->post('/pos/processSale', 'Pos::processSale');
$routes->get('/pos/sales', 'Pos::sales');

$routes->get('/products', 'Product::index');
$routes->get('/products/create', 'Product::create');
$routes->post('/product/store', 'Product::store');
$routes->get('/product/edit/(:num)', 'Product::edit/$1');
$routes->post('/product/update/(:num)', 'Product::update/$1');
$routes->get('/product/delete/(:num)', 'Product::delete/$1');
