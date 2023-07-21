
@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">
  <div class="col-lg-12 mb-5">
    <div class="card p-3">
    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
    <span class="mask bg-gradient-dark"></span>
    <div class="card-body position-relative z-index-1 h-100 p-3">
     


    <h6 class="text-white font-weight-bolder mb-3">Hey {{ Auth::user()->name }} !</h6>
    <p class="text-white mb-3">Stay informed with important updates, alerts, and messages regarding your dashboard and its features.</p>
    </div>
    </div>
    </div>
    </div>
  <div class="row">
    <div class="col-xl-8 col-lg-7">
      @if (Auth::user()->role->name != 'Assistant' &&  Auth::user()->role->name != 'Doctor' &&  Auth::user()->role->name != 'Sales Agent' &&  Auth::user()->role->name != 'Front Officer')
      <div class="row">
        <div class="col-sm-4">
          <div class="card overflow-hidden">
            <div class="card-header p-3 pb-0">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Patients</p>
              <h5 class="font-weight-bolder mb-0">
                {{ staticsdata()[0]}}
                <span class="text-success text-sm font-weight-bolder">Current month</span>
              </h5>
            </div>
            <div class="card-body p-0">
              <div class="chart">
                <canvas id="chart-line-1" class="chart-canvas" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card overflow-hidden">
            <div class="card-header p-3 pb-0">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Income</p>
              <h5 class="font-weight-bolder mb-0">
                   {{ staticsdata()[1] }}
                <span class="text-success text-sm font-weight-bolder">Current month</span>
              </h5>
            </div>
            <div class="card-body p-0">
              <div class="chart">
                <canvas id="chart-line-2" class="chart-canvas" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card overflow-hidden">
            <div class="card-header p-3 pb-0">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Appoinments</p>
              <h5 class="font-weight-bolder mb-0">
                   {{ staticsdata()[2] }}
                <span class="text-success text-sm font-weight-bolder">Current month</span>
              </h5>
            </div>
            <div class="card-body p-0">
              <div class="chart">
                <canvas id="chart-line-3" class="chart-canvas" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
     @endif
    
    {{-- <!-- Update form -->
    <form id="update-form">
        <input type="text" id="user-id">
        <input type="text" id="user-name">
        <!-- Add other fields as needed -->
        <button type="submit">Update</button>
    </form> --}}
      @if (Auth::user()->role->name == 'Assistant' || Auth::user()->role->name == 'Doctor')
      <div class="row">
      @else
      <div class="row mt-3">
      @endif
    
      @if (Auth::user()->role->name != 'Sales Agent' && Auth::user()->role->name != 'Assistant' && Auth::user()->role->name != 'Doctor')
      <div class="col-sm-4 mt-sm-0 mt-4">
        <div class="card border h-100">
            <div class="card-body d-flex flex-column justify-content-center text-center">
              
              <a href="javascript:;" id="add-customer-link">
                <i class="fa fa-plus text-secondary text-sm mb-1" aria-hidden="true"></i>
                <h6 class="text-secondary">Quick add Customer</h6>
              </a>
            </div>
        </div>
      </div>

      <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card border h-100">
              <div class="card-body d-flex flex-column justify-content-center text-center">
                  <h6 class="text-secondary">Enter Customer ID Or Phone</h6>
                  <form id="search-form">
                      <div class="input-group">
                          <input type="text" id="search-input" class="form-control" placeholder="Type here...">
                          <div class="input-group-append">
                          <button type="submit" class="btn btn-primary search px-2 ms-2">Search</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      @endif
      @if (Auth::user()->role->name == 'Sales Agent')
      <div class="col-sm-4 mt-sm-0 mt-4 ">
        <div class="card border h-100 lead-card">
          <div class="card-body d-flex flex-column justify-content-center text-center">
            <a href="javascript:;" id="add-lead-link">
              <i class="fa fa-plus text-secondary text-sm mb-1" aria-hidden="true"></i>
              <h6 class="text-secondary">New Lead</h6>
            </a>
          </div>
        </div>
      </div>
      @endif
      @if ( Auth::user()->role->name != 'Assistant' && Auth::user()->role->name != 'Doctor')
      <div class="col-sm-4 mt-sm-0 mt-4 ">
        <div class="card border h-100 lead-card">
          <div class="card-body d-flex flex-column justify-content-center text-center">
            <a href="javascript:;" id="add-appointment-link">
              <i class="fa fa-plus text-secondary text-sm mb-1" aria-hidden="true"></i>
              <h6 class="text-secondary">New Appointment</h6> 
            </a>
          </div>
        </div>
      </div>
      @endif
      @if ( Auth::user()->role->name == 'Sales Agent')
      <div class="col-sm-4 mt-sm-0 mt-4 ">
        <div class="card border h-100 lead-card">
          <div class="card-body d-flex flex-column justify-content-center text-center">
            <a href="javascript:;" id="add_day_summery">
              <i class="fa fa-plus text-secondary text-sm mb-1" aria-hidden="true"></i>
              <h6 class="text-secondary">Day Summary</h6>
            </a>
          </div>
        </div>
      </div>
      @endif
      @if ( Auth::user()->role->name == 'Assistant' || Auth::user()->role->name == 'Doctor')

        <div class="col-sm-12 mt-sm-0 mt-12">
            <div class="card border h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <h6 class="text-secondary">Enter Appointment ID</h6>
                    <form id="search-form-feed-data">
                        <div class="input-group">
                            <input type="text" id="search-input-feed-data" class="form-control" placeholder="Type here...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      @endif
        </div>


      
      
      <div class="row mt-4">
        <div class="col-12">
          <div class="card widget-calendar h-100">
            <!-- Card header -->
            <div class="card-header p-3 pb-0">
              <h6 class="mb-0">Calendar</h6>
              <div class="d-flex">
                <div class="p text-sm font-weight-bold mb-0 widget-calendar-day"></div>
                <span>,&nbsp;</span>
                <div class="p text-sm font-weight-bold mb-1 widget-calendar-year"></div>
              </div>
            </div>
            <!-- Card body -->
            <div class="card-body p-3">
              <div data-toggle="widget-calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-5 mt-lg-0 mt-4">
      <div class="row">
        @if (Auth::user()->role->name == 'Assistant' || Auth::user()->role->name == 'Doctor')
        
        <div class="col-lg-12 col-sm-6">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">To Day Patient</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                @php
                  if(Auth::user()->role->name == 'Doctor'){
                    $role = 'doctor_id';
                    $todayAppoinments = todayAppoinment($role,Auth::user()->id);
                  }else{
                    $role = 'assistant';
                    $todayAppoinments = todayAppoinment($role,Auth::user()->id);
                  }
                @endphp
              
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  
                   
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>App No</th>
                            <th>Customer</th>
                            <th>Treatment</th>
                          </tr>
                        </thead>
                        <tbody style="text-align: center;">
                          @foreach ( $todayAppoinments as $todayAppoinment)
                          <tr>
                            <td><h6 class="mb-1 text-dark text-sm me-3">{{ $todayAppoinment->appoinment_id }}</h6></td>
                            <td><h6 class="mb-1 text-dark text-sm me-3">{{ $todayAppoinment->customer_id }}</h6></td>
                            <td><h6 class="mb-1 text-dark text-sm">{{ $todayAppoinment->treatment }}</h6></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    
                  
                  
                </li>
               
              </ul>
            </div>
          </div>
        </div>
        
        @elseif (Auth::user()->role->name == 'Sales Agent' || Auth::user()->role->name == 'Admin')
        @php
          $top_margin ;
          if (Auth::user()->role->name == 'Sales Agent') {
            $top_margin = 'mt-5';
          } else {
            $top_margin = '';
          }
          
        @endphp 

       
        @if (Auth::user()->role->name == 'Sales Agent' )
           <div class="col-lg-12 col-sm-6">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Day Summary</h6>
            </div>
            <div class="card-body p-3">
              <form id="save-form" method="POST" action="{{ route('save_day_summary') }}">
                @csrf
            
                <div class="form-row align-items-center">
                  <div class="col-auto">
                    <label for="whatsapp_chat">WhatsApp Chat:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="form-control" id="whatsapp_chat" name="whatsapp_chat">
                  </div>
                </div>
            
                <div class="form-row align-items-center">
                  <div class="col-auto">
                    <label for="whatsapp_call">WhatsApp Call:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="form-control" id="whatsapp_call" name="whatsapp_call">
                  </div>
                </div>
            
                <div class="form-row align-items-center">
                  <div class="col-auto">
                    <label for="messenger_chat">Messenger Chat:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="form-control" id="messenger_chat" name="messenger_chat">
                  </div>
                </div>
            
                <div class="form-row align-items-center">
                  <div class="col-auto">
                    <label for="direct_call">Direct Call:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="form-control" id="direct_call" name="direct_call">
                  </div>
                </div>
            
                <div class="form-row align-items-center">
                  <div class="col-auto">
                    <label for="adsName">Ads Name:</label>
                  </div>
                  <div class="col-auto">
                    <select class="form-control" id="adsName" name="adsName">
                      @foreach (campaingFind() as $campaign)
                        <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
            
                <hr class="horizontal dark mt-0">
                <button type="submit" class="btn btn-primary" style="width: 100%;background-color: #82d616;">Save</button>
              </form>
            </div>
            
          </div>
        </div>
        @endif
       

        <div class="col-lg-12 col-sm-6 {{ $top_margin }}">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Day Summary</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                @php
                 $todaysummaries = todaysummary(Auth::user()->id);
                @endphp
              
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  
                   
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Agent Name</th>
                            <th>Whats app call</th>
                            <th>Whats app Chat</th>
                            <th>Messenger Chat</th>
                            <th>Direct Call</th>
                          </tr>
                        </thead>
                        <tbody style="text-align: center;">
                          @foreach ( $todaysummaries as  $todaysummary)
                          <tr>
                            
                            <td><h6 class="mb-1 text-dark text-sm me-3">{{ findSalesAgent($todaysummary->sale_agent_id)->name }}</h6></td>
                            <td><h6 class="mb-1 text-dark text-sm me-3">{{ $todaysummary->whatsapp_call }}</h6></td>
                            <td><h6 class="mb-1 text-dark text-sm">{{ $todaysummary->whatsapp_chat }}</h6></td>
                            <td><h6 class="mb-1 text-dark text-sm">{{ $todaysummary->messenger_chat }}</h6></td>
                            <td><h6 class="mb-1 text-dark text-sm">{{ $todaysummary->direct_call }}</h6></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    
                  
                  
                </li>
               
              </ul>
            </div>
          </div>
        </div>
        @else
        <div class="col-lg-12 col-sm-6">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Today Patients</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">

                @foreach ( todayAppoinmentfront() as $todayappoinmentfronts)
                  <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                 
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">{{ $todayappoinmentfronts->appointment_id }}</h6>
                   
                      <span class="text-xs">Time :<span class="font-weight-bold">{{ $todayappoinmentfronts->time_in_ampm }}</span></span>
                      <span class="text-xs">Patient :<span class="font-weight-bold">{{ $todayappoinmentfronts->customer_name }}</span></span>
                      <span class="text-xs">Doctor : <span class="font-weight-bold">{{ userdata($todayappoinmentfronts->doctor_id)->name }}</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                @endforeach
                
              </ul>
            </div>
          </div>
        </div>

       
        @endif
        

