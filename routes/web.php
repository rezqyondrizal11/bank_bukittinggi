<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MasterChatbotController;
use App\Http\Controllers\PengajuanNasabahController;
use App\Http\Controllers\PrioritasSurveiNasabahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiNasabahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');
    Route::get('/chatbot/history', [ChatbotController::class, 'history'])->name('chatbot.history');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/', [DashboardController::class, 'index'])
        ->name('index');
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    //nasabah routes
    Route::get('/pengajuan-nasabah', [PengajuanNasabahController::class, 'index'])
        ->name('pengajuan_nasabah.index');
    Route::get('pengajuan-nasabah/create', [PengajuanNasabahController::class, 'create'])
        ->name('pengajuan_nasabah.create');
    Route::get('/pengajuan-nasabah/{id}', [PengajuanNasabahController::class, 'show'])
        ->name('pengajuan_nasabah.show');

    Route::get('/pengajuan-nasabah/{id}/edit', [PengajuanNasabahController::class, 'edit'])
        ->name('pengajuan_nasabah.edit');
    Route::put('/pengajuan-nasabah/{id}', [PengajuanNasabahController::class, 'update'])
        ->name('pengajuan_nasabah.update');
    Route::get('/pengajuan_nasabah/persyaratan', [PengajuanNasabahController::class, 'persyaratan'])
        ->name('pengajuan_nasabah.persyaratan');

    route::post('/pengajuan-nasabah/store', [PengajuanNasabahController::class, 'store'])
        ->name('pengajuan_nasabah.store');


    //FO Routes

    Route::prefix('verifikasi-nasabah')->name('verifikasi_nasabah.')->middleware(['auth', 'role:ao'])->group(function () {

        Route::get('/',         [VerifikasiNasabahController::class, 'index'])->name('index');
        Route::get('/{id}',     [VerifikasiNasabahController::class, 'show'])->name('show');
        Route::patch('/dokumen/{id_dokumen}/verifikasi', [VerifikasiNasabahController::class, 'verifikasiDokumen'])
            ->name('verifikasi_dokumen');

        Route::patch('/{id}/status', [VerifikasiNasabahController::class, 'updateStatus'])
            ->name('update_status');
        Route::post('/slik',          [VerifikasiNasabahController::class, 'slikStore'])->name('slik_store');
        Route::put('/slik/{id_slik}', [VerifikasiNasabahController::class, 'slikUpdate'])->name('slik_update');
    });

    //Survei
    Route::get('/perhitungan-prioritas-survei', [PrioritasSurveiNasabahController::class, 'perhitungan'])
        ->name('prioritas_survei.perhitungan');

    Route::get('/prioritas-survei/print', [PrioritasSurveiNasabahController::class, 'printPdf'])
        ->name('prioritas_survei.print');

    Route::prefix('prioritas-survei')->name('prioritas_survei.')->middleware(['auth'])->group(function () {

        Route::get('/',                        [PrioritasSurveiNasabahController::class, 'index'])->name('index');
        Route::get('/show/{id}',                    [PrioritasSurveiNasabahController::class, 'show'])->name('show');
        Route::post('/assign-surveyor',        [PrioritasSurveiNasabahController::class, 'assignSurveyor'])->name('assign_surveyor');
        Route::post('/store-penilaian',        [PrioritasSurveiNasabahController::class, 'storePenilaian'])->name('store_penilaian');
    });

    //direksi
    Route::get('/nasabah-disetujui', [PrioritasSurveiNasabahController::class, 'nasabahDisetujui'])
        ->name('nasabah_disetujui.index');
    Route::get('/nasabah-disetujui/show/{id}', [PrioritasSurveiNasabahController::class, 'show'])
        ->name('nasabah_disetujui.show');
    Route::get('nasabah-disetujui/print/{id}', [PrioritasSurveiNasabahController::class, 'printNasabahDisetujui'])
        ->name('nasabah_disetujui.print_akad');



    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('master_chatbots', MasterChatbotController::class);

        Route::resource('users', UserController::class);
        Route::resource('kriterias', KriteriaController::class)->except(['show']);

        Route::get('kriterias/prioritas', [KriteriaController::class, 'prioritas'])->name('kriterias.prioritas');
        Route::post('kriterias/prioritas', [KriteriaController::class, 'prioritas']);
        Route::post('kriterias/prioritas/reset', [KriteriaController::class, 'reset'])->name('kriterias.reset');
        Route::resource('sub-kriterias', SubKriteriaController::class);
    });
});
