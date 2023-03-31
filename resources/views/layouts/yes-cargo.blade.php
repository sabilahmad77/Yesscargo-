<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Yes Cargo - @yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/fonts/fontawesome.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/fonts/tabler-icons.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/fonts/flag-icons.css ') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/css/rtl/core.css ') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/css/rtl/theme-default.css ') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('public/assets/css/demo.css ') }}" />

    <!-- Vendors CSS -->
    {{--<link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/node-waves/node-waves.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/typeahead-js/typeahead.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/apex-charts/apex-charts.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/swiper/swiper.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css ') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css ') }}" />--}}
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
    
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/css/pages/cards-advance.css ') }}" />
    <!-- Helpers -->
   
    @yield('css')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('layouts.yes-cargo-sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="ti ti-menu-2 ti-sm"></i>
                </a>
              </div>

              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                  <div class="nav-item navbar-search-wrapper mb-0">
                    <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                      <i class="ti ti-search ti-md me-2"></i>
                      <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                    </a>
                  </div>
                </div>
                <!-- /Search -->

                <ul class="navbar-nav flex-row align-items-center ms-auto">

                  <!-- Style Switcher -->
                  <li class="nav-item me-2 me-xl-0">
                    <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                      <i class="ti ti-md"></i>
                    </a>
                  </li>
                  
                  <!-- User -->
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('public/assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle" />
                      </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="{{ url('users/'.Auth::user()->id) }}">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar avatar-online">
                                <img src="{{ asset('public/assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                              <small class="text-muted">{{ Auth::user()->roles->pluck('name')[0] ?? '' }}</small>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="{{ url('users/'.Auth::user()->id) }}">
                          <i class="ti ti-user-check me-2 ti-sm"></i>
                          <span class="align-middle">My Profile</span>
                        </a>
                      </li>
                      
                      <li>
                        <a class="dropdown-item" href="{{ url('users/account-settings/'.Auth::user()->id ) }}">
                          <i class="ti ti-settings me-2 ti-sm"></i>
                          <span class="align-middle">Settings</span>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <form action="{{ url('logout') }}" method="POST">
                          @csrf
                        <button class="dropdown-item" type="submit">
                          <i class="ti ti-logout me-2 ti-sm"></i>
                          <span class="align-middle">Log Out</span>
                        </button>
                        </form>
                      </li>
                    </ul>
                  </li>
                  <!--/ User -->
                </ul>
              </div>

              <!-- Search Small Screens -->
              <div class="navbar-search-wrapper search-input-wrapper d-none">
                <input
                  type="text"
                  class="form-control search-input container-xxl border-0"
                  placeholder="Search..."
                  aria-label="Search..."
                />
                <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
              </div>
            </nav>
            <div class="content-wrapper">
              <!-- Content -->
              <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
              </div>
            </div>
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column"
                >
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by <a href="https://yescargosaudi.in" target="_blank" class="fw-semibold">Yes Cargo</a>
                  </div>
                  <!-- <div>
                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>
                    <a href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
                    <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block" >Support</a>
                  </div> -->
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
   

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('public/assets/js/config.js ') }}"></script>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
     <script src="{{ asset('public/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
   <script src="{{ asset('public/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/js/bootstrap.js') }}"></script>
    {{--<script src="{{ asset('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/node-waves/node-waves.js') }}"></script>--}}

    {{--<script src="{{ asset('public/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>--}}

    <script src="{{ asset('public/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    {{--<script src="{{ asset('public/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>--}}

    <!-- Main JS -->
    <script src="{{ asset('public/assets/js/main.js ') }}"></script>

    <!-- Page JS -->
    {{--<script src="{{ asset('public/assets/js/dashboards-analytics.js') }}"></script>--}}
     <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    {{--<script>
      $(document).ready(function() {
          $('#example').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          } );
      } );
    </script>--}}
    @yield('script')
  </body>
</html>