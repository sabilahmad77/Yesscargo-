@extends('layouts.yes-cargo')
@section('title','Invoice-List')
@section('content')
    <h4 class="fw-bold "><span class="text-muted fw-light">Invoice /</span> List</h4>

    <!-- Invoice List Table -->
    <div class="card">
    <div class="card-datatable table-responsive">
        <table class="invoice-list-table table border-top">
        <thead>
            <tr>
            <th></th>
            <th>#ID</th>
            <th><i class="ti ti-trending-up"></i></th>
            <th>Client</th>
            <th>Total</th>
            <th class="text-truncate">Issued Date</th>
            <th>Balance</th>
            <th>Invoice Status</th>
            <th class="cell-fit">Actions</th>
            </tr>
        </thead>
        </table>
    </div>
    </div>
@section('script')
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js ') }}"></script>

    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js ') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js ') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js ') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js ') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/app-invoice-list.js ') }}"></script>
@endsection
@endsection