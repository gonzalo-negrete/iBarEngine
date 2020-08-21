@if(Auth::user()->nivel == 'admin')
  <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-beer"></i>
        </div>
        <div class="sidebar-brand-text mx-3">iBarEngine</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Financiero
      </div>

      <li class="nav-item">
        <a class="nav-link" href="/admin/ventas">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Ventas</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/admin/caja">
          <i class="fas fa-fw fa-credit-card"></i>
          <span>Caja</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/reportes">
          <i class="fas fa-fw fa-file"></i>
          <span>Reportes</span></a>
      </li>

      <div class="sidebar-heading">
        Inventario
      </div>

      <li class="nav-item">
        <a class="nav-link" href="/admin/productos">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Productos</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/recetas">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Recetas</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/insumos">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Insumos</span></a>
      </li>

      <div class="sidebar-heading">
        Recursos humanos
      </div>

      <li class="nav-item">
        <a class="nav-link" href="/admin/usuarios">
          <i class="fas fa-fw fa-users"></i>
          <span>Usuarios</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/proveedores">
          <i class="fas fa-fw fa-flag"></i>
          <span>Proveedores</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/mesas">
          <i class="fas fa-fw fa-bars"></i>
          <span>Mesas</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/reservations">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Reservaciones</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
@endif

@if(Auth::user()->nivel == 'gerente')
  <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-beer"></i>
        </div>
        <div class="sidebar-brand-text mx-3">iBarEngine</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Financiero
      </div>

      <li class="nav-item">
        <a class="nav-link" href="/admin/ventas">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Ventas</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/admin/caja">
          <i class="fas fa-fw fa-credit-card"></i>
          <span>Caja</span></a>
      </li>

      <div class="sidebar-heading">
        Inventario
      </div>

      <li class="nav-item">
        <a class="nav-link" href="/admin/productos">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Productos</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/recetas">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Recetas</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/insumos">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Insumos</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/reservations">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Reservaciones</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
@endif

@if(Auth::user()->nivel == 'empleado')
  <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-beer"></i>
        </div>
        <div class="sidebar-brand-text mx-3">iBarEngine</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Financiero
      </div>
      
      <li class="nav-item">
        <a class="nav-link" href="/admin/caja">
          <i class="fas fa-fw fa-credit-card"></i>
          <span>Caja</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/reservations">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Reservaciones</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
@endif