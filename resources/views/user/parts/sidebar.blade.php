<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link  {{Request::is('dashboardUser') ? '' : 'collapsed'}}" href="{{route('dashboard.user')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->
    <li class="nav-item">
      <a class="nav-link {{Request::is('order') ? '' : 'collapsed'}}" href="{{route('user.createOrder')}}">
        <i class="bi bi-cart"></i>
        <span>Order</span>
      </a>
    </li><!-- End Orderan Nav -->
    <li class="nav-item">
      <a class="nav-link {{Request::is('history') ? '' : 'collapsed'}}" href="{{route('user.history')}}">
        <i class="bi bi-journals"></i>
        <span>History</span>
      </a>
    </li><!-- End Konfirmasi Nav -->


</aside><!-- End Sidebar-->