@if (Auth::user()->role->name == 'Admin')
{{-- <div class="col-lg-12 col-sm-6">
  <div class="card mt-4">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-4">
          <img src="../../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow w-100">
        </div>
        <div class="col-8 my-auto">
          <p class="text-muted text-sm font-weight-bold">
            Today is Martina's birthday. Wish her the best of luck!
          </p>
          <a href="javascript:;" class="btn btn-sm bg-gradient-dark mb-0">Send message</a>
        </div>
      </div>
    </div>
  </div>
</div> --}}
@endif


      </div>
    </div>
  </div>


</div>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card card-plain">
          <div class="card-header pb-0 text-left">
          
            <h3 class="font-weight-bolder text-info text-gradient">Add Appointment</h3>
            
          </div>
          <div class="card-body">
            <form role="form text-left" action="{{ route('add_appointment') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <label for="name">Name</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-label="Name" aria-describedby="name-addon" required>
              </div>
              
              <label for="phone">Phone Number</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" aria-label="Phone" aria-describedby="phone-addon" required>
              </div>
              
              <label for="address">Address</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" aria-label="Address" aria-describedby="email-addon">
              </div>
              
              <label for="treatments">Treatments</label>
              <div class="input-group mb-3">
                <select class="form-control" id="treatments" name="treatments" multiple required>
                  @foreach (allTreatments() as $treatment)
                     <option value="{{ $treatment->treatment_name }}">{{ $treatment->treatment_name }}</option>
                  @endforeach
                </select>
              </div>

              <label for="treatments">Doctors</label>
              <div class="input-group mb-3">
              <select class="form-control" id="doctors" name="doctors">
                <!-- Doctors options will be populated dynamically -->
             </select>
            </div>
              <label for="source">Source</label>
              <div class="input-group mb-3">
                <select class="form-control sourceSelect" id="sourceSelect" name="source" required>
                  @if (Auth::user()->role_id == 5)
                    <option>Ads</option>
                    <option>Direct</option>
                    <option>Personal</option>
                    <option>Referral</option>
                  @else
                      <option>Front Office</option>
                  @endif
                  
                </select>
              </div>
            
              

              <div id="adsNameFieldWrapper" class="mb-3 adsNameFieldWrapper">
                <label for="adsName">Ads Name</label>
                <div class="input-group">
                  <select class="form-control adsName" id="adsName" name="adsName" >
                    @foreach ( campaingFind() as $campain)
                           <option value="{{ $campain->id  }}">{{ $campain->name }}</option>
                    @endforeach
                  </select>
                </div>
              
                <div id="imageContainer" class="mt-3">
                <img class="relatedImage" src="" alt="Related Image" style="max-width: 200px; max-height: 200px;">
              </div>
            </div>
              
              
              <label for="appointmentDateTime">Appointment Date & Time</label>
              <div class="input-group mb-3">
                <input class="form-control" type="datetime-local" id="appointmentDateTime" name="appointmentDateTime"  required>
              </div>
              
              <label for="note">Note</label>
              <div class="input-group mb-3">
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
              </div>
              
              <div class="text-center">
                <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Add Appointment</button>
              </div>
            </form>
            
          </div>
        
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-form1" tabindex="-1" role="dialog" aria-labelledby="modal-form1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card card-plain">
          <div class="card-header pb-0 text-left">
            <h3 class="font-weight-bolder text-info text-gradient">Add Customer</h3>
            
          </div>
          <div class="card-body">
            <form role="form text-left" action="{{ route('add_appointment') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <label for="name">Name</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-label="Name" aria-describedby="name-addon" required>
              </div>
              
              <label for="phone">Phone Number</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" aria-label="Phone" aria-describedby="phone-addon" required>
              </div>
              
              <label for="address">Address</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" aria-label="Address" aria-describedby="email-addon">
              </div>
              
              <label for="treatments">Treatments</label>
              <div class="input-group mb-3">
                
                 <select class="form-control" id="treatment" name="treatments" multiple required>
                  @foreach (allTreatments() as $treatment)
                  <option value="{{ $treatment->treatment_name }}">{{ $treatment->treatment_name }}</option>
                  @endforeach
                </select>
              </div>
              <label for="treatments">Doctors</label>
              <div class="input-group mb-3">
              <select class="form-control" id="doctor" name="doctors">
                <!-- Doctors options will be populated dynamically -->
             </select>
              </div>

              <label for="appointmentDateTime">Appointment Date & Time</label>
              <div class="input-group mb-3">
                <input class="form-control" type="datetime-local" id="appointmentDateTime" name="appointmentDateTime"  required>
              </div>
              
              <label for="note">Note</label>
              <div class="input-group mb-3">
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
              </div>
              
              <hr class="horizontal dark mt-0">
                    <h6>Payment</h6>
                    <div class="form-group">
                      <label for="modal-name">Payment method:</label>
                      <select class="form-control" id="paymentMethod" name="paymentMethod">
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="modal-name">Amount:</label>
                      <input type="text" class="form-control" name="amount">
                    </div>
                    <input type="hidden" name="source" value="Front Office">
              <div class="text-center">
                <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Pay</button>
              </div>
            </form>
            
          </div>
        
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="new-lead" tabindex="-1" role="dialog" aria-labelledby="new-lead" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card card-plain">
          <div class="card-header pb-0 text-left">
          
            <h3 class="font-weight-bolder text-info text-gradient">New Lead</h3>
            
          </div>
          <div class="card-body">
            <form role="form text-left" action="{{ route('lead.create') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <label for="name">Name</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-label="Name" aria-describedby="name-addon" required>
              </div>
              
              <label for="phone">Phone Number</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" aria-label="Phone" aria-describedby="phone-addon" required>
              </div>
              
              <label for="address">Address</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" aria-label="Address" aria-describedby="email-addon">
              </div>
              
              <label for="treatments">Treatments</label>
              <div class="input-group mb-3">
                <select class="form-control treatments" id="treatment" name="treatments" multiple required>
                  @foreach (allTreatments() as $treatment)
                     <option value="{{ $treatment->treatment_name }}">{{ $treatment->treatment_name }}</option>
                  @endforeach
                </select>
              </div>

              <label for="treatments">Doctors</label>
              <div class="input-group mb-3">
              <select class="form-control" id="doctors" name="doctors">
                <!-- Doctors options will be populated dynamically -->
             </select>
            </div>
            <label for="source">Source</label>
            <div class="input-group mb-3">
              <select class="form-control sourceSelect" id="sourceSelect" name="source" required>
                @if (Auth::user()->role_id == 5)
                  <option>Ads</option>
                  <option>Direct</option>
                  <option>Personal</option>
                  <option>Referral</option>
                @else
                    <option>Front Office</option>
                @endif
                
              </select>
            </div>
          
            

            <div id="adsNameFieldWrapper" class="mb-3 adsNameFieldWrapper">
              <label for="adsName">Ads Name</label>
              <div class="input-group">
                <select class="form-control adsName" id="adsName" name="adsName" >
                  @foreach ( campaingFind() as $campain)
                         <option value="{{ $campain->id  }}">{{ $campain->name }}</option>
                  @endforeach
                </select>
              </div>
            
            <div id="imageContainer" class="mt-3">
              <img class="relatedImage" src="" alt="Related Image" style="max-width: 200px; max-height: 200px;">
            </div>
          </div>
              
              <label for="appointmentDateTime">Appointment Date & Time</label>
              <div class="input-group mb-3">
                <input class="form-control" type="datetime-local" id="appointmentDateTime" name="appointmentDateTime"  required>
              </div>
              
              <label for="note">Note</label>
              <div class="input-group mb-3">
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
              </div>
              
              <div class="text-center">
                <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Add Lead</button>
              </div>
            </form>
            
          </div>
        
        </div>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">User Details and Pay</h5>
              
          </div>
          <div class="modal-body">
              <form id="update-user-form" method="POST" action="{{ route('invoice.create') }}" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                      <label for="modal-id">Appointment ID:</label>
                      <input type="text" class="form-control" id="modal-appid" name="appoinment_id" readonly>
                      <input type="hidden"  id="modal-id" name="customer_id">
                  </div>
                  <div class="form-group">
                      <label for="modal-name">Name:</label>
                      <input type="text" class="form-control" name='name' id="modal-name">
                  </div>
                  <div class="form-group">
                    <label for="modal-name">Phone:</label>
                    <input type="text" class="form-control" name="phone"  id="modal-phone">
                  </div>
                  <div class="form-group">
                    <label for="modal-name">Treatment:</label>
                    <input type="text" class="form-control" id="modal-treatment" name="treatment">
                    
                  </div>
                  <hr class="horizontal dark mt-0">
                  <h6>Assign Assistant</h6>
                  <div class="form-group">
                    <label for="modal-name">Assistant:</label>
                    <select class="form-control" id="assistant" name="assistant">
                      @foreach ( allAssistant() as $allAssistant)
                        
                      @endforeach
                      <option value="{{ $allAssistant->id }}">{{ $allAssistant->name }}</option>
                    </select>
                  </div>
                  
                  <hr class="horizontal dark mt-0">
                  <h6>Payment</h6>
                  <div class="form-group">
                    <label for="modal-name">Payment method:</label>
                    <select class="form-control" id="paymentMethod" name="paymentMethod">
                      <option value="Cash">Cash</option>
                      <option value="Card">Card</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="modal-name">Total:</label>
                    <input type="text" class="form-control" id="total" name="total">
                  </div>
                  <div class="form-group">
                    <label for="modal-name">Pay Amount:</label>
                    <input type="text" class="form-control" id="payamount" name="payamount">
                  </div>
                  <div class="form-group">
                    <label for="modal-name">Balance:</label>
                    <input type="text" class="form-control" name="balance" id="balance" readonly>
                  </div>
                  <!-- Add other data fields here -->
                  <button type="submit" class="btn btn-primary">Pay</button>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="patient_docs" tabindex="-1" role="dialog" aria-labelledby="patient_docs" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="patient_docs">Upload Documents</h5>
              
          </div>
          <div class="modal-body">
            <form id="myForm" action="{{ route('treatment.patient_docs') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- Add the initial upload and dropdown fields here -->
              <div class="form-group">
                <input type="hidden" name="appoinment_id" id='appoinment_id'>
                <input type="file" name="upload[]" class="form-control" accept="image/*" capture="camera">
                <select name="dropdown[]" class="form-control">
                  <option value="Photo">Photo</option>
                  <option value="Prescription">Prescription</option>
                  <option value="Other Docs">Other Docs</option>
                  <option value="Reports">Reports</option>
                </select>
              </div>
            
              <div id="dynamicFieldsContainer">
                <!-- Duplicate fields will be added here -->
              </div>
            
              <!-- Plus icon or button to add more fields -->
              <button type="button" id="addFieldsButton" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Fields
              </button>

              <div class="form-group">
                <label for="modal-name">Next Appoinment Date:</label>
                <input class="form-control" type="datetime-local" id="appointmentDateTime" name="appointmentDateTime" >
            </div>
              <!-- Submit button to save all the fields -->
              <button type="submit" class="btn btn-success">Save</button>
            </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<div id="day_summery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="day_summery" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Day Summary</h5>
     
      </div>
      <div class="modal-body">
        <form id="save-form" method="POST" action="{{ route('save_day_summary') }}">
          @csrf
      
          <div class="form-row align-items-center">
            <div class="col-auto">
              <label for="whatsapp_chat">WhatsApp Chat:</label>
            </div>
            <div class="col-auto">
              <input type="text" class="form-control" id="whatsapp_chat" name="whatsapp_chat">
            </div>
          </div>
      
          <div class="form-row align-items-center">
            <div class="col-auto">
              <label for="whatsapp_call">WhatsApp Call:</label>
            </div>
            <div class="col-auto">
              <input type="text" class="form-control" id="whatsapp_call" name="whatsapp_call">
            </div>
          </div>
      
          <div class="form-row align-items-center">
            <div class="col-auto">
              <label for="messenger_chat">Messenger Chat:</label>
            </div>
            <div class="col-auto">
              <input type="text" class="form-control" id="messenger_chat" name="messenger_chat">
            </div>
          </div>
      
          <div class="form-row align-items-center">
            <div class="col-auto">
              <label for="direct_call">Direct Call:</label>
            </div>
            <div class="col-auto">
              <input type="text" class="form-control" id="direct_call" name="direct_call">
            </div>
          </div>
      
          <div class="form-row align-items-center">
            <div class="col-auto">
              <label for="adsName">Ads Name:</label>
            </div>
            <div class="col-auto">
              <select class="form-control" id="adsName" name="adsName">
                @foreach (campaingFind() as $campaign)
                  <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
      
          <hr class="horizontal dark mt-0">
          <button type="submit" class="btn btn-primary" style="width: 100%;background-color: #82d616;">Save</button>
        </form>
      </div>      
    </div>
  </div>
