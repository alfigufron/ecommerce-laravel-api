<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TechStore - @yield('title')</title>
    
    @include('includes.style')
  
</head>
<body class="hold-transition sidebar-mini text-sm">

  <div class="wrapper">

    @include('includes.navbar')

    @include('includes.sidebar')

    <div class="content-wrapper">
      @yield('content')
    </div>

    @include('includes.footer')

  </div>

@include('includes.script')
@include('sweetalert::alert')
@stack('after-script')

</body>
</html>
