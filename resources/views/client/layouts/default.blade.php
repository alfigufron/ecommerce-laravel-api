<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Yoga Studio Template">
  <meta name="keywords" content="Yoga, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tech Store - @yield('title-client')</title>

  @include('client.includes.style')
</head>
<body>

  @include('client.includes.navbar')

  @yield('content-client')

  @include('client.includes.footer')
  
  @include('client.includes.script')
  @include('sweetalert::alert')
  @stack('after-script')

</body>
</html>