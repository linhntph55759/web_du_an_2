<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{--DDifeenf các link dùng --}}
    @yield('CSS')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <header>
        @include('admins.block.header')
    </header>
    <main class="row justify-content-center">
        {{-- <aside class="col-3">
            @include('admins.blocks.siderbar')
        </aside> --}}
        <div class="col-9">
            {{-- @yield : dùng để chỉ định section được hiển thị --}}
            @yield('content')
        </div>
    </main>
    <br>
    <footer>
       @include('admins.block.footer' )
    </footer>
    @yield('JS')
    {{-- Các đoạn script dùng chung --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
