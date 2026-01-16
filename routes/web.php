<?php

use App\Events\EventTest;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\IntroController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\PrayerCounterController;
use App\Http\Controllers\Admin\TodoCategoryController;
use App\Http\Controllers\Admin\TodoTaskController;
use App\Http\Controllers\Admin\TodoTaskItemController;
use App\Http\Controllers\Admin\WeeklyPlannerController;
use App\Http\Controllers\Admin\DebtController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Web\FormsController;
use App\Http\Controllers\Web\PagesController;
use App\Jobs\SendMailJob;
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
    Route::get('/prayers', [PrayerCounterController::class, 'index'])->name('prayers.index');
    Route::post('/prayers/done/{prayer}', [PrayerCounterController::class, 'done'])->name('prayers.done');
    Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/sections/intro/edit', [IntroController::class, 'edit'])->name('intro.edit');
    Route::put('/sections/intro/update', [IntroController::class, 'update'])->name('intro.update');
    Route::get('/sections/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/sections/about/update', [AboutController::class, 'update'])->name('about.update');
    Route::post('/experience/company/inline', [ExperienceController::class, 'storeCompanyInline'])
        ->name('experience.company.storeInline');
    Route::post('/education/university/inline', [EducationController::class, 'storeUniversityInline'])
        ->name('education.university.storeInline');
    Route::resource('experience', ExperienceController::class)->except(['show']);
    Route::resource('education', EducationController::class)->except(['show']);
    Route::resource('resume', ResumeController::class)->except(['show']);
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('portfolio', PortfolioController::class)->except(['show']);
    Route::resource('gallery', GalleryController::class)->except(['show']);
    Route::resource('skills', SkillController::class)->except(['show']);

    Route::prefix('personal')->name('personal.')->group(function () {
        Route::resource('todo-categories', TodoCategoryController::class)->except(['show']);
        Route::resource('todo-tasks', TodoTaskController::class)->except(['show']);
        Route::post('todo-tasks/{todo_task}/split-items', [TodoTaskController::class, 'splitIntoItems'])
            ->name('todo-tasks.split-items');
        Route::post('todo-tasks/{todo_task}/mark-done', [TodoTaskController::class, 'markDone'])
            ->name('todo-tasks.mark-done');
        Route::post('todo-tasks/{todo_task}/mark-open', [TodoTaskController::class, 'markOpen'])
            ->name('todo-tasks.mark-open');
        Route::post('todo-tasks/reorder', [TodoTaskController::class, 'reorder'])
            ->name('todo-tasks.reorder');
        Route::post('todo-tasks/bulk', [TodoTaskController::class, 'bulkUpdate'])
            ->name('todo-tasks.bulk');
        Route::post('todo-tasks/{todo_task}/items', [TodoTaskItemController::class, 'store'])
            ->name('todo-task-items.store');
        Route::put('todo-tasks/{todo_task}/items/{item}', [TodoTaskItemController::class, 'update'])
            ->name('todo-task-items.update');
        Route::delete('todo-tasks/{todo_task}/items/{item}', [TodoTaskItemController::class, 'destroy'])
            ->name('todo-task-items.destroy');
        Route::post('todo-tasks/{todo_task}/items/{item}/mark-done', [TodoTaskItemController::class, 'markDone'])
            ->name('todo-task-items.mark-done');
        Route::post('todo-tasks/{todo_task}/items/{item}/mark-open', [TodoTaskItemController::class, 'markOpen'])
            ->name('todo-task-items.mark-open');
        Route::post('todo-tasks/{todo_task}/items/{item}/schedule', [TodoTaskItemController::class, 'schedule'])
            ->name('todo-task-items.schedule');
        Route::post('todo-tasks/{todo_task}/items/{item}/unschedule', [TodoTaskItemController::class, 'unschedule'])
            ->name('todo-task-items.unschedule');
        Route::post('todo-tasks/{todo_task}/items/reorder', [TodoTaskItemController::class, 'reorder'])
            ->name('todo-task-items.reorder');
        Route::get('weekly-planner/{weekStart?}', [WeeklyPlannerController::class, 'show'])
            ->name('weekly-planner.show');
        Route::post('weekly-planner/schedule', [WeeklyPlannerController::class, 'schedule'])
            ->name('weekly-planner.schedule');
        Route::post('weekly-planner/unschedule', [WeeklyPlannerController::class, 'unschedule'])
            ->name('weekly-planner.unschedule');
        Route::post('weekly-planner/items/{todo_task}/{item}/schedule', [TodoTaskItemController::class, 'schedule'])
            ->name('weekly-planner.schedule-item');
        Route::post('weekly-planner/items/{todo_task}/{item}/unschedule', [TodoTaskItemController::class, 'unschedule'])
            ->name('weekly-planner.unschedule-item');
        Route::post('weekly-planner/notes', [WeeklyPlannerController::class, 'saveNotes'])
            ->name('weekly-planner.notes');
    });

});

Route::group(['as' => 'dashboard.debts.', 'prefix' => 'dashboard/debts', 'middleware' => 'AuthPerson:admin'], function () {
    Route::get('/', [DebtController::class, 'index'])->name('index');
    Route::get('/{account}', [DebtController::class, 'show'])->name('show');
    Route::post('/transaction', [DebtController::class, 'storeTransaction'])->name('transaction');
    Route::post('/{account}/limit', [DebtController::class, 'updateLimit'])->name('limit');
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
