
@extends('doctor.admin.app')

@section('doctor')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">


<div class="main-container">
	<div class="pd-ltr-20">

<div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
            <h5 class="text-white">Doctors</h5>
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
                <th>Mobile No</th>
                <th>Stream</th>
                <th>Registration No</th>
                <th>Town / city</th>
               <th>Why Sleekcare 1</th>
               <th>Why Sleekcare 2</th>
               <th>Action</th>
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">
              @foreach($docter as $key=>$item)
             <tr>
                 
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->mobile}}</td>
                <td>{{$item->stream}}</td>
                <td>{{$item->registration_no}}</td>
                <td>{{$item->city}}</td>
                <td>{{$item->whysleekcare_1}}</td>

                <td>{{$item->whysleekcare_2}}</td>
                 <td>
                 
                    @if($item->status=='1')
                    <a href="{{route('doctor.active',$item->id)}}" class="btn btn-success  btn-sm" data-toggle="modal" data-target="#exampleModa{{$item->id}}"><i class="fa fa-check"></i></a>
                    <div class="modal fade" id="exampleModa{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--<h5 class="modal-title" id="exampleModalLabel"></h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-size:19px;">
        Are you sure want to Disapprove this user  ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a  href="{{route('doctor.active',$item->id)}}" type="button" class="btn btn-success">ok</a>
      </div>
    </div>
  </div>
</div>
                    @elseif($item->status=='0')
                    <a href="{{route('doctor.inactive',$item->id)}}" class="btn-success  btn-sm" data-toggle="modal" data-target="#exampleMod1{{$item->id}}"><i class="fa fa-check-square"></i></a>
                    
                    <div class="modal fade" id="exampleMod1{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--<h5 class="modal-title" id="exampleModalLabel"></h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-size:19px;">
        Are you sure want to Approve this user  ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a  href="{{route('doctor.inactive',$item->id)}}" type="button" class="btn btn-success">ok</a>
      </div>
    </div>
  </div>
</div>
                    @else

                    @endif
             <!--     </td>-->
             <!--     <td> <a href="" class="btn-success  btn-sm" data-toggle="modal" data-target="#exampleMod1"><i class="fa fa-check-square"></i></a></td>-->
             <!--</tr>-->
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




