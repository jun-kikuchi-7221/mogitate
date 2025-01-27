<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mogitate')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsMath/3.6/fonts/cmsymbol10.js"></script>
    @yield('css')
</head>


<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo">
                    mogitate
                </a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- JavaScriptセクション -->
    @yield('scripts')
</body>

</html>