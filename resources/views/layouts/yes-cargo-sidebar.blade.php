<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ url('/') }}" class="app-brand-link">
              <!-- <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                    fill="#7367F0"
                  />
                  <path
                    opacity="0.06"
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                    fill="#161616"
                  />
                  <path
                    opacity="0.06"
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                    fill="#161616"
                  />
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                    fill="#7367F0"
                  />
                </svg>
              </span> -->
              <!-- <span class="app-brand-text demo menu-text fw-bold">Vuexy</span> -->
              <img src="{{ asset('gen-img/Yes-Cargo-Logo.png') }}" style="width: 100%;">
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
              <!-- <ul class="menu-sub">
                <li class="menu-item active">
                  <a href="index.html" class="menu-link">
                    <div data-i18n="Analytics">Analytics</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="dashboards-crm.html" class="menu-link">
                    <div data-i18n="CRM">CRM</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="dashboards-ecommerce.html" class="menu-link">
                    <div data-i18n="eCommerce">eCommerce</div>
                  </a>
                </li>
              </ul> -->
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
                <li class="menu-item">
                  <a href="{{ url('branch') }}" class="menu-link">
                    <div data-i18n="Branch List">Branch List</div>
                  </a>
                </li>
              </ul>
            </li>
           @endcan
           
           
            
           
            <li class="menu-item {{Request::is(['accounts','accounts/invoice/*', 'accounts/manifest']) ? 'active open' : ''}}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                <div data-i18n="Accounts">Accounts</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{Request::is(['accounts/invoice/*']) ? 'active' : ''}}">
                  <a href="{{ url('accounts/invoice') }}" class="menu-link">
                    <div data-i18n="Invoice">Invoice</div>
                  </a>
                </li>
                <li class="menu-item {{Request::is(['accounts/manifest/*']) ? 'active' : ''}}">
                  <a href="{{ url('accounts/manifest') }}" class="menu-link">
                    <div data-i18n="Manifest">Manifest</div>
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="layouts-content-navbar.html" class="menu-link">
                    <div data-i18n="Packing List">Packing List</div>
                  </a>
                </li> -->
                <li class="menu-item">
                  <a href="{{ url('accounts/inventory') }} " class="menu-link">
                    <div data-i18n="Inventory">Inventory</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ url('accounts/reports') }}" class="menu-link">
                    <div data-i18n="Reports">Reports</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
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
                <li class="menu-item">
                  <a href="{{ url('cargo-master/return-box') }}" class="menu-link">
                    <div data-i18n="Return Box">Return Box</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ url('cargo-master/shipments') }}" class="menu-link">
                    <div data-i18n="Shipments">Shipments</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ url('cargo-master/track-shipment') }}" class="menu-link">
                    <div data-i18n="Track Shipment">Track Shipment</div>
                  </a>
                </li>
                
              </ul>
            </li>
            <!-- @can('admin-settings-menu-access')
            <li class="menu-item">
              <a href="{{ url('admin-settings') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-lock"></i>
                <div data-i18n="Admin Settings">Admin Settings</div>
              </a>
            </li>
            @endcan -->
            @can('admin-settings-menu-access')
            <!-- <li class="menu-item {{Request::is(['users','users/*']) ? 'active' : ''}}">
              <a href="{{ url('users') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="User Settings">User Settings</div>
              </a>
            </li> -->
            <li class="menu-item {{Request::is(['admin-settings','users','users/*']) ? 'active open' : ''}}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                <div data-i18n="Admin Settings">Admin Settings</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{Request::is(['users','users/*']) ? 'active' : ''}}">
                  <a href="{{ url('users') }}" class="menu-link">
                    <div data-i18n="Users">Users</div>
                  </a>
                </li>
                <li class="menu-item {{Request::is(['admin-settings']) ? 'active' : ''}}">
                  <a href="{{ url('admin-settings') }}" class="menu-link">
                    <div data-i18n="Shipment Charges">Shipment Charges</div>
                  </a>
                </li>
              </ul>
            @endcan
            @can('role-menu-access')
            <!-- <li class="menu-item {{Request::is(['roles','roles/*']) ? 'active' : ''}}">
              <a href="{{ url('roles') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                <div data-i18n="Role Settings">Role Settings</div>
              </a>
            </li> -->
            <!-- <li class="menu-item {{Request::is(['permissions/*','roles/*']) ? 'active open' : ''}}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Role & Permissions">Role & Permissions</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{Request::is(['roles','roles/*']) ? 'active' : ''}}">
                  <a href="{{ url('roles') }}" class="menu-link">
                    <div data-i18n="Role">Role</div>
                  </a>
                </li>
                <li class="menu-item {{Request::is(['permissions','permissions/*']) ? 'active' : ''}}">
                  <a href="{{ url('permissions') }}" class="menu-link">
                    <div data-i18n="Permissions">Permissions</div>
                  </a>
                </li>
              </ul>
            </li> -->
            @endcan

          </ul>
        </aside>