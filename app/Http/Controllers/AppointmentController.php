<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class AppointmentController extends Controller
{
    public function patient_index()
    {
        //$patient = Patient::latest()->get();
        $patient = DB::select('SELECT patients.*, docters.name AS dname
FROM patients
LEFT JOIN docters ON patients.doctor_id = docters.id ORDER BY `patients`.`id` DESC;
');
        return view('patient.index')->with('patient',$patient);
    }
    
    
    public function medication_pdf(? string $id){
        //return view('medication_pdf.index');
        
        $medication = DB::table('medication_new')
        ->join('docters','medication_new.doctor_id','=','docters.id')
        ->join('patients','medication_new.patient_id','=','patients.id')
        ->select(
            'medication_new.temperature as temperature',
            'medication_new.blood_pressure as blood_pressure',
            'medication_new.diabetic as diabetic',
            'medication_new.pulse as pulse',
            'medication_new.height as height',
            'medication_new.spo2 as spo2',
            'medication_new.blood_group as blood_group',
            'medication_new.weight as weight',
            'medication_new.diagnosis as diagnosis',
            'medication_new.symptoms as symptoms',
            'medication_new.labtest as labtest',
            'medication_new.medicine_details as medicine_details',
            'medication_new.notes as notes',
            'medication_new.created_at as created_at',
            
            'docters.name as doctor_name',
            'docters.signature as signature',
            'docters.profile_image as profile_image',
            'docters.logo as logo',
            'docters.about as about',
            'docters.hospital_number as hospital_number',
            'docters.alternate_number as alternate_number',
            'docters.mobile as mobile',
            'docters.time as time',
            'docters.address as address',
            
            'patients.name as patient_name',
            'patients.phone as patient_phone',
            'patients.dob as dob',
            'patients.age as age',
            'patients.gender as gender',
            )
        ->where('medication_new.appointment_id',$id)
        ->first();
         return view('medication_pdf.index', compact('medication'));
    }
   
}