</div>



</div>

@php

use Carbon\Carbon;

   // Prepare the data for the chart
    $customerlabels = [];
    $customerdata = [];

    $paymentlabels = [];
    $paymentdata = [];

    $appointmentlabels = [];
    $appointmentdata = [];

    $currentYear = Carbon::now()->year;
    foreach ( getCustomerCountByMonth() as $customerCount) {
        $customerlabels[] = Carbon::createFromDate($customerCount->year, $customerCount->month)->format('M');
        $customerdata[] = $customerCount->count;
    }


    foreach ( getpayments() as $dataPoint) {
    
            $paymentlabels[] = Carbon::createFromDate($currentYear, $dataPoint->month)->format('M');
            $paymentdata[] = $dataPoint->total_pay_amount;
    }

    foreach ( getappointment() as $dataPoint) {
    
            $appointmentlabels[] = Carbon::createFromDate($currentYear, $dataPoint->month)->format('M');
            $appointmentdata[] = $dataPoint->count;
    }
    // Return the data to the view
   

@endphp

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
     $('#treatment').change(function() {
        var selectedTreatments = $(this).val(); // Get the selected treatment values
  
        // Send AJAX request to retrieve related doctors
        $.ajax({
           url: '/getdoctors',
           type: 'GET',
           data: { treatments: selectedTreatments },
           success: function(response) {
              // Handle the response and populate the doctors select element
              var doctorsSelect = $('#doctors');
              doctorsSelect.empty();
  
              $.each(response.doctors, function(key, doctor) {
                 doctorsSelect.append($('<option></option>').val(doctor.id).text(doctor.name));
              });
           },
           error: function(xhr) {
              // Handle error
              console.log(xhr.responseText);
           }
        });
     });
  });
