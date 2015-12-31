<?php

// Admin routes for reward
Route::group(array('prefix' =>'admin'), function ()
{
    Route::get('/reward/reward/list', 'Petfinder\Reward\Http\Controllers\RewardAdminController@lists');
    Route::resource('/reward/reward', 'Petfinder\Reward\Http\Controllers\RewardAdminController');
});

// User routes for reward
Route::group(array('prefix' =>'user'), function ()
{
    Route::get('/reward/reward/list', 'Petfinder\Reward\Http\Controllers\RewardUserController@lists');
    Route::resource('/reward/reward', 'Petfinder\Reward\Http\Controllers\RewardUserController');
});

// Public routes for reward
Route::get('reward/reward', 'Petfinder\Reward\Http\Controllers\RewardPublicController@index');
Route::get('reward/reward/{slug?}', 'Petfinder\Reward\Http\Controllers\RewardPublicController@show');