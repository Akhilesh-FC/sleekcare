<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ApiController extends Controller
{
    
    
        
    public function search_old(?string $name)
    {
        $firstLetter = substr($name, 0, 1);
    
        // Fetch rows that start with the same first letter
        $allRows = DB::table('upload')->where('name', 'LIKE', $firstLetter . '%')->get();
        $similarities = [];
    
        foreach ($allRows as $item) {
            // Split $item->name into individual words by spaces
            $words = explode(' ', $item->name);
    
            // Get the first word only
            $firstWord = $words[0];
    
            // Calculate the Levenshtein distance between the input name and the first word
            $distance = levenshtein($name, $firstWord);
    
            // Normalize the distance
            $normalizedDistance = $distance / max(strlen($name), strlen($firstWord));
    
            // Store the item with normalized distance
            $item->normalized_distance = $normalizedDistance;
            $similarities[] = $item; // Use [] to create a list of items
        }
    
        // Sort the similarities by the normalized distance in ascending order
        usort($similarities, function($a, $b) {
            return $a->normalized_distance <=> $b->normalized_distance;
        });
    
        // Get the top 30 most similar results
        $topSimilarities = array_slice($similarities, 0, 30); // Adjust to 30 if needed
    
        // Build the result collection from the top similar entries
        $resultRows = collect($topSimilarities);
    
        return response()->json([
            'success' => true,
            'message' => 'Results for search',
            'data' => $resultRows
        ]);
    }
    
    
    public function search(?string $name)
    {
    // Split the input name into individual words
    $searchWords = explode(' ', $name);
    
    if (empty($searchWords[0])) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid search query',
            'data' => []
        ]);
    }

    // Get the first letter of the first word
    $firstLetter = substr($searchWords[0], 0, 1);

    // Fetch rows that start with the same first letter
    $allRows = DB::table('upload')->where('name', 'LIKE', $firstLetter . '%')->get();
    $similarities = [];

    foreach ($allRows as $item) {
        // Split $item->name into individual words by spaces
        $itemWords = explode(' ', $item->name);

        // Initialize distances array
        $distances = [];

        // 1. Calculate Levenshtein distance for each word in the search query
        foreach ($searchWords as $searchIndex => $searchWord) {
            $minNormalizedDistance = PHP_INT_MAX; // Start with a large value

            // Compare with each word in the item name
            foreach ($itemWords as $itemWord) {
                $levDistance = levenshtein($searchWord, $itemWord);
                $normalizedDistance = $levDistance / max(strlen($searchWord), strlen($itemWord));
                $minNormalizedDistance = min($minNormalizedDistance, $normalizedDistance);
            }

            // Store the minimum normalized distance for this search word
            $distances[$searchIndex][] = $minNormalizedDistance;
        }

        // After calculating distances, store them in a flattened format
        $item->distances = array_map(function($distanceArray) {
            sort($distanceArray); // Sort each word's distances
            return $distanceArray;
        }, $distances);
        $similarities[] = $item;
    }

    // 3. Sort the results based on the distances
    usort($similarities, function ($a, $b) {
        // Compare each set of sorted distances
        foreach ($a->distances as $index => $distanceArrayA) {
            $distanceArrayB = $b->distances[$index];

            // Compare sorted distances for each word
            foreach ($distanceArrayA as $key => $distanceA) {
                if ($distanceA != $distanceArrayB[$key]) {
                    return $distanceA <=> $distanceArrayB[$key];
                }
            }
        }
        return 0; // All distances are equal
    });

    // Get the top 30 most similar results
    $topSimilarities = array_slice($similarities, 0, 30);

    // Build the result collection from the top similar entries
    $resultRows = collect($topSimilarities);

    return response()->json([
        'success' => true,
        'message' => 'Results for search',
        'data' => $resultRows
    ]);
}


    


    public function search_diagnosis(Request $request){
             $validator = Validator::make($request->all(), [
                    'name' => 'required|string'
                ]);
            if($validator->fails()) {
                    return response()->json(['success' =>false,'message' => $validator->errors()]);
                }
           $name = $request->name;
           $firstLetter = substr($name, 0, 1);
           $allRows = DB::table('Diagnosis')->where('name', 'LIKE', $firstLetter . '%')->get();
           $similarities = [];
           
            foreach ($allRows as $item) {
                 $words = explode(' ', $item->name);
                 $firstWord = $words[0];
                 $distance = levenshtein($name, $firstWord);
                 $normalizedDistance = $distance / max(strlen($name), strlen($firstWord));
                 $item->normalized_distance = $normalizedDistance;
                 $similarities[] = $item; 
            }
            usort($similarities, function($a, $b) {
                return $a->normalized_distance <=> $b->normalized_distance;
            });
           $topSimilarities = array_slice($similarities, 0, 30);
           $resultRows = collect($topSimilarities);
           return response()->json([
                'success' => true,
                'message' => 'Results for search',
                'data' => $resultRows
             ]);
        }
        
    public function sarkar_diagnostic(Request $request){
             $validator = Validator::make($request->all(), [
                    'name' => 'required|string'
                ]);
            if($validator->fails()) {
                    return response()->json(['success' =>false,'message' => $validator->errors()]);
                }
           $name = $request->name;
           $firstLetter = substr($name, 0, 1);
           $allRows = DB::table('sarkardiagnostic')->where('name', 'LIKE', $firstLetter . '%')->get();
           $similarities = [];
           
            foreach ($allRows as $item) {
                 $words = explode(' ', $item->name);
                 $firstWord = $words[0];
                 $distance = levenshtein($name, $firstWord);
                 $normalizedDistance = $distance / max(strlen($name), strlen($firstWord));
                 $item->normalized_distance = $normalizedDistance;
                 $similarities[] = $item; 
            }
            usort($similarities, function($a, $b) {
                return $a->normalized_distance <=> $b->normalized_distance;
            });
           $topSimilarities = array_slice($similarities, 0, 30);
           $resultRows = collect($topSimilarities);
           return response()->json([
                'success' => true,
                'message' => 'Results for search',
                'data' => $resultRows
             ]);
        }
        
      
    public function hello()
    {
        echo "hi";
        
    }
   
    public function register(request $request)
    {
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'mobile'=>'required'
        ]);
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>"Mobile Is Required"
            ];                                                   
            
            return response()->json($response,200);
        }
        $existmobile = DB::table('docters')->where('mobile',$request->mobile)->get();
        if(count($existmobile)>0)
        {
            if(!empty($request->name))
            {
                DB::table('docters')->where('mobile',$request->mobile)->update(array('name'=>$request->name));
            }
            if(!empty($request->speciality))
            {
                DB::table('docters')->where('mobile',$request->mobile)->update(array('stream'=>$request->speciality));
            }
            if(!empty($request->registration_no))
            {
                DB::table('docters')->where('mobile',$request->mobile)->update(array('registration_no'=>$request->registration_no));
            }
            if(!empty($request->city))
            {
                DB::table('docters')->where('mobile',$request->mobile)->update(array('city'=>$request->city));
            }
            if(!empty($request->purpose))
            {
                DB::table('docters')->where('mobile',$request->mobile)->update(array('whysleekcare_1'=>$request->purpose));
            }
            if(!empty($request->pin))
            {
                DB::table('docters')->where('mobile',$request->mobile)->update(array('pin'=>$request->pin));
            }
            $index=DB::select("SELECT ((CASE WHEN `name` is NOT NULL THEN 1 ELSE 0 END) +(CASE WHEN `mobile` is NOT NULL THEN 1 ELSE 0 END)+ (CASE WHEN `pin` is NOT NULL THEN 1 ELSE 0 END) + (CASE WHEN `stream` is NOT NULL THEN 1 ELSE 0 END)+(CASE WHEN `registration_no` is NOT NULL THEN 1 ELSE 0 END)+(CASE WHEN `city` is NOT NULL THEN 1 ELSE 0 END)+(CASE WHEN `whysleekcare_1` is NOT NULL THEN 1 ELSE 0 END)) AS field_count FROM docters where `mobile`='$request->mobile';");
            if($index[0]->field_count=='7')
            {
                $response=[
                    'indexed'=>$index[0]->field_count,
                    'success'=>true,
                    'message'=>"All Data Filled"
                ];                                                   
                
                return response()->json($response,200);
            }
            else
            {
                $response=[
                    'indexed'=>$index[0]->field_count,
                    'success'=>true,
                    'message'=>"Update Successsfully"
                ];                                                   
                
                return response()->json($response,200);
            }
        }
        else
        {
            $values = [
                'mobile'=>$request->mobile,
                'profile_image'=>env('APP_URL').'images/doctor_profile.jpg',
                'status'=>"0",
                'indexed'=>'1'
                ];
            $ab=DB::table('docters')->insertGetId($values);
            if($ab)
            {
                $index=DB::select("SELECT ((CASE WHEN `name` is NOT NULL THEN 1 ELSE 0 END) +(CASE WHEN `mobile` is NOT NULL THEN 1 ELSE 0 END)+ (CASE WHEN `pin` is NOT NULL THEN 1 ELSE 0 END) + (CASE WHEN `stream` is NOT NULL THEN 1 ELSE 0 END)+(CASE WHEN `registration_no` is NOT NULL THEN 1 ELSE 0 END)+(CASE WHEN `city` is NOT NULL THEN 1 ELSE 0 END)+(CASE WHEN `whysleekcare_1` is NOT NULL THEN 1 ELSE 0 END)) AS field_count FROM docters where `mobile`='$request->mobile';");
                $response=[
                    'indexed'=>$index[0]->field_count,
                    'success'=>true,
                    'message'=>"Save"
                ];                                                   
            
                return response()->json($response,200);
            }
        }
        
    }
    
    public function multipleimages(request $request)
    {
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'image'=>'required'
        ]);
        $multiimg=$request->image;
        $multiimg=explode(",",$multiimg);
        $mohan=array();
        foreach ($multiimg as $key => $image)
        {
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = rand(111111,999999).'.'.'png';
            \File::put(public_path('uploads/doctor/multipleimages'). '/' . $imageName, base64_decode($image));
            $mohan[]=$imageName;
        }
      
    }
    
    // public function prescription(request $request)
    // {
    //     $tz = 'Asia/Kolkata'; 
    //     date_default_timezone_set($tz);
    //     $validator=validator ::make($request->all(),
    //     [
    //         'image'=>'required',
    //         'type_record'=>'required',
    //         'prescribed_by'=>'required',
    //         'patient_id'=>'required',
    //         'docter_id'=>'required',
    //         'date'=>'required'
    //     ]);
    //      $date=date('Y-m-d h:i:s');
    //     $multiimg=$request->image;
    //     $multiimg=explode(",",$multiimg);
    //     $mohan=array();
    //     foreach ($multiimg as $key => $image)
    //     {
    //         $image = str_replace('data:image/png;base64,', '', $image);
    //         $image = str_replace(' ', '+', $image);
    //         $imageName = rand(111111,999999).'.'.'png';
    //         \File::put(public_path('uploads/doctor/multipleimages'). '/' . $imageName, base64_decode($image));
    //         $path="https://sleekcare.apponrent.co.in/public/uploads/doctor/multipleimages/";
    //         $mohan[]=$path.$imageName;
            
    //     }
    //     // print_r($mohan);
    //      $values = [
    //         'type_record'=>"$request->type_record",
    //         'prescribed_by'=>"$request->prescribed_by",
    //         'patient_id'=>"$request->patient_id",
    //         'date'=>"$request->date",
    //           'docter_id'=>"$request->docter_id",
            
    //         'created_at'=>$date,
            
    //          'image'=>json_encode($mohan)
    //         ];
    //       $ab=DB::table('prescription')->insertGetId($values);
    //         if($ab==true)
    //         {
    //             $alldata=DB::table('prescription')->where('id',$ab)->get();
    //             foreach($alldata as $alldata2)
    //             {
    //               $alldata[0]->image= json_decode($alldata2->image);
    //             }
    //             $response=[
    //                 'id'=>"$ab",
    //                 'data'=>$alldata[0],
    //                 'success'=>true,
    //                 'message'=>"Successfully Add Patient"
    //             ];                                                   
                
    //             return response()->json($response,200);
    //         }
        
    // }
    
     public function prescription(request $request)
    {
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'image'=>'required',
            'type_record'=>'required',
            'prescribed_by'=>'required',
            'patient_id'=>'required',
            // 'docter_id'=>'required',
            'date'=>'required'
        ]);
         $date=date('Y-m-d h:i:s');
        $multiimg=$request->image;
        $multiimg=explode(",",$multiimg);
        $mohan=array();
        // foreach ($multiimg as $key => $image)
        // {
        //     $image = str_replace('data:image/png;base64,', '', $image);
        //     $image = str_replace(' ', '+', $image);
        //     $imageName = rand(111111,999999).'.'.'png';
        //     \File::put(public_path('uploads/doctor/multipleimages'). '/' . $imageName, base64_decode($image));
        //     $path="https://sleekcare.apponrent.co.in/public/uploads/doctor/multipleimages/";
        //     $mohan[]=$path.$imageName;
            
        // }
        
        
        foreach ($multiimg as $key => $image) {
        if (strpos($image, 'data:image/') === 0) {
            $image_parts = explode(';base64,', $image);
            $image_type_aux = explode('image/', $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
        } else {
            $image_base64 = base64_decode($image);
            $image_type = 'png'; // Default to PNG
        }
         $path="https://sleekcare.apponrent.co.in/public/uploads/doctor/multipleimages/";
        $imageName = rand(111111, 999999) . '.' . $image_type;
        \File::put(public_path('uploads/doctor/multipleimages') . '/' . $imageName, $image_base64);
        $mohan[] = $path . $imageName;
    }
        
        
         $values = [
            'type_record'=>"$request->type_record",
            'prescribed_by'=>"$request->prescribed_by",
            'patient_id'=>"$request->patient_id",
            'date'=>"$request->date",
            // 'docter_id'=>"$request->docter_id",
            'created_at'=>$date,
             'image'=>json_encode($mohan)
            ];
            
           
          $ab=DB::table('prescription')->insertGetId($values);
            if($ab==true)
            {
                $response=[
                    'success'=>true,
                    'message'=>"Successfully Add Patient"
                ];                                                   
                
                return response()->json($response,200);
            }
        
    }


      public function patients_medication(request $request){
       
           $doctor_id=$request->doctor_id;
              $patients_id=$request->patients_id;
          $user = DB::select("SELECT * FROM `medication` WHERE `appointment_id`='$patients_id'AND `doctor_id`='$doctor_id';");
       
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
        $response =[ 'success'=>"400",'data'=>[],'message'=>'Not Found Data'];return response ()->json ($response,400);
      } 
    }
  

   
       public function login (request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'mobile'=>'required',
            'pin'=>'required'
        ]);
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,200);
        }
        $where=[
            'mobile'=>"$request->mobile",
            'pin'=>"$request->pin"
            ];
       $existmobile = DB::table('docters')->where('mobile',"$request->mobile")->get();
       if(count($existmobile)>0)
       {
            $existdata = DB::table('docters')->where($where)->get();
            if(count($existdata)>0)
            {
                $id=$existdata[0]->id;
                $status=$existdata[0]->status;
                $username=$existdata[0]->name;
                $usermobile=$existdata[0]->mobile;
                $userimage=$existdata[0]->profile_image;
                $userpin=$existdata[0]->pin;
                //echo $status;
                $totalpatient=DB::table('patients')->where('doctor_id',$id)->count();
                if($status!=0)
                {
                    $response=[
                        'userid'=>"$id",
                        'username'=>"$username",
                        'usermobile'=>"$usermobile",
                        'userimage'=>"$userimage",
                        'status'=>$status,
                        'userpin'=>"$userpin",
                        'success'=>true,
                        'message'=>"Login Successfully"
                    ];    
                   
                    return response()->json($response,200);
                }
                else
                {
                    $response=[
                        'userid'=>"$id",
                        'username'=>"$username",
                        'usermobile'=>"$usermobile",
                        'userimage'=>"$userimage",
                        'status'=>$status,
                        'userpin'=>"$userpin",
                        'success'=>true,
                        'message'=>"Login Successfully"
                    ];                                                   
                
                    return response()->json($response,200);                                         
                   
                }
            }
            else
            {
                $index=DB::select("SELECT ((CASE WHEN `pin` is NULL THEN 1 ELSE 0 END)) AS field_count FROM docters where `mobile`='$request->mobile';");
                if($index[0]->field_count=='1')
                {
                    $response=[
                        'status'=>1,
                        'success'=>false,
                        'message'=>"Fill Your All Details"
                    ];                                                   
                    
                    return response()->json($response,200);
                }
                else
                {
                    $response=[
                        'success'=>false,
                        'message'=>"Your Pin Is Incorrect"
                    ];                                                   
                    
                    return response()->json($response,200);
                }
            }
            
       }
       else
       {
            $response=[
                    'status'=>1,
                    'success'=>false,
                    'message'=>"Your Mobile Is Not Registered"
                ];                                                   
                
            return response()->json($response,200);
        }
        
        
        // return response()->json($response,200);
    }
    
    
    
    
    public function loginpatients(Request $request){
         $validator = validator ::make ($request->all(),
           [
           
            'phone'=>'required',
           ]);
           
             if($validator->fails()){$response =['error'=>"400",'message'=>$validator->errors()];
            return response()->json ($response, 400);
           }
            $date=date('Y-m-d h:i:s');
           $phone=$request->phone;
            $otp = \rand(1000, 9999);
            $user = DB::select("SELECT * FROM `patients` WHERE `phone`= '$phone'");
            // $user=DB::select("SELECT * FROM `patients` WHERE `phone`= '$phone'")->get();
             if($user){
            // echo "rohan";
            foreach($user as $userss2)
             {
                 $ids=$userss2->id;
                 $userss2->id="$ids";
             }
           $response =[ 'success'=>"200",'otp' => "$otp",'data'=>$user[0],'message'=>'Success'];
        }else
        {
            $phone=$request->phone;
          
        $users=DB::select("INSERT INTO `patients`(`phone`, `created_at`, `updated_at`) VALUES ('$phone','$date','$date')");
             $userss = DB::select("SELECT * FROM `patients` WHERE `phone`= '$phone'");
             foreach($userss as $userss2)
             {
                 $ids=$userss2->id;
                 $userss2->id="$ids";
             }
        // $user = User::where('phone', $phone)->first();
         $response =[ 'success'=>"200",'otp' => "$otp",'data'=>$userss[0],'message'=>'Success'];
        
        }
        return $response;
    }
    
    
    
 
    
    public function patient_mobile(Request $request){
         $validator = validator ::make ($request->all(),
           [
           
            'phone'=>'required'
        
           ]);
             if($validator->fails()){$response =['error'=>"400",'message'=>$validator->errors()];
            return response()->json ($response, 400);
           }
            $date=date('Y-m-d h:i:s');
           $phone=$request->phone;
           $id=$request->id;
            $otp = \rand(1000, 9999);
            $user = DB::select("SELECT * FROM `patients` WHERE `phone`=$phone");
             if($user){
            foreach($user as $userss2)
             {
                 $ids=$userss2->id;
                 $userss2->id="$ids";
             }
           $response =[ 'success'=>"200",'data'=>$user[0],'message'=>'Success'];
        }else
        {
            
         $response =[ 'success'=>"400",'data'=>"",'message'=>'Your Mobile Is Not Registered'];
        
        }
        return $response;
    }
    
            public function search_akash_old(Request $request)
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|min:2'
                ]);
                if ($validator->fails()) {
                    return response()->json(['success' =>false,'message' => $validator->errors()]);
                }
                $name = $request->name;
                $startingRows = DB::table('upload')
                                ->where('name', 'LIKE', $name . '%')
                                ->orderBy('name', 'ASC')
                                ->limit(30)
                                ->get();
                $count_rows = count($startingRows);
                $remain_count = 30-$count_rows;
                $containingRows = [];
                if($count_rows<30){
                     $containingRows = DB::table('upload')
                                ->where('name', 'LIKE', '%' . $name . '%')
                                ->where('name', 'NOT LIKE', $name . '%')
                                ->orderBy('name', 'ASC')
                                ->limit($remain_count)
                                ->get();
                }
                                
               
               $resultRows = $startingRows->merge($containingRows);
               return response()->json(['success'=>true,'message'=>'result for serach','data'=>$resultRows]);
         }
         
               
    //$users = DB::table('sarkardiagnostic')
      //  ->where('name', 'LIKE', '%' . $name . '%')



      

