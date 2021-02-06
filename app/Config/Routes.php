<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */


$routes->group('pelamar', ['filter' => 'role:pelamar'], function($routes) {
	$routes->get('/', 'Pelamar::index');
	$routes->get('home', 'Pelamar::index');
	$routes->get('/index.php/pelamar', 'Pelamar::index');
});

$routes->group('perusahaan', ['filter' => 'role:perusahaan'], function($routes) {
	$routes->get('/', 'Perusahaan::index');
	$routes->get('home', 'Perusahaan::index');
	$routes->get('/index.php/perusahaan', 'Perusahaan::index');
});

// $routes->get('/pelamar', 'Pelamar::index', ['filter' => 'role:pelamar']);
// $routes->get('index.php/pelamar', 'Pelamar::index', ['filter' => 'role:pelamar']);

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->group('', ['filter' => 'login'], function($routes){
//     $routes->get('home', 'Home::home');
// });



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
