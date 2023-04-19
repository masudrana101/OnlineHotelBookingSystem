<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/insert', function () {
//  return \App\Models\Division::with('district')->get();
//});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [UserController::class, 'register'])->name('register');
Route::get('/hotel-search', [HomeController::class, 'hotel_search'])->name('hotel.search');
Route::get('/hotel-list', [HomeController::class, 'hotel_list'])->name('hotel.hotel-list');
Route::get('/hotel-room/{id}', [HomeController::class, 'hotel_room'])->name('hotel.hotel_room');
Route::get('/contact', [HomeController::class, 'hotel_contact'])->name('hotel.contact');

Route::post('room/booking/{id}', [HomeController::class, 'book_room'])->middleware('auth')->name('book_room');

#customer
Route::prefix('customer')->name('customer.')->middleware('is_customer')->group(function () {

  Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
  })->name('logout');

  Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
  Route::match(['get','post'],'/change-password',[UserController::class, 'change_password'])->name('change-password');
  Route::match(['get','post'],'/change-profile',[UserController::class, 'change_profile'])->name('change-profile');
  Route::get('/booking-list',[CustomerController::class, 'booking_list'])->name('booking.list');
});


# hotel manager
//Route::match(['get', 'post'], '/xmanager', [UserController::class, 'manager_login'])->name('manager.login');
Route::prefix('manager')->name('manager.')->middleware('is_manager')->group(function () {

  Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
  })->name('logout');

  Route::get('/dashboard', [ManagerController::class, 'index'])->name('dashboard');


  # ajax
  Route::prefix('ajax')->name('ajax.')->middleware('auth')->group(function () {
    Route::post('/update/hotel/status', [HotelController::class, 'ajax_update_hotel_status'])->name('update.hotel.status');
  });

  # hotel
  Route::prefix('hotel')->name('hotel.')->group(function () {
    Route::match(['get', 'post'], '/add', [HotelController::class, 'add_hotel'])->name('add');
    Route::get('/view', [HotelController::class, 'view_hotel'])->name('view');
    Route::get('/details/{id}', [HotelController::class, 'details_hotel'])->name('details');
    Route::match(['get', 'post'], '/edit/{id}', [HotelController::class, 'edit_hotel'])->name('edit');
    Route::delete('/delete', [HotelController::class, 'delete_hotel'])->name('delete');
    #room
    Route::prefix('room')->name('room.')->group(function () {
      Route::match(['get', 'post'], '/add/{hotel_id}', [RoomController::class, 'add_room'])->name('add');
      Route::match(['get', 'post'], '/edit/{hotel_id}/{id}', [RoomController::class, 'edit_room'])->name('edit');
      Route::delete('/delete', [RoomController::class, 'delete_room'])->name('delete');
    });
  });

    Route::match(['get','post'],'/change-password',[ManagerController::class, 'change_password'])->name('change-password');
    Route::match(['get','post'],'/change-profile',[ManagerController::class, 'change_profile'])->name('change-profile');
    Route::get('/booking-list',[ManagerController::class, 'booking_list'])->name('booking.list');
    Route::post('/change/booking/status', [ManagerController::class, 'change_booking_status'])->name('change.booking.status');
});


#admin
Route::match(['get', 'post'], '/xadmin', [UserController::class, 'admin_login'])->name('admin.login');
Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {

  Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('admin.login');
  })->name('logout');

  Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

  # ajax
  Route::prefix('ajax')->name('ajax.')->middleware('auth')->group(function () {
    Route::post('/update/manager/status', [AdminController::class, 'ajax_update_manager_status'])->name('update.manager.status');
    Route::post('/update/hotel/status', [HotelController::class, 'ajax_update_hotel_status'])->name('update.hotel.status');
    Route::post('/update/room-type/status', [RoomTypeController::class, 'ajax_update_room_type_status'])->name('update.room-type.status');
  });

  # manager
  Route::prefix('manager')->name('manager.')->group(function () {
    Route::match(['get', 'post'], '/add', [AdminController::class, 'add_manager'])->name('add');
    Route::match(['get', 'post'], '/view', [AdminController::class, 'view_manager'])->name('view');
    Route::match(['get', 'post'], '/edit/{id}', [AdminController::class, 'edit_manager'])->name('edit');
    Route::delete('/delete', [AdminController::class, 'delete_manager'])->name('delete');
  });

  # User
  Route::prefix('user')->name('user.')->group(function () {
      Route::match(['get', 'post'], '/add', [AdminController::class, 'add_user'])->name('add');
      Route::match(['get', 'post'], '/view', [AdminController::class, 'view_user'])->name('view');
      Route::match(['get', 'post'], '/edit/{id}', [AdminController::class, 'edit_user'])->name('edit');
      Route::delete('/delete', [AdminController::class, 'delete_user'])->name('delete');
  });

  Route::prefix('hotel')->name('hotel.')->group(function () {
    Route::match(['get', 'post'], '/add', [HotelController::class, 'add_hotel_admin'])->name('add');
    Route::match(['get', 'post'], '/view', [HotelController::class, 'view_hotel_admin'])->name('view');
    Route::match(['get', 'post'], '/edit/{id}', [HotelController::class, 'edit_hotel_admin'])->name('edit');
    Route::delete('/delete', [HotelController::class, 'delete_hotel_admin'])->name('delete');

  });

  # room type
  Route::prefix('room-type')->name('room-type.')->group(function () {
    Route::match(['get', 'post'], '/add', [RoomTypeController::class, 'add_room_type'])->name('add');
    Route::match(['get', 'post'], '/view', [RoomTypeController::class, 'view_room_type'])->name('view');
    Route::match(['get', 'post'], '/edit/{id}', [RoomTypeController::class, 'edit_room_type'])->name('edit');
    Route::delete('/delete', [RoomTypeController::class, 'delete_room_type'])->name('delete');
  });

  Route::match(['get','post'],'/change-password',[AdminController::class, 'change_password'])->name('change-password');
  Route::match(['get','post'],'/change-profile',[AdminController::class, 'change_profile'])->name('change-profile');
});