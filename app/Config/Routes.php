<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Recipes::overview');

$routes->match(['get', 'post'], '/login', 'Users::login');

$routes->match(['get', 'post'], '/register', 'Users::register');

$routes->match(['get'], '/log-out', 'Users::log_out');

$routes->get('/dashboard', 'Dashboard::index');
$routes->match(['get', 'post'], '/dashboard/add-recipe', 'AddRecipe::index');
$routes->match(['get', 'post'], '/dashboard/edit/(:segment)', 'EditRecipe::index/$1');
$routes->match(['get', 'post'], '/dashboard/delete/(:segment)', 'DeleteRecipe::index/$1');
$routes->get('recipes/(:segment)', 'Recipes::recipe/$1');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
