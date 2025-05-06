<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class MedicationController extends Controller
{
    public function medication_add_akash(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');

        // Validation
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:docters,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'required|exists:appointments,id',
            'medicine_details' => 'required'
        ]);
        
        $validator->stopOnFirstFailure();
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        // Insert Medication Record
        $medication_new = DB::table('medication_new')->insertGetId([
            'appointment_id' => $request->appointment_id,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'temperature' => $request->temperature,
            'blood_pressure' => $request->blood_pressure,
            'diabetic' => $request->diabetic,
            'pulse' => $request->pulse,
            'height' => $request->height,
            'spo2' => $request->spo2,
            'blood_group' => $request->blood_group,
            'weight' => $request->weight,
            'diagnosis' => json_encode($request->diagnosis),
            'symptoms' => json_encode($request->symptoms),
            'labtest' => json_encode($request->lab_test),
            'medicine_details' => json_encode($request->medicine_details),
            'notes' => json_encode($request->notes),
            'created_at' => $date,
        ]);

        // Retrieve Medication Data
        $medication = DB::table('medication_new')
            ->join('docters', 'medication_new.doctor_id', '=', 'docters.id')
            ->join('patients', 'medication_new.patient_id', '=', 'patients.id')
            ->select(
                'medication_new.temperature',
                'medication_new.blood_pressure',
                'medication_new.diabetic',
                'medication_new.pulse',
                'medication_new.height',
                'medication_new.spo2',
                'medication_new.blood_group',
                'medication_new.weight',
                'medication_new.diagnosis',
                'medication_new.symptoms',
                'medication_new.labtest',
                'medication_new.medicine_details',
                'medication_new.notes',
                'medication_new.created_at',
                'docters.name as doctor_name',
                'docters.signature',
                'docters.mobile as mobile',
                'docters.alternate_number as alternate_number',
                'docters.profile_image',
                'docters.about',
                'docters.address as address',
                'docters.time as time',
                'docters.logo as logo',
                'patients.name as patient_name',
                'patients.phone as patient_phone',
                'patients.dob',
                'patients.age',
                'patients.gender'
            )
            ->where('medication_new.id', $medication_new)
            ->first();

        // Generate PDF
        $pdf = Pdf::loadView('medication_pdf.index', compact('medication'))
           ->setPaper('A4', 'portrait')
           ->setOption('isHtml5ParserEnabled', true)
           ->setOption('isPhpEnabled', true);


        // Define the file name and path
        $rand = Str::random(6);
        $newName = $rand . '.pdf';
        $medication_path = 'medication_pdf/' . $newName;

        // Save the PDF to the specified path
        file_put_contents(public_path($medication_path), $pdf->output());
        DB::table('appointments')->where('id', $request->appointment_id)->update(['status' => 0,'medication_pdf' => $medication_path]);

        // Response
        return response()->json(['success' => true, 'message' => 'Medication saved successfully.', 'pdf_name' => $newName]);
    }
    
    
    
      public function appoi_pdf_parameter(? string $id){
          
          $validator = Validator::make(['id'=>$id],[
              'id'=>'required|exists:appointments,id'
              ]);
          $validator->stopOnFirstFailure();
          
          if($validator->fails()){
              return response()->json(['success'=>false,'message'=>$validator->errors()->first()]);
          }
              
        
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
    
         return response()->json(['success'=>true,'message'=>'Appointments pdf details.','data'=>$medication]);
    }
    
    
             public function medication_completed_details(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'patient_id' => 'required|exists:patients,id',
                'doctor_id' => 'required|exists:docters,id',
            ]);
            $validator->stopOnFirstFailure();
        
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
        
            date_default_timezone_set('Asia/Kolkata');
        
            $medications = DB::table('medication_new')
                ->join('docters', 'medication_new.doctor_id', '=', 'docters.id')
                ->join('patients', 'medication_new.patient_id', '=', 'patients.id')
                ->join('appointments','medication_new.appointment_id','=','appointments.id')
                ->select(
                    DB::raw('DATE(medication_new.created_at) as date'),
                    DB::raw('COUNT(*) as count'),
                    DB::raw('GROUP_CONCAT(
                        JSON_OBJECT(
                            "temperature", medication_new.temperature,
                            "blood_pressure", medication_new.blood_pressure,
                            "diabetic", medication_new.diabetic,
                            "pulse", medication_new.pulse,
                            "height", medication_new.height,
                            "spo2", medication_new.spo2,
                            "blood_group", medication_new.blood_group,
                            "weight", medication_new.weight,
                            "diagnosis", medication_new.diagnosis,
                            "symptoms", medication_new.symptoms,
                            "labtest", medication_new.labtest,
                            "medicine_details", medication_new.medicine_details,
                            "notes", medication_new.notes,
                            "created_at", medication_new.created_at,
                            "doctor_name", docters.name,
                            "signature", docters.signature,
                            "profile_image", docters.profile_image,
                            "logo", docters.logo,
                            "about", docters.about,
                            "hospital_number", docters.hospital_number,
                            "alternate_number", docters.alternate_number,
                            "mobile", docters.mobile,
                            "time", docters.time,
                            "address", docters.address,
                            "patient_name", patients.name,
                            "patient_phone", patients.phone,
                            "dob", patients.dob,
                            "age", patients.age,
                            "gender", patients.gender,
                            "pdf",appointments.medication_pdf
                        )
                    ) as data')
                )
                ->where('medication_new.patient_id', $request->patient_id)
                ->where('medication_new.doctor_id', $request->doctor_id)
                ->groupBy(DB::raw('DATE(medication_new.created_at)'))
                ->orderBy('medication_new.id', 'desc')
                ->get();
        
            // Process the data to convert JSON strings back to arrays
            $medications->transform(function ($item) {
                $item->data = json_decode('[' . $item->data . ']', true);
                return $item;
            });
        
            return response()->json(['success' => true, 'message' => 'Appointments pdf details.', 'data' => $medications]);
        }

    
    
    
    

}
