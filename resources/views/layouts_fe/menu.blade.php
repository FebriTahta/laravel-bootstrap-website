
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
            <li class="has-dropdown has-menu-child-item">
                <a href="javascript:void(0)">Alumni  <i class="feather-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="{{route('alumni')}}">Daftar Alumni</a></li>
                    <li><a href="{{route('registrasi.alumni')}}">Form Pendataan Alumni</a></li>
                    <li><a href="{{route('ulasan')}}">Form Ulasan</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>