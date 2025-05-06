@extends('admin.app')

@section('admin')

<div class="content-body ">
    
    <div class="container-fluid">




<div class="row">



<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
          
                <h4>Manage Task</h4>
                <a href="" class="btn btn-primary btn-sm">Add</a>
          
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="display min-w850">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Gender</th>
                            <th>Education</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Joining Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img class="rounded-circle" width="35" src="images/profile/small/pic1.jpg" alt=""></td>
                            <td>Tiger Nixon</td>
                            <td>Architect</td>
                            <td>Male</td>
                            <td>M.COM., P.H.D.</td>
                            <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
                            <td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
                            <td>2011/04/25</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                </div>												
                            </td>												
                        </tr>
                        <tr>
                            <td><img class="rounded-circle" width="35" src="images/profile/small/pic2.jpg" alt=""></td>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Female</td>
                            <td>M.COM., P.H.D.</td>
                            <td><a href="javascript:void(0);"><strong>987 654 3210</a></strong></td>
                            <td><a href="javascript:void(0);"><strong>info@example.com</a></strong></td>
                            <td>2011/07/25</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div></div></div>

@endsection