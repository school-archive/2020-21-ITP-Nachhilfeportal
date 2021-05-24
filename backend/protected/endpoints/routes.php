<?php

use classes\Route;
use controller\AuthenticationController;
use controller\UserController;

require_once __DIR__ . "/../vendor/autoload.php";


# User
Route::add('/users/?',function(){ UserController::index(); });
Route::add('/user/@me/?',function(){ UserController::show(); });
Route::add('/user/?',function(){ UserController::show(); });
Route::add('/update/?',function(){ UserController::update(); }, 'put');
Route::add('/user/ifunsettutor/?',function(){ UserController::ifUnsetTutor(); });

# Filter
Route::add('/search/?', function () { UserController::filter(); });

# Authentication
Route::add('/auth/login/redirect/?',function(){ AuthenticationController::redirect(); });
Route::add('/auth/login/?',function(){ AuthenticationController::login(); });
Route::add('/auth/logout/?',function(){ AuthenticationController::logout(); });
Route::add('/auth/authtest/?',function(){ AuthenticationController::authtest(); });



Route::run('/api');
