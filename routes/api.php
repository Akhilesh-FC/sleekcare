<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\MedicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!medication_add_new
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::prefix('auth')->group(function () {
      Route::post('/login_patients',[ApiController::class,'loginpatients'])->name('auth.loginpatients');
  //  Route::post('/register',[ApiController::class,'register'])->name('auth.register');
 //   Route::post('/login',[ApiController::class,'login'])->name('auth.login');
   // Route::post('/profile',[ApiController::class,'profile'])->name('auth.profile');
  //  Route::post('/profile/update',[ApiController::class,'update_profile'])->name('auth.update_profile');
   // Route::post('/update_patient',[ApiController::class,'update_patient'])->name('auth.update_patient');
   
   Route::post('/multiple_images',[ApiController::class,'multipleimages'])->name('auth.multipleimages');
// Route::post('/nikita',[ApiController::class,'nikita'])->name('auth.nikita');
// });



// Route::prefix('auth')->group(function () {
    
  //  Route::post('/create',[ApiController::class,'createpatient'])->name('auth.createpatient');
   //      Route::post('/createappointments',[ApiController::class,'createappointments'])->name('createappointments');
   
         Route::post('/createappointmgvhhcents',[ApiController::class,'createappointmgvhhcents'])->name('createappointmgvhhcents');
         Route::post('/medication',[ApiController::class,'medication'])->name('medication');
    
  //akash//  Route::post('/patiens_view',[ApiController::class,'patiens_view'])->name('auth.patiens_view');
    
     ////////////
     
    //  Route::post('/complete_medication',[ApiController::class,'complete_medication'])->name('auth.complete_medication');
      Route::post('/patiens_list',[ApiController::class,'patiens_list']);
            Route::post('/patients_list',[ApiController::class,'patiens_listt']);
            Route::get('/prescriptionDelete',[ApiController::class,'prescriptionDelete']);
   //    Route::any('/search',[ApiController::class,'search']);
      //   Route::any('/search_diagnosis',[ApiController::class,'search_diagnosis']);
       //  Route::any('/sarkar_diagnostic',[ApiController::class,'sarkar_diagnostic']);
         Route::any('/search_alphabetically',[ApiController::class,'search_alphabetically']);
      //  Route::post('/medication_add',[ApiController::class,'medication_add']);
         Route::post('/appointment_list',[ApiController::class,'appointment_list']);
       Route::post('/patients_profile',[ApiController::class,'patiens_profile'])->name('auth.patiens_profile');
     Route::post('/dashboard',[ApiController::class,'home'])->name('auth.dashboard');
      ///////////////////////////////////////////////////////////////////////////////////////////
    Route::post('/medication_symptom_add',[ApiController::class,'medication_symptom_add']);
///////////////////////////////////////////////////////////////////////////////////////////////////////
     Route::get('/appointment_view/{doctor_id}',[ApiController::class,'appointment_view']);
    //  Route::post('/date',[ApiController::class,'date']);
       Route::post('/date_app',[ApiController::class,'date_app']);
       Route::get('/prescription_view/{patient_id}',[ApiController::class,'prescription_list']);
       Route::get('/lab_reports/{patient_id}',[ApiController::class,'lab_reports']);
       
   //   Route::get('/patients_delete/{id}',[ApiController::class,'appointments_delete']);
      
      // Route::get('/appointment_delete/{id}',[ApiController::class,'patiens_delete']);
       Route::post('/appointment_date',[ApiController::class,'appointment_date']);
        Route::post('/appointment_medication',[ApiController::class,'appointment_medication']);
            Route::post('/patients_medication',[ApiController::class,'patients_medication']);
      //    Route::post('/update_appointment',[ApiController::class,'update_appointment']);
             Route::post('/update_medication',[ApiController::class,'update_medication']);
            
             
              Route::post('/prescription_add',[ApiController::class,'prescription']);
                 Route::any('/nikita',[ApiController::class,'nikita']);
                    Route::post('/patient_mobile',[ApiController::class,'patient_mobile']);
                   //   Route::post('/patient_name_list',[ApiController::class,'patient_name_list']);
                    Route::any('/docter_name',[ApiController::class,'docter_name']);
                //  Route::post('/forgot_password',[ApiController::class,'forgot_password']);
             
       Route::get('/medicine_list/',[ApiController::class,'medicine_list']);
     
      Route::get('/TotalPatients',[ApiController::class,'TotalPatients']);
      
        /////// akash  //////////////

   Route::post('/patient_view',[ApiController::class,'patient_view'])->name('auth.patiens_view');
   Route::post('/appointment_view',[ApiController::class,'appointment_view_list_akash']);
   
      
   Route::get('/patient_delete/{id}',[ApiController::class,'appointments_delete']);
   Route::post('/create_patient',[ApiController::class,'createpatient'])->name('auth.createpatient');
   Route::post('/update_patient',[ApiController::class,'update_patient'])->name('auth.update_patient');
      
// });

     
   
   /// today 01 august////
    
   Route::post('/register',[ApiController::class,'register'])->name('auth.register');
   Route::post('/login',[ApiController::class,'login'])->name('auth.login');
   Route::post('/profile_update',[ApiController::class,'profile_update'])->name('auth.update_profile');
   Route::post('/profile',[ApiController::class,'profile'])->name('auth.profile');
   Route::post('/create_appointment',[ApiController::class,'createappointments'])->name('createappointments');
   Route::post('/patient_name_list',[ApiController::class,'patient_name_list']);
   
   Route::post('/update_appointment',[ApiController::class,'update_appointment']);

     
    Route::post('/forget_password',[ApiController::class,'forget_password']);
    Route::get('/appointment_delete/{id}',[ApiController::class,'patiens_delete']);
    Route::post('/forget_pin_verify_mobile',[ApiController::class,'forget_pin_verify_mobile']);
    
        Route::post('/doctor_dashboard',[ApiController::class,'doctor_dashboard'])->name('auth.dashboard');
        Route::post('/finish_appointment',[ApiController::class,'complete_medication'])->name('auth.complete_medication');
        // complete_medication = finish_appointment
        Route::post('/medication_add',[ApiController::class,'medication_add']);
        
    Route::post('/medication_add_new',[MedicationController::class,'medication_add_akash']);
    Route::post('/medication_completed_details',[MedicationController::class,'medication_completed_details']);
    Route::post('/all_completed_appointments',[ApiController::class,'all_completed_appointments']);
    Route::get('/appoi_pdf_parameter/{id}',[MedicationController::class,'appoi_pdf_parameter']);
    //   Route::post('/medicine_list_search',[ApiController::class,'medicine_list_search']);
        
     
     Route::get('/medicine_list/{name}',[ApiController::class,'search']);
     Route::post('/diagnosis_list',[ApiController::class,'search_diagnosis']);
     Route::post('/lab_test_list',[ApiController::class,'sarkar_diagnostic']);
     
     
     
     
     


