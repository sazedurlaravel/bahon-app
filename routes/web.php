<?php

use App\Models\BusinessType;
use App\Models\CapitalRange;
use App\Models\Division;
use App\Models\OwnershipType;
use App\Models\WardNumber;
use App\Models\Zila;
use Illuminate\Support\Facades\Route;

// admin routes
require __DIR__.'/web/admin_auth.php'; 
require __DIR__.'/web/admin.php'; 


// json response routes
Route::get('json_response/division/{division}/zilas', function(Division $division) {
    if(count($division->zilas)) {
        return response()->json(['zilas' => $division->zilas]);
    }

    return response()->json(['error' => 'Zila not found.'], 422);
});
Route::get('json_response/zila/{zila}/pourashavas', function(Zila $zila) {
    if(count($zila->pourashavas)) {
        return response()->json(['pourashavas' => $zila->pourashavas]);
    }

    return response()->json(['error' => 'Pourashava not found.'], 422);
});

Route::get('json_response/ward/{ward}/villages', function(WardNumber $ward) {
   
    if(count($ward->villages)) {
        return response()->json(['villages' => $ward->villages]);
    }

    return response()->json(['error' => 'Village not found.'], 422);
});


Route::get('json_response/ownership/{ownership}/business_types', function(OwnershipType $ownership) {
    if(count($ownership->business_types)) {
        return response()->json(['business_types' => $ownership->business_types]);
    }
    return response()->json(['error' => 'Business Types not found.'], 422);
});


// frontend routes
require __DIR__.'/web/frontend.php';
