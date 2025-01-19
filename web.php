<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, ConfiguracionController, DepartamentoController, DistritoController, EgresoController, EmpresaController, EspecialidadController,
    HomeController, InformeMedicoController, MedicoController, PacienteController, PagoMedicoController, ProductoFarmaciaController, ProvinciaController, RecetaController, ServicioController, TestimonioController, TipoDocumentoController, UsuarioController, VentaFarmaciaController};

/*========================================= inicializamos la sesion en caso no exista ==============================*/
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

// Ruta para la página principal
Route::get('/', [HomeController::class, 'PageInicio']);
Route::get('/usuario/create', [UsuarioController::class, 'create']);

// Ruta para el Dashboard
Route::get('/dashboard', [HomeController::class, 'Dashboard']);
Route::get('/escritorio', [HomeController::class, 'Desktop']);

// Rutas para tipo de documentos
Route::get('/new-tipo-documento', [TipoDocumentoController::class, 'create']);
Route::post('/save-tipo-documento', [TipoDocumentoController::class, 'save']);
Route::get('/tipo-documentos-existentes', [TipoDocumentoController::class, 'index']);
Route::get('/documentos-existentes', [TipoDocumentoController::class, 'showTipoDocumentos']);