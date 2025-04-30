<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{env('APP_NAME')}}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{asset('backend/dist-assets/css/themes/lite-purple.min.css')}}" rel="stylesheet">
    @stack('css')
</head>
<body>
    <div class="auth-layout-wrap" style="background-image: url({{asset('backend/dist-assets/images/photo-wide-4.jpg')}})">
        <div class="auth-content">
            <div class="card o-hidden">
                @yield('content')
            </div>
        </div>
    </div>
    @stack('js')
</body>
</html>
