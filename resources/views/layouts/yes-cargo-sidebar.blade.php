<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ url('/') }}" class="app-brand-link">
             
              <img src="{{ asset('/gen-img/Yes-Cargo-Logo.png') }}" style="width: 100%;">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item {{Request::is(['/','home']) ? 'active' : ''}}">
              <a href="{{ url('/home') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <!-- <div class="badge bg-label-primary rounded-pill ms-auto">3</div> -->
              </a>
            
            </li>
            <li class="menu-item {{Request::is(['clients','clients/*']) ? 'active' : ''}}">
              <a href="{{ url('clients') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-lock"></i>
                <div data-i18n="Clients">Clients</div>
              </a>
            </li>
           @can('branch-menu-access')
            <li class="menu-item {{Request::is(['branch','branch/*']) ? 'active open' : ''}}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
                <div data-i18n="Branch">Branch</div>
              </a>

              <ul class="menu-sub">
                @can('branch-create')
                <li class="menu-item {{Request::is(['branch/create']) ? 'active' : ''}}">
                  <a href="{{ url('branch/create') }}" class="menu-link">
                    <div data-i18n="New Branch">New Branch</div>
                  </a>
                </li>
                @endcan
                <li class="menu-item {{Request::is(['branch']) ? 'active' : ''}}">
                  <a href="{{ url('branch') }}" class="menu-link">
                    <div data-i18n="Branch List">Branch List</div>
                  </a>
                </li>
              </ul>
            </li>
           @endcan
           
           
            
           
            <li class="menu-item {{Request::is(['accounts','accounts/invoice', 'accounts/invoice/*', 'accounts/manifest', 'accounts/manifest/*', 'accounts/inventory', 'accounts/inventory/*','accounts/reports','accounts/reports/*']) ? 'active open' : ''}}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                <div data-i18n="Accounts">Accounts</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{Request::routeIs('invoice.*') ? 'active' : ''}}">
                  <a href="{{ route('invoice.index') }}" class="menu-link">
                    <div data-i18n="Invoice">Invoice</div>
                  </a>
                </li>
                <li class="menu-item {{Request::routeIs('manifest.*') ? 'active' : ''}}">
                  <a href="{{ url('accounts/manifest') }}" class="menu-link">
                    <div data-i18n="Manifest">Manifest</div>
                  </a>
                </li>
               
                <li class="menu-item {{Request::is(['accounts/inventory','accounts/inventory/*']) ? 'active' : ''}}">
                  <a href="{{ url('accounts/inventory') }} " class="menu-link">
                    <div data-i18n="Inventory">Inventory</div>
                  </a>
                </li>
                <li class="menu-item {{Request::is(['accounts/reports','accounts/reports/*']) ? 'active' : ''}}">
                  <a href="{{ url('accounts/reports') }}" class="menu-link">
                    <div data-i18n="Reports">Reports</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item {{Request::is(['cargo-master/shipments','cargo-master/shipments/*', 'cargo-master','cargo-master/return-box', 'cargo-master/return-box/*','cargo-master/track-shipment', 'cargo-master/track-shipment/*' ]) ? 'active open' : ''}}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                <div data-i18n="Cargo Master">Cargo Master</div>
              </a>

              <ul class="menu-sub">
                <!-- <li class="menu-item">
                  <a href="layouts-collapsed-menu.html" class="menu-link">
                    <div data-i18n="Loading">Loading</div>
                  </a>
                </li> -->
                <li class="menu-item {{Request::is(['cargo-master/return-box','accounts/return-box/*']) ? 'active' : ''}}">
                  <a href="{{ url('cargo-master/return-box') }}" class="menu-link">
                    <div data-i18n="Return Box">Return Box</div>
                  </a>
                </li>
                <li class="menu-item {{Request::is(['cargo-master/shipments','cargo-master/shipments/*']) ? 'active' : ''}}">
                  <a href="{{ url('cargo-master/shipments') }}" class="menu-link">
                    <div data-i18n="Shipments">Shipments</div>
                  </a>
                </li>
                <li class="menu-item {{Request::is(['cargo-master/track-shipment']) ? 'active' : ''}}">
                  <a href="{{ url('cargo-master/track-shipment') }}" class="menu-link">
                    <div data-i18n="Track Shipment">Track Shipment</div>
                  </a>
                </li>
                
              </ul>
            </li>
           
            @can('admin-settings-menu-access')
           
            <li class="menu-item {{Request::is(['admin-settings','users','users/*']) ? 'active open' : ''}}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                <div data-i18n="Admin Settings">Admin Settings</div>
              </a>

              <ul class="menu-sub {{Request::is(['users','users/*']) ? 'active' : ''}}">
                
                <li class="menu-item {{Request::is(['admin-settings']) ? 'active' : ''}}">
                  <a href="{{ url('admin-settings') }}" class="menu-link">
                    <div data-i18n="Shipment Charges">Shipment Charges</div>
                  </a>
                </li>
              </ul>
            @endcan
            @can('role-menu-access')
            <li class="menu-item {{Request::is(['categories','categories/*']) ? 'active' : ''}}">
              <a href="{{ url('categories') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Categories">Categories</div>
                <!-- <div class="badge bg-label-primary rounded-pill ms-auto">3</div> -->
              </a>
            
            </li>
            @endcan

          </ul>
        </aside>