<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}} | Ev.ma</title>
    <link rel="stylesheet" href="{{asset('css/site/app.css')}}">
</head>
<body>

    <div class="container">
        @yield('content')
    </div>
    <script src="{{asset('js/site/common.js')}}"></script>
</body>
</html>