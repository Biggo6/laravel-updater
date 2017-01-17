<?php


Route::group(['prefix'=>'self-updater'], function(){
	Route::get('check', ['uses'=>'Biggo6\LaravelUpdater\Controllers\UpdateController@check']);
});