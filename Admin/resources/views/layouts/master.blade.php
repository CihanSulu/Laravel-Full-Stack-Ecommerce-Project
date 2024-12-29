<!doctype html>
<html lang="en">
<head>
<title>@yield('title')</title>
@include('layouts.partical.header')
@yield('header')
</head>

<body class="theme-cyan font-montserrat">
@include('layouts.partical.navbar')
@yield('content')
@include('layouts.partical.footer')

@yield('footer')
</body>
</html>
