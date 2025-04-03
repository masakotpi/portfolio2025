<!DOCTYPE html>
<html lang="ja">
    <head> 
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/recipe.css') }}" >
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <link href="https://unpkg.com/pattern.css" rel="stylesheet">
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

        @php
   $ingredient_type = [
    1 => 'お菓子',
    2 => 'パン',
    3 => 'サラダ',
    4 => '魚介類',
    5 => '肉料理',
    6 => 'ご飯',
    7 => '麺類',
    8 => 'スープ',
];
$color  = [
    1 => ['お菓子','pink' ],
    2 => ['パン','orange' ],
    3 => ['サラダ','green' ],
    4 => ['魚介類','skyblue' ],
    5 => ['肉料理','brown' ],
    6 => ['ご飯','lightyellow' ],
    7 => ['麺類','lightyellow' ],
    8 => ['スープ','lightgreen' ],
];
@endphp
    </head>
    <body class="sb-nav-fixed sb-sidenav-dark">
        <nav class="sb-topnav navbar navbar-expand navbar-dark pattern-diagonal-stripes-sm sb-sidenav-original">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/recipes" style="color:#572e0b; text-stroke: 1px #FFF;-webkit-text-stroke: 2px :#572e0b;" ><h3>Easy Recipe</h3></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="" style="color:#572e0b;"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">

                </div>
            </form>
            <!-- dropdown-toggle-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 form-inline" style="position:relative;right:100px;">
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fa-fw" style="color:#572e0b;"></i>
                        </a>
                    
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <small>
                                <li><a class="dropdown-item text-muted " href="/logout">ログアウト</a></li>
                                <li><a class="dropdown-item text-muted" href="/portfolio">ポートフォリオ</a></li>
                                <li><a class="dropdown-item text-muted" href="/orders">プロダクトマネージャー</a></li>
                        </small>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>                      
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">レシピ一覧</div>
                            <a class="nav-link" href="/recipes">
                                <div class="fas fa-book-open mx-2 my-2"><i class="fas fa-tachometer-alt"></i></div>
                                <small>レシピ一覧</small>
                            </a>
                        </div>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">レシピ登録</div>
                            @foreach($ingredient_type as $key => $ingredient)
                            <a class="nav-link" href="/ingredients?type={{$key}}">
                                <div class="fas fa-book-open mx-2 my-2"><i class="fas fa-tachometer-alt"></i></div>
                                <small>{{$ingredient}}</small>
                            </a>
                            @endforeach
                        </div>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">マスター登録</div>
                            <a class="nav-link" href="/mst_ingredients?type=1">
                                <div class="fas fa-book-open mx-2 my-2"><i class="fas fa-tachometer-alt"></i></div>
                                <small>材料登録・更新</small>
                            
                            </a>
                            <a class="nav-link" href="/mst_processes?type=1">
                                <div class="fas fa-book-open mx-2 my-2"><i class="fas fa-tachometer-alt"></i></div>
                                <small>工程登録・更新</small>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" style="background-color:rgb(253, 252, 247);" class="pattern-cross-dots-md">
                <main>
                    <div class="container-fluid px-4">
                        <h4 class="mt-4 mb-5">@yield('title')</h4>
                        <div class="showMessage">
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                            {{ $error }}
                                </div>
                            @endforeach
                            @endif
                            @if (session('flash_message'))
                                <div class="flash_message alert alert-success mg-2">
                                    {{ session('flash_message') }}
                                </div>
                            @endif
                        </div>
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
