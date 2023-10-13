<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function ()
{
    return view('welcome');
})->name('home');



Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::get('/dashboard', function ()
    {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // - Custom Routes

    Route::Resources([
        "posts" => PostsController::class,
    ]);
    Route::post("posts/images", [PostsController::class, "saveImage"])->name("posts.saveImage");
    Route::put("posts/flipPublishStatus/{post}", [PostsController::class, "flipPublishStatus"])->name("posts.flipPublishStatus");

    Route::apiResource("events", \App\Http\Controllers\EventController::class);
    Route::apiResource("locations", \App\Http\Controllers\LocationController::class);
    Route::apiResource("scheme-plans", \App\Http\Controllers\SchemePlanController::class);
});

Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/saveAvatar/{user}', [ProfileController::class, 'saveAvatar'])->name('profile.saveAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//  Log Viewer
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

require __DIR__ . '/auth.php';
