<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.head')

<body>
    <div class="wrapper">
        @include('dashboard.layouts.sidebar')

        <div  class="main">            
            @include('dashboard.layouts.nav')
            <main class="content px-4 py-2">
                <div class="container-fluid p-0">
                    @session('success')
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endsession

                    @session('error')
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endsession
                    @yield('content')
                </div>
            </main>

            @include('dashboard.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('dashboard-assets/js/app.js') }}"></script>
    @stack('js')
</body>

</html>
