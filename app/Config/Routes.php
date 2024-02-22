<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* home */
$routes->get('/','Home::index');
$routes->get('index','Home::index');

/* controlador ajax */
$routes->post('respuesta','Respuesta::acc');
$routes->get('respuesta','Respuesta::acc'); // temporal

/* encuestas */
$routes->get('encuesta/(:any)','Encuesta::formulario/$1');
$routes->get('gracias','Encuesta::gracias');

/* login */
$routes->get('login','Home::login');

/* admin perfil */
$routes->get('admin','Admin::index');
$routes->get('admin/encuestadescarga/(:any)','Admin::encuestadescarga/$1/$2/$3');
$routes->get('admin/verenviadas/(:any)','Admin::VerEncuestasEnviadas/$1/$2/$3');
$routes->get('admin/logdescarga','Admin::logdescarga');

/* tabla settings */
$routes->get('settings','Settings::index');
$routes->get('settings/(:num)','Settings::index/$1');
$routes->get('settings/create','Settings::create');
$routes->get('settings/edit/(:num)','Settings::edit/$1');
$routes->post('settings/save','Settings::save');
$routes->get('settings/delete/(:num)','Settings::delete/$1');

/* tabla banners */
$routes->get('banners','Banners::index');
$routes->get('banners/(:num)','Banners::index/$1');
$routes->get('banners/create','Banners::create');
$routes->get('banners/edit/(:num)','Banners::edit/$1');
$routes->post('banners/save','Banners::save');
$routes->get('banners/delete/(:num)','Banners::delete/$1');

/* tabla encuestas */
$routes->get('encuestas','Encuestas::index');
$routes->get('encuestas/(:num)','Encuestas::index/$1');
$routes->get('encuestas/create','Encuestas::create');
$routes->get('encuestas/edit/(:any)','Encuestas::edit/$1');
$routes->post('encuestas/save','Encuestas::save');
$routes->get('encuestas/delete/(:any)','Encuestas::delete/$1');

/* Tabla Contactos*/
$routes->get('contactos','Contactos::VerContactos');
$routes->get('contactos/descargaContactos','Contactos::DescargaContactos');


/* tabla encuestas_preguntas */
$routes->get('preguntas','Encuestas::indexpreg');
$routes->get('preguntas/(:num)','Encuestas::indexpreg/$1');
$routes->get('preguntas/(:num)/(:any)','Encuestas::indexpreg/$1/$2');
$routes->get('preguntas/createpreg/(:any)','Encuestas::createpreg/$1');
$routes->get('preguntas/editpreg/(:num)/(:any)','Encuestas::editpreg/$1/$2');
$routes->post('preguntas/savepreg','Encuestas::savepreg');
$routes->get('preguntas/deletepreg/(:num)/(:any)','Encuestas::deletepreg/$1/$2');

/* tabla encuestas_opciones */
$routes->get('opciones','Encuestas::indexopc');
$routes->get('opciones/(:num)','Encuestas::indexopc/$1');
$routes->get('opciones/(:num)/(:any)','Encuestas::indexopc/$1/$2');
$routes->get('opciones/(:num)/(:any)/(:any)','Encuestas::indexopc/$1/$2/$3');
$routes->get('opciones/createopc/(:num)/(:any)','Encuestas::createopc/$1/$2');
$routes->get('opciones/editopc/(:num)/(:any)','Encuestas::editopc/$1/$2');
$routes->post('opciones/saveopc','Encuestas::saveopc');
$routes->get('opciones/deleteopc/(:num)/(:num)/(:any)','Encuestas::deleteopc/$1/$2/$3');


/* uploads files */
$routes->get('upload', 'Admin::upload');
$routes->match(['get', 'post'], 'Admin/uploadFiles', 'Admin::uploadFiles');

//$routes->get('upload', 'UploadMultipleFiles::index');
//$routes->match(['get', 'post'], 'UploadMultipleFiles/uploadFiles', 'UploadMultipleFiles::uploadFiles');
