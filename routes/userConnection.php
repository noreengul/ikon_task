<?php

Route::get('/suggestions', [App\Http\Controllers\HomeController::class, 'getSuggestion'])->name('suggestions');
Route::get('/sent_requests', [App\Http\Controllers\HomeController::class, 'getSentRequest'])->name('sent_requests');
Route::get('/received_requests', [App\Http\Controllers\HomeController::class, 'getReceivedRequests'])->name('received_requests');
Route::get('/connections', [App\Http\Controllers\HomeController::class, 'getConnections'])->name('connections');

Route::get('/sent-invitation/{id}', [App\Http\Controllers\HomeController::class, 'sendInvitation'])->name('sent-invitation');
Route::get('/accept-network/{id}', [App\Http\Controllers\HomeController::class, 'acceptNetwork'])->name('accept-network');
Route::get('/remove-network/{id}', [App\Http\Controllers\HomeController::class, 'removeNetwork'])->name('remove-network');
Route::get('/withdraw-network/{id}', [App\Http\Controllers\HomeController::class, 'withdrawNetwork'])->name('withdraw-network');
