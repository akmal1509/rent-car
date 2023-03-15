<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('admin/dashboard') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('admin/dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            @foreach (AppHelper::getMenus() as $menu)
                @if ($menu->subMenus->isEmpty())
                    <li class="{{ Request::is('admin/' . $menu->slug) ? 'active' : '' }}">
                        <a href="{{ '/admin/' . $menu->slug }}" class="nav-link">
                            <i class="{{ $menu->icon }}"></i>
                            <span>{{ $menu->name }}</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown {{ $type_menu == $menu->slug ? 'active' : '' }} ">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="{{ $menu->icon }}"></i>
                            <span>{{ $menu->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($menu->subMenus as $sub)
                                <li class="{{ Request::is('admin/' . $sub->slug) ? 'active' : '' }}">
                                    <a href="{{ '/admin/' . $sub->slug }}" class="nav-link">
                                        <span>{{ $sub->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
