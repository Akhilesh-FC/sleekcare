
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
                   <h5 class="text-white"> Create medicine</h5>
                  <!-- <div>-->
              
                  <!--  {{--<a href="r&p-create" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Role & Permission</a>--}}-->
                  <!--  <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a>-->
                  <!--</div>-->
               </div>
            </div>

            <div class="card-body">
                <form action="{{route('package.medicine_store')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   


                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <labe class="text-white h4">Name</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="name"  value="" required>
                            
                           
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                     
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                            
                            
                    <!--        <labe class="text-white h4">Price</labe>-->
                    <!--        <input type="text" class="form-control bg-secondary text-white"  name="price"  value="" required>-->
                            
                            
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                            
                            
                            
                    <!--        <labe class="text-white h4">Slag</labe>-->
                    <!--        <input type="text" class="form-control bg-secondary text-white"  name="slag"  value="" required>-->
                            
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                            
                            
                            
                            
                    <!--        <labe class="text-white h4">Discount</labe>-->
                    <!--        <input type="text" class="form-control bg-secondary text-white"  name="discount"  value="" required>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                            
                            
                            
                            
                    <!--        <labe class="text-white h4">Total Price</labe>-->
                    <!--        <input type="text" class="form-control bg-secondary text-white"  name="total_price"  value="" required>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--  <div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                            
                            
                            
                            
                    <!--        <labe class="text-white h4">Stock</labe>-->
                    <!--        <input type="text" class="form-control bg-secondary text-white"  name="stock"  value="" required>-->
                    <!--    </div>-->
                    <!--</div>-->
                      <div class="col-md-6">
                        <div class="form-group">
                            
                            
                            
                            
                            <labe class="text-white h4">Date</labe>
                            <input type="text" class="form-control bg-secondary text-white"  name="date"  value="" required>
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





