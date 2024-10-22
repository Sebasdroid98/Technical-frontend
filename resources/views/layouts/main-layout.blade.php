<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title-page')</title>
    <link rel="stylesheet" href="/public/bookstores/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/bookstores/font-awesome-v6/css/all.min.css">
    <link rel="stylesheet" href="/public/bookstores/toastr/css/toastr.min.css">
    <link rel="stylesheet" href="/public/bookstores/datatables-bs4/css/dataTables.bootstrap4.css">

    <link rel="stylesheet" href="/public/global/css/main.css">

    <!-- Sección para los scripts CSS de cualquier página -->
    @yield('scripts-head')
</head>
<body class="fondo-principal">
    <!-- Sección principal del contenido de la página -->
    <section id="principal" class="py-5 px-5">
        @yield('content-page')
    </section>

    <!-- Sección para los modals -->
    <section id="modals">
        @yield('modals-page')
    </section>

    <!-- Scripts al footer -->
    <script src="/public/bookstores/jquery/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="/public/bookstores/bootstrap/js/popper.min.js" type="text/javascript"></script>
    <script src="/public/bookstores/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/public/bookstores/bootstrap/js/bootstrap.min.js.map" type="text/javascript"></script>
    <script src="/public/bookstores/toastr/js/toastr.min.js" type="text/javascript"></script>
    <script src="/public/global/js/main.js" type="text/javascript"></script>
    <script type="text/javascript">
        const urlBase = {!! json_encode(url('/'))!!};
    </script>

    <!-- Sección para los scripts JS de cualquier página -->
    @yield('scripts-footer')
</body>
</html>
