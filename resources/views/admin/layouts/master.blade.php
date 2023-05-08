<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png')}}">
  <title>
    {{  env('APP_NAME') }}
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
        console.log(events);
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

<script>
document.getElementById('add-appointment-link').addEventListener('click', function() {
  $('#modal-form').modal('show');
});

document.getElementById('add-customer-link').addEventListener('click', function() {
  $('#modal-form1').modal('show');
});

document.getElementById('patient_docs').addEventListener('click', function() {
  $('#patient_docs').modal('show');
});
document.getElementById('sourceSelect').addEventListener('change', function() {
  var adsNameFieldWrapper = document.getElementById('adsNameFieldWrapper');
  var adsNameSelect = document.getElementById('adsNameSelect');
  
  if (this.value === 'Ads') {
    adsNameFieldWrapper.style.display = 'block';
    adsNameSelect.classList.add('form-control-sm');
  } else {
    adsNameFieldWrapper.style.display = 'none';
    adsNameSelect.classList.remove('form-control-sm');
  }
});

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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.1.1')}}"></script>


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


</body>

</html>