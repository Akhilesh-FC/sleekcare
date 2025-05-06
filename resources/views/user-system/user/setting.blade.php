
@extends('doctor.admin.app')

@section('doctor')



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
 <div class="main-container">
     
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h5 mb-0 text-white">Setting</h5>
    <div>
        <ol class="breadcrumb text-white">
            <li class="breadcrumb-item"><a href="" class="text-danger"><i class="fas fa-fw fa-tachometer-alt mt-1 text-danger"></i> Home</li></a>
            <li class="breadcrumb-item"> Setting</li>
        </ol>
    </div>
</div> 


<div class="row">
  @if (session()->has('success'))
    <div class="col-md-5"> <div class="msg-success text-success"> {{session()->get('success')}}</div></div>
  @endif 
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
          
            <h6 class="text-white">SleekCare Settings</h6>
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
                <th>Name</th>
               
                <th>Status</th>
               <th>Action</th>
              </tr>
            </thead>
            <tbody id="myTable" class="text-white">
       @foreach($setting as $key=>$item)
             <tr>
               
                <td>{{$key+1}}</td> 
                <td>{{$item->name}}</td> 

                 @if($item->status=='1')
                  <td>  <a href="{{route('sleekcare.active',$item->id)}}" class="btn btn-success  btn-sm"><i class="fa fa-check"></i></a></td>
                @elseif($item->status=='0')
                  <td>  <a href="{{route('sleekcare.inactive',$item->id)}}" class="btn btn-danger  btn-sm"><i class="fa fa-times"></i></a></td>
                @else
                <td></td>
                @endif

                    <td>
                      <!--<a href="" class="btn btn-info  btn-sm"><i class="fa fa-eye"></i></a> -->
                      <a href="{{route('sleekcare.edit',$item->id)}}" class="btn btn-info  btn-sm"><i class="fa fa-pencil"></i></a>
                    </td> 
                
             </tr>  
       @endforeach

            </tbody>
          </table>
        
        </div>

      </div>
    </div>
 
  
  
  <!--settings-->
  
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 bg-secondary">
         <div class="d-flex justify-content-between align-items-center" >
          
            <h6 class="text-white">SleekCare settings</h6>
            <div>
              <!--<a href="{{route('system_users.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Create Users</a>-->
              <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
            </div>
           
         </div>
        </div>
        
        
        
    <div class="container mt-3">
        <div id="accordion">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <a class="btn" data-bs-toggle="collapse" href="#collapseOne">Speciality</a>
                    <a href="{{route('speciality.index')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                </div>
                
                <div id="collapseOne" class="collapse" data-bs-parent="#accordion">
                    <div class="card-body">
         
                        <form action="{{route('speciality.store')}}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Speciality name</label>
                                        <input type="text" class="form-control"  name="name"  required>
                                    </div>
                                </div>
                            </div>
        
                            <button class="btn btn-success  btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
   
            <!--<div class="card mt-3 mb-3 ">-->
            <!--    <div class="card-header d-flex flex-row align-items-center justify-content-between">-->
            <!--        <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseThree">Doctor Location</a>-->
            <!--    </div>-->
     
            <!--    <div id="collapseThree" class="collapse" data-bs-parent="#accordion">-->
            <!--        <div class="card-body">-->
            <!--            <form action="#" method="post">-->
            <!--                <div class="row">-->
            <!--                    <div class="col-md-6">-->
            <!--                        <div class="form-group">-->
            <!--                            <label for="name">Doctor</label>-->
            <!--                            <input type="text" class="form-control"  name="docid" required>-->
                                      
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="col-md-6">-->
            <!--                        <div class="form-group">-->
            <!--                            <label for="name">Address</label>-->
            <!--                            <input type="text" class="form-control"  name="address" required>-->
                                      
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->

            <!--                <div class="row">-->
            <!--                     <div class="col-md-6">-->
            <!--                        <div class="form-group">-->
            <!--                            <label for="name">Avalaivility</label>-->
            <!--                           <input type="text" class="form-control"  name="upid" required>-->
                                       
            <!--                        </div>-->
            <!--                    </div>-->
                                
            <!--                     <div class="col-md-6">-->
            <!--                        <div class="form-group">-->
            <!--                            <label for="name">Status</label>-->
            <!--                           <input type="text" class="form-control"  name="mykey" required>-->
                                       
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
    
            <!--                <button class="btn btn-success  btn-sm">Submit</button>-->
            <!--            </form>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
    
    
            <div class="card mt-3 mb-3">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#slider">App Logo</a>
                </div>
     
                <div id="slider" class="collapse" data-bs-parent="#accordion">
                    <div class="card-body">
                
                        <form action="{{route('sleekcare.logo')}}" method="post" enctype="multipart/form-data">
                           @csrf
                            @method('PATCH')
                            
                           
                          
                            <div class="row">
                                <div class="col-md-6">
                                   <div class="form-group">
                                       <label >App Logo (required size :- max- 550 x 500) </label>
                                       <input type="file" class="form-control"  name="image" required>
                                   </div>
                                   
                                   
                                </div>
                                   
                                <div class="col-md-6">
                                   <div class="form-group">
                                    @php $app = App\Models\Setting :: where('id',1)->first(); @endphp
                            
                                       @if(!empty('$app'))
                                    
                                           <img src="{{URL::asset('storage/'.$app->image)}}" width="100" height="100"> 
                                   
                                       @endif
                                      
                                    
                                   </div>
                                </div>
                            </div>    
                    
                            <button class="btn btn-success btn-sm" type="submit">Submit</button>
                        </form>   
                    </div>
                </div>
            </div>
    
            <div class="card mt-3 mb-3">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#banner">App Banner</a>
                </div>
        
                <div id="banner" class="collapse" data-bs-parent="#accordion">
                     @php $banner = App\Models\Setting :: where('id',2)->first(); @endphp
                    <div class="card-body">
                        <form action="{{route('sleekcare.banner')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($banner)
                            @method('put')
                            @endisset
                            <input type="hidden" name="id" value="{{$banner->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="name">App Banner (required size :- max- 550 x 500) </label>
                                       <input type="file" class="form-control"  name="banner" >
                                   </div>
                                </div>
                                   
                                <div class="col-md-6">
                                   <div class="form-group">
                                       <img src="" width="100" height="100">
                                   </div>
                                </div>
                            </div>    
                            
                            <button class="btn btn-success btn-sm" type="submit">Submit</button>
                        </form>   
                    </div>
                </div>
            </div>
       </div>
    </div> 
        
        
        </div>
        
     </div>
</div>
    
    
    
  
  
  
  
  
  
  
  
  
  





    
    

