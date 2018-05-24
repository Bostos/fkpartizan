<?php

	Route::get('/', 'FrontController@index')->name('/');
	Route::get('/news', 'FrontController@news')->name('news');
	Route::get('/news/{id}', 'NewsController@show')->name('news.display');
	Route::get('/team', 'FrontController@team')->name('team');
	Route::get('/vesnik', 'FrontController@vesnik')->name('vesnik');
	Route::get('/matches', 'FrontController@matches')->name('all-matches');
	Route::get('/matches/{id}', 'MatchController@show')->name('one-match');
	Route::get('/competitions', 'FrontController@competitions')->name('competitions');
	Route::get('/competitions/{id}', 'FrontController@single_competition')->name('single-competition');
	Route::post('/competitions/{id}', 'FrontController@single_competition')->name('single-competition');

	Route::get('/login', 'FrontController@login')->name('login');
	Route::post('/login', 'LoginController@login')->name('do-login');
	Route::get('/register', 'FrontController@register')->name('register');
	Route::get('/logout', 'LoginController@logout')->name('logout');

	Route::middleware(['admin'])->group(function(){

		Route::get('/admin', 'FrontController@admin')->name('admin');

		Route::prefix('admin')->group(function (){
			Route::get('/matches/filter', 'MatchController@filter')->name('matches.filter');
			Route::resource('/matches', 'MatchController');
			Route::get('/players/filter', 'PlayerController@filter')->name('players.filter');
			Route::get('/players/sort', 'PlayerController@sort')->name('players.sort');
			Route::resource('/players', 'PlayerController', ['names' => [
			    'index' => 'display-all-players',
			    'create' => 'display-create-form',
			    'store' => 'do-add-player',
			    'edit' => 'display-edit-form',
			    'update' => 'do-edit-player',
			    'destroy' => 'do-delete-player'
			]]);

			Route::get('/playerss/add_caps', 'PlayerController@create_cap')->name('display-insert-cap');
			Route::post('/playerss/store_caps', 'PlayerController@store_cap')->name('do-add-cap');
			
			Route::get('/goals/filter', 'GoalController@filter')->name('goals.filter');
			Route::resource('/goals', 'GoalController');
			Route::resource('/transfers', 'TransferController');
			Route::resource('/news', 'NewsController');
			Route::resource('/photos', 'PhotoController');
			Route::resource('/tables', 'TableController');
			Route::resource('/roles', 'RoleController');
			Route::resource('/menus', 'MenuController');
			Route::resource('/seasons', 'SeasonController');
			Route::resource('/clubs', 'ClubController');

			Route::get('/tables/{id}/fill', 'TableController@create_fill')->name('tables.createFill');
			Route::post('/tables/{id}/doFill', 'TableController@store_fill')->name('tables.storeFill');

			Route::get('/photos/search/{keyword?}', 'PhotoController@find');
		});
		
	});
