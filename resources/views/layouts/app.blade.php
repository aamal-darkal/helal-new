<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body dir="@lang('helal.dir')">
        @include('layouts.search-modal')
        @include('layouts.header')
        @include('layouts.navigation')
        @yield('content')
        @include('layouts.footer')
        @include('layouts.fixed-btn')
        @include('layouts.js')
        @stack('js')
</body>
</html>