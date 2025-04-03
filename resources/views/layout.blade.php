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
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark sb-sidenav-original">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/orders">ProductManager</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href=""><i class="fas fa-bars"></i></button>
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
                            <i class="fas fa-user fa-fw"></i>
                        </a>
                      
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                          <small>
                                <li><a class="dropdown-item text-muted " href="/logout">ログアウト</a></li>
                                <li><a class="dropdown-item text-muted" href="/portfolio">ポートフォリオ</a></li>
                                <li><a class="dropdown-item text-muted" href="/recipes">イージーレシピ</a></li>
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
                            <div class="sb-sidenav-menu-heading">発注</div>
                            <a class="nav-link" href="/orders">
                                <div class="fas fa-book-open mx-3"><i class="fas fa-tachometer-alt"></i></div>
                                発注・入荷予定
                            </a>
                        </div>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">登録</div>
                            <a class="nav-link" href="/products">
                                <div class="fas fa-book-open mx-3"><i class="fas fa-tachometer-alt"></i></div>
                                商品登録
                            </a>
                            <a class="nav-link" href="/makers">
                                <div class="fas fa-book-open mx-3"><i class="fas fa-tachometer-alt"></i></div>
                                メーカー
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h4 class="mt-4 mb-5">@yield('title')</h4>
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
