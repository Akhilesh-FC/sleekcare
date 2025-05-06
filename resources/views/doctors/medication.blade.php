
@extends('doctor.admin.app')

@section('doctor')



<div class="main-container">
	<div class="pd-ltr-20">

<div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
            <h5 class="text-white">Medication List</h5>
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
                
                <th>Doctor Name</th>
                <th>Doctor Mobile</th>
                <th>dignosis</th>
               <th>symptoms</th>
               <th>lab</th>
               <th>test</th>
                <th>temprature</th>
                 <th>dibitic</th>
               <th>blood_group</th>
               <th>pulse</th>
               <th>spo2</th>
                <th>date_time</th>
                 <th>weights</th>
               <th>height</th>
               <th>blood_pres</th>
               <th>notes</th>
                <th>medical_details	</th>
                 <th>diagnosis_remark</th>
               <th>symptoms_remark</th>
               <th>lab_remark</th>
               <th>dosage</th>
                <th>duration</th>
                 <th>frequency</th>
               <th>medicine_remark</th>
              
               
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">
              @foreach($doctor_appointments as $key=>$item)
             <tr>
                 
                <td>{{$key+1}}</td>
                <td>{{$item->docters_name}}</td>
                <td>{{$item->docters_mobile}}</td>
                <td>{{$item->dignosis}}</td>
                <td>{{$item->symptoms}}</td>
                <td>{{$item->lab}}</td>
                <td>{{$item->test}}</td>
                <td>{{$item->temprature}}</td>
                <td>{{$item->dibitic}}</td>
                <td>{{$item->pulse}}</td>
                <td>{{$item->spo2}}</td>
                <td>{{$item->date_time}}</td>
                <td>{{$item->weights}}</td>
                <td>{{$item->height}}</td>
                <td>{{$item->blood_pres}}</td>
                <td>{{$item->notes}}</td>
                <td>{{$item->medical_details}}</td>
                <td>{{$item->diagnosis_remark}}</td>
                <td>{{$item->symptoms_remark}}</td>
                <td>{{$item->lab_remark}}</td>
                <td>{{$item->dosage}}</td>
                <td>{{$item->duration}}</td>
                <td>{{$item->frequency}}</td>
                     <td>{{$item->medicine_remark}}</td>
                          <td>{{$item->notes_remark}}</td>
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




