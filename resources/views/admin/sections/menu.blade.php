@php
use Illuminate\Support\Facades\Storage;
@endphp

<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <span class="align-middle">
                <img src="{{ asset('assets/img/encore-events-logo.png') }}" alt="Encore Events" style="height: 32px; width: auto; margin-right: 8px;">
                Encore Events
            </span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Management
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.event-teams.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.event-teams.index') }}">
                    <i class="fas fa-users"></i> <span class="align-middle">Event Teams</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-tag"></i> <span class="align-middle">Categories</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.subcategories.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.subcategories.index') }}">
                    <i class="fas fa-tags"></i> <span class="align-middle">Subcategories</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.team-members.index') }}">
                    <i class="fas fa-user-check"></i> <span class="align-middle">Team Members</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.clients.index') }}">
                    <i class="fas fa-users"></i> <span class="align-middle">Clients</span>
                </a>
            </li>

            <li class="sidebar-header">
                Items
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.decoration-items.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.decoration-items.index') }}">
                    <i class="fas fa-palette"></i> <span class="align-middle">Decoration Items</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.service-items.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.service-items.index') }}">
                    <i class="fas fa-cogs"></i> <span class="align-middle">Service Items</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.food-items.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.food-items.index') }}">
                    <i class="fas fa-utensils"></i> <span class="align-middle">Food Items</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.galleries.index') }}">
                    <i class="fas fa-images"></i> <span class="align-middle">Gallery</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.seatings.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.seatings.index') }}">
                    <i class="fas fa-chair"></i> <span class="align-middle">Seating</span>
                </a>
            </li>

            <li class="sidebar-header">
                Reviews
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.reviews.index') }}">
                    <i class="fas fa-star"></i> <span class="align-middle">Customer Reviews</span>
                </a>
            </li>

            <li class="sidebar-header">
                Reports
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.reports.estimations') }}">
                    <i class="fas fa-chart-bar"></i> <span class="align-middle">Estimation Reports</span>
                </a>
            </li>

            <li class="sidebar-header">
                System
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-cog"></i> <span class="align-middle">Settings</span>
                </a>
            </li>

            <li class="sidebar-header">
                Account
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.profile.show') }}">
                    <i class="fas fa-user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>