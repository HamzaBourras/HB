<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titre}}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="font-[Poppins]">
    @include('layouts.navbar')
    <div>
        <div>
            @yield('content')
        </div>
        <div class=" m-auto mt-[50px]">
            @yield('form')
        </div>
    </div>
    @yield('scripts')
</body>
</html>