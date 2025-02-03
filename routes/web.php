<?php

use App\Events\EventTest;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IntroController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Web\FormsController;
use App\Http\Controllers\Web\PagesController;
use App\Jobs\SendMailJob;
use App\Mail\TestMailable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('front.homepage');
});

/**************************** FRONTEND ROUTES *****************************/

Route::get('/', [PagesController::class, 'index'])->name('front.homepage');
Route::get('/contact-us', [PagesController::class, 'index'])->name('front.contact');

Route::post('/contact-us/submit', [FormsController::class, 'contactUsRequest'])->name('front.contact-us.submit');


/**************************** ADMIN ROUTES ********************************/

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::group(['as' => 'admin.', 'prefix' => 'dashboard', 'middleware' => 'AuthPerson:admin'], function () {
    Route::get('/', [ContactUsController::class, 'index'])->name('index');
    Route::post('/contact/reply', [ContactUsController::class, 'replyToContactRequest'])->name('contact.reply');
    Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/sections/intro/edit', [IntroController::class, 'edit'])->name('intro.edit');
    Route::put('/sections/intro/update', [IntroController::class, 'update'])->name('intro.update');
    Route::get('/sections/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/sections/about/update', [AboutController::class, 'update'])->name('about.update');

});

Route::fallback(function () {
    return view('404');
});

Route::get('run-optimize/day{day_number}', function ($day_number) {
    $today = date('d');
    if ($day_number == $today) {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        dd('Caches cleared, configurations optimized, routes cleared, and new migrations run.');
    } else {
        abort(404);
    }
})->where('day_number', '[0-9]{2}');

Route::get('run-migrate/day{day_number}', function ($day_number) {
    $today = date('d');
    if ($day_number == $today) {
        Artisan::call('migrate', ['--force' => true]);
        dd('new migrations run successfully');
    } else {
        abort(404);
    }
})->where('day_number', '[0-9]{2}');

Route::get('event/test', function () {
    event(new EventTest('Test txt from event'));
});

Route::get('send/message', function(){
    // SendMailJob::dispatch();  // with QUEUE_CONNECTION=sync
    $job = (new SendMailJob)->delay(Carbon::now()->addSeconds(5));
    dispatch($job);
    return 'test Jobs message';
});

Route::group(['middleware' => 'api' ], function (){
    Route::post('/get-main-categories', [CategoriesController::class, 'index']);
});
