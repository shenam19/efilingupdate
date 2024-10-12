<?php
    /*
    |--------------------------------------------------------------------------
    | Documentation Routes  
    |--------------------------------------------------------------------------
    |
    */
    use App\Http\Controllers\Admin\AdminController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\Admin\MediaController;

    Route::get('index',[AdminController::class,'index']);

    Route::get('users',[UserController::class,'index']);
    Route::get('users/create',[UserController::class,'create']);

    Route::get('media',[MediaController::class,'index']);