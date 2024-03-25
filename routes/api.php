<?php

use App\Http\Controllers\LeaveRequestController;
use Illuminate\Support\Facades\Route;


// Route::resource('leave-requests', LeaveRequestController::class)->withoutMiddleware(['csrf']);
Route::get('leave-requests/create', [LeaveRequestController::class, 'create']);
Route::get('leave-requests/{leaveRequest}', [LeaveRequestController::class, 'show']);
Route::put('leave-requests/{leaveRequest}', [LeaveRequestController::class, 'update']);
Route::delete('leave-requests/{leaveRequest}', [LeaveRequestController::class, 'destroy']);
Route::get('leave-requests/{leaveRequest}/edit', [LeaveRequestController::class, 'edit']);
Route::post('leave-requests', [LeaveRequestController::class, 'store']);
Route::get('leave-requests', [LeaveRequestController::class, 'index']);
Route::post('leave-requests/batch', [LeaveRequestController::class, 'createTestBatch']);
