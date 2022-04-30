<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\PagamentoController;


Route::match(['post', 'get'], '/', [ SistemaController::class, 'index'])->name('home');

Route::get('/funcionarios', [ FuncionarioController::class, 'index'])->name('funcionarios');
Route::post('/funcionarios', [ FuncionarioController::class, 'salvar'])->name('funcionarios_salvar');
Route::get('/funcionarios/{id}/editar', [ FuncionarioController::class, 'index'])->name('funcionarios_editar');

Route::match(['post', 'get'], '/funcionarios/buscar', [ FuncionarioController::class, 'buscar'])->name('buscar_funcionarios');

Route::delete('/funcionarios/{id}', [ FuncionarioController::class, 'excluir'])->name('funcionarios_excluir');

Route::get('/clientes', [ ClienteController::class, 'index'])->name('clientes');
Route::post('/clientes', [ ClienteController::class, 'salvar'])->name('clientes_salvar');
Route::get('/clientes/{id}/editar', [ ClienteController::class, 'index'])->name('clientes_editar');
Route::delete('/clientes/{id}', [ ClienteController::class, 'excluir'])->name('clientes_excluir');

Route::match(['post', 'get'], '/clientes/buscar', [ ClienteController::class, 'buscar'])->name('buscar_clientes');

Route::get('/servicos', [ ServicoController::class, 'index'])->name('servicos');
Route::post('/servicos', [ ServicoController::class, 'salvar'])->name('servicos_salvar');

Route::get('/servicos/{id}/editar', [ ServicoController::class, 'index'])->name('servicos_editar');
Route::delete('/servicos/{id}/excluir', [ ServicoController::class, 'excluir'])->name('servicos_excluir');

Route::get('/servicos/tipos_servicos', [ ServicoController::class, 'tipos'])->name('tipos_servicos');
Route::post('/servicos/tipos_servicos', [ ServicoController::class, 'tipos_salvar'])->name('tipos_servicos_salvar');

Route::get('/servicos/tipos_servicos/{id}/editar', [ ServicoController::class, 'tipos'])->name('tipos_servicos_editar');
Route::delete('/servicos/tipos_servicos/{id}/excluir', [ ServicoController::class, 'tipos_excluir'])->name('tipos_servicos_excluir');

Route::get('/pagamentos', [ PagamentoController::class, 'index'])->name('pagamentos');
Route::post('/pagamentos', [ PagamentoController::class, 'salvar'])->name('pagamentos_salvar');

Route::get('/pagamentos/{id}/editar', [ PagamentoController::class, 'index'])->name('pagamentos_editar');
Route::delete('/pagamentos/{id}/excluir', [ PagamentoController::class, 'excluir'])->name('pagamentos_excluir');