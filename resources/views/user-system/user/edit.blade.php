
@extends('doctor.admin.app')

@section('doctor')

<div class="main-container">
	<div class="pd-ltr-20">
        <div class="card col-lg-12 mb-4 bg-dark">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-secondary">
              <h6 class="m-0 font-weight-bold text-white">Edit SleekCare</h6>
              <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Back</a> 
            </div>
        
        <div class="card-body">
            <form action="{{route('sleekcare.update',$setting->id)}}" method="post" enctype="multipart/form-data">
               @csrf
               
               @isset($setting)
               @method('put')
               @endisset

        
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <labe class="text-white">Name</labe>
                       <input type="text" class="form-control bg-secondary text-white" name="name" value="{{$setting->name}}">
                        @error('name')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">        
                <div class="col-md-12">
                    <div class="form-group">
                        <labe class="text-white">Discription</labe>
                       <textarea name="discription" class="ckeditor form-control" id="editor">{{$setting->discription}}</textarea>
                        @error('discription')
                        <small style="color: rgba(255, 0, 0, 0.626)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>


                <div class="form-group">
                    <button class="btn btn-success btn-icon-split btn-sm">Submit</button>
                </div>
           

        </form>
        
            </div>
         </div>
    </div>
</div>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

@endsection