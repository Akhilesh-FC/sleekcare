
@extends('doctor.admin.app')

@section('doctor')



<div class="main-container">
	<div class="pd-ltr-20">

<div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
            <h5 class="text-white">Appointments</h5>
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
                <th>Patient Name</th>
                <th>Patient Mobile</th>
                <th>Doctor Name</th>
                <th>Doctor Mobile</th>
                <th>Age</th>
               <th>Gender</th>
               <th>Date</th>
               <th>UH Id</th>
                <th>Medication List</th>
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">
              @foreach($doctor_appointments as $key=>$item)
             <tr>
                 
                <td>{{$key+1}}</td>
                <td>{{$item->patient_name}}</td>
                <td>{{$item->patient_mobile}}</td>
                <td>{{$item->doctorname}}</td>
                <td>{{$item->doctormobile}}</td>
                <td>{{$item->age}}</td>
                <td>{{$item->gender}}</td>

                <td>{{$item->date}}</td>
                 <td>{{$item->uhid}}</td>
                   <!--<td><a href="medication?id={{$item->id}}" type="button" class="btn btn-info"></a></td>-->
                    <td><a href="medication?id={{$item->id}}" ><button type="button" class="btn btn-info">Medication List</button></a></td>
             </tr>
             @endforeach
            </tbody>
          </table>
        
        </div>

      </div>
    </div>
  </div>

    </div>
</div>

  @endsection




