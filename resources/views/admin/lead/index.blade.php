@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4 px-0 px-md-4 px-lg-4">

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="data_table" class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone Number</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Treatment</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">convert</th>
              <!-- <th class="text-secondary opacity-7"></th> -->
            </tr>
          </thead>
          <tbody>

            @foreach ($leads as $lead)
            <tr>
              <td>
                <div class="d-flex px-2 py-1">

                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xs">{{ $lead->customer_name }}</h6>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{ $lead->customer_phone }}</p>
              </td>
              <td class="align-middle text-center text-sm">
                <p class="text-xs font-weight-bold mb-0">{{ $lead->treatment }}</p>
              </td>
              <td class="align-middle text-center text-sm">
                <p class="text-xs font-weight-bold mb-0">{{ $lead->note }}</p>
              </td>
              <td class="align-middle text-center text-sm">

                @if ($lead->status == 'converted')
                {{ "Can't Edit or Delete" }}
                @else
                <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <!-- Button trigger modal -->
                <form id="deleteForm{{ $lead->id }}" action="{{ route('lead.destroy', $lead->id) }}" method="POST" style="display: inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $lead->id }}">Delete</button>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="deleteConfirmationModal{{ $lead->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Lead</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete this lead?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm{{ $lead->id }}').submit()">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>

                @endif


              </td>
              <td class="align-middle text-center text-sm">
                @if ($lead->status == 'converted')
                {{ "It All Ready Convet in Appoinment" }}
                @else
                <a href="javascript:;" data-lead-id="{{ $lead->id }}" data-lead-name="{{ $lead->customer_name }}" data-lead-phone="{{ $lead->customer_phone }}" data-lead-address="{{ $lead->customer_address }}" data-lead-treatment="{{ $lead->treatment }}" data-lead-source="{{ $lead->source }}" data-lead-ads_name="{{ $lead->ads_name }}" class="text-secondary font-weight-bold text-xs convert-lead" data-toggle="tooltip" data-original-title="Edit user">
                  Convert to Appoinment
                </a>
                @endif

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <div class="mt-4">

  </div>
</div>

<div class="modal fade" id="new-lead-appoinment" tabindex="-1" role="dialog" aria-labelledby="new-lead-appoinment" aria-hidden="true">
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
                <input type="text" class="form-control" id="name" value="" name="name" placeholder="Name" aria-label="Name" aria-describedby="name-addon" required>
              </div>

              <label for="phone">Phone Number</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="phone" value="" name="phone" placeholder="Phone" aria-label="Phone" aria-describedby="phone-addon" required>
              </div>

              <label for="address">Address</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="address" value="" name="address" placeholder="Address" aria-label="Address" aria-describedby="email-addon">
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
                <input type="text" class="form-control" id="source" value="" name="source" placeholder="Source" aria-label="Source" aria-describedby="source-addon" readonly required>
              </div>



              <div id="adsNameFieldWrapper" class="mb-3">
                <label for="adsName">Ads Name</label>


                <div class="input-group">
                  <input type="text" class="form-control" id="adsName" value="" name="adsName" placeholder="adsName" aria-label="adsName" aria-describedby="adsName-addon" readonly required>
                </div>
              </div>
              <div id="imageContainer">
                <img id="relatedImage" src="" alt="Related Image">
              </div>

              <label for="appointmentDateTime">Appointment Date & Time</label>
              <div class="input-group mb-3">
                <input class="form-control" type="datetime-local" id="appointmentDateTime" name="appointmentDateTime" required>
              </div>

              <label for="note">Note</label>
              <div class="input-group mb-3">
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
              </div>
              <input type="hidden" id="leadID" value="" name="leadID" required>
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

@endsection

@section('scripts')


<script type="text/javascript">
  $('.convert-lead').click(function() {
    var leadID = $(this).data('lead-id');
    var name = $(this).data('lead-name');
    var phone = $(this).data('lead-phone');
    var address = $(this).data('lead-address');
    var treatment = $(this).data('lead-treatment');
    var doctor = $(this).data('lead-doctor');
    var source = $(this).data('lead-source');
    var ads_name = $(this).data('lead-ads_name');
    // Update the hidden input field value with the lead ID
    $('#leadID').val(leadID);
    $('#name').val(name);
    $('#phone').val(phone);
    $('#address').val(address);
    $('#source').val(source);
    $('#adsName').val(ads_name);
    $('#treatment').val(treatment);
    $('#doctor').val(doctor);

    $('#new-lead-appoinment').modal('show');
  });
</script>

@endsection