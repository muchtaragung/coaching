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
$route['coach']                                   = 'CoachController';
$route['coach/addcoachee']                        = 'CoachController/addCoachee';
$route['coach/coachee/(:num)']                    = 'CoachController/showCoacheeGoals/$1';
$route['coach/coachee/goal/(:num)']               = 'CoachController/ShowCoacheGoal/$1';
$route['coach/coachee/note/add']                  = 'CoachController/addNotes';
$route['coach/coachee/goal/milestone/add/(:num)'] = 'CoachController/addMilestone/$1';
$route['coach/coachee/goal/milestone/save']       = 'CoachController/saveMilestone';

// coachee session
$route['coach/coachee/session/(:num)']                  = 'CoachController/showCoacheeSessions/$1';
$route['coach/coachee/session/new/(:num)']              = 'CoachController/addSession/$1';
$route['coach/coachee/session/start/(:num)/(:num)']     = 'CoachController/startSession/$1/$2';
$route['coach/coachee/session/end/(:num)/(:num)']       = 'CoachController/endSession/$1/$2';
$route['coach/coachee/session/penilaian/(:num)/(:num)'] = 'CoachController/penilaianSesi/$1/$2';
$route['coach/coachee/session/save-penilaian']          = 'CoachController/savePenilaian';


// coachee routes
$route['coachee']                = 'CoacheeController';
$route['coachee/goals']          = 'CoacheeController/allGoals';
$route['coachee/addgoal']        = 'CoacheeController/addGoal';
$route['coachee/goal/(:num)']    = 'CoacheeController/showGoal/$1';
$route['coachee/addaction']      = 'CoacheeController/addActionPlan';
$route['coachee/addcriteria']    = 'CoacheeController/addCriteria';
$route['coachee/saveResult']     = 'CoacheeController/updateResult';
$route['coachee/endGoal/(:num)'] = 'CoacheeController/endGoal/$1';

// admin routes
$route['admin']       = 'AdminController';
$route['admin/login'] = 'AdminController/login';
$route['admin/auth']  = 'AdminController/auth';
$route['admin/coach/list']  = 'AdminController/coachList';
$route['admin/coach/add']  = 'AdminController/addCoach';
$route['admin/coach/delete/(:num)']  = 'AdminController/deleteCoach/$1';
$route['admin/coach/edit/(:num)']  = 'AdminController/editCoach/$1';
$route['admin/coach/update']  = 'AdminController/updateCoach';
