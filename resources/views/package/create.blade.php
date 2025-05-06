
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
                   <h5 class="text-white"> Create Package</h5>
                   <div>
              
                    {{--<a href="r&p-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Role & Permission</a>--}}
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
                  </div>
               </div>
            </div>

            <div class="card-body">
                <form action="{{route('package.store')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   


                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <labe class="text-white h4">Name</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="name"  value="" required>
                            
                           
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            
                            <labe class="text-white h4">Role</labe>
                            <select name="role_id" id="" class="form-control">
                            @foreach($role as $key=>$item)
                            
                            <option value="{{$item->id}}">{{$item->name}}</option>


                            @endforeach
                     </select>  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            <labe class="text-white h4">Mrp</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="mrp"  value="" required>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            <labe class="text-white h4">Discount</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="discount"  value="" required>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            
                            <labe class="text-white h4">Sp</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="sp"  value="" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            
                            <labe class="text-white h4">Duration</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="duration"  value="" required>
                        </div>
                    </div>
                </div>

                <button type="submit"  class="btn btn-primary btn-sm">Submit</button>

                </form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
</div>





