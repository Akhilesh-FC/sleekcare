
@extends('doctor.admin.app')

@section('doctor')



<div class="main-container">
	<div class="pd-ltr-20">

<div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
            <h5 class="text-white">Why SleekCare</h5>
            <div>
              {{-- <a href="role-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Create Role</a> --}}
              {{-- <a href="role-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Role & Permission</a> --}}
            </div>
           
        </div>
        </div>
        <div class="table-responsive p-3 bg-dark">
          <table class="table align-items-center table-flush table-hover mb-5" id="example" >
            <thead class="text-white bg-secondary">
              <tr>
                <th>Sr.No.</th>
                <th>Name</th>
               <th>Action</th>
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">

             <tr>
                <td></td>
                <td></td>
                <td>
                    <a href="" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                </td>
             </tr>
  
            </tbody>
          </table>
        
        </div>

      </div>
    </div>
  </div>

    </div>
</div>

  @endsection




