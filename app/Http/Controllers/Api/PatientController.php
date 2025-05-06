<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class PatientController extends Controller
{
    public function patient_index()
    {
        //$patient = Patient::latest()->get();
        $patient = DB::select('SELECT
    patients.*,
    docters.name AS dname,
    COUNT(appointments.id) AS total_appointments
FROM
    patients
LEFT JOIN
    docters ON patients.doctor_id = docters.id
LEFT JOIN
    appointments ON patients.id = appointments.patient_id
GROUP BY
    patients.id
ORDER BY
    patients.id DESC;
');
  

        return view('patient.index')->with('patient',$patient);
    }
    
//      public function patient_edit($id)
//     {
//         $patient = DB::select('SELECT patients.*, docters.name AS dname
//      FROM patients
//   LEFT JOIN docters ON patients.doctor_id = docters.id
//  WHERE patients.id = 6');
//         return redirect()->route('doctor.index')->with('success', 'Status Update Successfully');  
//     }
    public function patient_edit($id)
    {
        $getdoctor=DB::table('patients')->select('*')->where('id',$id)->get();
        // print_r($getdoctor);
        return view('patient.patient_edit')->with('docters', $getdoctor);
    
    }
    // In your controller method for updating a patient
public function patient_update(Request $request, $id)
{
    $patient = Patient::findOrFail($id);
   
    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'height' => 'required',
        'weight' => 'required',
        'age' => 'required',
        'dob' => 'required',
        'gender' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow null for image
    ]);

    if ($request->hasFile('image')) {
         $baseUrl = url('/'); 
       $url="/public/doctor/vendors/images/";
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('doctor/vendors/images/'), $imageName);

        if ($patient->image) {
            $previousImagePath = public_path('doctor/vendors/images/') . '/' . $patient->image;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }

        $patient->image = $baseUrl.$url.$imageName;
    }

    $patient->name = $request->name;
    $patient->phone = $request->phone;
    $patient->height = $request->height;
    $patient->weight = $request->weight;
    $patient->age = $request->age;
    $patient->dob = $request->dob;
    $patient->gender = $request->gender;

    $patient->save(); // Use save() instead of update()

 return redirect()->route('patient.index')->with('success', 'Patient updated successfully');
}





}
