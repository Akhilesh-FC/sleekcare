
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
          
            <h5 class="text-white">System Users</h5>
            <div>
              <!--<a href="{{route('system_users.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Create Users</a>-->
              <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
            </div>
           
        </div>
        </div>
        <div class="table-responsive p-3 bg-dark">
          <table class="table align-items-center table-flush table-hover mb-5" id="example" >
            <thead class="text-white bg-secondary">
              <tr>
                <th>Sr.No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Role</th>
                <th>City</th>
                <th>Join Date</th>
                <th>Status</th>
               <th>Action</th>
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">
        @foreach($users as $key=>$item)
             <tr>
                <td>{{$key+1}}</td>
                @if($item->image=='') <td></td> @else
                <td><img src="{{URL::asset('storage/'.$item->image)}}" class="rounded-circle" width="50"></td> @endif
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->mobile}}</td>
                <td>{{$item->role->name}}</td>
                <td>{{$item->city}}</td>
                <td>{{$item->created_at}}</td>
          
                <td>
                 
                    @if($item->status=='1')
                    <a href="{{route('users.active',$item->id)}}" class="btn btn-success  btn-sm"><i class="fa fa-check"></i></a>
                    @elseif($item->status=='0')
                    <a href="{{route('users.inactive',$item->id)}}" class="btn btn-danger  btn-sm"><i class="fa fa-times"></i></a>
                    @else

                    @endif
                  </td>
                 
                    <td>
                        <div class="d-flex">
                            <a href="{{route('system_users.view',$item->id)}}" class="btn btn-info  btn-sm m-1"><i class="fa fa-eye"></i></a> 
                            <a href="{{route('system_users.edit',$item->id)}}" class="btn btn-info  btn-sm m-1"><i class="fa fa-pencil"></i></a>
                        </div>
                    
                    </td> 
                
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