public function search_alphabetically(Request $request)
{
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|string'
    ]);

    if ($validator->fails()) {
        $response = [
            'error' => "400",
            'message' => $validator->errors()
        ];
        return response()->json($response, 400);
    }

    // Get the search term
    $name = $request->input('name');

    // Prepare an array to hold the results for each letter
    $alphabeticalResults = [];

    // Iterate over each letter of the alphabet
    foreach (range('A', 'Z') as $letter) {
        // Fetch records that start with the current letter
        $users = DB::table('upload')
            ->where('name', 'LIKE', $letter . '%')
            ->orderBy('name', 'ASC')
            ->get();

        // Add the results to the array
        $alphabeticalResults[$letter] = $users;
    }

    // Prepare the response
    $response = [
        'success' => "200",
        'data' => $alphabeticalResults,
        'message' => 'Success'
    ];

    // Return JSON response
    return response()->json($response);
}

   public function patient_name_list(Request $request){
    
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'doctor_id' => 'required'
        ]);
        $validator->stopOnFirstFailure();
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }
        $data = DB::table('patients')->select('id as patient_id','age','gender','name','phone')->where('doctor_id',$request->doctor_id)->where('phone',$request->phone)->get();
        return response()->json(['success'=>true,'message'=>'patience name list','data'=>$data]);
  }
    
    
      public function forget_password(Request $request){
         $validator = validator ::make ($request->all(),
           [
           
            'mobile'=>'required'
          
           ]);
           
             if($validator->fails()){$response =['success'=>false,'message'=>$validator->errors()];
            return response()->json ($response);
           }
            $date=date('Y-m-d h:i:s');
           $mobile=$request->mobile;
            $otp = \rand(1000, 9999);
        
            $users = DB::select("SELECT * FROM `docters` WHERE `mobile`= '$mobile' ;");
           
             if($users){
             $mobile=$request->mobile;
                 $pin=$request->pin;
                 
            $users=DB::select("UPDATE `docters` SET `pin`='$pin' WHERE `mobile`= '$mobile';");
             $userss = DB::select("SELECT * FROM `docters` WHERE `mobile`= '$mobile';");
             
             foreach($userss as $userss2)
             {
                 $ids=$userss2->id;
                 $userss2->id="$ids";
             }
     
         $response =[ 'success'=>true,'data'=>$userss[0],'message'=>'Pin updated successfully.'];
        }else
        {
          
         $response =[ 'success'=>false,'data'=>"",'message'=>'Mobile number not found!'];
        
        }
        return $response;
    }
    
     public function forget_pin_verify_mobile(Request $request){
         $validator = Validator::make($request->all(),[
             'mobile'=>'required|exists:docters,mobile'
             ]);
             
            if($validator->fails()){
                 return response()->json(['success'=>false,'message'=>$validator->errors()->first()]);
             }
         return response()->json(['success'=>true,'message'=>'Mobile verified successfully.']);
     }
    
    
    
    
      
    
       public function profile (request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'userid'=>'required'
        ]);
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
       $existid = DB::table('docters')->where('id',"$request->userid")->get();
       if(count($existid)>0)
       {
            $response=[
                'data'=>$existid[0],
                'success'=>true,
                'message'=>"successfully Login"
            ];                                                   
            
            return response()->json($response,200);
       }
       else
       {
            $response=[
                    'success'=>false,
                    'message'=>"Incorrect Userid"
                ];                                                   
                
            return response()->json($response,400);
        }
        
        
        // return response()->json($response,200);
    }
    
    
    public function patiens_list (request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'doctor_id'=>'required',
            'patiens_id'=>'required'
        ]);
          $doctor_id=$request->doctor_id;
          $patiens_id=$request->patiens_id;
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
  
        $existid= DB::select("SELECT * FROM `patients` WHERE `id`=$patiens_id AND `doctor_id`=$doctor_id;");
       if(count($existid)>0)
       {
            $response=[
                'data'=>$existid[0],
                'success'=>"200",
                'message'=>"successfully"
            ];                                                   
            
            return response()->json($response,200);
       }
       else
       {
            $response=[
                     'data'=>"",
                    'success'=>"400",
                    'message'=>"Incorrect Doctor Id"
                ];                                                   
                
            return response()->json($response,400);
        }
        
        
       
    }
    
    
     public function appointment_list (request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'doctor_id'=>'required',
            'appointment_id'=>'required'
        ]);
          $doctor_id=$request->doctor_id;
          $appointment_id=$request->appointment_id;
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
  
        $existid= DB::select("SELECT * FROM `appointments` WHERE `id`=$appointment_id AND `doctor_id`=$doctor_id;");
       if(count($existid)>0)
       {
            $response=[
                'data'=>$existid[0],
                'success'=>true,
                'message'=>"successfully"
            ];                                                   
            
            return response()->json($response,200);
       }
       else
       {
            $response=[
                    'success'=>false,
                    'message'=>"Incorrect  Id"
                ];                                                   
                
            return response()->json($response,400);
        }
    }
    
    public function patient_view(Request $request) {
                $tz = 'Asia/Kolkata'; 
                date_default_timezone_set($tz);
            
                // Validate the request
                $validator = Validator::make($request->all(), [
                    'doctor_id' => 'required'
                ]);
            
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()
                    ], 400);
                }
            
                $doctor_id = $request->doctor_id;
                $name = $request->name;
                $phone = $request->mobile;
                $limit = $request->limit ?? 10;
                $offset = $request->offset ?? 0;
            
                // Build the query
                $query = DB::table('patients')
                    ->where('doctor_id', $doctor_id);
            
                if ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                }
            
                if ($phone) {
                    $query->where('phone', 'like', '%' . $phone . '%');
                }
            
                // Get total count
                $totalCount = $query->count();
            
                // Get paginated results
                $patients = $query->orderBy('id', 'desc')
                    ->limit($limit)
                    ->offset($offset)
                    ->get();
            
                // Return the response
                return response()->json([
                    'data' => $patients,
                    'total_count' => $totalCount,
                    'success' => true,
                    'message' => "Successfully retrieved patient data"
                ], 200);
            }

    
     public function appointment_view_list_akash (request $request){
         
            date_default_timezone_set('Asia/Kolkata');
         
           $validator=validator::make($request->all(),[
             'doctor_id'=>'required|exists:appointments,doctor_id'
            ]);
            
            $doctor_id = $request->doctor_id;
            $date = $request->date;
            $limit = $request->limit??5;
            $offset = $request->offset??0;
            $name = $request->name;
            $phone = $request->phone;
            $appointment_status = $request->appointment_status;
            
            if(!$date){
                $date = date('Y-m-d');
            }
            
            $appointment_details = DB::table('appointments')->where('doctor_id',$doctor_id)->whereDate('date',$date)->where('status',$appointment_status); //->orderBy('id','desc')->get();
            
            if($name){
                $appointment_details->where('name','like','%'.$name.'%');
            }
            
            if($phone){
               $appointment_details->where('phone','like','%'.$phone.'%');
            }
            
            $totalCount = $appointment_details->count();
            
            $apmnt_details = $appointment_details->orderBy('id','desc')->limit($limit)->offset($offset)->get();
            
            return response()->json([
                'success'=>true,
                'message'=>'Appointment details..',
                'total_count'=>$totalCount,
                'data'=>$apmnt_details
                ]);
     }
    
    
     public function patiens_listt(request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'patients_id'=>'required'
        ]);
          $patients_id=$request->patients_id;
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,200);
        }
    
      $existid= DB::select("SELECT patients.*,prescription.id AS prescription_id ,prescription.image AS prescriptionimage,prescription.date AS date FROM patients JOIN prescription ON patients.id = prescription.patient_id
            WHERE patients.id ='$patients_id' ORDER BY prescription.id DESC");
        
      

       if(count($existid)>0)
       {
            $response=[
                'data'=>$existid,
                'success'=>true,
                'message'=>"successfully"
            ];                                                   
            
            return response()->json($response,200);
       }
       else
       {
            $response=[
                    'success'=>false,
                    'data'=>$existid,
                    'message'=>"No data"
                ];                                                   
                
              return response()->json($response,200);
        }
        
        
        // return response()->json($response,200);
    }
    
    
     public function prescriptionDelete(request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'prescription_id'=>'required|exists:prescription,id'
        ]);
          $prescription_id=$request->prescription_id;
      
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,200);
        }
    
    //   $existid= DB::select("DELETE FROM `prescription` WHERE `id`='$prescription_id'");
      $existid=DB::table('prescription')->where('id',$prescription_id)->delete();
    //   dd($existid);
        
       if($existid)
       {
            $response=[
                'success'=>true,
                'message'=>"successfully deleted"
            ];                                                   
            
            return response()->json($response,200);
       }
       else
       {
            $response=[
                    'success'=>false,
                    'message'=>"somthing went wrong"
                ];                                                   
                
           return response()->json($response,200);
        }
        
        
        // return response()->json($response,200);
    }
    
       public function docter_name (){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        // $validator=validator ::make($request->all(),
        // [
        //     'doctor_id'=>'required'
        // ]);
        $date=date('Y-m-d h:i:s');
       $existid= DB::select("SELECT `name`,`id` FROM `docters` WHERE 1;");
       
    //   $existid = DB::table('docters')->get();
       if(count($existid)>0)
       {
            $response=[
                'data'=>$existid,
                'success'=>true,
                'message'=>"successfully"
            ];                                                   
            
            return response()->json($response,200);
       }
     
        
        
        // return response()->json($response,200);
    }
    public function patiens_profile (request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'id'=>'required'
        ]);
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
       $existid = DB::table('patients')->where('id',"$request->id")->get();
       if(count($existid)>0)
       {
            $response=[
                'data'=>$existid[0],
                'success'=>true,
                'message'=>"successfully"
            ];                                                   
            
            return response()->json($response,200);
       }
       else
       {
            $response=[
                    'success'=>false,
                    'message'=>"Incorrect  Id"
                ];                                                   
                
            return response()->json($response,400);
        }
     
    }
     public function home(request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'doctor_id'=>'required'
        ]);
        $date=date('Y-m-d');
        
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,200);
        }
       $existid = DB::select("SELECT * FROM `appointments` WHERE `doctor_id`=$request->doctor_id AND  DATE(`created_at`)=DATE_FORMAT(CURDATE(), '%Y-%m-%d')  ORDER BY id DESC  LIMIT 5;");
      $patients = DB::select("SELECT * FROM `patients` WHERE `doctor_id`=$request->doctor_id ORDER BY id DESC  LIMIT 5;");
       $all = DB::select("SELECT patients.* ,appointments.bed_no ,appointments.bed_type ,docters.name AS consulting FROM `patients`,`appointments`,`docters` WHERE docters.id=patients.doctor_id AND patients.`doctor_id`=$request->doctor_id ORDER BY patients.id ASC LIMIT 5;");
   
    $totalpatients= DB::select("SELECT COUNT(*) AS TotalPatients FROM patients WHERE `doctor_id`= $request->doctor_id");
     $totalappontment= DB::select("SELECT COUNT(*) AS Totalappointments FROM `appointments` WHERE `doctor_id`=$request->doctor_id AND DATE(`date`) = CURDATE();");
          $totalappontm= DB::select("SELECT COUNT(*) AS appointments FROM appointments WHERE `doctor_id`= $request->doctor_id");
       
       $totalpoint=$totalpatients[0]->TotalPatients;
       $totalpoints=$totalappontment[0]->Totalappointments;
       $totalpoints2=$totalappontm[0]->appointments;
       $datap=[
           'todayappointment'=>$existid,
           'recentpatients'=>$patients,
           'allpatients'=>$all,
           'totalpatients'=>"$totalpoint",
            'totalappontment'=>"$totalpoints",
            'remaining'=>"$totalpoints2",
           ];
           $datap1=[
           'todayappointment'=>[],
           'recentpatients'=>[],
           'allpatients'=>[],
           'totalpatients'=>"",
            'totalappontment'=>"",
            'remaining'=>"",
           ];
       if(count($existid)>0 || count($patients)>0 || count($all)>0)
       {
            $response=[
                'data'=>$datap,
                'success'=>true,
                'message'=>"successfully"
            ];                                                   
            
            return response()->json($response,200);
       }
       else
       {
            $response=[
                    'data'=>$datap1,
                    'success'=>false,
                    'message'=>"Not Found Data"
                ];                                                   
                
            return response()->json($response,200);
        }
        
        
       
    }
    
    
      public function date_app(request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'doctor_id'=>'required'
        ]);
        //$date=date('Y-m-d');
        
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,200);
        }
        //   $date=$request->date;
     
      $existid = DB::select("SELECT date FROM `appointments` WHERE `doctor_id`=$request->doctor_id  ORDER BY id ASC  LIMIT 5;");
         // $patients = DB::select("SELECT date FROM `appointments` WHERE `doctor_id`=$request->doctor_id");
         $ram=array();
         foreach($existid as $existids)
         {
             $date=$existids->date;
             $patients = DB::select(" select * from `appointments` where `date` = '$date' order by `id` DESc limit 5;");
             
             $existids->patient_list=$patients;
             
             $ram[]=$existids;
         }
           
         

   
      $datap=[
          'data'=>$existid,
          'recentpatients'=>$patients,
            
          ];
          $datap1=[
          'data'=>[],
          //'recentpatients'=>[],
       
          ];
      if(count($existid)>0 || count($patients)>0 )
      {
            $response=[
                'data'=>$ram,
                'success'=>true,
                'message'=>"successfully"
            ];                                                   
            
            return response()->json($response,200);
      }
      else
      {
            $response=[
                    'data'=>$datap1,
                    'success'=>false,
                    'message'=>"Not Found Data"
                ];                                                   
                
            return response()->json($response,200);
        }
        
        
       
    }
    


    
    
    public function appointments_delete($id){
        // $users = Customer::findOrFail($doctor_id);
      
          $user = DB::select("DELETE FROM `patients` WHERE `id`='$id';");
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
       $response =[ 'success'=>"200",'message'=>'DATA DELETE'];return response ()->json ($response,200); 
      } 
    }
    
    
    
      public function patiens_delete($id){
        // $users = Customer::findOrFail($doctor_id);
      
          $user = DB::select("DELETE FROM `appointments` WHERE `id`='$id';");
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
       $response =[ 'success'=>"200",'message'=>'DATA DELETE'];return response ()->json ($response,200); 
      } 
    }
    
    
    
    
    public function appointment_view($doctor_id){
                 $user = DB::select("SELECT * FROM `appointments` WHERE `doctor_id`='$doctor_id';");
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
      $response =[ 'success'=>"400",'message'=>'Not Found Data'];return response ()->json ($response,400); 
      } 
      
    }
    
    ////////////////datee//////////////////////////////////////////////
    
    public function appointment_view_list (request $request){
        	date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');
        
        $validator=validator ::make($request->all(),
        [
            'doctor_id'=>'required'
        ]);
      
           $date=$request->date;
          
           
           $doctor_id=$request->doctor_id;
           
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,200);
        }
        if($date)
        {
            $existid = DB::select("SELECT * FROM `appointments` WHERE `doctor_id`='$doctor_id' and `date`='$date' and `status`='2';");
        }
        else{
            $existid = DB::select("SELECT * FROM `appointments` WHERE `doctor_id`='$doctor_id' and DATE(`date`)=DATE_FORMAT(CURDATE(), '%d-%m-%Y') and `status`='2';");
        }
       if(count($existid)>0)
       {
            $response=[
                'data'=>$existid,
                'success'=>true,
             
                'message'=>"successfully"
            ];                                                   
            
            return response()->json($response,200);
       }
       else
       {
           //$existid = DB::select("SELECT * FROM `appointments` WHERE `doctor_id`='$doctor_id' and `date`='$date';");
            $response=[
                     'data'=>[],
                    'success'=>true,
                    'message'=>"Incorrect id"
                ];                                                   
                
            return response()->json($response,200);
        }
        
    }
    
    
    
    
    
  

    
    
    
    
    
    
    
       public function prescription_list($patient_id){
        // $users = Customer::findOrFail($doctor_id);
      
          $user = DB::select("SELECT * FROM `prescription` WHERE `patient_id`='$patient_id';");
          foreach($user as $alldata2)
        {
           $alldata2->image= json_decode($alldata2->image);
        }
          if($user){
          $response =[ 'success'=>"200",'data'=>$user[0],'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
       $response =[ 'success'=>"400",'data'=>"",'message'=>'Not Found Data'];return response ()->json ($response,400); 
      } 
    }
    
    
    
    
     public function lab_reports($patient_id){
        // $users = Customer::findOrFail($doctor_id);
      
          $user = DB::select("SELECT  `date`,docters.name AS doctername , `prescription`.`image` FROM `prescription`,`docters` WHERE docters.id=prescription.docter_id AND `patient_id`=$patient_id;");
          foreach($user as $alldata2)
        {
           $alldata2->image= json_decode($alldata2->image);
        }
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
       $response =[ 'success'=>"400",'data'=>"",'message'=>'Not Found Data'];return response ()->json ($response,400); 
      } 
    }
    
    
      public function medicine_list(request $request){
       
           $name=$request->name;
           
          $users = DB::select("SELECT * FROM `medicine` WHERE 1");
        // SELECT * FROM `medicine` WHERE `price` LIKE '200'
           $user = DB::select("SELECT * FROM `medicine` WHERE `name` LIKE '%$name%'");
        //   echo $name;
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
        $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      } 
    }
    
    
      public function appointment_date(request $request){
       
           $doctor_id=$request->doctor_id;
              $date1=$request->date1;
                 $date2=$request->date;
           
       
   
           $user = DB::select("SELECT `appointments`.*, `docters`.`name` AS `doctorname`, `docters`.`mobile` AS `doctormobile`, `patients`.`name` AS `patientname`, `patients`.`phone` AS `patientmobile`, `patients`.`age` AS `patientage`, `patients`.`gender` AS `patientgender` FROM `appointments` LEFT JOIN `docters` ON `appointments`.`doctor_id` = `docters`.`id` LEFT JOIN `patients` ON `appointments`.`patient_id` = `patients`.`id` WHERE `appointments`.`doctor_id`= '$doctor_id' AND date BETWEEN '$date1' AND '$date2';
");
       
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
        $response =[ 'success'=>"400",'data'=>[],'message'=>'Not Found Data'];return response ()->json ($response,400);
      } 
    }
    
    
    
    
    
     public function appointment_medication(request $request){
       
           $doctor_id=$request->doctor_id;
              $appointment_id=$request->appointment_id;
          $user = DB::select("SELECT * FROM `medication` WHERE `appointment_id`='$appointment_id'AND `doctor_id`='$doctor_id';");
       
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
        $response =[ 'success'=>"400",'data'=>[],'message'=>'Not Found Data'];return response ()->json ($response,400);
      } 
    }
    
    
    
    
    
    
    
    
    public function TotalPatients(){
        // $users = Customer::findOrFail($doctor_id);
      
          $user = DB::select("SELECT COUNT(*) AS TotalPatients FROM patients;");
          if($user){
          $response =[ 'success'=>"200",'data'=>$user,'message'=>'Successfully'];return response ()->json ($response,200);
      }
      else{
       $response =[ 'success'=>"400",'message'=>'Not Found Data'];return response ()->json ($response,400); 
      } 
    }
    
    
    public function profile_update (request $request){
       
        $baseurl= url('');
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'userid'=>'required',
            
        ]);
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
        $userid=$request->userid;
        $address = $request->address;
        $time = $request->time;
        $about = $request->about;
        
        
        if($request->name!='null' || $request->name!='0'|| $request->name!='')
        {
            //echo "hi";
            DB::table('docters')->where('id',$userid)->update(array('name'=>$request->name));
        }
        if($request->stream!='null'|| $request->stream!='0'|| $request->stream!='')
        {
            //echo "hi";
            DB::table('docters')->where('id',$userid)->update(array('stream'=>$request->stream));
        }
        if($request->mobile!='null'|| $request->mobile!='0'|| $request->mobile!='')
        {
            DB::table('docters')->where('id',$userid)->update(array('mobile'=>$request->mobile));
        }
        if($request->city!='null'|| $request->city!='0'|| $request->city!='')
        {
            DB::table('docters')->where('id',$userid)->update(array('city'=>$request->city));
        }
         if(!empty($about))
        {
            DB::table('docters')->where('id',$userid)->update(array('about'=>json_encode($request->about)));
        }
        if(!empty($time))
        {
            DB::table('docters')->where('id',$userid)->update(array('time'=>json_encode($request->time)));
        }
        if(!empty($address))
        {
            DB::table('docters')->where('id',$userid)->update(array('address'=>$request->address));
        }
        if($request->city!='hospital_number'|| $request->hospital_number!='0'|| $request->hospital_number!='')
        {
            DB::table('docters')->where('id',$userid)->update(array('hospital_number'=>$request->hospital_number));
        }
        if($request->city!='alternate_number'|| $request->alternate_number!='0'|| $request->alternate_number!='')
        {
            DB::table('docters')->where('id',$userid)->update(array('alternate_number'=>$request->alternate_number));
        }
        if($request->doctor_signature!='0')
        {
            $image = $request->doctor_signature;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = rand(111111,999999).'.'.'png';
            \File::put(public_path('uploads/doctor/signature'). '/' . $imageName, base64_decode($image));
            DB::table('docters')->where('id',$userid)->update(array('signature'=>env('APP_URL')."uploads/doctor/signature/$imageName"));
        }
         if($request->logo!='0')
        {
            $image = $request->logo;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = rand(111111,999999).'.'.'png';
            \File::put(public_path('uploads/doctor/signature'). '/' . $imageName, base64_decode($image));
            DB::table('docters')->where('id',$userid)->update(array('logo'=>env('APP_URL')."uploads/doctor/signature/$imageName"));
        }
        if($request->profile_image!='0')
        {
            
            $image = $request->profile_image;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = rand(111111,999999).'.'.'png';
            \File::put(public_path('uploads/doctor/profileimage'). '/' . $imageName, base64_decode($image));
            DB::table('docters')->where('id',$userid)->update(array('profile_image'=>env('APP_URL')."uploads/doctor/profileimage/$imageName"));
        }
        $response=[
                'success'=>true,
                'message'=>"Updated Successfuly"
            ];                                                   
            
            return response()->json($response,200);
    }
    
    public function complete_medication (request $request){
        	date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');
        
        $validator=validator ::make($request->all(),
        [
            'appointment_id'=>'required',
            
        ]);
        
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            return response()->json($response);
        }
           $appointmentsid=$request->appointment_id;
           DB::select("UPDATE `appointments` SET `status`='0' WHERE `id`='$appointmentsid'");
            $response=[
                'success'=>true,
                'message'=>"Updated Successfuly"
            ];                                                   
            return response()->json($response);
    }
    
    
    
    
    
     public function update_appointment(request $request){
        $baseurl= url('');
       	date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        
        $validator=validator ::make($request->all(),
        [
            'id'=>'required',
            
        ]);
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
        $id=$request->id;
        if( $request->name!='')
        {
            
            DB::table('appointments')->where('id',$id)->update(array('name'=>"$request->name"));
        }
        if( $request->uhid!='')
        {
            
            DB::table('appointments')->where('id',$id)->update(array('uhid'=>"$request->uhid"));
        }
        if($request->mobile!='')
        {
            DB::table('appointments')->where('id',$id)->update(array('phone'=>"$request->mobile"));
        }
        if( $request->age!='')
        {
            DB::table('appointments')->where('id',$id)->update(array('age'=>"$request->age"));
        }
       
         if( $request->gender!='')
        {
            DB::table('appointments')->where('id',$id)->update(array('gender'=>"$request->gender"));
        }
         if( $request->uhid!='')
        {
            DB::table('appointments')->where('id',$id)->update(array('uhid'=>"$request->uhid"));
        }
        if( $request->city!='')
        {
            DB::table('appointments')->where('id',$id)->update(array('city'=>"$request->city"));
        }
        if( $request->date!='')
        {
            DB::table('appointments')->where('id',$id)->update(array('date'=>"$request->date"));
        }
       
      
        $response=[
                'success'=>true,
                'message'=>"Successfuly"
            ];                                                   
            
            return response()->json($response,200);
    }
    
    
    
    
    
    
     public function update_medication(request $request){
        $baseurl= url('');
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'id'=>'required',
            
        ]);
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
        $id=$request->id;
        if( $request->dignosis!='')
        {
            //echo "hi";
            DB::table('medication')->where('id',$id)->update(array('dignosis'=>"$request->dignosis"));
        }
        if( $request->symptoms!='')
        {
            //echo "hi";
            DB::table('medication')->where('id',$id)->update(array('symptoms'=>"$request->symptoms"));
        }
        if($request->lab!='')
        {
            DB::table('medication')->where('id',$id)->update(array('lab'=>"$request->lab"));
        }
        if( $request->medical_details!='')
        {
            DB::table('medication')->where('id',$id)->update(array('medical_details'=>"$request->medical_details"));
        }
       
         if( $request->notes!='')
        {
            DB::table('medication')->where('id',$id)->update(array('notes'=>"$request->notes"));
        }
         if( $request->blood_pres!='')
        {
            DB::table('medication')->where('id',$id)->update(array('blood_pres'=>"$request->blood_pres"));
        }
        if( $request->blood_group!='')
        {
            DB::table('medication')->where('id',$id)->update(array('blood_group'=>"$request->blood_group"));
        }
         if( $request->pulse!='')
        {
            DB::table('medication')->where('id',$id)->update(array('pulse'=>"$request->pulse"));
        }
         if( $request->height!='')
        {
            DB::table('medication')->where('id',$id)->update(array('height'=>"$request->height"));
        }
         if( $request->weights!='')
        {
            DB::table('medication')->where('id',$id)->update(array('weights'=>"$request->weights"));
        }
         if( $request->spo2!='')
        {
            DB::table('medication')->where('id',$id)->update(array('spo2'=>"$request->spo2"));
        }
         if( $request->dibitic!='')
        {
            DB::table('medication')->where('id',$id)->update(array('dibitic'=>"$request->dibitic"));
        }
         if( $request->dp!='')
        {
            DB::table('medication')->where('id',$id)->update(array('dp'=>"$request->dp"));
        }
         if( $request->diagnosis_remark!='')
        {
            DB::table('medication')->where('id',$id)->update(array('diagnosis_remark'=>"$request->diagnosis_remark"));
        }
         if( $request->symptoms_remark!='')
        {
            DB::table('medication')->where('id',$id)->update(array('symptoms_remark'=>"$request->symptoms_remark"));
        }
         if( $request->lab_remark!='')
        {
            DB::table('medication')->where('id',$id)->update(array('lab_remark'=>"$request->lab_remark"));
        }
         if( $request->dosage!='')
        {
            DB::table('medication')->where('id',$id)->update(array('dosage'=>"$request->dosage"));
        }
         if( $request->dosage!='')
        {
            DB::table('medication')->where('id',$id)->update(array('dosage'=>"$request->dosage"));
        }
         if( $request->duration!='')
        {
            DB::table('medication')->where('id',$id)->update(array('duration'=>"$request->duration"));
        }
         if( $request->frequency!='')
        {
            DB::table('medication')->where('id',$id)->update(array('frequency'=>"$request->frequency"));
        }
         if( $request->medicine_remark!='')
        {
            DB::table('medication')->where('id',$id)->update(array('medicine_remark'=>"$request->medicine_remark"));
        }
         if( $request->notes_remark!='')
        {
            DB::table('medication')->where('id',$id)->update(array('notes_remark'=>"$request->notes_remark"));
        }
        $response=[
                'success'=>true,
                'message'=>"Successfuly"
            ];                                                   
            
            return response()->json($response,200);
    }
    
     public function medication_symptom_add(request $request){
        $baseurl= url('');
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'id'=>'required',
            
            
        ]);
        $date=date('Y-m-d h:i:s');
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
        $id=$request->id;
        if( $request->dignosis!='')
        {
           
            DB::table('medication')->where('id',$id)->update(array('dignosis'=>"$request->dignosis"));
        }
        if( $request->symptoms!='')
        {
            
            DB::table('medication')->where('id',$id)->update(array('symptoms'=>"$request->symptoms"));
        }
        if($request->lab!='')
        {
            DB::table('medication')->where('id',$id)->update(array('lab'=>"$request->lab"));
        }
        if( $request->medical_details!='')
        {
            DB::table('medication')->where('id',$id)->update(array('medical_details'=>"$request->medical_details"));
        }
       
         if( $request->notes!='')
        {
            DB::table('medication')->where('id',$id)->update(array('notes'=>"$request->notes"));
        }
         if( $request->repeat!='')
        {
            DB::table('medication')->where('id',$id)->update(array('repeat'=>"$request->repeat"));
        }
        if( $request->tme_to_take!='')
        {
            DB::table('medication')->where('id',$id)->update(array('tme_to_take'=>"$request->tme_to_take"));
        }
         if( $request->to_be_taken!='')
        {
            DB::table('medication')->where('id',$id)->update(array('to_be_taken'=>"$request->to_be_taken"));
        }
         
        $response=[
                'success'=>true,
                'message'=>"Successfuly"
            ];                                                   
            
            return response()->json($response,200);
    }
    
    

     public function createappointments2 (request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'name'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'age'=>'required',
            'date'=>'required',
            'doctorid'=>'required',
             'patient_id'=>'required',
            
        ]);
        $date=date('Y-m-d h:i:s');
      
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
        $values = [
            'name'=>"$request->name",
            'phone'=>"$request->phone",
            'gender'=>"$request->gender",
            'age'=>"$request->age",
            
           'date'=>"$request->date",
            'doctor_id'=>"$request->doctorid",
             'patient_id'=>"$request->patient_id",
            'created_at'=>$date
            ];
        
            $ab=DB::table('appointments')->insertGetId($values);
            if($ab==true)
            {
                $alldata=DB::table('appointments')->where('id',$ab)->get();
                $response=[
                    'appointments'=>"$ab",
                    'appointmentsdata'=>$alldata[0],
                    'success'=>true,
                    'message'=>"Successfully Add appointments"
                ];                                                   
                
                return response()->json($response,200);
            }
            else
        {
            $phone=$request->phone;
            $name=$request->name;
            $gender=$request->gender;
            $age=$request->age;
            $date=$request->date;
             $doctorid=$request->doctorid;
            
              
          
        $users=DB::select("INSERT INTO `patients`(`phone`, `created_at`, `updated_at`) VALUES ('$phone','$date','$date')");
             $userss = DB::select("SELECT * FROM `patients` WHERE `phone`= '$phone'");
             foreach($userss as $userss2)
             {
                 $ids=$userss2->id;
                 $userss2->id="$ids";
             }
        // $user = User::where('phone', $phone)->first();
         $response =[ 'success'=>"200",'otp' => "$otp",'data'=>$userss[0],'message'=>'Success'];
        
        }
       
    }
    
         public function createappointments_1(Request $request){
         $validator = validator ::make ($request->all(),
           [
             'name'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'age'=>'required',
            'date'=>'required',
            'doctor_id'=>'required',
             //'patient_id'=>'required',
           
           ]);
           
             if($validator->fails()){$response =['error'=>"400",'message'=>$validator->errors()];
            return response()->json ($response, 400);
           }
            $datess=date('Y-m-d ');
           $phone=$request->phone;
            $otp = \rand(1000, 9999);
            $user = DB::select("SELECT * FROM `patients` WHERE `phone`='$phone';");
            if (count($user)>3) {
                $response = [
                    'success' => false,
                    'message' => 'The name and date of birth have already been added.'
                ];
                return response()->json($response, 400);
            }
           
             if($user){
             $datess=date('Y-m-d ');
             $phone=$request->phone;
               $name=$request->name;
                 $gender=$request->gender;
                   $age=$request->age;
                     $date=$request->date;
                      $patient_id=$request->patient_id;
                    $doctor_id=$request->doctor_id;
                   
                    
                     $randomnumber = rand(111111,999999);
                $users=DB::select("INSERT INTO `appointments`(  `doctor_id`, `date`, `status`,  `name`, `age`, `gender`, `phone`, `created_at`, `updated_at`,`uhid`) VALUES ('$doctor_id','$date','2','$name','$age','$gender','$phone','$date','$date','Sleek@$randomnumber')");
             $userss = DB::select("SELECT * FROM `appointments` ORDER BY `appointments`.`id` DESC");
             foreach($userss as $userss2)
             {
                 $ids=$userss2->id;
                 $userss2->id="$ids";
             }
       
         $response =[ 'success'=>"200",'data'=>$userss[0],'message'=>'Success'];
        }else
        {
          
              $datess=date('Y-m-d ');
            $phone=$request->phone;
               $name=$request->name;
                 $gender=$request->gender;
                   $age=$request->age;
                     $date=$request->date;
                       $city=$request->city;
                    $doctor_id=$request->doctor_id;
                    
                       $randomnumber = rand(111111,999999);
                      $dahgdvhcdhvc=date('d-m-Y ');
        $users=DB::select("INSERT INTO `patients`( `doctor_id`, `name`, `phone`,  `age`,  `gender`, `status`,`created_at`, `updated_at`,`uhid`,`date`) VALUES ('$doctor_id','$name','$phone','$age','$gender','1','$date','$date','Sleek@$randomnumber','$date')");
         $appp=DB::select("INSERT INTO `appointments`( `doctor_id`, `date`, `status`,  `name`, `age`, `gender`, `phone`, `created_at`, `updated_at`,`uhid`) VALUES ('$doctor_id','$date','2','$name','$age','$gender','$phone','$date','$date','Sleek@$randomnumber')");
             $userss = DB::select("SELECT * FROM `appointments` ORDER BY `appointments`.`id` DESC");
                          foreach($userss as $userss2)
             {
                 $ids=$userss2->id;
                 $userss2->id="$ids";
             }
       
         $response =[ 'success'=>"200",'data'=>$userss[0],'message'=>'Success'];
        
        }
        return $response;
    }
    
    
