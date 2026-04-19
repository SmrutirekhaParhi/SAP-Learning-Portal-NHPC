<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Sap');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); // enable this only if needed (can be off if all routes are defined manually)

// --- SAP Learning Public Portal ---
$routes->get('/', 'Sap::index');

// --- Admin Panel Routes ---
$routes->get('admin', 'Admin::index');
$routes->post('admin/save', 'Admin::save');
$routes->get('admin/view/(:any)', 'Admin::view/$1');
$routes->get('admin/edit/(:any)', 'Admin::edit/$1');
$routes->post('admin/update/(:any)', 'Admin::update/$1');
$routes->get('admin/delete/(:num)', 'Admin::delete/$1');

// --- Material Viewer (PDF/Video) handler ---
$routes->get('materials/serve', 'Materials::serve');

// --- SAP Dynamic Dropdowns & Search --- 
$routes->get('sap/fetch-modules', 'Sap::fetchModules');
$routes->get('sap/fetch-topics', 'Sap::fetchTopics');
$routes->get('sap/fetch-modules-with-topics', 'Sap::fetchModulesWithTopics');
$routes->get('sap/search', 'Sap::search');
$routes->get('/admin/fixMaterialFileTypes', 'Admin::fixMaterialFileTypes');