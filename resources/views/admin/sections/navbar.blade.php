@php
use Illuminate\Support\Facades\Storage;
@endphp

<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="fas fa-cog"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" class="avatar img-fluid rounded me-1" alt="{{ auth()->user()->name }}" style="width: 32px; height: 32px; object-fit: cover;" />
                    @else
                        <div class="avatar bg-primary text-white rounded me-1 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                    <span class="text-dark ms-2">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                        <i class="fas fa-user me-1"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                        <i class="fas fa-edit me-1"></i> Edit Profile
                    </a>
                    <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-1"></i> Log out
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
              @csrf
            </form>
                </div>
          </li>
    </ul>
  </div>
</nav>
