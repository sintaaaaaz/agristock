<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AgriStock</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-light">

    {{-- Header --}}
    @include('components.header')

    <div class="container-fluid">

        <div class="row">

            {{-- Sidebar --}}
            @include('components.sidebar')

            {{-- Content --}}
            <main class="col-md-10 ms-sm-auto px-md-4 py-4">

                @yield('content')

            </main>

        </div>

    </div>

    {{-- Footer --}}
    @include('components.footer')

</body>

</html>
