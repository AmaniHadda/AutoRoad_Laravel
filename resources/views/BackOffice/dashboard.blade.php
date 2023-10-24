@extends('BackOffice.home')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Welcome, Admin Autoroad!🎉</h5>
                  <p class="mb-4">
                     You possess full access and privileges.
                  </p>

                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../assets/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/chart-success.png"
                        alt="chart success"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Utilisateurs</span>
                  <h3 class="card-title mb-2">{{$users}}</h3>
                 
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/wallet-info.png"
                        alt="Credit Card"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt6"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                      </div>
                    </div>
                  </div>
                  <span>Blogs</span>
                  <h3 class="card-title text-nowrap mb-3">{{$blogs}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

      {{-- contacts chart --}}
      <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card" style="height: 330px">
          <div class="row row-bordered g-0">
            <div class="col-md-8  chart-container">
              <div class="fw-semibold m-4"><h5>Contacts Created Per Day</h5></div>
              <canvas id="contactChart"></canvas>

            </div>
            <div class="col-md-4">
              <div class="card-body">
                <div class="text-center">
                  <h3>Total Contacts</h3>
                  <div class="total-contacts" id="totalContacts"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- end contacts chart --}}

        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
          <div class="row">
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt4"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                      </div>
                    </div>
                  </div>
                  <span class="d-block mb-1">Events</span>
                  <h3 class="card-title text-nowrap mb-2">{{$events}}</h3>
                </div>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt1"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="cardOpt1">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Reclamations</span>
                  <h3 class="card-title mb-2">{{$reclamations}}</h3>
                </div>
              </div>
            </div>
            <!-- </div>
<div class="row"> -->
            <div class="col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2">Number of vehicules</h5>
                        <span class="badge bg-label-warning rounded-pill">Year 2023</span>
                      </div>
                      <div class="mt-sm-auto">
                       
                        <h3 class="mb-0">{{$vehicules}}</h3>
                      </div>
                    </div>
                    <div id="profileReportChart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!--Contact Chart Scripts and styles-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .chart-container {
      position: relative;
    }

    .chart-container canvas {
      box-shadow: -5px 0 15px #9472f9b3;
    }

    .total-contacts {
      background-color: #c6b9f0;
      color: white;
      font-size: 24px;
      border-radius: 50%;
      width: 80px;
      height: 80px;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
      border: 5px solid #9472f9;
      box-shadow: 0 0 15px #9472f9b3;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var daysOfWeek = @json($daysOfWeek);
      var counts = @json($counts);
      var totalContacts = counts.reduce(function(a, b) {
          return a + b;
      }, 0);

      var ctx = document.getElementById('contactChart').getContext('2d');
      var contactChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: daysOfWeek,
              datasets: [{
                  label: 'Contacts Created Per Day',
                  data: counts,
                  backgroundColor: '#9472f9b3', // Light purple with alpha for transparency
                  borderColor: '#9472f9b3', // Border color for bars
                  borderWidth: 1, // Adjust the border width
                  borderRadius: 10, // Adjust the border radius for rounded bars
                  barThickness: 10, // Adjust the bar thickness to make them thinner
              }]
          },
          options: {
              scales: {
                  x: {
                      title: {
                          display: true,
                          text: 'Day of the Week'
                      }
                  },
                  y: {
                      title: {
                          display: true,
                          text: 'Number of Contacts'
                      }
                  }
              }
          }
      });

      // Display the total number of contacts in the col-md-4 section
      var totalContactsElement = document.getElementById('totalContacts');
      totalContactsElement.textContent = totalContacts;
    });
  </script>
 <!--End Contact Chart Scripts and styles-->
@endsection