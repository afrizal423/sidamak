@php
$links = [
    [
        "href" => "dashboard",
        "text" => "Dashboard",
        "is_multi" => false,
    ],
    [
        "href" => [
            [
                "section_text" => "User",
                "section_icon" => "fas fa-user",
                "section_list" => [
                    // ["href" => "user", "text" => "Data User"],
                    ["href" => "jenisuser", "text" => "Jenis User"]
                ]
            ]
        ],
        "text" => "User",
        "is_multi" => true,
    ],
    [
        "href" => [
            [
                "section_text" => "Kerja",
                "section_icon" => "fas fa-briefcase",
                "section_list" => [
                    ["href" => "unit_kerja", "text" => "Data Unit Kerja"],
                    ["href" => "divisi", "text" => "Data Divisi"]
                ]
            ],
            [
                "section_text" => "Pegawai",
                "section_icon" => "fas fa-users",
                "section_list" => [
                    ["href" => "dtpegawai", "text" => "Data Pegawai"],
                ]
            ]
            ,
            [
                "section_text" => "Reminder",
                "section_icon" => "fas fa-clock",
                "section_list" => [
                    ["href" => "reminder_index", "text" => "Lihat kalender"],
                    ["href" => "manage_reminder", "text" => "Manage Reminder"],
                ]
            ]
        ],
        "text" => "Master Data",
        "is_multi" => true,
    ],
    [
        "href" => [
            [
                "section_text" => "Aduan",
                "section_icon" => "fas fa-info",
                "section_list" => [
                    // ["href" => "user", "text" => "Data User"],
                    ["href" => "aduan_index", "text" => "Tambah Aduan"],
                    ["href" => "manage_aduan", "text" => "Manage Aduan"],
                    ["href" => "progress_aduan", "text" => "Progress Aduan"],
                    ["href" => "approval_aduan", "text" => "Approval Aduan"],
                    ["href" => "history_aduan", "text" => "History Aduan"]
                ]
            ]
        ],
        "text" => "Menu",
        "is_multi" => true,
    ],
];
$links_user = [
    [
        "href" => "dashboard",
        "text" => "Dashboard",
        "is_multi" => false,
    ],
    [
        "href" => [
            [
                "section_text" => "Aduan",
                "section_icon" => "fas fa-info",
                "section_list" => [
                    // ["href" => "user", "text" => "Data User"],
                    ["href" => "progress_aduan_user", "text" => "Progress Aduan"],
                    ["href" => "penanganan_aduan_user", "text" => "Penanganan Aduan"]
                ]
            ]
        ],
        "text" => "Menu",
        "is_multi" => true,
    ],
];
$navigation_links = array_to_object($links);
$navigation_links_user = array_to_object($links_user);
$user = auth()->user();
@endphp
@if ($user->roles == 0)
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="190px" height="140.61px" src="{{ asset('img/logo-pelindo-2.png') }}" alt=""
                style="padding-bottom: 100px">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="50px" height="40.61px" src="{{ asset('img/logo-pelindo.png') }}" alt="">
            </a>
        </div>
        @foreach ($navigation_links as $link)
        <ul class="sidebar-menu">
            <li class="menu-header">{{ $link->text }}</li>
            @if (!$link->is_multi)
            <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route($link->href) }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @else

                @foreach ($link->href as $section)
                    @php
                    $routes = collect($section->section_list)->map(function ($child) {
                        return Request::routeIs($child->href);
                    })->toArray();

                    $is_active = in_array(true, $routes);
                    @endphp

                    <li class="nav-item dropdown {{ ($is_active) ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{ $section->section_icon }}"></i> <span>{{ $section->section_text }}</span></a>
                        <ul class="dropdown-menu" {{ ($is_active) ? 'id=dropdown-menu' : '' }}>
                            @foreach ($section->section_list as $child)
                                <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach

            @endif
        </ul>
        @endforeach
    </aside>
</div>
@elseif ($user->roles == 1)
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="190px" height="140.61px" src="{{ asset('img/logo-pelindo-2.png') }}" alt=""
                style="padding-bottom: 100px">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="50px" height="40.61px" src="{{ asset('img/logo-pelindo.png') }}" alt="">
            </a>
        </div>
        @foreach ($navigation_links_user as $link)
        <ul class="sidebar-menu">
            <li class="menu-header">{{ $link->text }}</li>
            @if (!$link->is_multi)
            <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route($link->href) }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @else

                @foreach ($link->href as $section)
                    @php
                    $routes = collect($section->section_list)->map(function ($child) {
                        return Request::routeIs($child->href);
                    })->toArray();

                    $is_active = in_array(true, $routes);
                    @endphp

                    <li class="nav-item dropdown {{ ($is_active) ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{ $section->section_icon }}"></i> <span>{{ $section->section_text }}</span></a>
                        <ul class="dropdown-menu" {{ ($is_active) ? 'id=dropdown-menu' : '' }}>
                            @foreach ($section->section_list as $child)
                                <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach

            @endif
        </ul>
        @endforeach
    </aside>
</div>
@endif


{{-- code dibawah ini untuk perubahan sidebar ke html biasa
tanpa loop php --}}

{{-- <div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                {{-- <img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
                asd
            </a>
        </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
              <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
            </ul>
          </li>
          <li class="menu-header">Starter</li>
          <li class="nav-item dropdown active">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
            <ul class="dropdown-menu" id="dropdown-menu">
              <li class="active"><a class="nav-link" href="layout-default.html">Default Layout</a></li>
              <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
              <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
            </ul>
          </li>
          <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>

          <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div>
    </aside>
  </div> --}}
