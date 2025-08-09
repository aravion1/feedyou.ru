<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
<header>
    <div class="container mb-5">
        <nav class="navbar navbar-expand-lg navbar-dark p-2">
            <a class="navbar-brand" href="#">Накормим Вас!</a>

            <div class="collapse navbar-collapse justify-content-end" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/products/1">Продукты
                            @if(Request::is('products/*'))
                                <span class="sr-only">(Вы тут!:))</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" disabled="true"
                              href="#">Рецепты (Скоро появится, пока в разработке)</span>
                    </li>
                </ul>
                <form method="GET" action="@yield('search-action')" class="form-inline d-flex flex-row">
                    <input class="form-control mr-sm-2" minlength="3" type="search" name="search" value="@yield('search-value')" placeholder="Поиск продуктов"
                           aria-label="Поиск продуктов">
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Поиск</button>
                </form>
            </div>
        </nav>
    </div>
</header>
<content>
    @yield('content')
</content>
</body>
</html>
