 <nav class="navbar navbar-expand navbar-light navbar-bg py-1">
     <a class="sidebar-toggle js-sidebar-toggle">
         <i class="hamburger align-self-center"></i>
     </a>

     <div class="navbar-collapse collapse">
         <ul class="navbar-nav navbar-align">
             <li class="nav-item dropdown">
                 <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                     <i class="align-middle" data-feather="settings"></i>
                 </a>

                 <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                     <span class="text-salmon fw-bold">{{ auth()->user()->name }}</span>
                 </a>

                 <div class="dropdown-menu dropdown-menu-end">
                     <a class="dropdown-item" href="{{ route('dashboard.profile.edit') }}">
                         تغيير كلمة السر
                         <i class="align-middle me-1" data-feather="user"></i>
                     </a>

                     <div class="dropdown-divider"></div>
                     <form method="POST" action="{{ route('logout') }}">
                         @csrf
                         <button class="dropdown-item">
                             خروج
                             <i class="align-middle me-1" data-feather="log-out"></i>
                         </button>
                     </form>
                 </div>
             </li>
         </ul>
         <img src="{{ asset('assets/images/logo/logo.png') }}" width="50" alt="">

     </div>
 </nav>
