<?php

// Simple health check endpoint
Route::get('/health', function() {
    return response()->json([
        'status' => 'OK',
        'timestamp' => now(),
        'app' => config('app.name'),
        'env' => config('app.env'),
        'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
    ]);
});
