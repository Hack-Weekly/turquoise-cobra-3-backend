<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\GeneralAccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\TransactionController;
use App\Models\Asset;
use App\Models\Entity;
use App\Models\GeneralAccount;
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

    // Route::apiResources([
    //     'accounts' => AccountController::class,
    //     'assets' => AssetController::class,
    //     'entities' => EntityController::class,
    //     'general_accounts' => GeneralAccountController::class,
    //     'sources' => SourceController::class,
    //     'transactions' => TransactionController::class,
    // ]);
});
Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//  Log Viewer
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
require __DIR__ . '/auth.php';
