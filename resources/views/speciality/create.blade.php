
@extends('doctor.admin.app')

@section('doctor')

<div class="main-container">
    
    
    
	<div class="pd-ltr-20">
        <div class="card col-lg-12 mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Edit Speciality </h6>
              <a href="/users" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back </a> 
            </div>
            
        
            <div class="card-body">
            <form action="{{route('speciality.update',$speciality->id)}}" method="post" enctype="multipart/form-data">
               @csrf
               
               @isset($speciality) @method('PUT') @endisset
        
          
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Speciality</label>
                        <input type="text" class="form-control"  name="name"  value="{{$speciality->name}}">
                        @error('name')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

          

               

            
        
            <button class="btn btn-primary btn-icon-split btn-sm">
                Submit
              </button>
            </form>
        
            </div>
         </div>
    </div>
</div>

@endsection