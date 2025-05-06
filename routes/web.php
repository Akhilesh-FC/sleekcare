<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SubadminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DrlocationController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Auth

Route::get('/',[Controller::class,'auth_index'])->name('auth.index');

Route::post('/auth/login',[Controller::class,'auth_login'])->name('auth.login');

Route::any('logout',[Controller::class,'logout'])->name('auth.logout');


// Route::get('/',[Controller::class,'login_index'])->name('login.index');

Route::middleware(['auth'])->group(function () {
    
Route::get('/dashboard',[Controller::class,'dashboard'])->name('dashboard');

//users and System-users

Route::get('/users',[SubadminController::class,'user_index'])->name('user.index');
Route::get('/user-active/{id}',[SubadminController::class,'user_active'])->name('user.active');
Route::get('/user-inactive/{id}',[SubadminController::class,'user_inctive'])->name('user.inactive');
Route::get('/users-active/{id}',[SubadminController::class,'users_active'])->name('users.active');
Route::get('/users-inactive/{id}',[SubadminController::class,'users_inctive'])->name('users.inactive');
Route::get('/system_users/{id}',[SubadminController::class,'system_users_index'])->name('system_users.index');
Route::get('/system_users/create',[SubadminController::class,'system_users_create'])->name('system_users.create');
Route::post('/system_users/store',[SubadminController::class,'system_users_store'])->name('system_users.store');
Route::get('/system_users/edit/{id}',[SubadminController::class,'system_users_edit'])->name('system_users.edit');
Route::get('/system_users/view/{id}',[SubadminController::class,'system_users_view'])->name('system_users.view');
Route::put('/system_users/update/{id}',[SubadminController::class,'system_users_update'])->name('system_users.update');
Route::get('/sleekcare/setting',[SubadminController::class,'sleekcare_setting'])->name('sleekcare.setting');
Route::PATCH('/sleekcare/logo',[SubadminController::class,'sleekcare_logo'])->name('sleekcare.logo');

Route::put('/sleekcare/banner',[SubadminController::class,'sleekcare_banner'])->name('sleekcare.banner');


Route::get('/sleekcare/edit/{id}',[SubadminController::class,'sleekcare_edit'])->name('sleekcare.edit');

Route::put('/sleekcare/update/{id}',[SubadminController::class,'sleekcare_update'])->name('sleekcare.update');

Route::get('/sleekcare/active/{id}',[SubadminController::class,'sleekcare_active'])->name('sleekcare.active');
Route::get('/sleekcare/inactive/{id}',[SubadminController::class,'sleekcare_inactive'])->name('sleekcare.inactive');

Route::get('/role',[RoleController::class,'role_index'])->name('role.index');
Route::get('/role-create',[RoleController::class,'role_create'])->name('role.create');
Route::post('/role-store',[RoleController::class,'role_store'])->name('role.store');
Route::get('/role-active/{id}',[RoleController::class,'role_active'])->name('role.active');
Route::get('/role-inctive/{id}',[RoleController::class,'role_inctive'])->name('role.inctive');
Route::get('/role-edit/{id}',[RoleController::class,'role_edit'])->name('role.edit');
Route::put('/role-update/{id}',[RoleController::class,'role_update'])->name('role.update');

Route::get('/r&p-create',[RoleController::class,'rp_index'])->name('rp.index');
Route::post('/r&p-store',[RoleController::class,'rp_store'])->name('rp.store');
Route::post('/r&p-edit/{id}',[RoleController::class,'rp_edit'])->name('rp.edit');




Route::get('/sleekcare-role/{id}',[SubadminController::class,'sleekcare_role'])->name('sleekcare.role');

//package

Route::get('package',[PackageController::class,'package_index'])->name('package.index');

Route::get('medicine',[PackageController::class,'medicine'])->name('package.medicine');



Route::get('/package-create',[PackageController::class,'package_create'])->name('package.create');
Route::post('/package-store',[PackageController::class,'package_store'])->name('package.store');

Route::any('/medicine_store',[PackageController::class,'medicine_store'])->name('package.medicine_store');



 Route::any('/medicine_create',[PackageController::class,'medicine_create'])->name('package.medicine_create');
// Route::post('/package-store',[PackageController::class,'package_store'])->name('package.store');

// Speciality 

Route::get('/speciality',[SpecialityController::class,'speciality_index'])->name('speciality.index');
Route::post('/speciality/store',[SpecialityController::class,'speciality_store'])->name('speciality.store');
Route::get('/speciality/edit/{id}',[SpecialityController::class,'speciality_edit'])->name('speciality.edit');
Route::put('/speciality/update/{id}',[SpecialityController::class,'speciality_update'])->name('speciality.update');


//Doctor location 

Route::get('/doctor-location',[DrlocationController::class,'dl_index'])->name('dl.index');


//Coupon 


Route::get('/coupon',[CouponController::class,'coupon_index'])->name('coupon.index');
Route::get('/coupon-create',[CouponController::class,'coupon_create'])->name('coupon.create');
Route::post('/coupon-store',[CouponController::class,'coupon_store'])->name('coupon.store');
//doctor
Route::get('/doctors',[DoctorController::class,'doctor_index'])->name('doctor.index');
Route::get('/doctors-approve/',[DoctorController::class,'doctor_approve'])->name('doctor.approve');
Route::get('/doctors-patient/{id}',[DoctorController::class,'doctors_patient'])->name('doctors.patient');

Route::get('/doctors-active/{id}',[DoctorController::class,'doctor_active'])->name('doctor.active');
Route::get('/doctors-inactive/{id}',[DoctorController::class,'doctor_inctive'])->name('doctor.inactive');

Route::get('/doctors-edit/{id}',[DoctorController::class,'doctor_edit'])->name('doctor.edit');
Route::post('/doctors-update',[DoctorController::class,'doctor_update'])->name('doctor.update');
Route::get('/doctors-appointment',[DoctorController::class,'doctor_appointment'])->name('doctor.appointment');
Route::get('/p_appointment',[DoctorController::class,'p_appointment'])->name('doctor.p_appointment');
Route::any('/medication',[DoctorController::class,'medication'])->name('doctor.medication');
Route::get('/doctor_appointment_all',[DoctorController::class,'doctor_appointment_all'])->name('doctor.appointment');

//Patient
Route::get('/patient',[PatientController::class,'patient_index'])->name('patient.index');
Route::get('/patient/edit/{id}',[PatientController::class,'patient_edit'])->name('patient.edit');
Route::post('/patient_update/{id}',[PatientController::class,'patient_update'])->name('patient.update');
// Route::get('/doctor',function(){
//     return view('docter.index');
// })->name('docter.index');

});

Route::get('/medication_pdf/{id}',[AppointmentController::class,'medication_pdf'])->name('medication_pdf');
Route::get('/medication_pdf_test/{id}',[AppointmentController::class,'medication_pdf_test'])->name('medication_pdf_test');







