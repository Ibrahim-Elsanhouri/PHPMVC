<?php 

use Src\Http\Route;
use App\Controllers\HomeController; 
/*
Route::get('/' , function(){
echo 'hello'; 
}); 
*/

Route::get('/' , [HomeController::class ,  'index']); 