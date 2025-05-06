
@extends('doctor.admin.app')

@section('doctor')



<div class="main-container">
	<div class="pd-ltr-20">

   

    <div class="row">
          @if (session()->has('success'))
            <div class="col-md-5"> <div class="msg-success text-success"> {{session()->get('success')}}</div></div>
          @endif 
  
   
        <div class="row col-md-12 d-flex justify-content-between">
          
            <h4 class="text-white">SleekCare User Detaile</h4>
           
            <a href="{{URL::previous()}}" class="btn btn-primary btn-sm">Back</a>
         
        </div>
        
        <div class="row col-md-12 d-flex justify-content-center mb-5"> <img src="{{URL::asset('storage/'.$users->image)}}" class="rounded-circle" width="10%" >  </div>
           
        
      
     
        
        <div class="row col-md-12 d-flex justify-content-around align-items-center">
            <div class="col-md-6">
                
                   <div class="d-flex"> <h5 class="text-white">Name-</h5> <p class="text-white">{{$users->name}}</p></div>
                   <div class="d-flex"> <h5 class="text-white">Mobile-</h5><p class="text-white"> {{$users->mobile}}</p></div>
                   <div class="d-flex"> <h5 class="text-white">Email-</h5> <p class="text-white"> {{$users->email}}</p> </div>
                   <div class="d-flex"> <h5 class="text-white">City-</h5> <p class="text-white"> {{$users->city}}</p> </div>
                  
            </div>
            
            
            <div class="col-md-6">
              
                    <div class="d-flex"><h5 class="text-white">Role- </h5 ><p class="text-white"> {{$users->role->name}}</p></div>
                    <div class="d-flex"><h5 class="text-white">Status- </h5><p class="text-white"> {{$users->status}}</p> </div>
                    <div class="d-flex"><h5 class="text-white">joined date-  </h5><p class="text-white"> {{$users->created_at}}</p></div>
                  
            </div>
              
            
        </div>
        
        
        
        
              
    </div>

      </div>
    </div>
 


  @endsection