public function createappointments(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'phone' => 'required',
        'gender' => 'required',
        'age' => 'required',
        'date' => 'required',
        'doctor_id' => 'required',
    ]);

    $patient_id = $request->patient_id;
    
    if ($validator->fails()) {
        return response()->json([
            'error' => "400",
            'message' => $validator->errors()
        ], 400);
    }

     	date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        
    $phone = $request->phone;
    $lastFourDigits = substr($phone, -4);
    $uhid = $lastFourDigits . "@Sleekcare";
    
    $userCount = DB::table('patients')->where('doctor_id',$request->doctor_id)->where('phone', $phone)->count();
   

    $appointmentData = [
        'patient_id'=>$patient_id,
        'doctor_id' => $request->doctor_id,
        'date' => $request->date,
        'status' => 2,
        'name' => $request->name,
        'age' => $request->age,
        'gender' => $request->gender,
        'phone' => $phone,
        'created_at' => $date,
        'uhid' => $uhid,
    ];


       if($patient_id){
           $check_patient_id = DB::table('patients')->where('id',$patient_id)->first();
           if(!$check_patient_id){
             return response()->json(['success'=>false,'message'=>'Patient id not found!']);  
           }
       }
       
       
       if($userCount>0 && $patient_id){
           $id = DB::table('appointments')->insertGetId($appointmentData);
       }else{
           if($userCount>=3){
               return response()->json(['success'=>false,'message'=>'Mobile number has been used with maximum allowed account!']);
           }else{
               
              $existingPatient = DB::table('patients')
                ->where('phone', $request->phone)
                ->where('doctor_id',$request->doctor_id)
                ->where('name', $request->name)
                ->where('age', $request->age)
                ->where('gender',$request->gender)
                 ->first();
            
               if($existingPatient){
                  return response()->json(['status'=>false,'message'=>'Patient already exist!']); 
               }
               
                $patientData = [
                        'doctor_id' => $request->doctor_id,
                        'name' => $request->name,
                        'phone' => $phone,
                        'age' => $request->age,
                        'gender' => $request->gender,
                        'status' => 1,
                        'created_at' => $date,
                        'uhid' => $uhid,
                        'date' =>$date,
                    ];
                    
                    $patient_inserted_id =  DB::table('patients')->insertGetId($patientData);
                    $appointmentData['patient_id'] = $patient_inserted_id;
                    $id =  DB::table('appointments')->insertGetId($appointmentData);
           }
       }

    $latestAppointment = DB::table('appointments')->where('id',$id)->first();

    return response()->json([
        'success' =>true,
        'data' => $latestAppointment,
        'message' => 'Success'
    ]);
}
    
