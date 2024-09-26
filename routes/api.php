<?php

use App\Http\Controllers\Api\CategoriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'api' ], function (){
    Route::get('/get-main-categories', [CategoriesController::class, 'index']);
});












































// Route::post('login', [AuthController::class, 'login']);
// Route::post('register', [RegisterController::class, 'register']);

// Route::get('/registration-types',  [RegistrationTypeController::class, 'getRegistrationTypes']);
// Route::get('/countries',  [GeneralController::class, 'getCountriesWithCities']);


// Route::prefix('reset-password')->group(function () {
//     Route::post('/send-link', [AuthController::class, 'sendPasswordResetLink']);
//     Route::post('/validate-token', [AuthController::class, 'validatePasswordResetToken']);
//     Route::post('/change', [AuthController::class, 'changePassword']);
// });


// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/logout',  [AuthController::class, 'logout']);

//     Route::post('/verify-otp',  [OtpController::class, 'verifyOtp']);
//     Route::post('/resend-otp',  [OtpController::class, 'resendOtp']);
//     Route::get('/registration-dropdowns',  [RegistrationDropdownController::class, 'getRegistrationDropdowns']);

//     Route::middleware('verified')->group(function () {
//         Route::post('/register-business-info',  [RegisterController::class, 'registerComapny']);
//         Route::post('/compelete-business-info',  [RegisterController::class, 'completeBusinessInfo']);
//         Route::post('/submit-user-systems',  [RegisterController::class, 'registerUserSystems']);

//         Route::get('/registration-systems',  [RegistrationSystemsController::class, 'getRegistrationSystem']);
//         Route::get('/registration-systems-by-type',  [RegistrationSystemsController::class, 'getRegistrationSystemByType']);
//         Route::get('/companies-search',  [RegisterController::class, 'searchCompany']);

//         Route::post('/join-company',  [RegisterController::class, 'joinCompany']);

//         Route::prefix('products')->group(function () {
//             Route::get('/dropdowns', [ProductController::class, 'getProductsDropdownsList']);
//             Route::get('/sheet-template',  [ProductController::class, 'getProductTemplate']);
//             Route::get('/', [ProductController::class, 'getAllProductsForUser']);
//             Route::get('/{id}', [ProductController::class, 'getProductById']);
//             Route::post('/import', [ProductController::class, 'import']);
//             Route::delete('/delete/{id}', [ProductController::class, 'deleteProduct']);
//             Route::post('/submit', [ProductController::class, 'submitProduct']);
//             Route::post('/duplicate/{id}', [ProductController::class, 'duplicateProduct']);
//             Route::patch('/update/{id}', [ProductController::class, 'updateProduct']);
//             Route::delete('/delete-image/{id}', [ProductController::class, 'deleteProductImage']);
//         });

//         // services
//         Route::get('/services/attributes',  [ServiceController::class, 'getAttributes']);
//         Route::get('/services/attributes/systems',  [ServiceController::class, 'getSystemsAttributes']);
//         Route::get('/services/all',  [ServiceController::class, 'getAllServices']);
//         Route::get('/services',  [ServiceController::class, 'getSpecificServices']);
//         Route::get('/services/{id}',  [ServiceController::class, 'getService']);
//         Route::get('/services/edit/{id}',  [ServiceController::class, 'getServiceForEdit']);
//         Route::post('/services/submit',  [ServiceController::class, 'submit']);
//         // update
//         Route::post('/services/{id}/update',  [ServiceController::class, 'update']);
//         Route::delete('/services/{id}',  [ServiceController::class, 'delete']);
//     });

//     Route::get('/profile',  [ProfileController::class, 'profile']);
//     Route::post('/update-profile',  [ProfileController::class, 'updateProfile']);
// });

