<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FuncionarioController;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\AgendaController;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ServicoController;

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

Route::get('/request', function(\Illuminate\Http\Request $request){
    dd($request->input(key: 'key'));
    return $request;
});

// Rotas para o admin
Route::prefix('admin')->group(function() {
    Route::get('', [DashboardController::class, 'index'])->name('admin.index');

    Route::get('/login', [UserController::class, 'getLogin'])->name('admin.login');

    Route::post('/logar', [UserController::class, 'logar'])->name('admin.logar');

    // Grupo de rotas para os funcionarios
    Route::prefix('funcionarios')->group(function() {
        Route::get('', [FuncionarioController::class, 'listar'])->name('funcionarios.listar');

        // Para pegar a página de cadastro
        Route::get('/cadastrar', [FuncionarioController::class, 'getCadastro'])->name('funcionarios.cadastrar');
        // Para cadastrar
        Route::post('/create', [FuncionarioController::class, 'cadastrar'])->name('funcionarios.create');

        // Para pegar a página de editar
        Route::get('/editar/{id}', [FuncionarioController::class, 'getEdit'])->name('funcionarios.editar');
        // Para editar
        Route::post('/edit', [FuncionarioController::class, 'editar'])->name('funcionarios.edit');
        
        // Para Deletar
        Route::post('/deletar', [FuncionarioController::class, 'deletar'])->name('funcionarios.deletar');
    });

    // Grupo de rotas para os clientes
    Route::prefix('clientes')->group(function() {
        Route::get('', [ClienteController::class, 'listar'])->name('clientes.listar');

        // Para pegar a página de cadastro
        Route::get('/cadastrar', [ClienteController::class, 'getCadastro'])->name('clientes.cadastrar');
        // Para cadastrar
        Route::post('/create', [ClienteController::class, 'cadastrar'])->name('clientes.create');

        // Para pegar a página de editar
        Route::get('/editar/{id}', [ClienteController::class, 'getEdit'])->name('clientes.editar');
        // Para editar
        Route::post('/edit', [ClienteController::class, 'editar'])->name('clientes.edit');
        
        // Para Deletar
        Route::post('/deletar', [ClienteController::class, 'deletar'])->name('clientes.deletar');

        // Gerar PDF
        Route::get('/pdf', [ClienteController::class, 'exportarPDF'])->name('clientes.pdf');
    });

    // Grupo de rotas para os Serviços
    Route::prefix('servicos')->group(function() {
        Route::get('', [ServicoController::class, 'listar'])->name('servicos.listar');

        // Para pegar a página de cadastro
        Route::get('/cadastrar', [ServicoController::class, 'getCadastro'])->name('servicos.cadastrar');
        // Para cadastrar
        Route::post('/create', [ServicoController::class, 'cadastrar'])->name('servicos.create');

        // Para pegar a página de editar
        Route::get('/editar/{id}', [ServicoController::class, 'getEdit'])->name('servicos.editar');
        // Para editar
        Route::post('/edit', [ServicoController::class, 'editar'])->name('servicos.edit');
        
        // Para Deletar
        Route::post('/deletar', [ServicoController::class, 'deletar'])->name('servicos.deletar');

        // Gerar PDF
        Route::get('/pdf', [ServicoController::class, 'exportarPDF'])->name('servicos.pdf');
    });

    // Grupo de rotas para agendas
    Route::prefix('agendas')->group(function() {
        Route::get('', [AgendaController::class, 'listar'])->name('agendas.listar');

        // Para pegar a página de cadastro
        Route::get('/agendar', [AgendaController::class, 'getStepOne'])->name('agendas.agendar');

        // Para cadastrar
        Route::post('/create', [AgendaController::class, 'agendar'])->name('agendas.create');
        
        Route::post('/agendar', [AgendaController::class, 'postStepOne'])->name('agendas.step_one');

        Route::post('/finalizar', [AgendaController::class, 'finalizar']);

        // Para pegar a página de editar
        Route::get('/editar/{id}', [AgendaController::class, 'getEdit'])->name('agendas.editar');
        // Para editar
        Route::post('/edit', [AgendaController::class, 'editar'])->name('agendas.edit');
        
        // Para Deletar
        Route::post('/deletar', [AgendaController::class, 'deletar'])->name('agendas.deletar');
    });
});
