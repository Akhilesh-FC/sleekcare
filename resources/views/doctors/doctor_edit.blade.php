
@extends('doctor.admin.app')

@section('doctor')
<div class="main-container">
	<div class="pd-ltr-20">

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

        <div class="card col-lg-12 bg-dark">
            <div class="card-header bg-secondary">
                <div class="d-flex justify-content-between align-items-center" >
                   <h5 class="text-white"> Edit Doctor</h5>
                   <div>
              
                    {{--<a href="r&p-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Role & Permission</a>--}}
                    <a href="{{route('role.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
                  </div>
               </div>
            </div>

            <div class="card-body">
                <form action="{{route('doctor.update')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   


                @foreach($docters as $key=>$item)
                
                <div class="row">
                    
                    <input type="hidden" class="form-control bg-secondary text-white"  name="id"  value="{{$item->id}}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <labe class="text-white h4">Name</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="name"  value="{{$item->name}}">
                            
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            <labe class="text-white h4">Mobile No.</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="mobile"  value="{{$item->mobile}}">
                            
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            <labe class="text-white h4">Stream</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="stream"  value="{{$item->stream}}">
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            <labe class="text-white h4">Registration No.</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="registration_no"  value="{{$item->registration_no}}">
                            
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            <labe class="text-white h4">Town</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="town"  value="{{$item->city}}">
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            <labe class="text-white h4">Why to choose Sleekcare.</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="why_us"  value="{{$item->whysleekcare_1}}">
                            
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