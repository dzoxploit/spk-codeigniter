<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Custom Routes
$route['dashboard'] = 'Dashboard/index';
$route['kriteria'] = 'Kriteria/kriteria';
$route['kriteria/add'] = 'Kriteria/kriteria_add';
$route['kriteria/edit/(:any)'] = 'Kriteria/kriteria_edit/$1';
$route['kriteria/delete/(:any)'] = 'Kriteria/kriteria_delete/$1';
$route['kriteria/parameter/(:any)'] = 'Kriteria/parameter/$1';
$route['subkriteria'] = 'Subkriteria/subkriteria';
$route['subkriteria/add'] = 'Subkriteria/subkriteria_add';
$route['subkriteria/insert'] = 'Subkriteria/subkriteria_insert';
$route['subkriteria/edit/(:any)'] = 'Subkriteria/subkriteria_edit/$1';
$route['subkriteria/delete/(:any)'] = 'Subkriteria/subkriteria_delete/$1';
$route['kost'] = 'Kost/index';
$route['kost/add'] = 'Kost/kost_add';
$route['kost/insert'] = 'Kost/kost_insert';
$route['kost/edit/(:any)'] = 'Kost/kost_edit/$1';
$route['kost/delete/(:any)'] = 'Kost/kost_delete/$1';
$route['alternatif'] = 'Perbandingan/alternatif';
$route['alternatif/add'] = 'Perbandingan/alternatif_add';
$route['alternatif/edit/(:any)'] = 'Perbandingan/alternatif_edit/$1';
$route['alternatif/delete/(:any)'] = 'Perbandingan/alternatif_delete/$1';
$route['perbandingan'] = 'Perbandingan/index';
$route['update-kriteria'] = 'Perbandingan/update_kriteria';
$route['perbandingan/subkriteria/(:any)'] = 'Perbandingan/get_subkriteria/$1';
$route['update-subkriteria'] = 'Perbandingan/update_subkriteria';
$route['hasil'] = 'Perbandingan/hasil';
$route['update-rangking'] = 'Perbandingan/update_rangking';
$route['rangking'] = 'Rangking/index';
