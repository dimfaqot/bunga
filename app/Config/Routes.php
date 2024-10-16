<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing::index');
$routes->get('/logout', 'Landing::logout');
$routes->post('/landing/auth', 'Landing::auth');


$routes->get('/home', 'Home::index');
$routes->post('/home/ganti_password', 'Home::ganti_password');

// user
$routes->get('/user', 'User::index');
$routes->post('/user/add', 'User::add');
$routes->post('/user/update', 'User::update');
$routes->post('/user/delete', 'User::delete');
// options
$routes->get('/options', 'Options::index');
$routes->post('/options/add', 'Options::add');
$routes->post('/options/update', 'Options::update');
$routes->post('/options/delete', 'Options::delete');
// menu
$routes->get('/menu', 'Menu::index');
$routes->post('/menu/add', 'Menu::add');
$routes->post('/menu/update', 'Menu::update');
$routes->post('/menu/delete', 'Menu::delete');
// settings
$routes->get('/settings', 'Settings::index');
$routes->post('/settings/update', 'Settings::update');

// products
$routes->get('/products', 'Products::index');
$routes->post('/products/add', 'Products::add');
$routes->post('/products/update', 'Products::update');
$routes->post('/products/delete', 'Products::delete');

// about
$routes->get('/about', 'About::index');
$routes->post('/about/update', 'About::update');
$routes->get('p-about', 'Pabout::index');
// term
$routes->get('/term', 'Term::index');
$routes->post('/term/update', 'Term::update');
$routes->get('p-term', 'Pterm::index');
