<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisbarangController;
use App\Http\Controllers\AplikasiItTolController;
use App\Http\Controllers\JenisHardwareController;
use App\Http\Controllers\JenisSoftwareController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ActivityWorkersController;
use App\Http\Controllers\JadwalMaintenanceController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/user/{id}', [UserController::class, 'getById']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthenticationController::class, 'logout']);
    Route::post('/user', [AuthenticationController::class, 'user']);
    
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/update/{id}', [UserController::class, 'updateProfile']);

    Route::post('/toll', [ActivityController::class, 'addactivity_toll']);
    Route::get('/toll', [ActivityController::class, 'getactivity_toll']);
    Route::get('/toll/noPagination', [ActivityController::class, 'getactivity_toll_without_pagination']);
    Route::get('/toll/all', [ActivityController::class, 'getAllActivityTol']);
    Route::get('/toll/{id}', [ActivityController::class, 'getactivity_toll_id']);
    Route::get('/toll/user/{userId}', [ActivityController::class, 'getactivity_toll_by_user']);

    Route::put('/toll/update/{id}', [ActivityController::class, 'edit_activity']);
    Route::delete('/toll/delete/{id}', [ActivityController::class, 'delete_activity']);
    Route::post('/nontoll', [ActivityController::class, 'addactivity_nontoll']);
    Route::get('/nontoll', [ActivityController::class, 'getactivity_nontoll']);
    Route::get('/nontoll/{id}', [ActivityController::class, 'getactivity_nontoll_id']);
    // Route::get('/nontoll/user/{userId}', [ActivityController::class, 'getactivity_nontoll_by_user']);
    Route::put('/nontoll/update/{id}', [ActivityController::class, 'edit_activitynontoll']);
    Route::delete('/nontoll/delete/{id}', [ActivityController::class, 'delete_activitynontoll']);
    Route::post('/toll/{id}/status', [ActivityController::class, 'changeStatus']);

    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::get('/kategori/{id}', [KategoriController::class, 'show']);
    Route::put('/kategori/{id}', [KategoriController::class, 'update']);
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);    

    Route::get('/lokasi', [LokasiController::class, 'index']);
    Route::post('/lokasi', [LokasiController::class, 'store']);
    Route::get('/lokasi/{id}', [LokasiController::class, 'show']);
    Route::put('/lokasi/{id}', [LokasiController::class, 'update']);
    Route::delete('/lokasi/{id}', [LokasiController::class, 'destroy']);

    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang', [BarangController::class, 'store']);
    Route::get('/barang/{id}', [BarangController::class, 'show']);
    Route::get('/logbarang/{id}', [BarangController::class, 'logbarang_byid']);
    Route::put('/barang/{id}', [BarangController::class, 'update']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
    Route::get('/logbarang', [BarangController::class, 'logbarang']);
    Route::post('/barang/{id}/updatestock', [BarangController::class, 'updatestock']);
    Route::put('/barang/{id}/minusstock', [BarangController::class, 'minusstock']);

    Route::get('/jadwal-maintenance', [JadwalMaintenanceController::class, 'index']);
    Route::post('/jadwal-maintenance', [JadwalMaintenanceController::class, 'store']);
    Route::get('/jadwal-maintenance/{id}', [JadwalMaintenanceController::class, 'show']);
    Route::put('/jadwal-maintenance/{id}', [JadwalMaintenanceController::class, 'update']);
    Route::delete('/jadwal-maintenance/{id}', [JadwalMaintenanceController::class, 'destroy']);
    Route::put('/jadwal-maintenancestatus/{id}', [JadwalMaintenanceController::class, 'updateStatus']);



    Route::get('/jenisSoftware', [JenisSoftwareController::class, 'index']);
    Route::post('/jenisSoftware', [JenisSoftwareController::class, 'store']);
    Route::get('/jenisSoftware/{id}', [JenisSoftwareController::class, 'show']);
    Route::delete('/jenisSoftware/{id}', [JenisSoftwareController::class, 'destroy']);

    Route::get('/jenisHardware', [JenisHardwareController::class, 'index']);
    Route::post('/jenisHardware', [JenisHardwareController::class, 'store']);
    Route::get('/jenisHardware/{id}', [JenisHardwareController::class, 'show']);
    Route::delete('/jenisHardware/{id}', [JenisHardwareController::class, 'destroy']);
    Route::get('/jenisHardware/count/problem', [JenisHardwareController::class, 'count_hardware_problem']);

    Route::get('/aplikasi_it_tol', [AplikasiItTolController::class, 'index']);
    Route::post('/aplikasi_it_tol', [AplikasiItTolController::class, 'store']);
    Route::get('/aplikasi_it_tol/{id}', [AplikasiItTolController::class, 'show']);
    Route::delete('/aplikasi_it_tol/{id}', [AplikasiItTolController::class, 'destroy']);

    Route::post('/activity_workers', [ActivityWorkersController::class, 'store']);
    Route::post('/activity_workers/end/{id}', [ActivityWorkersController::class, 'done_activity']);
    Route::post('/activity_workers/end/admin/{id}', [ActivityWorkersController::class, 'done_activity_by_admin']);
    Route::post('/activity_workers/pending/{id}', [ActivityWorkersController::class, 'pending_activity']);
    Route::get('/activity_workers', [ActivityWorkersController::class, 'index']);
    Route::get('/activity_workers/{id}', [ActivityWorkersController::class, 'getByActivityId']);
    Route::get('/activity_workers/user/{id}', [ActivityWorkersController::class, 'getActivityWorkerByUser']);
    Route::get('/activity_workers/grafik/{year}', [ActivityWorkersController::class, 'grafikWaktuPengerjaan']);
    Route::get('/activity_workers/grafik/user/{id}/{year}', [ActivityWorkersController::class, 'grafikWaktuPengerjaanByUser']);

    Route::get('/item', [RegisbarangController::class, 'get_regisbarang']);
    Route::post('/regisbarang', [RegisbarangController::class, 'add_regisbarang']);
    Route::put('/regisbarang/{id}', [RegisbarangController::class, 'update_barang']);
    Route::get('/regisbarang/{id}', [RegisbarangController::class, 'get_regisbarangid']);
    Route::delete('/regisbarang/{id}', [RegisbarangController::class, 'deletebarang']);
   
    Route::get('employee', [EmployeeController::class, 'index']);
    Route::post('employee', [EmployeeController::class, 'store']);
    Route::get('employee/{id}', [EmployeeController::class, 'show']);
    Route::put('employee/{id}', [EmployeeController::class, 'update']);
    Route::delete('employee/{id}', [EmployeeController::class, 'destroy']);

});
Route::get('/tes', function () {
    return 'tes';
});
