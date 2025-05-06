
@extends('doctor.admin.app')

@section('doctor')

<div class="main-container">
	<div class="pd-ltr-20">
        <div class="card col-lg-12 mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Users</h6>
              <a href="/users" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back </a> 
            </div>
        
            <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
               @csrf
        
           
        
        
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control bg-secondary"  name="name"  value="">
                        @error('name')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="percent_N">Mobile</label>
                        <input type="text" class="form-control bg-secondary"  name="percent_N"  value=""">
                        @error('percent_N')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="percent_P">Image</label>
                        <input type="file" class="form-control bg-secondary"  name="percent_P"  value="">
                        @error('percent_P')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="percent_K">City</label>
                        <input type="text" class="form-control"  name="percent_K"  value="">
                        @error('percent_K')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="percent_K">Role</label>
                        <select name="" class="form-control" id="">
                            <option value="">sub Admin</option>
                            <option value="">sub Admin</option>
                            <option value="">sub Admin</option>
                        </select>
                        @error('percent_K')
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