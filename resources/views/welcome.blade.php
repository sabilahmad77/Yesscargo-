@extends('layouts.yes-cargo')
@section('title','Dashboard')
@section('content')
    
  <div class="row">
  @can('admin-dashboard')
    <div class="col-lg-5 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Clients</h5>
            <small class="text-muted">Branch Wise Invoices & Clients</small>
          </div>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            @foreach($BranchWithClientsCount as $data)
            <li class="d-flex align-items-center mb-2">
            
              <div class="badge bg-label-info rounded p-2">
                <i class="tf-icons ti ti-layout-kanban"></i>
              </div>

              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                
                <div class="me-2" style="margin-left:4px;min-width:90px;">
                  <div class="d-flex align-items-center">
                    <h6 class="mb-0 me-1">{{ @$data->branch_name }}</h6>
                  </div>
                  <small class="text-muted">{{ @$data->user->name }}</small>
                </div>
                <div class="user-progress" >
                  <p class="text-primary fw-semibold mb-0">
                  
                  <div class="badge bg-label-success rounded p-2">
                    <i class="tf-icons ti ti-file-dollar"></i>
                  </div>
                    {{ @$data->invoices_count }}
                    
                  </p>
                </div>
               
                <div class="user-progress">
                  <p class="text-primary fw-semibold mb-0">
                  
                  <div class="badge bg-label-primary rounded p-2">
                    <i class="ti ti-users ti-sm"></i>
                  </div>
                    {{ $data->clients_count }}
                    
                  </p>
                </div>
              </div>
            </li>
            @endforeach
            
          </ul>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="mb-0">Inventory</h5>
            <small class="text-muted">Branch Wise Inventory</small>
          </div>
         
        </div>
        <div class="card-body">
          <ul class="list-unstyled mb-0">
            @foreach($activeBranches as $branch)
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-danger p-2 me-3 rounded">
                  <i class="tf-icons ti ti-layout-kanban"></i>
                </div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">{{ @$branch->branch_name }}</h6>
                    <small class="text-muted">{{  @$branch->user->name }}</small>
                  </div>
                  <div class="d-flex align-items-center">
                    <!-- <p class="mb-0">1.2k</p> -->
                    @php 
                      $amount = 0;
                      foreach($branch->inventory as $rec){
                        $amount += $rec->amount;

                      }

                    @endphp
                    @if($amount != 0)
                    <div class="ms-3 badge bg-label-danger text-dark">{{ 'SAR '.number_format($amount,2) }}</div>
                    @endif
                  </div>
                </div>
              </div>
            </li>
           @endforeach
          </ul>
        </div>
      </div>

      <div class="col-lg-12 mt-4">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4 px-0">
                <div class="d-flex gap-2 align-items-center mb-2">
                  <span class="badge bg-label-danger p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                  <p class="mb-0">Inventory</p>
                </div>
                @php
                  $inventry = 0;
                  foreach($Invetories as $data){
                      $inventry += $data->amount;
                  }
                @endphp
                <h5 class="mb-0 pt-5 text-nowrap">{{ 'SAR '. number_format($inventry,2) }}</h5>
                <!-- <small class="text-muted">6,440</small> -->
              </div>
              <div class="col-3 px-0">
                <div class="divider divider-vertical">
                  <div class="divider-text">
                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                  </div>
                </div>
              </div>
              <div class="col-4 text-end px-0">
                <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                  <p class="mb-0">Income</p>
                  <span class="badge bg-label-success p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
                </div>
                @foreach($Income as $order)
                  @php 
                      $totalPrice = 0;
                      foreach($order->invoice_item_details as $item){
                          $totalPrice += $item->price;
                      }
                      $subTotal = $totalPrice + $order->packing_charges + $order->box_charges + $order->bill_charges + $order->other_charges - $order->discount;
                      
                      $VatInPercent = $order->vat;
                      $vatPercentAmount = ($subTotal / 100) * $order->vat;
                      $InvoiceAmount = $vatPercentAmount + $subTotal;
                     // $InvoiceAmount += $InvoiceAmount;
                      
                  @endphp
                @endforeach
                <h5 class="mb-0 pt-5 text-nowrap ms-lg-n3 ms-xl-0">{{ 'SAR '. number_format(@$InvoiceAmount,2) }}</h5>
              </div>
            </div>
            <div class="d-flex align-items-center mt-4">
              <div class="progress w-100" style="height: 8px">
                <div class="progress-bar bg-danger" style="width: 50%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title mb-1">Overview</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4 px-0">
              <div class="d-flex gap-2 align-items-center mb-2">
                <span class="badge bg-label-info p-1 rounded"><i class="tf-icons ti ti-layout-kanban"></i></span>
                <p class="mb-0">Branches</p>
              </div>
              @php
                $branchCount = 0; $branchClientCount = 0;
                foreach($activeBranches as $data){
                    ++$branchCount;

                    foreach($data->Clients  as $key => $users){
                    ++$branchClientCount;
                  }
                }
              @endphp
              
              <h5 class="mb-0 pt-1 text-nowrap">{{ $branchCount }}</h5>
              <small class="text-muted">Total</small>
            </div>
            <div class="col-4 px-0">
              <div class="divider divider-vertical">
                <div class="divider-text">
                  <span class="badge-divider-bg bg-label-secondary">VS</span>
                </div>
              </div>
            </div>
            <div class="col-4 text-end px-0">
              <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                <p class="mb-0">Clients</p>
                <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-users ti-sm"></i></span>
              </div>
              <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">{{ $branchClientCount  }}</h5>
              <small class="text-muted">Total</small>
            </div>
          </div>
          
          <div class="d-flex align-items-center mt-4">
            <div class="progress w-100" style="height: 8px">
              <div class="progress-bar bg-info" style="width: 50%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>

    </div>
    
  @endcan

  @can('branch-admin-dashboard')
    <div class="col-xl-2 col-md-4 col-6 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <h5 class="card-title mb-0">Clients</h5>
          <!-- <small class="text-muted">Last Year</small> -->
        </div>
        <div id="salesLastYear" style="min-height: 78px;"><div id="apexchartsy8df3g7k" class="apexcharts-canvas apexchartsy8df3g7k apexcharts-theme-light" style="width: 154px; height: 78px;"><svg id="SvgjsSvg1001" width="154" height="78" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent none repeat scroll 0% 0%;"><g id="SvgjsG1003" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1002"><clipPath id="gridRectMasky8df3g7k"><rect id="SvgjsRect1008" width="160" height="80" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMasky8df3g7k"></clipPath><clipPath id="nonForecastMasky8df3g7k"></clipPath><clipPath id="gridRectMarkerMasky8df3g7k"><rect id="SvgjsRect1009" width="158" height="82" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1014" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1015" stop-opacity="0.6" stop-color="rgba(40,199,111,0.6)" offset="0"></stop><stop id="SvgjsStop1016" stop-opacity="0.25" stop-color="rgba(212,244,226,0.25)" offset="1"></stop><stop id="SvgjsStop1017" stop-opacity="0.25" stop-color="rgba(212,244,226,0.25)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1007" x1="0" y1="0" x2="0" y2="78" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="78" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1020" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1021" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1027" class="apexcharts-grid"><g id="SvgjsG1028" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1030" x1="0" y1="0" x2="154" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1031" x1="0" y1="15.6" x2="154" y2="15.6" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1032" x1="0" y1="31.2" x2="154" y2="31.2" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1033" x1="0" y1="46.8" x2="154" y2="46.8" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1034" x1="0" y1="62.4" x2="154" y2="62.4" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1035" x1="0" y1="78" x2="154" y2="78" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1029" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1037" x1="0" y1="78" x2="154" y2="78" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1036" x1="0" y1="1" x2="0" y2="78" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1010" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1011" class="apexcharts-series" seriesName="seriesx1" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1018" d="M0 78L0 43.333333333333336C17.966666666666665 43.333333333333336 33.366666666666674 68.46666666666667 51.333333333333336 68.46666666666667C69.3 68.46666666666667 84.7 8.666666666666671 102.66666666666667 8.666666666666671C120.63333333333334 8.666666666666671 136.03333333333333 34.666666666666664 154 34.666666666666664C154 34.666666666666664 154 34.666666666666664 154 78M154 34.666666666666664C154 34.666666666666664 154 34.666666666666664 154 34.666666666666664 " fill="url(#SvgjsLinearGradient1014)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMasky8df3g7k)" pathTo="M 0 78L 0 43.333333333333336C 17.966666666666665 43.333333333333336 33.366666666666674 68.46666666666667 51.333333333333336 68.46666666666667C 69.3 68.46666666666667 84.7 8.666666666666671 102.66666666666667 8.666666666666671C 120.63333333333334 8.666666666666671 136.03333333333333 34.666666666666664 154 34.666666666666664C 154 34.666666666666664 154 34.666666666666664 154 78M 154 34.666666666666664z" pathFrom="M -1 78L -1 78L 51.333333333333336 78L 102.66666666666667 78L 154 78"></path><path id="SvgjsPath1019" d="M0 43.333333333333336C17.966666666666665 43.333333333333336 33.366666666666674 68.46666666666667 51.333333333333336 68.46666666666667C69.3 68.46666666666667 84.7 8.666666666666671 102.66666666666667 8.666666666666671C120.63333333333335 8.666666666666671 136.03333333333333 34.666666666666664 154 34.666666666666664C154 34.666666666666664 154 34.666666666666664 154 34.666666666666664 " fill="none" fill-opacity="1" stroke="#28c76f" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMasky8df3g7k)" pathTo="M 0 43.333333333333336C 17.966666666666665 43.333333333333336 33.366666666666674 68.46666666666667 51.333333333333336 68.46666666666667C 69.3 68.46666666666667 84.7 8.666666666666671 102.66666666666667 8.666666666666671C 120.63333333333334 8.666666666666671 136.03333333333333 34.666666666666664 154 34.666666666666664" pathFrom="M -1 78L -1 78L 51.333333333333336 78L 102.66666666666667 78L 154 78"></path><g id="SvgjsG1012" class="apexcharts-series-markers-wrap" data:realIndex="0"></g></g><g id="SvgjsG1013" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1038" x1="0" y1="0" x2="154" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1039" x1="0" y1="0" x2="154" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1040" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1041" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1042" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1006" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1026" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1004" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 39px;"></div></div></div>
        <div class="card-body pt-0">
          <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
            <h4 class="mb-0">{{ $BranchWithClientsAndInvoiceCount->clients_count }}</h4>
            <!-- <small class="text-danger">-16.2%</small> -->
          </div>
        </div>
      <!-- <div class="resize-triggers">
        <div class="expand-trigger">
          <div style="width: 155px; height: 220px;"></div>
        </div>
        <div class="contract-trigger"></div>
      </div> -->
    </div>
    </div>

    <div class="col-xl-2 col-md-4 col-6 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <h5 class="card-title mb-0">Inventory</h5>
          <!-- <small class="text-muted">Last Month</small> -->
        </div>
        <div class="card-body" style="position: relative; padding: 0px 15px 25px;">
          <div id="sessionsLastMonth" style="min-height: 78px;"><div id="apexcharts5c7qsiu5l" class="apexcharts-canvas apexcharts5c7qsiu5l apexcharts-theme-light" style="width: 106px; height: 78px;"><svg id="SvgjsSvg1043" width="106" height="78" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent none repeat scroll 0% 0%;"><g id="SvgjsG1045" class="apexcharts-inner apexcharts-graphical" transform="translate(-8, -11)"><defs id="SvgjsDefs1044"><linearGradient id="SvgjsLinearGradient1049" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1050" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1051" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1052" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMask5c7qsiu5l"><rect id="SvgjsRect1054" width="129" height="90" x="-2.5" y="-0.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask5c7qsiu5l"></clipPath><clipPath id="nonForecastMask5c7qsiu5l"></clipPath><clipPath id="gridRectMarkerMask5c7qsiu5l"><rect id="SvgjsRect1055" width="128" height="93" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect1053" width="0" height="89" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1049)" class="apexcharts-xcrosshairs" y2="89" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG1071" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1072" class="apexcharts-xaxis-texts-g" transform="translate(0, 2.75)"></g></g><g id="SvgjsG1081" class="apexcharts-grid"><g id="SvgjsG1082" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1084" x1="0" y1="0" x2="124" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1085" x1="0" y1="17.8" x2="124" y2="17.8" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1086" x1="0" y1="35.6" x2="124" y2="35.6" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1087" x1="0" y1="53.400000000000006" x2="124" y2="53.400000000000006" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1088" x1="0" y1="71.2" x2="124" y2="71.2" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1089" x1="0" y1="89" x2="124" y2="89" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1083" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1091" x1="0" y1="89" x2="124" y2="89" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1090" x1="0" y1="1" x2="0" y2="89" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1056" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1057" class="apexcharts-series" seriesName="PRODUCTxA" rel="1" data:realIndex="0"><path id="SvgjsPath1059" d="M7.44 48.4L7.44 34.666666666666664C7.4399999999999995 31.33333333333333 9.106666666666667 29.666666666666664 12.440000000000001 29.666666666666664L11.36 29.666666666666664C14.693333333333333 29.666666666666664 16.36 31.33333333333333 16.36 34.666666666666664L16.36 34.666666666666664L16.36 48.4C16.36 51.733333333333334 14.693333333333333 53.400000000000006 11.36 53.4C11.36 53.4 12.440000000000001 53.4 12.440000000000001 53.4C9.106666666666667 53.400000000000006 7.4399999999999995 51.733333333333334 7.44 48.4C7.44 48.4 7.44 48.4 7.44 48.4 " fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 7.44 48.4L 7.44 34.666666666666664Q 7.44 29.666666666666664 12.440000000000001 29.666666666666664L 11.36 29.666666666666664Q 16.36 29.666666666666664 16.36 34.666666666666664L 16.36 34.666666666666664L 16.36 48.4Q 16.36 53.4 11.36 53.4L 12.440000000000001 53.4Q 7.44 53.4 7.44 48.4z" pathFrom="M 7.44 48.4L 7.44 48.4L 16.36 48.4L 16.36 48.4L 16.36 48.4L 16.36 48.4L 16.36 48.4L 7.44 48.4" cy="29.666666666666664" cx="31.740000000000002" j="0" val="4" barHeight="23.733333333333334" barWidth="9.92"></path><path id="SvgjsPath1060" d="M32.24 48.4L32.24 40.599999999999994C32.24 37.266666666666666 33.906666666666666 35.599999999999994 37.24 35.599999999999994L36.160000000000004 35.599999999999994C39.49333333333334 35.599999999999994 41.160000000000004 37.266666666666666 41.160000000000004 40.599999999999994L41.160000000000004 40.599999999999994L41.160000000000004 48.4C41.160000000000004 51.733333333333334 39.49333333333334 53.400000000000006 36.160000000000004 53.4C36.160000000000004 53.4 37.24 53.4 37.24 53.4C33.906666666666666 53.400000000000006 32.24 51.733333333333334 32.24 48.4C32.24 48.4 32.24 48.4 32.24 48.4 " fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 32.24 48.4L 32.24 40.599999999999994Q 32.24 35.599999999999994 37.24 35.599999999999994L 36.160000000000004 35.599999999999994Q 41.160000000000004 35.599999999999994 41.160000000000004 40.599999999999994L 41.160000000000004 40.599999999999994L 41.160000000000004 48.4Q 41.160000000000004 53.4 36.160000000000004 53.4L 37.24 53.4Q 32.24 53.4 32.24 48.4z" pathFrom="M 32.24 48.4L 32.24 48.4L 41.160000000000004 48.4L 41.160000000000004 48.4L 41.160000000000004 48.4L 41.160000000000004 48.4L 41.160000000000004 48.4L 32.24 48.4" cy="35.599999999999994" cx="56.540000000000006" j="1" val="3" barHeight="17.8" barWidth="9.92"></path><path id="SvgjsPath1061" d="M57.040000000000006 48.4L57.040000000000006 22.799999999999997C57.040000000000006 19.466666666666665 58.70666666666668 17.799999999999997 62.040000000000006 17.799999999999997L60.96000000000001 17.799999999999997C64.29333333333334 17.799999999999997 65.96000000000001 19.466666666666665 65.96000000000001 22.799999999999997L65.96000000000001 22.799999999999997L65.96000000000001 48.4C65.96000000000001 51.733333333333334 64.29333333333334 53.400000000000006 60.96000000000001 53.4C60.96000000000001 53.4 62.040000000000006 53.4 62.040000000000006 53.4C58.70666666666668 53.400000000000006 57.040000000000006 51.733333333333334 57.040000000000006 48.4C57.040000000000006 48.4 57.040000000000006 48.4 57.040000000000006 48.4 " fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 57.040000000000006 48.4L 57.040000000000006 22.799999999999997Q 57.040000000000006 17.799999999999997 62.040000000000006 17.799999999999997L 60.96000000000001 17.799999999999997Q 65.96000000000001 17.799999999999997 65.96000000000001 22.799999999999997L 65.96000000000001 22.799999999999997L 65.96000000000001 48.4Q 65.96000000000001 53.4 60.96000000000001 53.4L 62.040000000000006 53.4Q 57.040000000000006 53.4 57.040000000000006 48.4z" pathFrom="M 57.040000000000006 48.4L 57.040000000000006 48.4L 65.96000000000001 48.4L 65.96000000000001 48.4L 65.96000000000001 48.4L 65.96000000000001 48.4L 65.96000000000001 48.4L 57.040000000000006 48.4" cy="17.799999999999997" cx="81.34" j="2" val="6" barHeight="35.6" barWidth="9.92"></path><path id="SvgjsPath1062" d="M81.84 48.4L81.84 34.666666666666664C81.84 31.33333333333333 83.50666666666667 29.666666666666664 86.84 29.666666666666664L85.76 29.666666666666664C89.09333333333333 29.666666666666664 90.76 31.33333333333333 90.76 34.666666666666664L90.76 34.666666666666664L90.76 48.4C90.76 51.733333333333334 89.09333333333333 53.400000000000006 85.76 53.4C85.76 53.4 86.84 53.4 86.84 53.4C83.50666666666667 53.400000000000006 81.84 51.733333333333334 81.84 48.4C81.84 48.4 81.84 48.4 81.84 48.4 " fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 81.84 48.4L 81.84 34.666666666666664Q 81.84 29.666666666666664 86.84 29.666666666666664L 85.76 29.666666666666664Q 90.76 29.666666666666664 90.76 34.666666666666664L 90.76 34.666666666666664L 90.76 48.4Q 90.76 53.4 85.76 53.4L 86.84 53.4Q 81.84 53.4 81.84 48.4z" pathFrom="M 81.84 48.4L 81.84 48.4L 90.76 48.4L 90.76 48.4L 90.76 48.4L 90.76 48.4L 90.76 48.4L 81.84 48.4" cy="29.666666666666664" cx="106.14" j="3" val="4" barHeight="23.733333333333334" barWidth="9.92"></path><path id="SvgjsPath1063" d="M106.64 48.4L106.64 40.599999999999994C106.64 37.266666666666666 108.30666666666667 35.599999999999994 111.64 35.599999999999994L110.56 35.599999999999994C113.89333333333335 35.599999999999994 115.56 37.266666666666666 115.56 40.599999999999994L115.56 40.599999999999994L115.56 48.4C115.56 51.733333333333334 113.89333333333335 53.400000000000006 110.56 53.4C110.56 53.4 111.64 53.4 111.64 53.4C108.30666666666667 53.400000000000006 106.64 51.733333333333334 106.64 48.4C106.64 48.4 106.64 48.4 106.64 48.4 " fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 106.64 48.4L 106.64 40.599999999999994Q 106.64 35.599999999999994 111.64 35.599999999999994L 110.56 35.599999999999994Q 115.56 35.599999999999994 115.56 40.599999999999994L 115.56 40.599999999999994L 115.56 48.4Q 115.56 53.4 110.56 53.4L 111.64 53.4Q 106.64 53.4 106.64 48.4z" pathFrom="M 106.64 48.4L 106.64 48.4L 115.56 48.4L 115.56 48.4L 115.56 48.4L 115.56 48.4L 115.56 48.4L 106.64 48.4" cy="35.599999999999994" cx="130.94" j="4" val="3" barHeight="17.8" barWidth="9.92"></path></g><g id="SvgjsG1064" class="apexcharts-series" seriesName="PRODUCTxB" rel="2" data:realIndex="1"><path id="SvgjsPath1066" d="M7.44 63.4L7.44 71.2C7.4399999999999995 74.53333333333333 9.106666666666667 76.2 12.440000000000001 76.2L11.36 76.2C14.693333333333333 76.2 16.36 74.53333333333333 16.36 71.2L16.36 71.2L16.36 63.4C16.36 60.06666666666666 14.693333333333333 58.39999999999999 11.36 58.4C11.36 58.4 12.440000000000001 58.4 12.440000000000001 58.4C9.106666666666667 58.39999999999999 7.4399999999999995 60.06666666666666 7.44 63.4C7.44 63.4 7.44 63.4 7.44 63.4 " fill="rgba(40,199,111,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 7.44 63.4L 7.44 71.2Q 7.44 76.2 12.440000000000001 76.2L 11.36 76.2Q 16.36 76.2 16.36 71.2L 16.36 71.2L 16.36 63.4Q 16.36 58.4 11.36 58.4L 12.440000000000001 58.4Q 7.44 58.4 7.44 63.4z" pathFrom="M 7.44 63.4L 7.44 63.4L 16.36 63.4L 16.36 63.4L 16.36 63.4L 16.36 63.4L 16.36 63.4L 7.44 63.4" cy="66.2" cx="31.740000000000002" j="0" val="-3" barHeight="-17.8" barWidth="9.92"></path><path id="SvgjsPath1067" d="M32.24 63.4L32.24 77.13333333333333C32.24 80.46666666666667 33.906666666666666 82.13333333333333 37.24 82.13333333333333L36.160000000000004 82.13333333333333C39.49333333333334 82.13333333333333 41.160000000000004 80.46666666666667 41.160000000000004 77.13333333333333L41.160000000000004 77.13333333333333L41.160000000000004 63.4C41.160000000000004 60.06666666666666 39.49333333333334 58.39999999999999 36.160000000000004 58.4C36.160000000000004 58.4 37.24 58.4 37.24 58.4C33.906666666666666 58.39999999999999 32.24 60.06666666666666 32.24 63.4C32.24 63.4 32.24 63.4 32.24 63.4 " fill="rgba(40,199,111,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 32.24 63.4L 32.24 77.13333333333333Q 32.24 82.13333333333333 37.24 82.13333333333333L 36.160000000000004 82.13333333333333Q 41.160000000000004 82.13333333333333 41.160000000000004 77.13333333333333L 41.160000000000004 77.13333333333333L 41.160000000000004 63.4Q 41.160000000000004 58.4 36.160000000000004 58.4L 37.24 58.4Q 32.24 58.4 32.24 63.4z" pathFrom="M 32.24 63.4L 32.24 63.4L 41.160000000000004 63.4L 41.160000000000004 63.4L 41.160000000000004 63.4L 41.160000000000004 63.4L 41.160000000000004 63.4L 32.24 63.4" cy="72.13333333333333" cx="56.540000000000006" j="1" val="-4" barHeight="-23.733333333333334" barWidth="9.92"></path><path id="SvgjsPath1068" d="M57.040000000000006 63.4L57.040000000000006 71.2C57.040000000000006 74.53333333333333 58.70666666666668 76.2 62.040000000000006 76.2L60.96000000000001 76.2C64.29333333333334 76.2 65.96000000000001 74.53333333333333 65.96000000000001 71.2L65.96000000000001 71.2L65.96000000000001 63.4C65.96000000000001 60.06666666666666 64.29333333333334 58.39999999999999 60.96000000000001 58.4C60.96000000000001 58.4 62.040000000000006 58.4 62.040000000000006 58.4C58.70666666666668 58.39999999999999 57.040000000000006 60.06666666666666 57.040000000000006 63.4C57.040000000000006 63.4 57.040000000000006 63.4 57.040000000000006 63.4 " fill="rgba(40,199,111,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 57.040000000000006 63.4L 57.040000000000006 71.2Q 57.040000000000006 76.2 62.040000000000006 76.2L 60.96000000000001 76.2Q 65.96000000000001 76.2 65.96000000000001 71.2L 65.96000000000001 71.2L 65.96000000000001 63.4Q 65.96000000000001 58.4 60.96000000000001 58.4L 62.040000000000006 58.4Q 57.040000000000006 58.4 57.040000000000006 63.4z" pathFrom="M 57.040000000000006 63.4L 57.040000000000006 63.4L 65.96000000000001 63.4L 65.96000000000001 63.4L 65.96000000000001 63.4L 65.96000000000001 63.4L 65.96000000000001 63.4L 57.040000000000006 63.4" cy="66.2" cx="81.34" j="2" val="-3" barHeight="-17.8" barWidth="9.92"></path><path id="SvgjsPath1069" d="M81.84 63.4L81.84 65.26666666666667C81.84 68.6 83.50666666666667 70.26666666666667 86.84 70.26666666666667L85.76 70.26666666666667C89.09333333333333 70.26666666666667 90.76 68.6 90.76 65.26666666666667L90.76 65.26666666666667L90.76 63.4C90.76 60.06666666666666 89.09333333333333 58.39999999999999 85.76 58.4C85.76 58.4 86.84 58.4 86.84 58.4C83.50666666666667 58.39999999999999 81.84 60.06666666666666 81.84 63.4C81.84 63.4 81.84 63.4 81.84 63.4 " fill="rgba(40,199,111,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 81.84 63.4L 81.84 65.26666666666667Q 81.84 70.26666666666667 86.84 70.26666666666667L 85.76 70.26666666666667Q 90.76 70.26666666666667 90.76 65.26666666666667L 90.76 65.26666666666667L 90.76 63.4Q 90.76 58.4 85.76 58.4L 86.84 58.4Q 81.84 58.4 81.84 63.4z" pathFrom="M 81.84 63.4L 81.84 63.4L 90.76 63.4L 90.76 63.4L 90.76 63.4L 90.76 63.4L 90.76 63.4L 81.84 63.4" cy="60.266666666666666" cx="106.14" j="3" val="-2" barHeight="-11.866666666666667" barWidth="9.92"></path><path id="SvgjsPath1070" d="M106.64 63.4L106.64 71.2C106.64 74.53333333333333 108.30666666666667 76.2 111.64 76.2L110.56 76.2C113.89333333333335 76.2 115.56 74.53333333333333 115.56 71.2L115.56 71.2L115.56 63.4C115.56 60.06666666666666 113.89333333333335 58.39999999999999 110.56 58.4C110.56 58.4 111.64 58.4 111.64 58.4C108.30666666666667 58.39999999999999 106.64 60.06666666666666 106.64 63.4C106.64 63.4 106.64 63.4 106.64 63.4 " fill="rgba(40,199,111,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask5c7qsiu5l)" pathTo="M 106.64 63.4L 106.64 71.2Q 106.64 76.2 111.64 76.2L 110.56 76.2Q 115.56 76.2 115.56 71.2L 115.56 71.2L 115.56 63.4Q 115.56 58.4 110.56 58.4L 111.64 58.4Q 106.64 58.4 106.64 63.4z" pathFrom="M 106.64 63.4L 106.64 63.4L 115.56 63.4L 115.56 63.4L 115.56 63.4L 115.56 63.4L 115.56 63.4L 106.64 63.4" cy="66.2" cx="130.94" j="4" val="-3" barHeight="-17.8" barWidth="9.92"></path></g><g id="SvgjsG1058" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG1065" class="apexcharts-datalabels" data:realIndex="1"></g></g><line id="SvgjsLine1092" x1="0" y1="0" x2="124" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1093" x1="0" y1="0" x2="124" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1094" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1095" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1096" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1080" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1046" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 39px;"></div></div></div>
          <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
            @php 

            $amount = 0;
              foreach( $branchAdmin->inventory as $data){
                  $amount +=  $data->amount;
              }
           

            @endphp
            <h4 class="mb-0"> {{ 'SAR '. number_format($amount,2) }}</h4>
            <!-- <small class="text-success">+12.6%</small> -->
          </div>
        <!-- <div class="resize-triggers">
          <div class="expand-trigger">
            <div style="width: 155px; height: 149px;"></div>
          </div>
          <div class="contract-trigger"></div>
        </div> -->
      </div>
      </div>
    </div>

    <div class="col-xl-2 col-md-4 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="badge p-2 bg-label-info mb-2 rounded"><i class="ti ti-chart-bar ti-md"></i></div>
          <h5 class="card-title mb-1 pt-2">Invoices</h5>
          <!-- <small class="text-muted">Last week</small> -->
          <h4 class="mt-3">{{ $BranchWithClientsAndInvoiceCount->invoices_count }}</h4>
          <!-- <div class="pt-1">
            <span class="badge bg-label-secondary d-none">+25.2%</span>
          </div> -->
        </div>
      </div>
    </div>
    
    <div class="col-lg-4 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <div class="d-flex gap-2 align-items-center mb-2">
                <span class="badge bg-label-danger p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                <p class="mb-0">Inventory</p>
              </div>
              @php
                $branchInventry = 0;
                foreach($branchInvetories as $data){
                    $branchInventry += $data->amount;
                }
              @endphp
              <h5 class="mb-0 pt-5 text-nowrap">{{ 'SAR '. number_format($branchInventry,2) }}</h5>
              <!-- <small class="text-muted">6,440</small> -->
            </div>
            <div class="col-3">
              <div class="divider divider-vertical">
                <div class="divider-text">
                  <span class="badge-divider-bg bg-label-secondary">VS</span>
                </div>
              </div>
            </div>
            <div class="col-4 text-center p-0">
              <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                <p class="mb-0">Income</p>
                <span class="badge bg-label-success p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
              </div>
              @foreach($BranchIncome as $order)
                @php 
                    $totalPrice = 0;
                    foreach($order->invoice_item_details as $item){
                        $totalPrice += $item->price;
                    }
                    $subTotal = $totalPrice + $order->packing_charges + $order->box_charges + $order->bill_charges + $order->other_charges - $order->discount;
                    
                    $VatInPercent = $order->vat;
                    $vatPercentAmount = ($subTotal / 100) * $order->vat;
                    $InvoiceAmount = $vatPercentAmount + $subTotal;
                    $InvoiceAmount;
                   // $InvoiceAmount += $InvoiceAmount;
                    
                @endphp
              @endforeach
              <h5 class="mb-0 pt-5 text-nowrap ms-lg-n3 ms-xl-0">{{ 'SAR '. number_format(@$InvoiceAmount,2) }}</h5>
              <!-- <small class="text-muted">12,749</small> -->
            </div>
          </div>
          <div class="d-flex align-items-center mt-4">
            <div class="progress w-100" style="height: 8px">
              <div class="progress-bar bg-danger" style="width: 50%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  @endcan
  </div>

      
@endsection

