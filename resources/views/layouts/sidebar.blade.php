<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Админ панель</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <a href="{{ route('dashboard') }}" class="brand-link">
          <img src="{{ auth()->user()->avatar_url }}" id="profileImage" alt="user image" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span href="#" class="brand-text font-weight-light" x-ref="username">{{ auth()->user()->name }}</span>
        </a>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Панель
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('debtors') }}" class="nav-link {{ request()->is('home/debtors') ? 'active' : '' }}">
              <i class="nav-icon fas fa-address-book fa-5x" ></i>
              <p>
                Должники
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('debts') }}" class="nav-link {{ request()->is('home/debts') ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Долги
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('paid-debts') }}" class="nav-link {{ request()->is('home/paid_debts') ? 'active' : '' }}">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Оплаченные долги
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('debtor-report') }}" class="nav-link {{ request()->is('home/debtor_report') ? 'active' : '' }}">
              {{-- <i class="nav-icon fas fa-flag"></i> --}}
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Отчет должника
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('transaction-history') }}" class="nav-link {{ request()->is('home/transactions_history') ? 'active' : '' }}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Транзакции
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('notifications') }}" class="nav-link {{ request()->is('home/notifications') ? 'active' : '' }}">
              <i class="nav-icon far fa-bell"></i>
              <p>
                Уведомления
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('users') }}" class="nav-link {{ request()->is('home/users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Пользователи
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('user.profile') }}" class="nav-link {{ request()->is('home/user/profile') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>Профиль</p>
            </a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Выйти</p>
            </a>
            </form>
          </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
