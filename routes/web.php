<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\RentalsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarsController::class,'index'])->name('car.index');
Route::get('/about', [CarsController::class,'about'])->name('car.about');
Route::get('/contact', [CarsController::class,'contact'])->name('car.contact');
Route::get('/all_cars', [CarsController::class,'allcars'])->name('all.cars');
Route::get('/cars/filter', [CarsController::class, 'filter'])->name('cars.filter');
Route::get('/sroll_table', [CarsController::class,'sroll_table'])->name('sroll_table');
Route::get('/welcome', [CarsController::class,'welcome'])->name('welcome');


//-----------------this is for the storing , edit and update query route under admin login
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('car.admin');
    Route::get('/car/create', [AdminController::class, 'create'])->name('car.create');
    Route::post('/submit-car', [AdminController::class, 'store'])->name('car.store');
    Route::get('/cars/{id}/edit', [AdminController::class, 'edit'])->name('car.edit');
    Route::put('/cars/{id}', [AdminController::class, 'update'])->name('car.update');
    Route::delete('/cars/{id}', [AdminController::class, 'destroy'])->name('car.destroy');
    Route::delete('/rental/{id}', [AdminController::class, 'destroyRental'])->name('rental.destroy');
    Route::delete('/user/delete/{id}', [AdminController::class, 'Userdestroy'])->name('user.destroy');
    
}); 
    

//------------------this is for user dashboard and user profile
Route::get('/dashboard',[CarsController::class,'UserDashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/rental/{id}', [RentalsController::class, 'rental_form'])->name('user.rental');
    Route::post('/rental/store', [RentalsController::class, 'store'])->name('rental.store');
    Route::get('/cars/filter', [CarsController::class, 'filter'])->name('cars.filter');


});

require __DIR__.'/auth.php';
