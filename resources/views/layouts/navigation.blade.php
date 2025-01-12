<nav class="navbar navbar-expand-xl p-0" id="navbar-area">
    <div class="container p-0">        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-lg-0 p-0">
                @foreach ($menus as $menu) 
                    {{-- main menu --}}
                    @if (!$menu->sub_menus_count)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url($menu->url) }}">
                                {{ $menu->title }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <button class="nav-link dropdown-toggle">
                                {{ $menu->title }}
                            </button>
                            <ul class="dropdown-menu dropdown-hidden">
                                @foreach ($menu->subMenus as $subMenu)
                                    {{-- DROP DOWN MENU --}}
                                    @if (!$subMenu->sub_menus_count)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ url($subMenu->url) }}">{{ $subMenu->title }}
                                            </a>
                                        </li>
                                    @else
                                        <li class="dropdown-item dropdown">
                                            <button class="nav-link dropdown-toggle">
                                                {{ $subMenu->title }}
                                        </button>
                                            <ul class="dropdown-menu dropdown-hidden">
                                                @foreach ($subMenu->subMenus as $subSubMenu)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ url($subSubMenu->url) }}">{{ $subSubMenu->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach                
            </ul>
        </div>
    </div>

</nav>
