<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\App;

// language switcher
Route::post('/language/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// nutrition tracker
Route::middleware('auth')->group(function () {
    Route::get('/nutrition', [\App\Http\Controllers\NutritionController::class, 'index'])->name('nutrition.index');
    Route::post('/nutrition/scan', [\App\Http\Controllers\NutritionController::class, 'scan'])->name('nutrition.scan');
    Route::post('/nutrition/confirm', [\App\Http\Controllers\NutritionController::class, 'confirm'])->name('nutrition.confirm');
    Route::get('/nutrition/search', [\App\Http\Controllers\NutritionController::class, 'search'])->name('nutrition.search');
    Route::post('/nutrition/manual', [\App\Http\Controllers\NutritionController::class, 'manual'])->name('nutrition.manual');
    Route::get('/nutrition/history', [\App\Http\Controllers\NutritionController::class, 'history'])->name('nutrition.history');
    Route::delete('/nutrition/{nutritionLog}', [\App\Http\Controllers\NutritionController::class, 'destroy'])->name('nutrition.destroy');
});

// daily report
Route::middleware('auth')->group(function () {
    Route::get('/report', [\App\Http\Controllers\ReportController::class, 'index'])->name('report');
});

// activity tracker
Route::middleware('auth')->group(function () {
    Route::get('/activities', [\App\Http\Controllers\ActivityController::class, 'index'])->name('activities');
    Route::post('/activities', [\App\Http\Controllers\ActivityController::class, 'store'])->name('activities.store');
    Route::delete('/activities/{activity}', [\App\Http\Controllers\ActivityController::class, 'destroy'])->name('activities.destroy');
});

// comments on articles
Route::middleware('auth')->group(function () {
    Route::post('/articles/{article}/comments', [\App\Http\Controllers\CommentController::class, 'store'])
        ->name('comments.store');
    Route::delete('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

// community discussions
Route::middleware('auth')->group(function () {
    Route::get('/discussions', [\App\Http\Controllers\DiscussionController::class, 'index'])
        ->name('discussions.index');
    Route::get('/discussions/create', [\App\Http\Controllers\DiscussionController::class, 'create'])
        ->name('discussions.create');
    Route::post('/discussions', [\App\Http\Controllers\DiscussionController::class, 'store'])
        ->name('discussions.store');
    Route::get('/discussions/{thread}', [\App\Http\Controllers\DiscussionController::class, 'show'])
        ->name('discussions.show');
    Route::delete('/discussions/{thread}', [\App\Http\Controllers\DiscussionController::class, 'destroy'])
        ->name('discussions.destroy');
    Route::post('/discussions/{thread}/replies', [\App\Http\Controllers\DiscussionReplyController::class, 'store'])
        ->name('replies.store');
    Route::delete('/replies/{reply}', [\App\Http\Controllers\DiscussionReplyController::class, 'destroy'])
        ->name('replies.destroy');
});

// history page
Route::get(
    '/history',
    [\App\Http\Controllers\HistoryController::class, 'index']
)->middleware(['auth'])->name('history');

// health articles
Route::middleware('auth')->group(function () {
    Route::get('/learning', [\App\Http\Controllers\ArticleController::class, 'index'])->name('learning');
    Route::get('/learning/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
});

// SDG detail page
Route::get('/sdg/{id}', [\App\Http\Controllers\SdgController::class, 'show'])->middleware(['auth']);

// quiz page
Route::get('/quiz', [\App\Http\Controllers\QuizController::class, 'index'])->middleware(['auth'])->name('quiz');

// achievements page
Route::get('/achievements', [\App\Http\Controllers\AchievementController::class, 'index'])
    ->middleware(['auth'])->name('achievements');

// quiz result
Route::post('/quiz/result', [\App\Http\Controllers\QuizController::class, 'result'])->middleware(['auth'])->name('quiz.result');
// detect & save location
Route::middleware('auth')->post('/api/location/detect', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'lat' => ['required', 'numeric', 'min:-90', 'max:90'],
        'lon' => ['required', 'numeric', 'min:-180', 'max:180'],
    ]);

    $city = app(\App\Services\WeatherService::class)
        ->getCityFromCoordinates($request->lat, $request->lon);

    if (!$city) {
        return response()->json(['error' => 'Could not determine location'], 422);
    }

    $request->user()->update(['city' => $city]);

    return response()->json(['city' => $city]);
})->name('location.detect');

// body data (post-registration)
Route::middleware('auth')->group(function () {
    Route::get('/body-data', [\App\Http\Controllers\BodyDataController::class, 'index'])->name('body-data');
    Route::post('/body-data', [\App\Http\Controllers\BodyDataController::class, 'store'])->name('body-data.store');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);

    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');

    Route::get('data', [\App\Http\Controllers\Admin\DataController::class, 'index'])->name('data.index');

    Route::resource('quiz-questions', \App\Http\Controllers\Admin\QuizQuestionController::class)
        ->except(['show']);

    Route::get('comments', [\App\Http\Controllers\Admin\CommentController::class, 'index'])
        ->name('comments.index');
    Route::delete('comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])
        ->name('comments.destroy');

    Route::get('discussions', [\App\Http\Controllers\Admin\DiscussionController::class, 'index'])
        ->name('discussions.index');
    Route::patch('discussions/{thread}/pin', [\App\Http\Controllers\Admin\DiscussionController::class, 'pin'])
        ->name('discussions.pin');
    Route::patch('discussions/{thread}/lock', [\App\Http\Controllers\Admin\DiscussionController::class, 'lock'])
        ->name('discussions.lock');
    Route::delete('discussions/{thread}', [\App\Http\Controllers\Admin\DiscussionController::class, 'destroy'])
        ->name('discussions.destroy');
});

require __DIR__.'/auth.php';
