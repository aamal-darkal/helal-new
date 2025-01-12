<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <title> @yield('title') | @lang("helal." . config('app.name', 'SARC'))  </title>

    <link href="{{ asset('dashboard-assets/css/bootstrap-5.0.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard-assets/css/app.css') }}" rel="stylesheet">
    @stack('css')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
