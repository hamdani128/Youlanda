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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/auth/login', 'AuthController::index');
$routes->post('/auth/check', 'AuthController::check');
$routes->get('/auth/logout', 'AuthController::logout');
// $routes->resource('apiproduct');
$routes->get('/apiproduct/display_product/(:num)', 'ApiProduct::display_product/$1');
$routes->get('/apiproduct/get_karyawan/(:any)', 'ApiProduct::get_karyawan/$1');
$routes->post('/apiproduct/create', 'ApiProduct::create');
$routes->post('/apiproduct/create_pesanan', 'ApiProduct::create_order_pesanan');
$routes->post('/apiproduct/create_cashbon', 'ApiProduct::create_cashbon');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/sdm/master', 'SDM\MasterSDM::index');
    $routes->get('/sdm/absensi', 'SDM\AbsensiSDM::index');
    $routes->post('/sdm/master/import', 'SDM\MasterSDM::import');
    $routes->get('/sdm/master/delete/(:num)', 'SDM\MasterSDM::delete_sdm/$1');
    $routes->get('/sdm/update_show', 'SDM\MasterSDM::show_update');
    $routes->post('/sdm/add', 'SDM/MasterSDM::add');
    $routes->post('/sdm/update', 'SDM/MasterSDM::update');
    $routes->get('/sdm/show_add_resign', 'SDM/MasterSDM::show_add_resign');
    $routes->post('/sdm/add_resign', 'SDM/MasterSDM::add_resign');

    // resign
    $routes->get('/sdm/resign', 'SDM/MasterSDM::resign');

    $routes->get('/op/master_product', 'OP\OpersionalController::index');
    $routes->post('/op/master_product/insert', 'OP\OpersionalController::insert_master_product');
    $routes->post('/op/master_product/update', 'OP\OpersionalController::update_master_product');
    $routes->get('/op/master_product/delete/(:num)', 'OP\OpersionalController::delete_master_product/$1');
    $routes->get('/op/export_sales/(:any)/(:any)', 'OP\Opersional2Controller::export_sales/$1/$2');
    $routes->get('/op/export_order_sales/(:any)/(:any)', 'OP\Opersional2Controller::export_order_sales/$1/$2');
    $routes->get('/op/cashbon/(:any)/(:any)', 'OP\Opersional2Controller::export_cashbon/$1/$2');
    $routes->get('/audit/filter_audit_sales', 'Audit\AuditController::filter_audit_sales');
    $routes->get('/audit/list_retail', 'Audit\AuditController::list_retail');

    // Surat Jalan
    $routes->get('/op/delivery_order', 'OP\OpersionalController::surat_jalan');
    $routes->get('/op/master_product/delivery_order/add', 'OP\OpersionalController::surat_jalan_add');
    $routes->get('/op/master_product/delivery_order/add_detail', 'OP\OpersionalController::surat_jalan_add_detail');
    $routes->get('/op/delivery_order/invoice/(:num)', 'OP\OpersionalController::surat_jalan_faktur/$1');
    $routes->get('/op/delivery_order/delete/(:num)', 'OP\OpersionalController::surat_jalan_delete/$1');
    $routes->get('/op/delivery_order/filter', 'OP\OpersionalController::surat_jalan_filter');

    $routes->get('/op/filter_income', 'OP\OpersionalController::filter_income');
    $routes->get('/op/filter_qty', 'OP\OpersionalController::filter_qty');
    $routes->get('/op/filter_pesanan', 'OP\OpersionalController::filter_pesanan');
    $routes->get('/op/filter_kasbon', 'OP\OpersionalController::filter_kasbon');
    $routes->get('/op/filter_barang', 'OP\OpersionalController::filter_barang');
    $routes->get('/op/filter_order', 'OP\OpersionalController::filter_order');
    $routes->get('/op/filter_cashbon_employe', 'OP/OpersionalController::filter_income_cashbon');
    $routes->get('/op/filter_free_item', 'OP/OpersionalController::filter_list_free');

    // modul Gudang Operasional
    $routes->get('/op/gd/items', 'OP/OpersionalGudangController::index');
    $routes->get('/op/gd/request', 'OP/OpersionalGudangController::request');
    $routes->get('/op/gd/autocomplete', 'OP/OpersionalGudangController::autocomplete_request');
    $routes->get('/op/gd/entry_by_item', 'OP/OpersionalGudangController::add_entry_by_item');
    $routes->get('/op/gd/id_change_request', 'OP/OpersionalGudangController::id_change_request');
    $routes->get('/op/gd/request/add_detail', 'OP/OpersionalGudangController::add_detail');
    $routes->get('/op/gd/request/add', 'OP/OpersionalGudangController::add_request');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}