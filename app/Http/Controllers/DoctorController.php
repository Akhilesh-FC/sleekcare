<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Docter;
use App\Models\Patient;

class DoctorController extends Controller
{
    public function doctor_index()
    {
        $docter = Docter::where('status', 0)->latest()->get();
        
        return view('doctors.index')->with('docter',$docter);
    }
    public function doctors_patient($id)
    {
        $doctor_patient = DB::table('patients')
    ->select('patients.*', 'docters.name AS dname')
    ->leftJoin('docters', 'patients.doctor_id', '=', 'docters.id')
    ->where('patients.doctor_id', $id)
    ->orderBy('patients.id', 'desc')
    ->get();
        
        return view('doctors.doctor_patient')->with('doctor_patient',$doctor_patient);
    }
    
 public function doctor_approve()
{
    $docters =DB::table('docters')
    ->select('docters.*')
    ->selectRaw('COUNT(DISTINCT patients.id) AS total_patients')
    ->selectRaw('COUNT(DISTINCT appointments.id) AS total_appointments')
    ->leftJoin('patients', 'docters.id', '=', 'patients.doctor_id')
    ->leftJoin('appointments', 'docters.id', '=', 'appointments.doctor_id')
    ->where('docters.status', 1)
    ->groupBy('docters.id')
    ->orderBy('docters.created_at', 'desc')
    ->get();
    return view('doctors.approve')->with('docters', $docters);
}
    
     public function doctor_active($id)
    {
        $roles = Docter::where('id',$id)->update(['status' =>0]);
        return redirect()->route('doctor.index')->with('success', 'Status Update Successfully');  
    }
    public function doctor_inctive($id)
    {
        $roles = Docter::where('id',$id)->update(['status' =>1]);
        return redirect()->route('doctor.index')->with('success', 'Status Update Successfully');
    }
    
    public function doctor_edit($id)
    {
        $getdoctor=DB::table('docters')->select('*')->where('id',$id)->get();
        // print_r($getdoctor);
        return view('doctors.doctor_edit')->with('docters', $getdoctor);
    }
    public function doctor_update(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
            'name'=>'required',
            'mobile'=>'required',
            'stream'=>'required',
            'registration_no'=>'required',
            'town'=>'required',
             'why_us'=>'required'
          ]);
            $id =$request['id'];
            $name =$request['name'];
            $mobile=$request['mobile'];
            $stream = $request['stream'];
            $registration_no = $request['registration_no'];
            $town = $request['town']; 
            $why_us=$request['why_us'];
            
            DB::select("UPDATE `docters` SET `name`='$name',`mobile`='$mobile',`stream`='$stream',`registration_no`='$registration_no',`city`='$town',`whysleekcare_1`='$why_us' WHERE id='$id'");
            return redirect()->route('doctor.approve')->with('success', 'Update Successfully');
    }
    public function doctor_appointment(Request $request)
    {
        // echo "hi";
        $this->validate($request,[
            'id'=>'required'
          ]);
            $id =$request['id'];
            if(empty($id))
            {
                $getappointment = DB::table('appointments')->select('appointments.*','docters.name AS doctorname','docters.mobile AS doctormobile','patients.name AS patient_name','patients.phone AS patient_mobile')
            ->leftJoin('docters', 'appointments.doctor_id', '=', 'docters.id')->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')->get();
            }
            else
            {
               
                $getappointment = DB::table('appointments')->select('appointments.*','docters.name AS doctorname','docters.mobile AS doctormobile','patients.name AS patient_name','patients.phone AS patient_mobile')
            ->leftJoin('docters', 'appointments.doctor_id', '=', 'docters.id')->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')->where('appointments.doctor_id',$id)->get();
                
            }
            
            return view('doctors.appointment')->with('doctor_appointments', $getappointment);
    }
      public function p_appointment(Request $request)
    {
        // echo "hi";
        $this->validate($request,[
            'id'=>'required'
          ]);
            $id =$request['id'];
            if(empty($id))
            {
                $getappointment = DB::table('appointments')->select('appointments.*','docters.name AS doctorname','docters.mobile AS doctormobile','patients.name AS patient_name','patients.phone AS patient_mobile')
            ->leftJoin('docters', 'appointments.doctor_id', '=', 'docters.id')->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')->get();
            }
            else
            {
               
                $getappointment = DB::table('appointments')->select('appointments.*','docters.name AS doctorname','docters.mobile AS doctormobile','patients.name AS patient_name','patients.phone AS patient_mobile')
            ->leftJoin('docters', 'appointments.doctor_id', '=', 'docters.id')->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')->where('appointments.patient_id',$id)->get();
                
            }
            
            return view('doctors.appointment')->with('doctor_appointments', $getappointment);
    }
     public function medication(Request $request)
    {
        // echo "hi";
        $this->validate($request,[
            'id'=>'required'
          ]);
            $id =$request['id'];
            if(!empty($id))
            {
                $getappointment = DB::select("SELECT `medication`.*, `docters`.`name` AS `docters_name`, `docters`.`mobile` AS `docters_mobile` FROM `medication` LEFT JOIN `appointments` ON `medication`.`appointment_id` = `appointments`.`id` LEFT JOIN `docters` ON `medication`.`doctor_id` = `docters`.`id` WHERE `medication`.`appointment_id` = $id;");
            }
           
            
            return view('doctors.medication')->with('doctor_appointments', $getappointment);
    }
      public function doctor_appointment_all()
    {
        // echo "hi";
       
         
                 $getappointment = DB::table('appointments')->select('appointments.*','docters.name AS doctorname','docters.mobile AS doctormobile','patients.name AS patient_name','patients.phone AS patient_mobile')
            ->leftJoin('docters', 'appointments.doctor_id', '=', 'docters.id')->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')->get();
            
              
            
            return view('doctors.all_data_appointments')->with('doctor_appointments', $getappointment);
    }
}
