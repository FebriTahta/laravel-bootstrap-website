
<div class="rbt-main-navigation d-none d-xl-block">
    <nav class="mainmenu-nav">
        <ul class="mainmenu">
            @foreach ($menus as $menu)
            <li class="has-dropdown has-menu-child-item">
                <a
                @if ($menu->konten)
                    href="/post/{{$menu->konten->konten_slug}}" 
                @else
                    href="#"     
                @endif 
                
                class="text-capitalize">{{$menu->menu_name}}
                    @if ($menu->submenu_count > 0)
                        <i class="feather-chevron-down"></i>
                    @endif
                </a>

                
                @if ($menu->submenu_count > 0)
                    <ul class="submenu">
                        @foreach ($menu->submenu as $item)
                            <li><a
                                @if ($item->konten)
                                    href="/post/{{$item->konten->konten_slug}}"
                                @else
                                    href="#"
                                @endif 
                                class="text-capitalize">{{$item->submenu_name}}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </nav>
</div>