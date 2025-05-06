@extends('doctor.admin.app')

@section('doctor')


<div class="main-container">
	<div class="pd-ltr-20">

<div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
            <h5 class="text-white">Package</h5>
            <div>
              <a href="{{route('package.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Create Package</a> 
              <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
            </div>
           
        </div>
        </div>
        <div class="table-responsive p-3 bg-dark">
          <table class="table align-items-center table-flush table-hover mb-5" id="example" >
            <thead class="text-white bg-secondary">
                       
                        <tr>
                            <th>Sr no.</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Mrp</th>
                            <th>Discount</th>
                            <th>Sp</th>
                            <th>Duration</th>
                            <!--<th>Action</th>-->
                         
                        </tr>
       
                    </thead>
                    <tbody>
                        @foreach($package as $key=>$item)
                        <tr class="text-white">
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->rname}}</td>
                            <td>{{$item->mrp}}</td>
                            <td>{{$item->discount}}</td>
                            <td>{{$item->sp}}</td>
                            <td>{{$item->duration}}</td>
                            <!--<td>-->
                            <!--    <div class="d-flex">-->
                            <!--        <a href="#" class="btn btn-info btn-sm "><i class="fa fa-pencil"></i></a>-->
                            <!--        {{-- <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a> --}}-->
                            <!--    </div>												-->
                            <!--</td>												-->
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
      
      
      
      
      