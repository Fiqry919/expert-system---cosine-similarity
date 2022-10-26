<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/* Read this for remember model function
|--------------------------------------------------------------------------
| - Model Aturan = Metode Similarity
| - Model Pertanyaan = Metode Forward Chaining
|--------------------------------------------------------------------------
*/

# Revalidate Back
Route::group(['middleware' => 'revalidate'], function () {
    # welcome
    Route::get('/', function () {
        return view('welcome_custom');
    });
    Auth::routes();
    # disable route register
    // Auth::routes(['register' => false]);

    /*
    |----------------------------------------------------------------------------------------------------------------------------------------------
    | route admin
    |----------------------------------------------------------------------------------------------------------------------------------------------*/
    Route::middleware('auth', 'verified')->group(function () {
        # dashboard
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        # Penyakit
        Route::resource('/penyakit', 'App\Http\Controllers\admin\PenyakitController')->except('show');
        # Gejala
        Route::resource('/gejala', 'App\Http\Controllers\admin\GejalaController')->except('show');
        # Aturan
        Route::resource('/aturan', 'App\Http\Controllers\admin\AturanController')->except('show');
        # Question
        Route::resource('/question', 'App\Http\Controllers\admin\PertanyaanController')->except('show');
        # history
        Route::resource('/history', 'App\Http\Controllers\admin\HistoryController')->except('create', 'store', 'edit', 'update');
    });
    /*
    |----------------------------------------------------------------------------------------------------------------------------------------------
    | route guest
    |----------------------------------------------------------------------------------------------------------------------------------------------*/
    Route::middleware('auth.guest')->group(function () {
        # Form Konsultasi
        Route::resource('/konsultasi', 'App\Http\Controllers\guest\KonsultasiController')->except('create', 'edit', 'update', 'show', 'destroy');
        # Option Metode
        Route::get('/pilihan', function () {
            if (empty(session('name')) && empty(session('email'))) {
                session()->flash('danger', 'Anda belum mengisi formulir pendaftaran!');
                return redirect('konsultasi');
            } else {
                return view('guest.option');
            }
        })->name('option');
        # Cosine Similarity | Diagnosa dengan pilihan
        Route::resource('/guest/select', 'App\Http\Controllers\guest\DiagnosaController')->except('create', 'edit', 'update', 'show', 'destroy');
        # Forward Chaining | Diagnosa dengan pertanyaan menggunakan paginate
        Route::resource('/question/guest', 'App\Http\Controllers\guest\QuestionController')->except('edit', 'update', 'show', 'destroy');
        # Done
        Route::get('/done', function () {
            # Redirect with delete all session
            return redirect('/')->with(session()->flush());
        })->name('done');
    });
});
