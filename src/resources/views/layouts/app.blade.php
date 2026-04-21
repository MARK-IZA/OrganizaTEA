<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'OrganizaTEA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="container mt-5">

    @yield('content')

</body>
</html>