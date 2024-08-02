<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'AuthController::login');
/*
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/loginauth', 'AuthController::loginAuth');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/recibos', 'Wso2Controller::fetchData');
$routes->get('admin', 'Admin::index');
*/

$routes->post('/loginPost', 'AuthController::loginPost');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/recibos', 'Wso2Controller::fetchData');

/*  rutas de bonita */
$routes->post('authenticate', 'BonitaController::authenticate');
$routes->post('/bonita/startProcess', 'BonitaController::startProcess');
$routes->post('/bonita/executeTask', 'BonitaController::executeTask');
/** inicio de filtro por roles */

$routes->get('admin/dashboard', 'AdminController::dashboard', ['filter' => 'permission:admin_access']);

/**  fin de filtro por roles*/
 



/*fin de rutas de bonita*/

$routes->group('', ['filter' => 'auth'], function($routes) {
$routes->get('/', 'Home::index');


$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/recibos', 'Wso2Controller::fetchData');
$routes->get('admin', 'Admin::index');
    // Añade aquí más rutas que deban estar protegidas
});