public function medication_add(Request $request) {
   
   	date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s'); 
    
    $randomnumber = date('Y-m-d');

   
    $values = [
        'dignosis' => json_encode($request->diagnosis),
        'tme_to_take' => json_encode($request->tme_to_take),
        'to_be_taken' => json_encode($request->to_be_taken),
        'tables' => json_encode($request->tables),
        'symptoms' => json_encode($request->symptoms),
        'lab' => json_encode($request->lab),
        'medical_details' => json_encode($request->medical_details),
        'notes' => json_encode($request->notes),
        'temprature' => $request->temperature,
        'blood_pres' => $request->blood_pres,
        'blood_group' => $request->blood_group,
        'pulse' => $request->pulse,
        'height' => $request->height,
        'weights' => $request->weights,
        'spo2' => $request->spo2,
        'appointment_id' => $request->appointment_id,
        'dibitic' => $request->diabetic,
        'doctor_id' => $request->doctor_id,
        'repeat' => $request->repeat,
        'date' => $date,
        'randomnumber' => $randomnumber,
        'diagnosis_remark' => json_encode($request->diagnosis_remark),
        'symptoms_remark' => json_encode($request->symptoms_remark),
        'lab_remark' => json_encode($request->lab_remark),
        'notes_remark' => json_encode($request->notes_remark),
    ];

    // Insert the values into the database and get the inserted ID
    $medicationId = DB::table('medication')->insertGetId($values);

    // Check if the insertion was successful
    if ($medicationId) {
        $response = [
            'medication' => $medicationId,
            'success' => true,
            'message' => "Successfully Add"
        ];

        return response()->json($response);
    } else {
        // Handle the failure case
        return response()->json(['success' => false, 'message' => "Failed to Add"]);
    }
}

    
    public function medication (request $request){
        $tz = 'Asia/Kolkata'; 
        date_default_timezone_set($tz);
        $validator=validator ::make($request->all(),
        [
            'dignosis'=>'required',
            'symptoms'=>'required',
            'lab'=>'required',
            'medical_details'=>'required',
            'notes'=>'required',
            'temprature'=>'required',
            'blood_pres'=>'required',
             'blood_group'=>'required',
              'pulse'=>'required',
             'height'=>'required',
              'weights'=>'required',
              'spo2'=>'required',
                'appointment_id'=>'required',
                'dibitic'=>'required',
                 'doctor_id'=>'required',
                 
                 'repeat'=>'required',
                 'tme_to_take'=>'required',
                 'to_be_taken'=>'required',
                 //////////////////////////////
                 
          
        ]);
        $date=date('Y-m-d h:i:s');
       
        if($validator ->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator ->errors()
            ];                                                   
            
            return response()->json($response,400);
        }
         $diagnosis_remark=$request->diagnosis_remark;
          $symptoms_remark=$request->symptoms_remark;
           $lab_remark=$request->lab_remark;
            $medicine_remark=$request->medicine_remark;
             $notes_remark=$request->notes_remark;
             ///////////////////////////////////
           
             //////////////////////////////////
        $values = [
            'dignosis'=>"$request->dignosis",
            'symptoms'=>"$request->symptoms",
            'lab'=>"$request->lab",
            'medical_details'=>"$request->medical_details",
             'notes'=>"$request->notes",
            'date_time'=>$date,
            'temprature'=>"$request->temprature",
            'blood_pres'=>"$request->blood_pres",
             'blood_group'=>"$request->blood_group",
            'pulse'=>"$request->pulse",
          'height'=>"$request->height",
          'weights'=>"$request->weights",
          'spo2'=>"$request->spo2",
            'appointment_id'=>"$request->appointment_id",
            
          'dibitic'=>"$request->dibitic",
            
             'doctor_id'=>"$request->doctor_id",
            
             
              'repeat'=>"$request->repeat",
            
             'tme_to_take'=>"$request->tme_to_take",
            
              'to_be_taken'=>"$request->to_be_taken",
             'date'=>$date,
             
                 'diagnosis_remark'=>"$request->diagnosis_remark",
                 'symptoms_remark'=>"$request->symptoms_remark",
                   'lab_remark'=>"$request->lab_remark",
                           'medicine_remark'=>"$request->medicine_remark",
                             'notes_remark'=>"$request->notes_remark",
             
            ];
        
            // print_r($values);die;
            $ab=DB::table('medication')->insertGetId($values);
            if($ab==true)
            {
                $alldata=DB::table('medication')->where('id',$ab)->get();
                $response=[
                    'medication'=>"$ab",
                    // 'medication'=>$alldata[0],
                    'success'=>true,
                    'message'=>"Successfully Add"
                ];                                                   
                
                return response()->json($response,200);
            }
        
       
        
        
        // return response()->json($response,200);
    }
    
