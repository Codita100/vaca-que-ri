<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default"
      data-assets-path="../../assets/" data-template="vertical-menu-template-starter">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  <meta charset="utf-8"/>
    <title>{{ config('app.name') }} </title>
    <!-- Favicon -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/tabler-icons.css')}}"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />

    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>

    <!--Custom CSS-->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    @yield('css')
</head>

<body>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('layouts.left_menu')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('layouts.navbar')
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div>
                <!-- Content -->
                <div class="container my-5">
                    @include('layouts.errors')
                    @yield('content')
                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl">
                    <div
                        class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                        <div>
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , Voucheradama</a>
                        </div>
                        <div class="d-none d-lg-inline-block">
                            <a
                                href=""
                                target="_blank"
                                class="footer-link me-4"
                            ></a
                            >
                        </div>
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


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
<script src="{{asset('assets/vendor/js/menu.js')}}"></script>
<script src="{{asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>
<script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<!-- endbuild -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!--Checkeditor-->
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

<!--datatable-->
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!--FontAwesome-->
<script src="https://kit.fontawesome.com/2ba9cacf02.js" crossorigin="anonymous"></script>




<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{asset('assets/js/app-ecommerce-customer-all.js')}}"></script>
@yield('after_js')
@stack('after_js_stack')
</body>

</html>
