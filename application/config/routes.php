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
$route['default_controller'] = 'AuthController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// auth routes
$route['login']  = 'AuthController';
$route['auth']   = 'AuthController/auth';
$route['logout'] = 'AuthController/logout';

// coach routes
$route['coach']                                   = 'CoachController';
$route['coach/addcoachee']                        = 'CoachController/addCoachee';
$route['coach/coachee/list/(:num)']               = 'CoachController/showCoacheeByCompanyID/$1';
$route['coach/coachee/(:num)']                    = 'CoachController/showCoacheeGoals/$1';
$route['coach/coachee/goal/(:num)']               = 'CoachController/ShowCoacheGoal/$1';
$route['coach/coachee/note/add']                  = 'CoachController/addNotes';
$route['coach/coachee/goal/milestone/add/(:num)'] = 'CoachController/addMilestone/$1';
$route['coach/coachee/goal/milestone/save']       = 'CoachController/saveMilestone';


// coachee session
$route['coach/coachee/session/(:num)']                  = 'CoachController/showCoacheeSessions/$1';
$route['coach/coachee/session/show/(:num)']				= 'CoachController/showSessionData/$1';
$route['coach/coachee/session/new/(:num)']              = 'CoachController/addSession/$1';
$route['coach/coachee/session/start/(:num)/(:num)']     = 'CoachController/startSession/$1/$2';
$route['coach/coachee/session/end/(:num)/(:num)']       = 'CoachController/endSession/$1/$2';
$route['coach/coachee/session/penilaian/(:num)/(:num)'] = 'CoachController/penilaianSesi/$1/$2';
$route['coach/coachee/session/save-penilaian']          = 'CoachController/savePenilaian';

// report
$route['coach/coachee/session/report/create/(:num)/(:num)'] = 'CoachController/createReport/$1/$2';
$route['coach/coachee/session/report/show/(:num)/(:num)'] = 'CoachController/showReport/$1/$2';

// coachee routes
$route['coachee']                = 'CoacheeController';
$route['coachee/goals']          = 'CoacheeController/allGoals';
$route['coachee/addgoal']        = 'CoacheeController/addGoal';
$route['coachee/goal/(:num)']    = 'CoacheeController/showGoal/$1';
$route['coachee/addaction']      = 'CoacheeController/addActionPlan';
$route['coachee/addcriteria']    = 'CoacheeController/addCriteria';
$route['coachee/saveResult']     = 'CoacheeController/updateResult';
$route['coachee/endGoal/(:num)'] = 'CoacheeController/endGoal/$1';

$route['coachee/report/show/(:num)'] = 'CoacheeController/showReport/$1';

// admin routes
$route['admin']       = 'AdminController';
$route['admin/login'] = 'AdminController/login';
$route['admin/auth']  = 'AdminController/auth';

// admin coach routes
$route['admin/coach/list']  = 'AdminController/coachList';
$route['admin/coach/add']  = 'AdminController/addCoach';
$route['admin/coach/delete/(:num)']  = 'AdminController/deleteCoach/$1';
$route['admin/coach/edit/(:num)']  = 'AdminController/editCoach/$1';
$route['admin/coach/update']  = 'AdminController/updateCoach';

$route['admin/company/list'] = 'AdminController/companyList';
$route['admin/company/save'] = 'AdminController/saveCompany';
$route['admin/company/delete/(:num)'] = 'AdminController/deleteCompany/$1';
$route['admin/company/edit/(:num)'] = 'AdminController/editCompany/$1';
$route['admin/company/update'] = 'AdminController/updateCompany';

$route['admin/coachee/list/(:num)'] = 'AdminController/coacheeList/$1';
$route['admin/coachee/save'] = 'AdminController/saveCoachee';
$route['admin/coachee/delete/(:num)'] = 'AdminController/deleteCoachee/$1';
$route['admin/coachee/edit/(:num)'] = 'AdminController/editCoachee/$1';
$route['admin/coachee/update'] = 'AdminController/updateCoachee';

$route['admin/coachee/goal/list/(:num)'] = 'AdminController/goalList/$1';
$route['admin/coachee/goal/delete/(:num)'] = 'AdminController/deleteGoal/$1';
$route['admin/coachee/goal/edit/(:num)'] = 'AdminController/editGoal/$1';
$route['admin/coachee/goal/update'] = 'AdminController/updateGoal';
$route['admin/coachee/goal/show/(:num)'] = 'AdminController/showGoal/$1';

$route['admin/coachee/action/reset/(:num)/(:num)'] = 'AdminController/resetAction/$1/$2';
$route['admin/coachee/action/delete/(:num)/(:num)'] = 'AdminController/deleteAction/$1/$2';

$route['admin/coachee/criteria/update'] = 'AdminController/updateCriteria';
$route['admin/coachee/criteria/save'] = 'AdminController/saveCriteria';
$route['admin/coachee/criteria/delete/(:num)/(:num)'] = 'AdminController/deleteCriteria/$1/$2';

$route['admin/coachee/notes/delete/(:num)/(:num)'] = 'AdminController/deleteNotes/$1/$2';
$route['admin/coachee/notes/edit/(:num)'] = 'AdminController/editNotes/$1';
$route['admin/coachee/notes/update'] = 'AdminController/updateNotes';

$route['admin/coachee/milestone/show/(:num)'] = 'AdminController/showMilestone/$1';
$route['admin/coachee/milestone/delete/(:num)/(:num)'] = 'AdminController/deleteMilestone/$1/$2';

$route['admin/coachee/session/list/(:num)'] = 'AdminController/sessionList/$1';
$route['admin/coachee/session/show/(:num)'] = 'AdminController/showSessionData/$1';
$route['admin/coachee/session/laporan/delete/(:num)/(:num)'] = 'AdminController/deleteReport/$1/$2';
$route['admin/coachee/session/penilaian/delete/(:num)/(:num)'] = 'AdminController/deletePenilaian/$1/$2';

//profile admin
$route['admin/profile'] = 'AdminController/profile';
$route['admin/profile/update'] = 'AdminController/update_password';

//profile coach
$route['coach/profile'] = 'CoachController/profile';
$route['coach/profile/update'] = 'CoachController/update_password';

//profile coachee
$route['coachee/profile'] = 'CoacheeController/profile';
$route['coachee/profile/update'] = 'CoacheeController/update_password';

//lupa password
$route['auth/lupa_password']   = 'AuthController/forget';
$route['auth/lupa_password/send_email'] = 'AuthController/lupaPassword';
$route['auth/reset_password/(:any)']   = 'AuthController/reset_password/$1';
$route['auth/password_baru/(:any)']   = 'AuthController/inputPassword/$1';
$route['auth/reset_password']   = 'AuthController/reset_password';
