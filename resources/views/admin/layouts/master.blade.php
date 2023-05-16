<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/bloom-skin-clinic-logo.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('img/bloom-skin-clinic-logo.png')}}">
  <title>
    {{  'Bloom Skin Clinic' }}
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  
  <link href="{{ asset('css/nucleo-svg.css" rel="stylesheet')}}" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css?v=1.1.1')}}" rel="stylesheet" />
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
  
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">

    @include('admin.layouts.sidebar')

  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
        @include('admin.layouts.header')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
    <!-- Main content -->
        @include('sweetalert::alert')
        @yield('content')
    <!--End Main content -->
    </div>
    <!--Footer -->
         @include('admin.layouts.footer')
    <!--End Footer-->
        
  </main>




  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/core/popper.min.js')}}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{ asset('js/plugins/fullcalendar.min.js')}}"></script>
  <!-- Kanban scripts -->
  <script src="{{ asset('js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{ asset('js/plugins/jkanban/jkanban.js')}}"></script>
  <script src="{{ asset('js/plugins/chartjs.min.js')}}"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>
   <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
   <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.1.1')}}"></script>

  @yield('scripts')

{{-- get doctoter related treatment --}}
  <script>
    $(document).ready(function() {
       $('#treatments').change(function() {
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

</body>

</html>