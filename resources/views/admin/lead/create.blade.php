@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">
    
      <div class="card">
        <div class="card-body">
            <form role="form text-left" action="{{ route('lead.store') }}" method="POST" enctype="multipart/form-data">
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

@endsection