//       public function update_patient(Request $request) {
//     // Set timezone
//     $tz = 'Asia/Kolkata';
//     date_default_timezone_set($tz);

//     // Validate the request
//     $validator = Validator::make($request->all(), [
//         'patient_id' => 'required|exists:patients,id', // Ensure the patient ID exists
//         'name' => 'nullable|string|max:255',
//         'phone' => 'nullable|string|max:20',
//         'gender' => 'nullable|string',
//         'height' => 'nullable|numeric',
//         'weight' => 'nullable|numeric',
//         'age' => 'nullable|integer',
//         'email' => 'nullable|email|max:255',
//         'dob' => 'nullable|date',
//         'image' => 'nullable|string'
//     ]);

//     // Check if validation fails
//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'message' => $validator->errors()
//         ]);
//     }

//     // Get validated data
//     $data = $request->only([
//         'name', 'phone', 'gender', 'height', 'weight', 'age', 'email', 'dob'
//     ]);

//     // Handle image upload if present
//     if ($request->has('image')) {
//         $image = $request->image;
//         $imageName = null;

//         if ($image) {
//             $image = str_replace('data:image/png;base64,', '', $image);
//             $image = str_replace(' ', '+', $image);
//             $imageName = rand(111111, 999999) . '.png';
//             $image_update = env('APP_URL').'uploads/doctor/profileimage/'.$imageName;
//             \File::put(public_path('uploads/doctor/profileimage') . '/' . $imageName, base64_decode($image));
//         }

