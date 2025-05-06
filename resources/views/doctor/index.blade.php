
@extends('doctor.admin.app')

@section('doctor')

<div class="main-container">
	<div class="pd-ltr-20">

		<h3 class="text-white mb-3">Welcome ...!</h3>


		@foreach($dashboard as $key=>$item)
		<div class="row">
			<div class="col-xl-3 mb-30">
			    <a href="/doctor_appointment_all">
				<div class="card-box height-100-p widget-style1 bg-dark">
					<div class="d-flex flex-wrap align-items-center">
						<div class="progress-data">
							<div id="" ><img src="{{asset('doctor/vendors/images/medical-appointment.png')}}" alt="" style="height:60px; margin-top:20px;"></div>
						</div>
						
						<div class="widget-data">
							<div class="h4 mb-0 text-white">{{$item->appointments}}</div>
							<div class="weight-600 font-14 text-white">Appointment</div>
						</div>
					</div>
				</div>
				</a>
			</div>
			<div class="col-xl-3 mb-30">
			    <a href="/patient">
				<div class="card-box height-100-p widget-style1 bg-dark">
					<div class="d-flex flex-wrap align-items-center">
						<div class="progress-data">
							<div id="" style="color:red; font-size:60px;"><i class="fa fa-heartbeat"></i></div>
						</div>
						<div class="widget-data">
							<div class="h4 mb-0 text-white">{{$item->patient}}</div>
							<div class="weight-600 font-14 text-white">Patient</div>
						</div>
					</div>
				</div>
				</a>
			</div>
			<div class="col-xl-3 mb-30">
			    <a href="/doctors-approve">
				<div class="card-box height-100-p widget-style1 bg-dark">
					<div class="d-flex flex-wrap align-items-center">
						<div class="progress-data">
							<div id="" style="color:blue; font-size:60px;"><i class="fa fa-user-md"></i></div>
						</div>
						<div class="widget-data">
							<div class="h4 mb-0 text-white">{{$item->doctor}}</div>
							<div class="weight-600 font-14 text-white">Total Approved Doctor</div>
						</div>
					</div>
				</div>
				</a>
			</div>
			<div class="col-xl-3 mb-30">
			    <a href="/doctors">
				<div class="card-box height-100-p widget-style1 bg-dark">
					<div class="d-flex flex-wrap align-items-center">
						<div class="progress-data">
							<div id="" style="color:blue; font-size:60px;"><i class="fa fa-user-md"></i></div>
						</div>
						<div class="widget-data">
							<div class="h4 mb-0 text-white">{{$item->doctor}}</div>
							<div class="weight-600 font-14 text-white">Total Pendig Doctor</div>
						</div>
					</div>
				</div>
				</a>
			</div>
			<div class="col-xl-3 mb-30">
			    <a href="#">
				<div class="card-box height-100-p widget-style1 bg-dark">
					<div class="d-flex flex-wrap align-items-center">
						<div class="progress-data">
							<div id="" style="color:white; font-size:60px;"><i class="fa fa-money"></i></div>
						</div>
						<div class="widget-data">
							<div class="h4 mb-0 text-white">0</div>
							<div class="weight-600 font-14 text-white">Sleekcare Earning</div>
						</div>
					</div>
				</div>
				</a>
			</div>
		</div>
    @endforeach
		{{-- <div class="d-flex justify-content-between">
			<h5 class="text-white mb-2">Today's Appointments</h5>
			<h6 class="text-primary">View all</h6>
		</div>

		<div class="pd-20 card-box mb-30">
		

			<table class="table">
				<thead>
					<tr>
						<th scope="col">Name</th>
						<th scope="col">UHID</th>
						<th scope="col">City</th>
						<th scope="col">Contact</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Mark</td>
						<td>Otto</td>
						<td>@mdo</td>
						<td><span class="badge badge-primary">Primary</span></td>
					</tr>
					
				</tbody>
			</table>

		</div> --}}
			
	</div>
</div>


@endsection 