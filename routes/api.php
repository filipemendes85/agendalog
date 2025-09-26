<?php

use App\Http\Controllers\api\AuthApiController;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware(['jwt.verify'])->group(function () {

    Route::get('/me', [AuthApiController::class, 'me']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::post('/refresh', [AuthApiController::class, 'refresh']);

    //Incluir aqui as rotas para os recursos de leitura e gravação de dados
    
});
