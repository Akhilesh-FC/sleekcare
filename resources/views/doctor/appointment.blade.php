@extends('doctor.admin.app')

@section('doctor')

<div class="content-body ">
    <div class="container-fluid">

        <div class="me-auto">
            <h2 class="text-white font-w600">Appointments</h2>
        
        </div>

        <div class="d-flex bd-highlight">
            <div class="text-white btn btn-primary btn-sm me-auto bd-highlight">
                <a href="" class="text-white btn btn-info btn-sm"><i class="fa fa-users"></i> patient List</a>
                <a class="text-white btn btn-info btn-sm me-auto bd-highlight"> <i class="fa fa-list"></i> Go To</a>
            </div>
    
           <div>
                <a href="" class="text-primary btn btn-dark btn-sm btn-rounded m-1">Payment mode</a>
                <a href="" class="text-primary btn btn-dark btn-sm btn-rounded m-1">Visit Slip</a>
                <a href="" class="text-primary btn btn-dark btn-sm btn-rounded m-1">Consult type</a>
                <a href="" class="text-primary btn btn-dark btn-sm btn-rounded m-1">Patient Condition</a>
           </div>
        </div>

        <div class="form-head d-flex align-items-center mb-sm-4 m-3">
            <div class="me-auto">
                <h4 class="text-white font-w600">07 October 2023</h4>
            </div>
            <a href="javascript:void(0)" class="text-secondary"><i class="las la-user me-3"></i>View All</a>
        </div> 
      
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>UHID</th>
                                    <th>Type</th>
                                    <th>Doctor</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Payment</th>
                                    <th></th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td class="d-flex">
                                        <img class="rounded-circle" width="35" src="images/profile/small/pic1.jpg" alt="">
                                        Tiger Nixon</td>
                                    <td>963852741</td>
                                    <td></td>
                                    <td>Dr. Neeraj </td>
                                    <td>30</td>
                                    <td>M</td>	
                                    <td>3011234578</td>	
                                    <td>Unpaid</td>
                                    <td><div class="btn btn-info btn-sm  btn-rounded">Start</div></td>										
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="form-head d-flex align-items-center mb-sm-4 m-3">
            <div class="me-auto">
                <h4 class="text-white font-w600">06 October 2023</h4>
            </div>
            <a href="javascript:void(0)" class="text-secondary"><i class="las la-user me-3"></i>View All</a>
        </div> 
      
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>UHID</th>
                                    <th>Type</th>
                                    <th>Doctor</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Payment</th>
                                    <th></th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td class="d-flex">
                                        <img class="rounded-circle" width="35" src="images/profile/small/pic1.jpg" alt="">
                                        Tiger Nixon</td>
                                    <td>963852741</td>
                                    <td></td>
                                    <td>Dr. Neeraj </td>
                                    <td>30</td>
                                    <td>M</td>	
                                    <td>3011234578</td>	
                                    <td>Unpaid</td>
                                    <td><div class="btn btn-info btn-sm  btn-rounded">Start</div></td>										
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