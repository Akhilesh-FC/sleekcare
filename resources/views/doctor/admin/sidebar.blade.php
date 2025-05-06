<div class="left-side-bar bg-dark">
    <div class="brand-logo">
        <a href="index.html">
            {{-- <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
            <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo"> --}}
            <h3 class="text-white align-items-center">SleekCare</h3>
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">

                <?php
                use Illuminate\Support\Facades\DB;
                use App\Models\Role;
                use App\Models\User;
                if(Auth::check())
                {
                    $userid = Auth::id();
                    
                    // dd($userid);

                //   $roleid = App\models\User::where('id',$userid)->where('status',1)->first();
                   $roleid = DB::table('users')->where('id',1)->where('status',1)->first(); 
                 
                //   dd($roleid);

                  $rid=$roleid->role_id;
                
                //  $users = DB::table('users')->get();
                    
                    $roles = DB::table('roles')->where('id',$rid)->where('status',1)->first();  

                    
               
                $arr1=$roles->permissionid;

                $arr = json_decode($arr1, true);
          
if (in_array(0, $arr)) { ?>
    <li class="dropdown">
                    <a href="{{route('dashboard')}}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{route('doctor.index')}}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-user"></span><span class="mtext">Doctors Registration</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{route('doctor.approve')}}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-user"></span><span class="mtext">Doctors Approve </span>
                    </a>
                </li>
               <li class="dropdown">
                    <a href="{{route('package.medicine')}}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-user"></span><span class="mtext">Medicine</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{route('patient.index')}}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-user"></span><span class="mtext">Patient</span>
                    </a>
                </li>
@php } else { } if (in_array(1, $arr)) { @endphp
    <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-user"></span><span class="mtext">SleekCare Users</span>
                    </a>
                    @php $rdata = App\Models\Role::All(); @endphp
                    @if($rdata !='')
                    <ul class="submenu">
                        <li><a href="{{route('user.index')}}">All</a></li>
                        @foreach($rdata as $item)
							<li><a href="{{route('system_users.index',$item->id)}}">{{$item->name}}</a></li>
						@endforeach
					</ul>
					@else
					 <ul class="submenu">
							<li><a href="{{route('role.create')}}">Add SleekCare Role</a></li>
					</ul>
					@endif
                </li>
@php } else { } if (in_array(2, $arr)) { @endphp
    <li class="dropdown">
                    <a href="{{route('role.index')}}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-user"></span><span class="mtext">Role</span>
                    </a>
                </li>
@php } else { } if (in_array(3, $arr)) { @endphp
    <li class="dropdown">
                    <a href="{{route('package.index')}}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-library"></span><span class="mtext">Package</span>
                    </a>
                </li>

@php } else { } if (in_array(4, $arr)) { @endphp
    <li class="dropdown">
                    <a href="{{route('coupon.index')}}" class="dropdown-toggle no-arrow">
                        <span class="micon"><i class="icon-copy ion-pricetags"></i></span><span class="mtext">Coupon Code</span>
                    </a>
                </li>



@php } else { } }@endphp
                     
              
            </ul>
        </div>
    </div>
</div>

<div class="mobile-menu-overlay"></div>
