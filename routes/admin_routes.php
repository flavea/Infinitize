<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Basic_Informations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/basic_informations', 'LA\Basic_InformationsController');
	Route::get(config('laraadmin.adminRoute') . '/basic_information_dt_ajax', 'LA\Basic_InformationsController@dtajax');

	/* ================== Members ================== */
	Route::resource(config('laraadmin.adminRoute') . '/members', 'LA\MembersController');
	Route::get(config('laraadmin.adminRoute') . '/member_dt_ajax', 'LA\MembersController@dtajax');

	/* ================== Subunits ================== */
	Route::resource(config('laraadmin.adminRoute') . '/subunits', 'LA\SubunitsController');
	Route::get(config('laraadmin.adminRoute') . '/subunit_dt_ajax', 'LA\SubunitsController@dtajax');

	/* ================== Discography_Types ================== */
	Route::resource(config('laraadmin.adminRoute') . '/discography_types', 'LA\Discography_TypesController');
	Route::get(config('laraadmin.adminRoute') . '/discography_type_dt_ajax', 'LA\Discography_TypesController@dtajax');

	/* ================== Discographies ================== */
	Route::resource(config('laraadmin.adminRoute') . '/discographies', 'LA\DiscographiesController');
	Route::get(config('laraadmin.adminRoute') . '/discography_dt_ajax', 'LA\DiscographiesController@dtajax');

	/* ================== Songs ================== */
	Route::resource(config('laraadmin.adminRoute') . '/songs', 'LA\SongsController');
	Route::get(config('laraadmin.adminRoute') . '/song_dt_ajax', 'LA\SongsController@dtajax');

	/* ================== Awards ================== */
	Route::resource(config('laraadmin.adminRoute') . '/awards', 'LA\AwardsController');
	Route::get(config('laraadmin.adminRoute') . '/award_dt_ajax', 'LA\AwardsController@dtajax');

	/* ================== Drama_Types ================== */
	Route::resource(config('laraadmin.adminRoute') . '/drama_types', 'LA\Drama_TypesController');
	Route::get(config('laraadmin.adminRoute') . '/drama_type_dt_ajax', 'LA\Drama_TypesController@dtajax');

	/* ================== Dramas ================== */
	Route::resource(config('laraadmin.adminRoute') . '/dramas', 'LA\DramasController');
	Route::get(config('laraadmin.adminRoute') . '/drama_dt_ajax', 'LA\DramasController@dtajax');

	/* ================== Drama_Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/drama_roles', 'LA\Drama_RolesController');
	Route::get(config('laraadmin.adminRoute') . '/drama_role_dt_ajax', 'LA\Drama_RolesController@dtajax');

	/* ================== Variety_Shows ================== */
	Route::resource(config('laraadmin.adminRoute') . '/variety_shows', 'LA\Variety_ShowsController');
	Route::get(config('laraadmin.adminRoute') . '/variety_show_dt_ajax', 'LA\Variety_ShowsController@dtajax');

	/* ================== Concerts ================== */
	Route::resource(config('laraadmin.adminRoute') . '/concerts', 'LA\ConcertsController');
	Route::get(config('laraadmin.adminRoute') . '/concert_dt_ajax', 'LA\ConcertsController@dtajax');

	/* ================== Merchandises_Types ================== */
	Route::resource(config('laraadmin.adminRoute') . '/merchandises_types', 'LA\Merchandises_TypesController');
	Route::get(config('laraadmin.adminRoute') . '/merchandises_type_dt_ajax', 'LA\Merchandises_TypesController@dtajax');

	/* ================== Merchandises ================== */
	Route::resource(config('laraadmin.adminRoute') . '/merchandises', 'LA\MerchandisesController');
	Route::get(config('laraadmin.adminRoute') . '/merchandise_dt_ajax', 'LA\MerchandisesController@dtajax');

	/* ================== Varshow_Episodes ================== */
	Route::resource(config('laraadmin.adminRoute') . '/varshow_episodes', 'LA\Varshow_EpisodesController');
	Route::get(config('laraadmin.adminRoute') . '/varshow_episode_dt_ajax', 'LA\Varshow_EpisodesController@dtajax');

	/* ================== Drama_Episodes ================== */
	Route::resource(config('laraadmin.adminRoute') . '/drama_episodes', 'LA\Drama_EpisodesController');
	Route::get(config('laraadmin.adminRoute') . '/drama_episode_dt_ajax', 'LA\Drama_EpisodesController@dtajax');

	/* ================== Music_Videos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/music_videos', 'LA\Music_VideosController');
	Route::get(config('laraadmin.adminRoute') . '/music_video_dt_ajax', 'LA\Music_VideosController@dtajax');

	/* ================== Compositions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/compositions', 'LA\CompositionsController');
	Route::get(config('laraadmin.adminRoute') . '/composition_dt_ajax', 'LA\CompositionsController@dtajax');
});
