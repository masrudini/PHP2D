<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | Page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('admin_template/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin_template/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ url('admin_template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('admin_template/assets/css/custom.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('images/sungai_kakap.ico') }}" />
    <!-- Bootstrap CSS -->
    <!-- Bootstrap DataTables CSS -->
    <!-- Jquery -->
    <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- Jquery DataTables -->
    <script type="text/javascript" language="javascript"
        src="http:////cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap dataTables Javascript -->
    <script type="text/javascript" language="javascript"
        src="http://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
</head>

<body>
    <div class="container-scroller">
        {{-- navbar --}}
        @include('admin/includes/navbar')
        {{-- end navbar --}}

        <div class="container-fluid page-body-wrapper">
            {{-- sidebar --}}
            @include('admin/includes/sidebar')
            {{-- end sidebar --}}
            <div class="main-panel">
                {{-- content --}}
                @yield('content')
                {{-- end content --}}
            </div>
        </div>

    </div>

    <script src="{{ url('admin_template/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('admin_template/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('admin_template/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ url('admin_template/assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('admin_template/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('admin_template/assets/js/misc.js') }}"></script>
    <script src="{{ url('admin_template/assets/js/dashboard.js') }}"></script>
    <script src="{{ url('admin_template/assets/js/todolist.js') }}"></script>
</body>

</html>
