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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// auth routes
$route['login']  = 'AuthController';
$route['auth']   = 'AuthController/auth';
$route['logout'] = 'AuthController/logout';

// coach routes
$route['coach']                     = 'CoachController';
$route['coach/addcoachee']          = 'CoachController/addCoachee';
$route['coach/coachee/(:any)']      = 'CoachController/showCoacheeGoals/$1';
$route['coach/coachee/goal/(:any)'] = 'CoachController/ShowCoacheGoal/$1';

// coachee session
$route['coach/coachee/session/(:any)']              = 'CoachController/showCoacheeSessions/$1';
$route['coach/coachee/session/new/(:any)']          = 'CoachController/addSession/$1';
$route['coach/coachee/session/start/(:any)/(:any)'] = 'CoachController/startSession/$1/$2';
$route['coach/coachee/session/end/(:any)/(:any)']   = 'CoachController/endSession/$1/$2';


// coachee routes
$route['coachee']             = 'CoacheeController';
$route['coachee/goals']       = 'CoacheeController/allGoals';
$route['coachee/addgoal']     = 'CoacheeController/addGoal';
$route['coachee/goal/(:any)'] = 'CoacheeController/showGoal/$1';
$route['coachee/addaction']   = 'CoacheeController/addActionPlan';
$route['coachee/addcriteria'] = 'CoacheeController/addCriteria';
$route['coachee/saveResult']  = 'CoacheeController/updateResult';

// admin routes
$route['admin']       = 'AdminController';
$route['admin/login'] = 'AdminController/login';
$route['admin/auth']  = 'AdminController/auth';
