@extends('doctor.admin.app')

@section('doctor')

<div class="main-container">
	<div class="pd-ltr-20">

<div class="row">
  @if (session()->has('success'))
  <div class="col-md-5"> <div class="msg-success text-success"> {{session()->get('success')}}</div></div>
@endif 
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
            <h5 class="text-white">Role</h5>
            <div>
              <a href="role-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Create Role</a>
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
                <th>permission</th>
                <th>Status</th>
               
            
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">

             


              
              @foreach($roles as $key=>$item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->name}}</td>
                  
               
                    <td></td>
                 
              
                  @if($item->status=='1')
                  <td><a href="{{route('role.active',$item->id)}}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a></td>
                  @elseif($item->status=='0')
                  <td><a href="{{route('role.inctive',$item->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a></td>
                  @else
                  <td></td>
                  @endif
                  
               
                
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