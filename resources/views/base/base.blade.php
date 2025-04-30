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
    @yield('footer')
    @include('base.footer')
    @include('list.components.modal-add-resident')
    @include('components.modal-add-resident-js')

    @stack('scripts')
</body>

</html>
