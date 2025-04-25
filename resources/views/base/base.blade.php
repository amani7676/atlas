<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'صفحه اصلی')</title>
    @yield('styles')
    @include('base.header')
</head>
<body>
    
    @include('base.menu')
    <div>
        @yield('body')
    </div>

    @include('base.footer')
    @stack('scripts')
</body>
</html>