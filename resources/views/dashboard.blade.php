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
      @if (Auth::user()->role->name != 'Assistant' && Auth::user()->role->name != 'Doctor')
      <div class="row">
        <div class="col-sm-4">
          <div class="card overflow-hidden">
            <div class="card-header p-3 pb-0">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Visitors</p>
              <h5 class="font-weight-bolder mb-0">
                5,927
                <span class="text-success text-sm font-weight-bolder">+55%</span>
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
                $130,832
                <span class="text-success text-sm font-weight-bolder">+90%</span>
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
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Income</p>
              <h5 class="font-weight-bolder mb-0">
                $130,832
                <span class="text-success text-sm font-weight-bolder">+90%</span>
              </h5>
            </div>
            <div class="card-body p-0">
              <div class="chart">
                <canvas id="chart-line-2" class="chart-canvas" height="100"></canvas>
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
                              <button type="submit" class="btn btn-primary search">Search</button>
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

        <div class="col-lg-12 col-sm-6 mt-5">
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
                          @foreach (  $todaysummaries as  $todaysummary)
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
              <h6 class="mb-0">Categories</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mt-1">
                        <title>spaceship</title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                              <g transform="translate(4.000000, 301.000000)">
                                <path d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                                <path d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                                <path d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z" opacity="0.598539807"></path>
                                <path d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z" opacity="0.598539807"></path>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Devices</h6>
                      <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mt-1">
                        <title>settings</title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                              <g transform="translate(304.000000, 151.000000)">
                                <polygon opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                <path d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                                <path d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                      <span class="text-xs">123 closed, <span class="font-weight-bold">15 open</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mt-1">
                        <title>box-3d-50</title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                              <g transform="translate(603.000000, 0.000000)">
                                <path d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z"></path>
                                <path d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                                <path d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                      <span class="text-xs">1 is active, <span class="font-weight-bold">40 closed</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

       
        @endif
        

@if (Auth::user()->role->name == 'Admin')
<div class="col-lg-12 col-sm-6">
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
</div>
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

<div class="modal fade" id="new-lead" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Add Lead</button>
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
                <select class="form-control" id="treatments" name="treatments" multiple required>
                  @foreach (allTreatments() as $treatment)
                  <option value="{{ $treatment->treatment_name }}">{{ $treatment->treatment_name }}</option>
                  @endforeach
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
@endsection

@section('scripts')
<script>
    
  var ctx1 = document.getElementById("chart-line-1").getContext("2d");

  var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.02)');
  gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

  var ctx2 = document.getElementById("chart-line-2").getContext("2d");

  new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Visitors",
        tension: 0.5,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#cb0c9f",
        borderWidth: 2,
        backgroundColor: gradientStroke1,
        data: [50, 45, 60, 60, 80, 65, 90, 80, 100],
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
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Income",
        tension: 0.5,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#cb0c9f",
        borderWidth: 2,
        backgroundColor: gradientStroke1,
        data: [60, 80, 75, 90, 67, 100, 90, 110, 120],
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
              return '$' + value;
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
      return {
title: event.treatment,
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
              html: '<div class="fc-event-title fc-sticky">' + arg.event.title + '</div>'
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