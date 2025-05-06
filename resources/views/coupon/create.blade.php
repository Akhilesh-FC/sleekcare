
@extends('doctor.admin.app')

@section('doctor')


<div class="main-container">
	<div class="pd-ltr-20">

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

        <div class="card col-lg-12 bg-dark">
            <div class="card-header bg-secondary">
                <div class="d-flex justify-content-between align-items-center" >
                   <h5 class="text-white"> Create Coupon Code</h5>
                   <div>
              
                    {{--<a href="r&p-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Role & Permission</a>--}}
                    <a href="{{route('role.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>
                  </div>
               </div>
            </div>

            <div class="card-body">
                <form action="{{route('coupon.store')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   


                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <labe class="text-white h4">Code</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="code"  value="">
                            
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            <labe class="text-white h4">Max Off</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="maxoff"  value="">
                            
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            <labe class="text-white h4">Minmum Perchase</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="minpurchase"  value="">
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            <labe class="text-white h4">Package duration</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="package_duration"  value="">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            
                            <labe class="text-white h4">Package</labe>
                            <select name="package_id" id="" class="form-control">
                            @foreach($package as $key=>$item)
                            
                            <option value="{{$item->id}}">{{$item->name}}</option>


                            @endforeach
                     </select>  
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





