<!DOCTYPE html>
<html lang="{{ $currentLocale }}" dir="{{ $direction }}">

    @include('layout.header.head')

    <body class="@yield('body-class')">

        <main class="main">

            @include('layout.navbar.nav')

            @yield('content')

            @include('layout.footer.footer')

            @yield('scripts')
            @stack('scripts')

        </main>
        
    </body>

</html>
