<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
//$route['default_controller'] = 'welcome';

$route['default_controller'] 	= 'authcontroller/login';
$route['dashboard'] 			= 'authcontroller/dashboard';
$route['authcontroller/login'] 	= 'authcontroller/login';
$route['authcontroller/logout'] = 'authcontroller/logout';

//locations
$route['locationcontroller/index'] = 'LocationController/index';
$route['locationcontroller/create'] = 'LocationController/create';
$route['locationcontroller/edit/(:num)'] = 'LocationController/edit/$1';
$route['locationcontroller/delete/(:num)'] = 'LocationController/delete/$1';

$route['vehicletypecontroller/index'] = 'VehicleTypeController/index';
$route['vehicletypecontroller/create'] = 'VehicleTypeController/create';
$route['vehicletypecontroller/edit/(:num)'] = 'VehicleTypeController/edit/$1';
$route['vehicletypecontroller/delete/(:num)'] = 'VehicleTypeController/delete/$1';

$route['ridedetailcontroller/index'] = 'RideDetailController/index';
$route['ridedetailcontroller/create'] = 'RideDetailController/create';
$route['ridedetailcontroller/edit/(:num)'] = 'RideDetailController/edit/$1';
$route['ridedetailcontroller/delete/(:num)'] = 'RideDetailController/delete/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//API
$route['api/ridedetail/create'] = 'api/RideDetailApi/create';

$route['api/user/signup'] = 'api/UserApi/signup';
$route['api/user/login'] = 'api/UserApi/login';