//         // Add image name to the data array
//         $data['image'] = $image_update;
//     }

//     // Update patient record
//     $update_record = DB::table('patients')
//         ->where('id', $request->patient_id)
//         ->update($data);

//     // Return response based on the update result
//     if ($update_record) {
//         return response()->json(['success' => true, 'message' => 'Updated successfully']);
//     } else {
//         return response()->json(['success' => false, 'message' => 'Failed to update']);
//     }
// }


public function update_patient(Request $request) {
    // Set timezone
    $tz = 'Asia/Kolkata';
    date_default_timezone_set($tz);

    // Validate the request
    $validator = Validator::make($request->all(), [
        'patient_id' => 'required|exists:patients,id', // Ensure the patient ID exists
        'name' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'gender' => 'nullable|string',
        'height' => 'nullable|numeric',
        'weight' => 'nullable|numeric',
        'age' => 'nullable|integer',
        'email' => 'nullable|email|max:255',
        'dob' => 'nullable|date',
        'image' => 'nullable|string'
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()
        ]);
    }

    // Get validated data
    $data = $request->only([
        'name', 'phone', 'gender', 'height', 'weight', 'age', 'email', 'dob'
    ]);

    // Remove null values from $data so they don't override existing values in the database
    $data = array_filter($data, function ($value) {
        return !is_null($value);
    });

    // Handle image upload if present
    if ($request->has('image')) {
        $image = $request->image;
        $imageName = null;

        if ($image) {
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = rand(111111, 999999) . '.png';
            $image_update = env('APP_URL').'uploads/doctor/profileimage/'.$imageName;
            \File::put(public_path('uploads/doctor/profileimage') . '/' . $imageName, base64_decode($image));

            // Add image name to the data array
            $data['image'] = $image_update;
        }
    }

    // Update patient record only with non-null fields
    if (!empty($data)) {
        $update_record = DB::table('patients')
            ->where('id', $request->patient_id)
            ->update($data);

        // Return response based on the update result
        if ($update_record) {
            return response()->json(['success' => true, 'message' => 'Updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update']);
        }
    } else {
        return response()->json(['success' => false, 'message' => 'No data to update']);
    }
}

    
public function createpatient(Request $request)
{
   	       	date_default_timezone_set('Asia/Kolkata');
           $datetime = date('Y-m-d H:i:s');
    
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'mobile' => 'required',
        'gender' => 'required',
        'age' => 'required',
        'dob' => 'required',
        'doctor_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()
        ]);
    }
    
    
    $mobile = $request->mobile;
    $last_four_digits = substr($mobile, -4);
    $uhid = $last_four_digits . "@Sleekcare";
    
    
    $imageName = '';
    $image = $request->image;
    if($image){
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = rand(111111, 999999) . '.png';
    $image_update = env('APP_URL').'uploads/doctor/profileimage/'.$imageName;
    \File::put(public_path('uploads/doctor/profileimage') . '/' . $imageName, base64_decode($image));
    }
    

    $mobileCount = DB::table('patients')->where('doctor_id',$request->doctor_id)->where('phone', $mobile)->count();
    if ($mobileCount >=3) {
        return response()->json([
            'success' => false,
            'message' => 'Mobile number has been used with maximum allowed account!'
        ]);
    }

    $existingPatient = DB::table('patients')
        ->where('phone', $mobile)
        ->where('doctor_id',$request->doctor_id)
        ->where('name', $request->name)
        ->where('age', $request->age)
        ->where('gender',$request->gender)
        ->first();

    if ($existingPatient) {
        return response()->json([
            'success' => false,
            'message' => 'The name and age combination has already been added.'
        ]);
    }

    $values = [
        'name' => $request->name,
        'phone' => $mobile,
        'date' =>$datetime,
        'age' => $request->age,
        'gender' => $request->gender,
        'dob' => $request->dob,
        'created_at' =>$datetime,
        'doctor_id' => $request->doctor_id,
        'uhid' => $uhid,
        'image' => $image_update ?? null
    ];

    $patientId = DB::table('patients')->insertGetId($values);
    $patientData = DB::table('patients')->where('id', $patientId)->first();

    return response()->json([
        'patientid' => $patientId,
        'patientdata' => $patientData,
        'success' => true,
        'message' => "Successfully added patient"
    ]);
}



    public function doctor_dashboard(Request $request){
          $validator = Validator::make($request->all(),[
             'doctor_id'=>'required|exists:docters,id'
             ]);
          if($validator->fails()){
                 return response()->json(['success'=>false,'message'=>$validator->errors()->first()]);
             }
             
        	date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d');
             
           $doctor_id = $request->doctor_id;
          $today_total_appointment = DB::table('appointments')->where('doctor_id',$doctor_id)->whereDate('date',$date)->count();
          $today_completed_appointment = DB::table('appointments')->where('doctor_id',$doctor_id)->where('status',0)->whereDate('date',$date)->count();
          $today_remaining_appointment = $today_total_appointment - $today_completed_appointment;
          $total_patient = DB::table('patients')->where('doctor_id',$doctor_id)->count();
          
          
          return response()->json([
              'success'=>true,
              'message'=>'Dashboard details',
              'today_total_appointment'=>$today_total_appointment,
              'today_remaining_appointment'=>$today_remaining_appointment,
              'total_patient'=>$total_patient
              ]);
      }
      
      
       public function all_completed_appointments(Request $request){
           $validator = Validator::make($request->all(),[
             'doctor_id'=>'required|exists:docters,id',
             'patient_id'=>'required|exists:patients,id',
             ]);
             $validator->stopOnFirstFailure();
          if($validator->fails()){
                 return response()->json(['success'=>false,'message'=>$validator->errors()->first()]);
             }
        	date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d');
           
           $completed_appointments = DB::table('appointments')->where('patient_id',$request->patient_id)->where('doctor_id',$request->doctor_id)->orderBy('id','desc')->where('status',0)->get();
           return response()->json(['success'=>true,'message'=>'Completed appointments details.','data'=>$completed_appointments]);
       }
      
      
      
      
      
      
      
    
   
}
