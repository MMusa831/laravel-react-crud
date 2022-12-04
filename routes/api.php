<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Resources\StudentResource;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/create', [StudentController::class, 'store']);

Route::get('/students', function () {
    return StudentResource::collection(Student::all());
});

Route::get('/student/{id}', function ($id) {
    return new StudentResource(Student::findOrfail($id));
});

Route::put('/update/{id}', [StudentController::class, 'update']);
Route::delete('/delete/{id}', [StudentController::class, 'destroy']);
