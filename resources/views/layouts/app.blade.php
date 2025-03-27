<!-- this is the main layout. Shown when the use is logged in  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-filing</title>
    <!-- vue-treeselect -->
    <!-- include Vue 2.x -->
    <script src="{{ asset('js/vue2.js') }}"></script>
    <!-- include vue-treeselect & its styles. you can change the version tag to better suit your needs. -->
    <script src="{{ asset('js/vue-tree.js') }}"></script>
    <!-- vue-treeselect -->
    <link rel="stylesheet" href="{{ asset('css/vue-tree.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- summernote
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
    -->
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">


    @stack('styles')
    @livewireStyles

</head>
<!--
    `body` tag options:

    Apply one or more of the following classes to to the body tag
    to get the desired effect

    * sidebar-collapse
    * sidebar-mini
    -->

<body class="hold-transition sidebar-mini sidebar-collapse ">
    <div class="wrapper">
        <!----- TOP NAVBAR ----->
        @include('components.navbar')
        <!----- END NAVBAR ----->

        <!----- SIDEBAR ------->
        @include('components.sidebar')
        <!------ END SIDEBAR -------->

        <!----- MAIN CONTENT ------->
        <div class="content-wrapper">
            {{ $slot }}
        </div>
    </div>


    <script defer src="{{ mix('js/app.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- Summernote
    <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
    -->
    <!-- toastr -->
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>


    @livewireScripts

    @stack('scripts')

    <script>
        window.addEventListener('toastr:success', event => {

            // toastr.success(event.detail.message);
            // Access the first item of the array to get the message
            const message = event.detail[0]?.message;

            // Check if the message is defined
            if (message) {
                toastr.success(message);
            } else {
                // Fallback to a default message if undefined
                toastr.success('Default success message');
            }
        });
        window.addEventListener('toastr:warning', event => {
            toastr.warning(event.detail.message);
        });
        window.addEventListener('toastr:error', event => {
            toastr.error(event.detail.message);
        });

        @if (session('success'))
            toastr.success("{{ session('success') }}")
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}")
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}")
        @endif

        $(document).ready(function() {

            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function() {
                if (this.checked) {
                    checkbox.each(function() {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function() {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function() {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>
</body>

</html>
