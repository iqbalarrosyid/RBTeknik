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
$routes->get('/blog', 'UserBlog::index');
$routes->get('/blog/(:num)', 'UserBlog::detail/$1');
$routes->get('/contact', 'Contact::index');
$routes->post('/contact/send', 'Contact::send');


$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'Product::index');
    $routes->get('product/create', 'Product::create');
    $routes->post('product/store', 'Product::store');
    $routes->get('product/edit/(:num)', 'Product::edit/$1');
    $routes->post('product/update/(:num)', 'Product::update/$1');
    $routes->post('product/delete/(:num)', 'Product::delete/$1');
    $routes->get('blog/', 'Blog::index');
    $routes->get('blog/create', 'Blog::create');
    $routes->post('blog/store', 'Blog::store');
    $routes->get('blog/(:segment)', 'Blog::show/$1');
    $routes->get('blog/edit/(:num)', 'Blog::edit/$1');
    $routes->post('blog/update/(:num)', 'Blog::update/$1');
    $routes->post('blog/delete/(:num)', 'Blog::delete/$1');
});
