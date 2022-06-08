@extends('layouts.master')

@section('content')
    @push('css')
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-ecommerce.css">
        <!-- END: Page CSS-->
    @endpush
    <section id="bg-variants" class="dashboard">
        <div class="row">
            <div class="col-12 mt-3 mb-1">
                <h3 class="text-uppercase">DASHBOARD</h3>
            </div>
        </div>
    </section>
    @push('js')
        <!-- BEGIN: Page Vendor JS-->
        <script src="../../../app-assets/vendors/js/charts/apexcharts.min.js"></script>
        <!-- END: Page Vendor JS-->
        <!-- BEGIN: Page JS-->
        <script src="../../../app-assets/js/scripts/cards/card-analytics.js"></script>
        <script src="../../../app-assets/js/scripts/pages/app-ecommerce-shop.js"></script>

        <!-- END: Page JS-->
    @endpush
@endsection

