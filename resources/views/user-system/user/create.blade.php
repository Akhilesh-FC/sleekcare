
@extends('doctor.admin.app')

@section('doctor')

<div class="main-container">
	<div class="pd-ltr-20">
        <div class="card col-lg-12 mb-4 bg-dark">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-secondary">
              <h6 class="m-0 font-weight-bold text-white">@if(isset($users)) Edit System User @else Create System User @endif</h6>
              <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a> 
            </div>
        
        <div class="card-body">
            <form action="{{isset($users) ? route('system_users.update',$users->id) : route('system_users.store')}}" method="post" enctype="multipart/form-data">
               @csrf

               @isset($users)
                @method('PUT')
               @endisset
        
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <labe class="text-white">Name</labe>
                       <input type="text" class="form-control bg-secondary text-white" name="name" value="{{isset($users)? $users->name : old('name')}}">
                        @error('name')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                    
                <div class="col-md-4">
                    <div class="form-group">
                        <labe class="text-white">Mobile</labe>
                       <input type="text" class="form-control bg-secondary text-white" name="mobile" maxlength="10"  value="{{isset($users)? $users->mobile : old('mobile')}}">
                        @error('mobile')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <labe class="text-white">Email</labe>
                       <input type="email" class="form-control bg-secondary text-white" name="email" value="{{isset($users)? $users->email : old('email')}}">
                        @error('email')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                                
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <labe class="text-white">Password</labe>
                       <input type="password" class="form-control bg-secondary text-white" name="password" value="{{isset($users)? $users->password : old('password')}}" @if(isset($users)) readonly @else  @endif>
                        @error('password')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                    
                <div class="col-md-4">
                    <div class="form-group">
                        <labe class="text-white">City</labe>
                       <input type="text" class="form-control bg-secondary text-white" name="city" value="{{isset($users)? $users->city : old('city')}}">
                        @error('city')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <labe class="text-white">Role</labe>
                       <select  class="form-control bg-secondary text-white" name="role" value="{{isset($users)? $users->role_id : old('role')}}">
                        @foreach($roles as $role)
                            @if(isset($users))
                            <option value="{{$role->id}}" {{$users->role_id == "$role->id" ? "selected" : ""}}>{{$role->name}}</option>
                            {{-- <option value="{{@$item->id}}"{{$devices->dealer_id=="$item->id"? "selected":""}}>{{$item->name}}</option> --}}
                            @else <option value="{{$role->id}}">{{$role->name}}</option> @endif
                        @endforeach
                       </select>
                        @error('role')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <labe class="text-white">Image</labe>
                       <input type="file" class="form-control bg-secondary text-white" name="image">
                        
                        @error('image')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                 
                @if (isset($users->image))  <img src="{{URL::asset('storage/'.$users->image)}}" width="100" height="100"> @else  @endif


            </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-icon-split btn-sm">Submit</button>
                </div>
           

        </form>
        
            </div>
         </div>
    </div>
</div>
@endsection