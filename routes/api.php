<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BannerController;
use App\Http\Controllers\Api\v1\CarController;
use App\Http\Controllers\Api\v1\CarModelController;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\CityController;
use App\Http\Controllers\Api\v1\FavoriteSearchController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\OrderOfferController;
use App\Http\Controllers\Api\v1\PartController;
use App\Http\Controllers\Api\v1\PartGroupController;
use App\Http\Controllers\Api\v1\ProducerController;
use App\Http\Controllers\Api\v1\StoreController;
use App\Http\Controllers\Api\v1\SupportMessageController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('login-firebase', [AuthController::class, 'loginFirebase']);
    Route::post('logout', [AuthController::class, 'login'])->middleware('api');
    Route::delete('delete-profile', [UserController::class, 'delete'])->middleware('api');
    Route::post('send-message', [SupportMessageController::class, 'send']);

    Route::post('confirmCode', [AuthController::class, 'confirmCode']);

    Route::get('producers', [ProducerController::class, 'index']);
    Route::get('carModels', [CarModelController::class, 'index']);
    Route::get('parts', [PartController::class, 'index']);
    Route::get('part-groups', [PartGroupController::class, 'getPaginated']);
    Route::get('city', [CityController::class, 'get']);
    Route::get('banners', [BannerController::class, 'get']);

    Route::group(['prefix' => 'car'], function () {
        Route::get('/', [CarController::class, 'getPaginated']);
        Route::post('/', [CarController::class, 'add']);
        Route::get('/my', [CarController::class, 'my']);
        Route::get('/vin', [CarController::class, 'getCarByVin']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('/update', [UserController::class, 'updateProfile']);
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'create']);
        Route::get('my', [OrderController::class, 'indexMy']);

        Route::group(['prefix' => '{order}'], function () {
            Route::get('/', [OrderController::class, 'show']);
            Route::get('/offers', [OrderOfferController::class, 'index']);
            Route::post('/rate', [OrderController::class, 'rate']);
        });
    });

    Route::group(['prefix' => 'offers'], function () {
        Route::get('/my', [OrderOfferController::class, 'myOffers']);
        Route::post('/create', [OrderOfferController::class, 'create']);
        Route::post('/{orderOffer}/accept', [OrderOfferController::class, 'accept']);
    });

    Route::group(['prefix' => 'store'], function () {
        Route::post('login', [AuthController::class, 'loginStore']);
        Route::post('/updateСategory', [StoreController::class, 'updateCategory']);
        Route::get('/{id}', [StoreController::class, 'info']);
        Route::post('/{id}', [StoreController::class, 'edit']);
    });

    Route::group(['prefix' => 'favorite-search'], function () {
        Route::get('/', [FavoriteSearchController::class, 'index']);
        Route::post('/create', [FavoriteSearchController::class, 'create']);
        Route::post('/{favoriteSearch}', [FavoriteSearchController::class, 'update']);
        Route::delete('/{favoriteSearch}', [FavoriteSearchController::class, 'delete']);
    });

    Route::group(['prefix' => 'cart', 'middleware' => 'api'], function () {
        Route::get('/', [CartController::class, 'get']);
        Route::post('/add/{part}', [CartController::class, 'add']);
        Route::delete('/delete/{cart}', [CartController::class, 'delete']);
    });
});
