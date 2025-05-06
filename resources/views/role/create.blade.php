
@extends('doctor.admin.app')

@section('doctor')

<div class="main-container">
	<div class="pd-ltr-20">
        <div class="card col-lg-12 mb-4 bg-dark">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-secondary">
              <h6 class="m-0 font-weight-bold text-white">Create Role</h6>
              <a href="{{route('role.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a> 
            </div>
        
            <div class="card-body">
            <form action="{{route('rp.store')}}" method="post" enctype="multipart/form-data">
               @csrf
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <labe class="text-white h4">Role</labe>
                        <select name="name" id="" class="form-control">
                            @foreach($roles as $item)
                             <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                 <div class="col-md-6">
                      <div class="form-group">
                          <labe class="text-white h4">Permissions List</labe>
                          
                           <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="0">
                                <label class="form-check-label text-white" for="check1">Dashboard</label>
                            </div>
                          
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="1">
                                <label class="form-check-label text-white" for="check1">Users</label>
                            </div>
                            
                             <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="2">
                                <label class="form-check-label text-white" for="check1">Speciality</label>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="3">
                                <label class="form-check-label text-white" for="check1">Why Sleekcare</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="4">
                                <label class="form-check-label text-white" for="check1"> Know Promotions</label>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="5">
                                <label class="form-check-label text-white" for="check1">Role </label>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="6">
                                <label class="form-check-label text-white" for="check1">Doctor Location</label>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="7">
                                <label class="form-check-label text-white" for="check1">Package  </label>
                            </div>
                          
                           <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="permissionid[]" value="8">
                                <label class="form-check-label text-white" for="check1">Coupon Code</label>
                            </div>
                            
                           
                          
                           
                    
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