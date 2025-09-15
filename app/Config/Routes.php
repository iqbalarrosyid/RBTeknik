<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/products', 'UserProduct::index');
$routes->get('/product/(:num)', 'UserProduct::detail/$1');
$routes->get('/faq', 'Home::faq');
$routes->get('/contact', 'Home::contact');


$routes->get('admin/', 'Product::index');
$routes->get('admin/product/create', 'Product::create');
$routes->post('admin/product/store', 'Product::store');
$routes->get('admin/product/edit/(:num)', 'Product::edit/$1');
$routes->post('admin/product/update/(:num)', 'Product::update/$1');
$routes->post('admin/product/delete/(:num)', 'Product::delete/$1');
