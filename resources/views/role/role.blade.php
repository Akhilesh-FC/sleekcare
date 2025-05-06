
@extends('doctor.admin.app')

@section('doctor')

@if(isset($roless))
<div class="main-container">
	<div class="pd-ltr-20">

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

        <div class="card col-lg-12 bg-dark">
            <div class="card-header bg-secondary">
                <div class="d-flex justify-content-between align-items-center" >
                   <h5 class="text-white"> Create Role</h5>
                   <div>
              
                    <a href="r&p-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Role & Permission</a>
                    <a href="{{route('role.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
                  </div>
               </div>
            </div>

            <div class="card-body">
                <form action="{{ isset($roless) ? route('role.update',$roless->id) :route('role.store')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   
                    @isset($roless)
                       @method('PUT')
                    @endisset


                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <labe class="text-white h4">Role</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="name"  value="{{isset($roless) ? $roless->name: old('name')}}">
                            @error('name')
                            <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit"  class="btn btn-primary btn-sm">Submit</button>

                </form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
</div>

@elseif(isset($roles))


<div class="main-container">
	<div class="pd-ltr-20">

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

        <div class="card col-lg-12 bg-dark">
            <div class="card-header bg-secondary">
                <div class="d-flex justify-content-between align-items-center" >
                   <h5 class="text-white"> Create Role</h5>
                   <div>
              
                    <a href="r&p-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Role & Permission</a>
                    <a href="{{route('role.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
                  </div>
               </div>
            </div>

            <div class="card-body">
                <form action="{{ isset($roless) ? route('role.update',$roless->id) :route('role.store')}}" method="post" enctype="multipart/form-data">
                   @csrf

                    @isset($roless)
                       @method('PUT')
                    @endisset


                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <labe class="text-white h4">Role</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="name"  value="{{isset($roless) ? $roless->name: old('name')}}">
                            @error('name')
                            <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit"  class="btn btn-primary btn-sm">Submit</button>

                </form>
            </div>
        </div>
        </div>
        </div>
    </div>


<div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
            <h5 class="text-white">Role Lists</h5>
            
           
        </div>
        </div>
        <div class="table-responsive p-3 bg-dark">
          <table class="table align-items-center table-flush table-hover mb-5" id="example" >
            <thead class="text-white bg-secondary">
              <tr>
                <th>Sr.No.</th>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">


                
                @foreach($roles as $key=>$item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                @if($item->status=='1')
                <td><a href="{{route('role.active',$item->id)}}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a></td>
                @elseif($item->status=='0')
                <td><a href="{{route('role.inctive',$item->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a></td>
                @else
                <td></td>
                @endif
                <td>
                    <a href="{{route('role.edit',$item->id)}}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

@endif

  @endsection