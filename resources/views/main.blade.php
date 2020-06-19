<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
    @yield('stylesheets')
</head>
<body>
    @include('partials._navbar')
    <div class="container-fluid">

        @include('partials._messages')

        @yield('content')

        @include('partials._footer')
    </div><!-- end of container -->

    @include('partials._javascript')

    @yield('scripts')
</body>
</html>