</script>


<script>
    
  var ctx1 = document.getElementById("chart-line-1").getContext("2d");

  var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.02)');
  gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

  var ctx2 = document.getElementById("chart-line-2").getContext("2d");
  var ctx3 = document.getElementById("chart-line-3").getContext("2d");
  new Chart(ctx1, {
    type: "line",
    data: {
      labels: @json($customerlabels),
      datasets: [{
        label: "Patients",
        tension: 0.5,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#cb0c9f",
        borderWidth: 2,
        backgroundColor: gradientStroke1,
        data: @json($customerdata),
        maxBarThickness: 6,
        fill: true
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#9ca2b7'
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#9ca2b7'
          }
        },
      },
    },
  });

  new Chart(ctx2, {
    type: "line",
    data: {
      labels: @json($paymentlabels),
      datasets: [{
        label: "Income",
        tension: 0.5,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#cb0c9f",
        borderWidth: 2,
        backgroundColor: gradientStroke1,
        data: @json($paymentdata),
        maxBarThickness: 6,
        fill: true
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            callback: function(value, index, values) {
              return index ;
            },
            display: true,
            padding: 10,
            color: '#9ca2b7'
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#9ca2b7'
          }
        },
      },
    },
  });

  new Chart(ctx3, {
    type: "line",
    data: {
      labels: @json($appointmentlabels),
      datasets: [{
        label: "Income",
        tension: 0.5,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#cb0c9f",
        borderWidth: 2,
        backgroundColor: gradientStroke1,
        data: @json($appointmentdata),
        maxBarThickness: 6,
        fill: true
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            callback: function(value, index, values) {
              return index;
            },
            display: true,
            padding: 10,
            color: '#9ca2b7'
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#9ca2b7'
          }
        },
      },
    },
  });
