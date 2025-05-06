
@extends('doctor.admin.app')

@section('doctor')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    
        <!--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<div class="main-container">
	<div class="pd-ltr-20">

<div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
            <h5 class="text-white">Patient</h5>
            <div>
               <a href="{{ route('doctor.approve')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a> 
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
                <th>Doctor</th>
                <th>Phone</th>
                <th>Age</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Height</th>
                <th>Weight</th>
               <!--<th>Action</th>-->
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">
              @foreach($doctor_patient as $key=>$item)
             <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->dname}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->age}}</td>
                <td>{{$item->dob}}</td>
                <td>{{$item->gender}}</td>
                <td>{{$item->height}}</td>
                <td>{{$item->weight}}</td>
                <!--<td>-->
                <!--    <a href="" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>-->
                <!--</td>-->
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


<!-- JavaScript -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
              {
                    extend: 'excelHtml5',
                    title: 'Project Report - ' + new Date().toJSON().slice(0,10).replace(/-/g,'-')
                },
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
    

</script>


  @endsection




