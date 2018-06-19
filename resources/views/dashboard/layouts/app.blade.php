<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Tender | Dashboard</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">
</head>
<body>
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/admin">Tender</a>
    <form class="form-control-dark w-100" action="admin/">
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" name="search" aria-label="Search" value="{{ isset($search) ? $search : '' }}">
    </form>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a href="{{ route('logout') }}" class="nav-link" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fa fa-share"></i>
          <span>Выйти</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
      </li>
    </ul>
</nav>

<div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                  <a data-toggle="dropdown" class="nav-link" href="#">
                      <span class="clear"> <span> <strong class="font-bold">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</strong>
                       </span> <span class="text-muted block"> Admin</span> </span> </a>
                  <ul class="dropdown-menu">
                      <li><a href="profile.html">Профиль</a>
                      <li><a href="login.html">Выйти</a></li>
                  </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{ Request::is('admin') ? 'active' : '' }}" href="/admin">
                  <span data-feather="home"></span>
                  Панель управления <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="/admin/users">
                  <span data-feather="users"></span>
                  Пользователи
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('statistics') ? 'active' : '' }}" href="statistics">
                  <span data-feather="bar-chart-2"></span> 
                  Статистика
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('customers') ? 'active' : '' }}" href="customers">
                  <span data-feather="shopping-cart"></span>
                  Заказчики
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('reports') ? 'active' : '' }}" href="reports">
                  <span data-feather="file"></span>
                  Отчеты
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
          
          @yield('content')
          @include('dashboard.layouts.partials.scripts')
          
        </main>
      </div>
      <script type="text/javascript">
    $('.input-datepicker').datepicker({
    format: "yyyy-mm-dd",
    language: "ru",
    orientation: "bottom auto",
    autoclose: true,
    todayHighlight: true
});
</script>
</div>
    
</body>
</html>