</script>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<script>
if (document.querySelector('[data-toggle="widget-calendar"]')) {
var calendarEl = document.querySelector('[data-toggle="widget-calendar"]');
var today = new Date();
var mYear = today.getFullYear();
var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var mDay = weekday[today.getDay()];

var m = today.getMonth();
var d = today.getDate();
document.getElementsByClassName('widget-calendar-year')[0].innerHTML = mYear;
document.getElementsByClassName('widget-calendar-day')[0].innerHTML = mDay;

// Retrieve events from Laravel backend using AJAX
$.ajax({
  url: '/followups', // Replace with your Laravel route URL that fetches the events
  type: 'GET',
  success: function(events) {

    // Map the Laravel events to FullCalendar events format
    var mappedEvents = events.map(function(event) {
      
      var userId = {{ Auth::user()->id }};
    const dateObj = new Date(event.appointment_date_time);

// Get the hours and minutes from the Date object
const hours = dateObj.getHours();
const minutes = dateObj.getMinutes();

// Determine the meridiem (am/pm)
const meridiem = hours >= 12 ? "PM" : "AM";

// Convert hours to 12-hour format
const formattedHours = hours % 12 || 12;

// Format the time as "hh:mm am/pm"
const formattedTime = `${formatTwoDigits(formattedHours)}:${formatTwoDigits(minutes)} ${meridiem}`;

// Helper function to add leading zero for single-digit numbers
function formatTwoDigits(num) {
  return num.toString().padStart(2, "0");
}

  return {
    title: event.treatment,
    customername: event.customer_name,
    customerphone: event.customer_phone,
    doctorname: event.name,
    time: formattedTime,
start: event.appointment_date_time,
className: userId === event.agent_id && event.status === 'converted' ||  event.agent_id === '' && event.status === 'converted'  ? 'bg-gradient-success' : (userId === event.agent_id && event.status === 'missed' || userId != event.agent_id && event.status === 'missed' ? 'bg-gradient-danger' : userId === event.agent_id ? 'bg-gradient-info' : 'bg-gradient-warning')

};
    });
    
    // Initialize FullCalendar with the fetched events
    var calendar = new FullCalendar.Calendar(calendarEl, {
          contentHeight: 'auto',
          initialView: 'dayGridMonth',
          selectable: true,
          initialDate: new Date(),
          editable: true,
          headerToolbar: {
              left: 'prev,next',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          events: mappedEvents,
          eventContent: function(arg) {
            
              return {
            html: '<div class="fc-event-title fc-sticky">' + arg.event.title + '</div> <div class=extra_data><ul><li> ' + arg.event.extendedProps.customername + '</li><li> ' + arg.event.extendedProps.customerphone + '</li><li> ' + arg.event.extendedProps.doctorname + '</li><li> ' + arg.event.extendedProps.time + '</li></ul></div>'

             
              };
          }
          });
          calendar.render();


  },
  error: function() {
    alert('Error fetching events');
  }
});
}

</script>

@if (Auth::user()->role_id != 5 )
<script>
document.getElementById('add-customer-link').addEventListener('click', function() {
$('#modal-form1').modal('show');
});
</script>
@endif

<script>
document.getElementById('add-appointment-link').addEventListener('click', function() {
$('#modal-form').modal('show');
});




document.getElementById('add-lead-link').addEventListener('click', function() {
$('#new-lead').modal('show');
});

document.getElementById('patient_docs').addEventListener('click', function() {
$('#patient_docs').modal('show');
});

document.getElementById('add_day_summery').addEventListener('click', function() {
$('#day_summery').modal('show');
});




// AJAX call to get the selected option value


</script> 

<script>
// Attach event handler to the plus button
document.getElementById('addFieldsButton').addEventListener('click', function() {
var container = document.getElementById('dynamicFieldsContainer');

// Check if the container has any child elements
if (container.firstElementChild) {
  var clonedFields = container.firstElementChild.cloneNode(true);
  container.appendChild(clonedFields);
} else {
  // If there are no existing fields, create the first set of fields manually or using a template
  var initialFields = createInitialFields();
  container.appendChild(initialFields);
}
});

function createInitialFields() {
// Create and return the HTML elements for the initial set of fields
var fieldsContainer = document.createElement('div');
fieldsContainer.classList.add('form-group');

var uploadInput = document.createElement('input');
uploadInput.type = 'file';
uploadInput.name = 'upload[]';
uploadInput.accept = 'image/*';
uploadInput.capture = 'camera';
uploadInput.classList.add('form-control');

var dropdownSelect = document.createElement('select');
dropdownSelect.name = 'dropdown[]';
dropdownSelect.classList.add('form-control');

var option1 = document.createElement('option');
option1.value = 'Photo';
option1.textContent = 'Photo';

var option2 = document.createElement('option');
option2.value = 'Prescription';
option2.textContent = 'Prescription';

var option3 = document.createElement('option');
option3.value = 'Other Docs';
option3.textContent = 'Other Docs';

var option4 = document.createElement('option');
option3.value = 'Reports';
option3.textContent = 'Reports';

dropdownSelect.appendChild(option1);
dropdownSelect.appendChild(option2);
dropdownSelect.appendChild(option3);
dropdownSelect.appendChild(option4);

fieldsContainer.appendChild(uploadInput);
fieldsContainer.appendChild(dropdownSelect);

return fieldsContainer;
}
</script>



<script>
$(document).ready(function() {
  // Search operation
  $('#search-form').on('submit', function(event) {
      event.preventDefault();
      var query = $('#search-input').val();

      $.ajax({
          url: '/appointments/search',
          type: 'GET',
          data: { query: query },
          success: function(response) {

              console.log(response);
              // Handle the success response
              if (response.id) {
                  // Open the Bootstrap modal and pass the data
                  openModal(response);
              }
          },
          error: function(error) {
              // Handle the error response
              console.log(error);
          }
      });
  });

  // Update operation
  $('#update-form').on('submit', function(event) {
      event.preventDefault();
      var id = $('#user-id').val();
      var name = $('#user-name').val();
      // Add other fields as needed

      $.ajax({
          url: '/appointments/' + id,
          type: 'PUT',
          data: { name: name },
          success: function(response) {
              // Handle the success response
              console.log(response);

              // Open the Bootstrap modal and pass the data
              openModal(response);
          },
          error: function(error) {
              // Handle the error response
              console.log(error);
          }
      });
  });

  // Function to open Bootstrap modal and pass data
      function openModal(data) {
      // Set the data in the form fields
      $('#modal-appid').val(data.appointment_id);
      $('#modal-id').val(data.customer_id);
      $('#modal-name').val(data.customer_name);
      $('#modal-phone').val(data.customer_phone);
      $('#modal-treatment').val(data.treatment);
      // Add other data fields as needed

      // Open the modal
      $('#myModal').modal('show');
  }
});


</script>

<script>
$(document).ready(function() {
   // Search operation
   $('#search-form-feed-data').on('submit', function(event) {
       event.preventDefault();
       var query = $('#search-input-feed-data').val();

       $.ajax({
           url: '/gettreatment/feed_data',
           type: 'GET',
           data: { query: query },
           success: function(response) {

               console.log(response);
               // Handle the success response
               if (response.id) {
                   // Open the Bootstrap modal and pass the data
                   openModal(response);
               }
           },
           error: function(error) {
               // Handle the error response
               console.log(error);
           }
       });
   });

   // Function to open Bootstrap modal and pass data
       function openModal(data) {
       // Set the data in the form fields
       
       // Add other data fields as needed
       $('#appoinment_id').val(data.appoinment_id);
       // Open the modal
       $('#patient_docs').modal('show');
   }
});


</script>


<script>
$(document).ready(function() {
   // Search operation
   $('#search-form1').on('submit', function(event) {
       event.preventDefault();
       var query = $('#search-input1').val();

       $.ajax({
           url: '/customer/search',
           type: 'GET',
           data: { query: query },
           success: function(response) {

               console.log(response);
               // Handle the success response
               if (response.id) {
                   // Open the Bootstrap modal and pass the data
                   openModal(response);
               }
           },
           error: function(error) {
               // Handle the error response
               console.log(error);
           }
       });
   });

   // Update operation
   $('#update-form1').on('submit', function(event) {
       event.preventDefault();
       var id = $('#user-id').val();
       var name = $('#user-name').val();
       // Add other fields as needed

       $.ajax({
           url: '/appointments/' + id,
           type: 'PUT',
           data: { name: name },
           success: function(response) {
               // Handle the success response
               console.log(response);

               // Open the Bootstrap modal and pass the data
               openModal(response);
           },
           error: function(error) {
               // Handle the error response
               console.log(error);
           }
       });
   });

   // Function to open Bootstrap modal and pass data
       function openModal(data) {
       // Set the data in the form fields
       $('#modal-id').val(data.id);
       $('#modal-id').val(data.customer_id);
       $('#modal-name').val(data.name);
       $('#modal-phone').val(data.phone);
       $('#modal-treatment').val(data.treatment);
       // Add other data fields as needed

       // Open the modal
       $('#myModal1').modal('show');
   }
});

</script>

<script>
// Get the elements
const totalInput = document.getElementById('total');
const payAmountInput = document.getElementById('payamount');
const balanceInput = document.getElementById('balance');

// Add event listener for input change
payAmountInput.addEventListener('input', calculateBalance);

function calculateBalance() {
  const total = parseFloat(totalInput.value);
  const payAmount = parseFloat(payAmountInput.value);
  const balance = payAmount - total;

  // Set the balance value
  balanceInput.value = balance.toFixed(2); // Adjust the decimal places as needed
}
</script>



@endsection