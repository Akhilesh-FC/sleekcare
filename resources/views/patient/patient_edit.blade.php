
@extends('doctor.admin.app')

@section('doctor')
<div class="main-container">
	<div class="pd-ltr-20">

    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card mb-4">

        <div class="card col-lg-12 bg-dark">
            <div class="card-header bg-secondary">
                <div class="d-flex justify-content-between align-items-center" >
                   <h5 class="text-white"> Edit Patient</h5>
                   <div>
              
                    {{--<a href="r&p-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Role & Permission</a>--}}
                    <a href="{{route('patient.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
                  </div>
               </div>
            </div>
  @foreach($docters as $key=>$item)
            <div class="card-body">
                <form action="{{route('patient.update', ['id' => $item->id])}}" method="post" enctype="multipart/form-data">
                   @csrf
                   


              
                
                <div class="row">
                    
                    <!--<input type="hidden" class="form-control bg-secondary text-white"  name="id"  value="{{$item->id}}">-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <labe class="text-white h4">Name</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="name"  value="{{$item->name}}">
                            
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            <labe class="text-white h4">Mobile No.</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="phone"  value="{{$item->phone}}">
                            
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            <labe class="text-white h4">Date of Brith</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="dob"  value="{{$item->dob}}">
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            <labe class="text-white h4">Age</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="age"  value="{{$item->age}}">
                            
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            <labe class="text-white h4">Height</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="height"  value="{{$item->height}}">
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            <labe class="text-white h4">Weight</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="weight"  value="{{$item->weight}}">
                            
                        </div>
                    </div>
                    <div class="col-6 from_part_2">
                                            <labe class="text-white h4">Image</labe>
                                    <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" uired="" d="document.getElementById('en-link').click()">
                                                <label class="custom-file-label" for="customFileEg1">Choose
                                                    File</label>
                                            </div>
                                        </div>
                    <div class="col-md-6">
                        <div class="form-group">
                           <labe class="text-white h4">Gender</labe>
                            <select name="gender" class="form-control">
                        <option value="male" {{ $item->gender === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $item->gender === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $item->gender === 'other' ? 'selected' : '' }}>Other</option>
                    </select>  
                        </div>
                    </div>
                    <div class="col-6 from_part_2">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img style="width: 30%; border: 1px solid; border-radius: 10px;" id="viewer" src="{{$item->image }}" alt="image">
                                                </div>
                                            </div>
                                        </div>
                     
                </div>
                @endforeach

                <button type="submit"  class="btn btn-primary btn-sm">Submit</button>

                </form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
</div>