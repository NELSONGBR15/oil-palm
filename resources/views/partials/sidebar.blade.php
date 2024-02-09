<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="{{ route('home') }}" class="logo" wire:navigate>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon img-fluid" alt="logo icon">
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol in">
        <li class="sidebar-header">Menú principal</li>
        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" wire:navigate class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Inicio</span>
            </a>
        </li>
        @can('view positions')
            <li class="{{ request()->routeIs('positions.index') || request()->routeIs('positions.create') ? 'active' : '' }}">
                <a href="{{ route('positions.index') }}" wire:navigate class="{{ request()->routeIs('positions.index') || request()->routeIs('positions.create') ? 'active' : '' }}">
                    <i class="zmdi zmdi-card-travel"></i> <span>Cargos</span>
                </a>
            </li>
        @endcan
        @can('view diseases')
            <li class="{{ request()->routeIs('diseases.index') || request()->routeIs('diseases.create') ? 'active' : '' }}">
                <a href="{{ route('diseases.index') }}" wire:navigate class="{{ request()->routeIs('diseases.index') || request()->routeIs('diseases.create') ? 'active' : '' }}">
                    <i class="zmdi zmdi-card-travel"></i> <span>Enfermedades</span>
                </a>
            </li>
        @endcan
        @can('view farms')
            <li class="{{ request()->routeIs('farms.index') || request()->routeIs('farms.create') ? 'active' : '' }}">
                <a href="{{ route('farms.index') }}" wire:navigate class="{{ request()->routeIs('farms.index') || request()->routeIs('farms.create') ? 'active' : '' }}">
                    <i class="zmdi zmdi-card-travel"></i> <span>Fincas</span>
                </a>
            </li>
        @endcan
        @can('view varieties')
            <li class="{{ request()->routeIs('varieties.index') || request()->routeIs('varieties.create') ? 'active' : '' }}">
                <a href="{{ route('varieties.index') }}" wire:navigate class="{{ request()->routeIs('varieties.index') || request()->routeIs('varieties.create') ? 'active' : '' }}">
                    <i class="zmdi zmdi-card-travel"></i> <span>Variedades</span>
                </a>
            </li>
        @endcan
        @can('view lots')
            <li class="{{ request()->routeIs('lots.index') || request()->routeIs('lots.create') ? 'active' : '' }}">
                <a href="{{ route('lots.index') }}" wire:navigate class="{{ request()->routeIs('lots.index') || request()->routeIs('lots.create') ? 'active' : '' }}">
                    <i class="zmdi zmdi-card-travel"></i> <span>Lotes</span>
                </a>
            </li>
        @endcan
        @can('view users')
            <li class="{{ request()->routeIs('users.index') || request()->routeIs('users.create') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" wire:navigate class="{{ request()->routeIs('users.index') || request()->routeIs('users.create') ? 'active' : '' }}">
                    <i class="zmdi zmdi-card-travel"></i> <span>Usuarios</span>
                </a>
            </li>
        @endcan
        @can('view registers')
            <li class="{{ request()->routeIs('registers.index') || request()->routeIs('registers.create') ? 'active' : '' }}">
                <a href="{{ route('registers.index') }}" wire:navigate class="{{ request()->routeIs('registers.index') || request()->routeIs('registers.create') ? 'active' : '' }}">
                    <i class="zmdi zmdi-card-travel"></i> <span>Registros</span>
                </a>
            </li>
        @endcan
        @can('view roles')
            <li class="{{ request()->routeIs('roles.index') || request()->routeIs('roles.create') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" wire:navigate class="{{ request()->routeIs('roles.index') || request()->routeIs('roles.create') ? 'active' : '' }}">
                    <i class="zmdi zmdi-card-travel"></i> <span>Roles</span>
                </a>
            </li>
        @endcan
    </ul>
</div>
<!--End sidebar-wrapper-->
